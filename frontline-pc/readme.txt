=== Frontline PC ===

Contributors: frontlinepc
Requires at least: 6.7
Tested up to: 7.1
Requires PHP: 8.2
Stable tag: 1.0.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Tags: e-commerce, full-site-editing, custom-logo, custom-menu, translation-ready, block-patterns, wide-blocks

Block theme for the Frontline PC WooCommerce store, built from the Frontline PC design system.

== Description ==

Deep-navy authority, electric-blue energy and frosted "liquid glass" accents on a
soft light canvas. Norwegian (bokmal) storefront: prices incl. mva, nb_NO number
formatting, currency read from WooCommerce rather than hardcoded.

Every design token from the Frontline PC design system is expressed in theme.json
using the design system's own names, so var(--wp--preset--color--navy-800) stays
recognisable against the source. Fonts are bundled; the theme makes no external
requests.

== Frequently Asked Questions ==

= Which products appear in the front-page grid? =

The three-up grid is a WooCommerce Product Collection sourced from the Featured
flag, limited to three. Star exactly three products in WooCommerce to control it.
No category slug is hardcoded anywhere in the theme.

= Why does the theme register blocks? =

The design's product card shows a spec table, a stock pill and an instalment line
that no core or WooCommerce block provides. They read their product from block
context so the card stays real data. Theme Check flags register_block_type() as
plugin territory; that rule governs the WordPress.org theme directory and does not
apply to this bespoke theme.

= Is the instalment figure a real Klarna quote? =

No. It is a presentational estimate using the artboard's formula (price divided by
months, rounded to the nearest 10). Filter frontline_pc_installment_amount to hook
a real gateway quote, or return 0 to hide the line.

== Copyright ==

Frontline PC WordPress theme, (C) 2026 Frontline PC AS.
Frontline PC is distributed under the terms of the GNU GPL v2 or later.

Chakra Petch, Space Grotesk, JetBrains Mono
  (C) their respective authors, SIL Open Font License 1.1
  https://scripts.sil.org/OFL

Lucide icons
  (C) Lucide Contributors, ISC License
  https://github.com/lucide-icons/lucide/blob/main/LICENSE

== Changelog ==

= 1.0.0 =
* Initial release. Front page implemented from "Frontline PC Forside.dc.html".
