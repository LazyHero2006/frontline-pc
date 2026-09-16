<?php
/**
 * Render the product price.
 *
 * WooCommerce's own woocommerce/product-price declares an ancestor of
 * woocommerce/single-product (or a query loop), which this template does not
 * use, so the editor flags it as invalid content on every load. This renders
 * the same value — get_price_html() still passes through the theme's "fra"
 * filter — without that constraint.
 *
 * @package Frontline_PC
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block content.
 * @var WP_Block $block      Block instance.
 */

defined( 'ABSPATH' ) || exit;

$frontline_pc_post_id = isset( $block->context['postId'] ) ? (int) $block->context['postId'] : (int) get_the_ID();

if ( ! $frontline_pc_post_id || ! function_exists( 'wc_get_product' ) ) {
	return;
}

$frontline_pc_product = wc_get_product( $frontline_pc_post_id );

if ( ! $frontline_pc_product ) {
	return;
}

$frontline_pc_price = $frontline_pc_product->get_price_html();

if ( ! $frontline_pc_price ) {
	return;
}

?>
<div <?php echo wp_kses_data( get_block_wrapper_attributes( array( 'class' => 'fl-product-price' ) ) ); ?>>
	<?php
	/*
	 * wp_kses_post() drops <bdi>, which WooCommerce uses to isolate the amount
	 * from surrounding text direction, so it is allowed back in explicitly.
	 */
	$frontline_pc_allowed         = wp_kses_allowed_html( 'post' );
	$frontline_pc_allowed['bdi']  = array( 'class' => true );
	$frontline_pc_allowed['span'] = array( 'class' => true );

	echo wp_kses( $frontline_pc_price, $frontline_pc_allowed );
	?>
</div>
