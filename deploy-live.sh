#!/usr/bin/env bash
#
# Deploy frontline-pc theme files to live, purge the page cache, verify as a customer.
#
#   ./deploy-live.sh assets/css/frontline.css parts/header.html ...
#
# A deploy is finished when customers get the new files, not when the files are copied.
# The Super Page Cache plugin never watches theme files, so every deploy ends with a purge
# through the plugin's own hook, and verification loads plain URLs exactly as a visitor
# does — no cache-busting parameters. Any step that does not hold stops the script.
#
# Files only: nothing outside wp-content/themes/frontline-pc/ is written, apart from the
# purge, which the cache plugin performs itself. Never activates the theme.

set -euo pipefail

THEME=/home/starscream/frontline-pc-theme/frontline-pc
CONTAINER=customer-site-1-wordpress-1
DEST=/var/www/html/wp-content/themes/frontline-pc
SITE=https://frontlinepc.no
CHECK_PATHS=(/ /products/ /product-category/frontline-fighter/ /cart/ /checkout/)

fail() { echo "STOPP: $*" >&2; exit 1; }

[ $# -gt 0 ] || { echo "bruk: $0 <sti relativt til temaet> ..." >&2; exit 2; }
for f in "$@"; do
	[ -f "$THEME/$f" ] || fail "finnes ikke lokalt: $f"
	case "$f" in /*|*..*) fail "ugyldig sti: $f" ;; esac
done

echo "1/5  php -l på alle PHP-filer (kasteboks-container)"
docker run --rm -v "$THEME":/src:ro php:8.3-cli sh -c '
	for p in $(find /src -name "*.php"); do php -l "$p" >/dev/null 2>&1 || { php -l "$p"; exit 1; }; done' \
	|| fail "syntaksfeil — ingenting er kopiert"

echo "2/5  kopierer ${#} fil(er)"
for f in "$@"; do
	docker exec "$CONTAINER" mkdir -p "$(dirname "$DEST/$f")"
	docker cp "$THEME/$f" "$CONTAINER:$DEST/$f"
	docker exec "$CONTAINER" chown www-data:www-data "$DEST/$f"
	echo "     -> $f"
done

echo "3/5  kontrollerer at live er identisk med lokalt"
for f in "$@"; do
	a=$(md5sum < "$THEME/$f" | cut -c1-32)
	b=$(docker exec "$CONTAINER" md5sum "$DEST/$f" | cut -c1-32)
	[ "$a" = "$b" ] || fail "avvik etter kopiering: $f"
done
docker exec "$CONTAINER" sh -c "cd $DEST && for p in \$(find . -name '*.php'); do php -l \"\$p\" >/dev/null || exit 1; done" \
	|| fail "php -l feilet i live-containeren"

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
[ "$bad" = 0 ] || fail "minst én side leverer ikke det som ble deployet"

echo "FERDIG: filene er ute, bufferen er tømt, og kundene får frontline.css?ver=$cssver"
