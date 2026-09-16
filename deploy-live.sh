#!/usr/bin/env bash
# Usage: ./deploy-live.sh <paths…> deploys the working tree (must be committed AND pushed to origin/main) · ./deploy-live.sh --commit <rev> [paths…] redeploys a pushed commit, e.g. rollback after a failed step 5: --commit HEAD~1 (no paths = whole theme, removing files that commit lacks).
#
# Deploy frontline-pc theme files to live, purge the page cache, verify as a customer.
#
#   ./deploy-live.sh assets/css/frontline.css parts/header.html ...
#   ./deploy-live.sh --commit HEAD~1                  roll the whole theme back one commit
#   ./deploy-live.sh --commit 687dc20 parts/footer.html   one file as it was in a commit
#
# Only what exists off-server is deployed. Working-tree mode stops on uncommitted changes
# and on local commits not yet pushed; commit mode stops unless GitHub already has the
# commit. Commit mode reads files with `git archive` into a temporary folder, so the
# working tree and branch are never touched during a recovery.
#
# A deploy is finished when customers get the new files, not when the files are copied.
# The Super Page Cache plugin never watches theme files, so every deploy ends with a purge
# through the plugin's own hook, and verification loads plain URLs exactly as a visitor
# does — no cache-busting parameters. Any step that does not hold stops the script.
#
# Files only: nothing outside wp-content/themes/frontline-pc/ is written, apart from the
# purge, which the cache plugin performs itself. Never activates the theme.

set -euo pipefail

REPO=/home/starscream/frontline-pc-theme
THEME_DIR=frontline-pc
CONTAINER=customer-site-1-wordpress-1
DEST=/var/www/html/wp-content/themes/frontline-pc
SITE=https://frontlinepc.no
BRANCH=main
CHECK_PATHS=(/ /products/ /product-category/frontline-fighter/ /cart/ /checkout/)

fail() { echo "STOPP: $*" >&2; exit 1; }
g() { git -C "$REPO" "$@"; }

# ── Arguments ───────────────────────────────────────────────────────────────
MODE=worktree
REV=
if [ "${1:-}" = "--commit" ]; then
	MODE=commit
	REV=${2:-}
	[ -n "$REV" ] || { echo "bruk: $0 --commit <commit> [sti ...]" >&2; exit 2; }
	shift 2
