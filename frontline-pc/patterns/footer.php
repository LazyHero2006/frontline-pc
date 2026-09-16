<?php
/**
 * Title: Footer
 * Slug: frontline-pc/footer
 * Categories: frontline-pc, footer
 * Block Types: core/template-part/footer
 * Description: Four-column navy footer with brand blurb, shop and service links, payment chips and the legal line.
 * Keywords: footer, bunn, lenker, betaling
 * Viewport Width: 1400
 *
 * @package Frontline_PC
 */

$frontline_pc_shop = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );

$frontline_pc_shop_links = array(
	array( __( 'Frontline Fighter', 'frontline-pc' ), '/product-category/frontline-fighter/' ),
	array( __( 'Frontline Ghost', 'frontline-pc' ), '/product-category/frontline-ghost/' ),
	array( __( 'Frontline Titan', 'frontline-pc' ), '/product-category/frontline-titan/' ),
	array( __( 'Frontline Elite', 'frontline-pc' ), '/product-category/frontline-elite/' ),
);

$frontline_pc_service_links = array(
	array( __( 'Garanti & service', 'frontline-pc' ), '/pc-service/' ),
	array( __( 'Om oss', 'frontline-pc' ), '/om-oss/' ),
	array( __( '3D Printing lokalt', 'frontline-pc' ), '/3d-printing-lokalt/' ),
	array( __( 'Kontakt oss', 'frontline-pc' ), '/contact-us/' ),
);

$frontline_pc_payments = array( 'Vipps', 'Klarna', 'Visa', 'Mastercard' );

$frontline_pc_copyright = sprintf(
	/* translators: %s: current year. */
	__( '© %s Frontline PC AS', 'frontline-pc' ),
	gmdate( 'Y' )
);

?>
<!-- wp:group {"tagName":"footer","className":"fl-footer","layout":{"type":"default"}} -->
<footer class="wp-block-group fl-footer">
	<!-- wp:group {"className":"fl-wrap fl-footer__cols","layout":{"type":"default"}} -->
	<div class="wp-block-group fl-wrap fl-footer__cols">

		<!-- wp:group {"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:site-logo {"width":150} /-->

			<!-- wp:paragraph {"className":"fl-footer__about"} -->
			<p class="fl-footer__about"><?php echo esc_html__( 'Frontline PC bygger driftssikre gaming-maskiner med høy ytelse. Håndbygget i Norge siden 2014.', 'frontline-pc' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:paragraph {"className":"fl-footer__title"} -->
			<p class="fl-footer__title"><?php echo esc_html__( 'Butikk', 'frontline-pc' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:html -->
			<div class="fl-footer__links">
				<?php foreach ( $frontline_pc_shop_links as $frontline_pc_link ) : ?>
					<a href="<?php echo esc_url( home_url( $frontline_pc_link[1] ) ); ?>"><?php echo esc_html( $frontline_pc_link[0] ); ?></a>
				<?php endforeach; ?>
				<a href="<?php echo esc_url( $frontline_pc_shop ); ?>"><?php echo esc_html__( 'Alle PC-er', 'frontline-pc' ); ?></a>
			</div>
			<!-- /wp:html -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:paragraph {"className":"fl-footer__title"} -->
			<p class="fl-footer__title"><?php echo esc_html__( 'Kundeservice', 'frontline-pc' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:html -->
			<div class="fl-footer__links">
				<?php foreach ( $frontline_pc_service_links as $frontline_pc_link ) : ?>
					<a href="<?php echo esc_url( home_url( $frontline_pc_link[1] ) ); ?>"><?php echo esc_html( $frontline_pc_link[0] ); ?></a>
				<?php endforeach; ?>
			</div>
			<!-- /wp:html -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"layout":{"type":"default"}} -->
		<div class="wp-block-group">
			<!-- wp:paragraph {"className":"fl-footer__title"} -->
			<p class="fl-footer__title"><?php echo esc_html__( 'Betaling', 'frontline-pc' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:html -->
			<div class="fl-footer__pay">
				<?php foreach ( $frontline_pc_payments as $frontline_pc_payment ) : ?>
					<span class="fl-chip"><?php echo esc_html( $frontline_pc_payment ); ?></span>
				<?php endforeach; ?>
			</div>
			<!-- /wp:html -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"className":"fl-wrap fl-footer__legal","layout":{"type":"default"}} -->
	<div class="wp-block-group fl-wrap fl-footer__legal">
		<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
		<p style="margin-top:0;margin-bottom:0"><?php echo esc_html( $frontline_pc_copyright ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
		<p style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Alle priser inkl. mva.', 'frontline-pc' ); ?></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->
</footer>
<!-- /wp:group -->
