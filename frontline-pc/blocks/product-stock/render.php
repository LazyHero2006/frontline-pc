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
 * dot, no rounded chip. Type and colour carry the status on their own, which
 * is also why the old success-600-on-success-100 contrast failure no longer
 * exists: that pairing is gone.
 *
 * The block attribute wins when the owner has edited it; the __() default is
 * the fallback, so the string also stays in the .pot for Loco Translate.
 */
if ( $frontline_pc_product->is_in_stock() ) {
	$frontline_pc_label = ! empty( $attributes['inStockLabel'] ) ? $attributes['inStockLabel'] : __( 'På lager', 'frontline-pc' );
	$frontline_pc_class = 'fl-stock fl-stock--in';
} elseif ( $frontline_pc_product->is_on_backorder( 1 ) ) {
	$frontline_pc_label = ! empty( $attributes['backorderLabel'] ) ? $attributes['backorderLabel'] : __( 'På restordre', 'frontline-pc' );
	$frontline_pc_class = 'fl-stock fl-stock--backorder';
} else {
	$frontline_pc_label = ! empty( $attributes['outOfStockLabel'] ) ? $attributes['outOfStockLabel'] : __( 'Utsolgt', 'frontline-pc' );
	$frontline_pc_class = 'fl-stock fl-stock--out';
}

?>
<span <?php echo wp_kses_data( get_block_wrapper_attributes( array( 'class' => $frontline_pc_class ) ) ); ?>><?php echo esc_html( $frontline_pc_label ); ?></span>