fi
PATHS=("$@")
[ "$MODE" = commit ] || [ ${#PATHS[@]} -gt 0 ] || { echo "bruk: $0 <sti relativt til temaet> ...   eller   $0 --commit <commit> [sti ...]" >&2; exit 2; }
for f in "${PATHS[@]}"; do
	case "$f" in /*|*..*|"") fail "ugyldig sti: $f" ;; esac
done

# ── 0/5 Off-server copy ─────────────────────────────────────────────────────
echo "0/5  kontrollerer at det som deployes finnes på GitHub (origin/$BRANCH)"

# What GitHub actually has, asked directly — not the local tracking ref, which only
# reflects the last fetch or push from this machine.
remote_sha=$(GIT_TERMINAL_PROMPT=0 g ls-remote origin "refs/heads/$BRANCH" | cut -f1) \
	|| fail "får ikke kontakt med origin — kan ikke bekrefte en kopi utenfor serveren"
[ -n "$remote_sha" ] || fail "origin har ingen gren $BRANCH"
g cat-file -e "${remote_sha}^{commit}" 2>/dev/null \
	|| fail "GitHub har commits som ikke finnes lokalt (origin/$BRANCH = ${remote_sha:0:7}). Kjør git pull og se hva som er endret før du deployer."

if [ "$MODE" = worktree ]; then
	branch=$(g symbolic-ref --quiet --short HEAD || echo "(løsrevet HEAD)")
	[ "$branch" = "$BRANCH" ] || fail "står på $branch, ikke $BRANCH"

	dirty=$(g status --porcelain --untracked-files=all)
	if [ -n "$dirty" ]; then
		echo "     ucommittede endringer (ikke i git, og dermed ikke på GitHub):" >&2
		echo "$dirty" | sed 's/^/       /' >&2
		fail "$(echo "$dirty" | wc -l) fil(er) er ikke committet — commit og push før deploy"
	fi

	ahead=$(g rev-list --count "${remote_sha}..HEAD")
	if [ "$ahead" -gt 0 ]; then
		echo "     commits på $BRANCH som GitHub ikke har:" >&2
		g log --oneline "${remote_sha}..HEAD" | sed 's/^/       /' >&2
		fail "$BRANCH er $ahead commit(s) foran origin/$BRANCH — push før deploy"
	fi
	behind=$(g rev-list --count "HEAD..${remote_sha}")
	[ "$behind" -eq 0 ] || fail "$BRANCH er $behind commit(s) bak origin/$BRANCH — kjør git pull, ellers deployes en eldre versjon enn den som er sikret"

	DEPLOY_SHA=$(g rev-parse HEAD)
	SRC="$REPO/$THEME_DIR"
	echo "     rent arbeidstre, $BRANCH = origin/$BRANCH = ${DEPLOY_SHA:0:7}"
else
	DEPLOY_SHA=$(g rev-parse --verify --quiet "${REV}^{commit}") || fail "ukjent commit: $REV"
	g merge-base --is-ancestor "$DEPLOY_SHA" "$remote_sha" \
		|| fail "commit ${DEPLOY_SHA:0:7} finnes ikke på GitHub (ikke i origin/$BRANCH) — push den først"
	g cat-file -e "${DEPLOY_SHA}:${THEME_DIR}" 2>/dev/null || fail "commit ${DEPLOY_SHA:0:7} inneholder ikke $THEME_DIR/"

	WORK=$(mktemp -d)
	trap 'rm -rf "$WORK"' EXIT
	g archive "$DEPLOY_SHA" "$THEME_DIR" | tar -x -C "$WORK"
	SRC="$WORK/$THEME_DIR"
	echo "     deployer commit ${DEPLOY_SHA:0:7} ($(g log -1 --format='%ad, %s' --date=short "$DEPLOY_SHA"))"
	echo "     arbeidstreet og grenen røres ikke"
fi

# Files to copy, and live files to remove (commit mode only).
COPY=()
REMOVE=()
if [ ${#PATHS[@]} -gt 0 ]; then
	for f in "${PATHS[@]}"; do
		if [ -f "$SRC/$f" ]; then
			COPY+=("$f")
		elif [ "$MODE" = commit ]; then
			REMOVE+=("$f")   # absent in the target commit: restoring that commit means removing it
		else
			fail "finnes ikke lokalt: $f"
		fi
	done
else
	# Whole theme: every file in the commit, and every live file the commit does not have.
	while IFS= read -r f; do COPY+=("$f"); done < <(cd "$SRC" && find . -type f | sed 's#^\./##' | sort)
	while IFS= read -r f; do
		[ -f "$SRC/$f" ] || REMOVE+=("$f")
	done < <(docker exec "$CONTAINER" sh -c "cd $DEST && find . -type f" | sed 's#^\./##' | sort)
fi

# A live file is only removed if git can give it back: it must exist somewhere in the
# pushed history. Anything else was put on the server by hand and is not ours to delete.
for f in "${REMOVE[@]}"; do
	docker exec "$CONTAINER" test -f "$DEST/$f" || continue
	[ -n "$(g log --format=%H -n 1 "$remote_sha" -- "$THEME_DIR/$f")" ] \
		|| fail "live-filen $f finnes ikke i git-historikken på GitHub — slettes ikke automatisk. Ta en kopi og fjern den manuelt."
done

# ── 1/5 Lint ────────────────────────────────────────────────────────────────
echo "1/5  php -l på alle PHP-filer som deployes (kasteboks-container)"
docker run --rm -v "$SRC":/src:ro php:8.3-cli sh -c '
	for p in $(find /src -name "*.php"); do php -l "$p" >/dev/null 2>&1 || { php -l "$p"; exit 1; }; done' \
	|| fail "syntaksfeil — ingenting er kopiert"

# ── 2/5 Copy ────────────────────────────────────────────────────────────────
echo "2/5  kopierer ${#COPY[@]} fil(er)$([ ${#REMOVE[@]} -gt 0 ] && echo ", fjerner ${#REMOVE[@]}")"
for f in "${COPY[@]}"; do
	docker exec "$CONTAINER" mkdir -p "$(dirname "$DEST/$f")"
	docker cp "$SRC/$f" "$CONTAINER:$DEST/$f"
	docker exec "$CONTAINER" chown www-data:www-data "$DEST/$f"
	[ ${#COPY[@]} -gt 12 ] || echo "     -> $f"
done
[ ${#COPY[@]} -le 12 ] || echo "     -> ${#COPY[@]} filer (hele temaet)"
for f in "${REMOVE[@]}"; do
	if docker exec "$CONTAINER" test -f "$DEST/$f"; then
		docker exec "$CONTAINER" rm -f "$DEST/$f"
		echo "     x  $f (finnes ikke i ${DEPLOY_SHA:0:7})"
	fi
done

# ── 3/5 Identical ───────────────────────────────────────────────────────────
echo "3/5  kontrollerer at live er identisk med ${DEPLOY_SHA:0:7}"
for f in "${COPY[@]}"; do
	a=$(md5sum < "$SRC/$f" | cut -c1-32)
	b=$(docker exec "$CONTAINER" md5sum "$DEST/$f" | cut -c1-32)
	[ "$a" = "$b" ] || fail "avvik etter kopiering: $f"
done
for f in "${REMOVE[@]}"; do
	! docker exec "$CONTAINER" test -e "$DEST/$f" || fail "ble ikke fjernet: $f"
done
docker exec "$CONTAINER" sh -c "cd $DEST && for p in \$(find . -name '*.php'); do php -l \"\$p\" >/dev/null || exit 1; done" \
	|| fail "php -l feilet i live-containeren"

# ── 4/5 Purge ───────────────────────────────────────────────────────────────
echo "4/5  tømmer sidebufferen via pluginens hook (swcfpc_purge_cache)"
docker exec -i "$CONTAINER" php <<'PHP' || fail "bufferen ble ikke tømt — kunder kan få gamle filer"
<?php
define( 'WP_USE_THEMES', false );
error_reporting( E_ERROR );
require '/var/www/html/wp-load.php';
$dir   = WP_CONTENT_DIR . '/wp-cloudflare-super-page-cache/' . wp_parse_url( home_url(), PHP_URL_HOST ) . '/fallback_cache/';
$count = static function () use ( $dir ) { clearstatcache(); return count( glob( $dir . '*.html' ) ?: array() ); };
$before = $count();
// Empty list = purge everything. Also asks Cloudflare to purge the zone when it is connected.
do_action( 'swcfpc_purge_cache', array() );
$after = $count();
if ( $after > 0 ) {
	// purge_all() stops before the disk cache if the Cloudflare call fails; clear the disk
	// copies with the plugin's own method so customers are not left on stale HTML.
	\SPC\Loader::get()->fallback_cache()->fallback_cache_purge_all();
	$after = $count();
	echo "     merk: Cloudflare-purge feilet eller ble hoppet over, diskbufferen tømt direkte\n";
}
printf( "     lagrede sider: %d -> %d\n", $before, $after );
exit( $after > 0 ? 1 : 0 );
PHP

# ── 5/5 Verify ──────────────────────────────────────────────────────────────
echo "5/5  verifiserer som en kunde: vanlige URL-er, ingen cache-busting"
cssver=$(docker exec "$CONTAINER" stat -c %Y "$DEST/assets/css/frontline.css")
bad=0
for path in "${CHECK_PATHS[@]}"; do
	for n in 1 2; do
		hdr=$(mktemp); body=$(mktemp)
		# -L: follow redirects as a browser does (/checkout/ with an empty cart goes to /cart/).
		code=$(curl -sSkL -D "$hdr" -o "$body" -w '%{http_code}' "$SITE$path" || echo 000)
		# A missing header or stylesheet is a finding, reported below — not a reason to abort.
		cache=$( { grep -i '^x-wp-spc-disk-cache' "$hdr" || true; } | tail -1 | awk '{print $2}' | tr -d '\r')
		ver=$( { grep -o 'frontline\.css?ver=[0-9]*' "$body" || true; } | head -1 | cut -d= -f2)
		lh=$( { grep -c 'localhost' "$body" || true; } | head -1)
		# Every problem is listed; one must not hide another (a 500 page also lacks the stylesheet).
		problems=()
		[ "$code" = 200 ] || problems+=("HTTP $code")
		[ "$ver" = "$cssver" ] || problems+=("GAMMELT STILARK (${ver:-mangler})")
		[ "$lh" = 0 ] || problems+=("localhost i siden")
		if [ ${#problems[@]} -eq 0 ]; then status=OK; else status="FEIL: $(IFS=';'; echo "${problems[*]}")"; bad=1; fi
		printf "     %-40s forespørsel %s  buffer=%-4s css=%s  %s\n" "$path" "$n" "${cache:--}" "${ver:--}" "$status"
		rm -f "$hdr" "$body"
	done
done
if [ "$bad" != 0 ]; then
	prev=$(g rev-parse --short "${DEPLOY_SHA}~1" 2>/dev/null || true)
	fail "minst én side leverer ikke det som ble deployet${prev:+ — for å rulle tilbake: $0 --commit $prev}"
fi

echo "FERDIG: ${DEPLOY_SHA:0:7} er ute, bufferen er tømt, og kundene får frontline.css?ver=$cssver"
