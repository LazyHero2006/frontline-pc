<?php
/**
 * Render the "fra kr X/mnd" instalment line.
 *
 * Renders NOTHING by default. A price/12 estimate is credit marketing, which in
 * Norway carries disclosure obligations the theme cannot satisfy on its own, so
 * the line is opt-in: frontline_pc_installment_amount must return a real figure
 * from the gateway before anything is shown. The artboard's own formula is
 * passed to the filter as $estimate for convenience, but is never the default.
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

$frontline_pc_price = (float) wc_get_price_to_display( $frontline_pc_product );

if ( $frontline_pc_price <= 0 ) {
	return;
}

$frontline_pc_months   = isset( $attributes['months'] ) ? max( 1, (int) $attributes['months'] ) : 12;
$frontline_pc_estimate = round( $frontline_pc_price / $frontline_pc_months / 10 ) * 10;

/**
 * Filters the monthly instalment figure shown on a product card.
 *
 * Zero by default, which hides the line. Return a real per-month figure from
 * Klarna or Vipps — together with whatever disclosure your agreement and
 * finansavtaleloven require — to switch it on. Returning $estimate advertises
 * an unverified rate; do not do that on a live shop.
 *
 * @since 1.0.0
 *
 * @param float      $amount   Monthly amount to display. 0 hides the line.
 * @param WC_Product $product  The product being rendered.
 * @param int        $months   Number of months the estimate assumes.
 * @param float      $estimate The artboard's price/months formula, for reference.
 */
$frontline_pc_amount = (float) apply_filters(
	'frontline_pc_installment_amount',
	0.0,
	$frontline_pc_product,
	$frontline_pc_months,
	$frontline_pc_estimate
);

if ( $frontline_pc_amount <= 0 ) {
	return;
}

$frontline_pc_suffix = wc_prices_include_tax()
	? __( 'inkl. mva', 'frontline-pc' )
	: __( 'eks. mva', 'frontline-pc' );

$frontline_pc_from = ! empty( $attributes['fromLabel'] ) ? $attributes['fromLabel'] : __( 'fra', 'frontline-pc' );
$frontline_pc_per  = ! empty( $attributes['perMonthLabel'] ) ? $attributes['perMonthLabel'] : __( '/mnd', 'frontline-pc' );

$frontline_pc_text = sprintf(
	/* translators: 1: "from" label, 2: formatted amount, 3: per-month label, 4: tax suffix. */
	__( '%1$s %2$s%3$s %4$s', 'frontline-pc' ),
	$frontline_pc_from,
	wp_strip_all_tags( wc_price( $frontline_pc_amount ) ),
	$frontline_pc_per,
	$frontline_pc_suffix
);

?>
<div <?php echo wp_kses_data( get_block_wrapper_attributes( array( 'class' => 'fl-tiers__vat' ) ) ); ?>>
	<?php echo esc_html( $frontline_pc_text ); ?>
</div>
