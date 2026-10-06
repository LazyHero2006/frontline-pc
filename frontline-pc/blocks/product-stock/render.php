<?php
/**
 * Render the stock-status badge.
 *
 * @package Frontline_PC
 *
 * @var array    $attributes Block attributes.
 * @var string   $content    Block content.
 * @var WP_Block $block      Block instance.
 */

defined( 'ABSPATH' ) || exit;

// Context comes from the product template; fall back to the loop's current
// post so the card also works when rendered through a pattern reference.
$frontline_pc_post_id = isset( $block->context['postId'] ) ? (int) $block->context['postId'] : (int) get_the_ID();

if ( ! $frontline_pc_post_id || ! function_exists( 'wc_get_product' ) ) {
	return;
}

$frontline_pc_product = wc_get_product( $frontline_pc_post_id );

if ( ! $frontline_pc_product ) {
	return;
}

/*
 * A plain uppercase label on the page background — no tinted pill, no status
 * dot, no rounded chip. Type and colour carry the status on their own.
 *
 * The machines are built after the order is placed, so "På lager" would be
 * untrue for them: nothing sits on a shelf. Accessories are ordinary stocked
 * goods and keep the plain in-stock wording. Which products are built to order
 * is decided by the product category and can be changed with the
 * frontline_pc_is_built_to_order filter, without touching this file.
 *
 * The block attribute wins when the owner has edited it in the editor; the
 * __() default is the fallback, so every string also stays in the .pot for
 * Loco Translate.
 *
 * Backorder is tested before stock: WooCommerce reports a backordered product
 * as in stock, so the opposite order would make that branch unreachable.
 */
$frontline_pc_built_to_order = has_term( 'pc-er', 'product_cat', $frontline_pc_post_id );

/**
 * Whether a product is built to order rather than stocked.
 *
 * @since 1.0.0
 *
 * @param bool       $built_to_order Whether the product is built to order.
 * @param WC_Product $product        The product being rendered.
 */
$frontline_pc_built_to_order = (bool) apply_filters( 'frontline_pc_is_built_to_order', $frontline_pc_built_to_order, $frontline_pc_product );

if ( ! $frontline_pc_product->is_in_stock() ) {
	$frontline_pc_label = ! empty( $attributes['outOfStockLabel'] ) ? $attributes['outOfStockLabel'] : __( 'Utsolgt', 'frontline-pc' );
	$frontline_pc_class = 'fl-stock fl-stock--out';
} elseif ( $frontline_pc_product->is_on_backorder( 1 ) ) {
	$frontline_pc_label = ! empty( $attributes['backorderLabel'] ) ? $attributes['backorderLabel'] : __( 'På restordre', 'frontline-pc' );
	$frontline_pc_class = 'fl-stock fl-stock--backorder';
} elseif ( $frontline_pc_built_to_order ) {
	$frontline_pc_label = ! empty( $attributes['builtToOrderLabel'] ) ? $attributes['builtToOrderLabel'] : __( 'Bygges på bestilling', 'frontline-pc' );
	$frontline_pc_class = 'fl-stock fl-stock--order';
} else {
	$frontline_pc_label = ! empty( $attributes['inStockLabel'] ) ? $attributes['inStockLabel'] : __( 'På lager', 'frontline-pc' );
	$frontline_pc_class = 'fl-stock fl-stock--in';
}

?>
<span <?php echo wp_kses_data( get_block_wrapper_attributes( array( 'class' => $frontline_pc_class ) ) ); ?>><?php echo esc_html( $frontline_pc_label ); ?></span>
