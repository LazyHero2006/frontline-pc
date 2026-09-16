<?php
/**
 * Title: 404 content
 * Slug: frontline-pc/error-404
 * Categories: frontline-pc
 * Inserter: no
 * Description: Message and search shown when nothing matches the URL.
 *
 * @package Frontline_PC
 */

$frontline_pc_shop = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );

?>
<!-- wp:group {"className":"fl-wrap fl-page","layout":{"type":"default"}} -->
<div class="wp-block-group fl-wrap fl-page">
	<!-- wp:paragraph {"className":"fl-eyebrow"} -->
	<p class="fl-eyebrow"><?php echo esc_html__( 'Feil 404', 'frontline-pc' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:heading {"level":1} -->
	<h1 class="wp-block-heading"><?php echo esc_html__( 'Denne siden finnes ikke', 'frontline-pc' ); ?></h1>
	<!-- /wp:heading -->

	<!-- wp:paragraph {"className":"fl-prose"} -->
	<p class="fl-prose"><?php echo esc_html__( 'Lenken kan være utdatert, eller så har maskinen du lette etter fått nytt navn. Prøv et søk, eller se hele utvalget.', 'frontline-pc' ); ?></p>
	<!-- /wp:paragraph -->

	<!-- wp:search {"label":"<?php echo esc_attr__( 'Søk', 'frontline-pc' ); ?>","showLabel":false,"placeholder":"<?php echo esc_attr__( 'Søk etter maskiner', 'frontline-pc' ); ?>","buttonText":"<?php echo esc_attr__( 'Søk', 'frontline-pc' ); ?>"} /-->

	<!-- wp:html -->
	<p><a class="fl-btn fl-btn--accent" href="<?php echo esc_url( $frontline_pc_shop ); ?>"><?php echo esc_html__( 'Se alle maskiner', 'frontline-pc' ); ?><?php frontline_pc_the_icon( 'arrow-right' ); ?></a></p>
	<!-- /wp:html -->
</div>
<!-- /wp:group -->
