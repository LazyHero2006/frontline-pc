<?php
/**
 * Render the product spec rows.
 *
 * Attribute slugs vary across the catalogue (the operating-system attribute is
 * spelled both "operativsystem" and "opperativsystem"), so lookups are matched
 * loosely against the product's own attribute names.
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

/**
 * Filters which product attributes appear as spec rows on a product card.
 *
 * @since 1.0.0
 *
 * @param string[]   $slugs   Attribute slugs, in display order.
 * @param WC_Product $product The product being rendered.
 */
$frontline_pc_slugs = apply_filters(
	'frontline_pc_card_spec_attributes',
	isset( $attributes['rows'] ) ? (array) $attributes['rows'] : array(),
	$frontline_pc_product
);

/*
 * Labels come from the product's own attribute names, so they are editable
 * under Produkter → Attributter rather than being theme copy. The theme used
 * to remap them to the artboard's shorter terms (GPU, CPU, Minne, Lagring),
 * which meant the owner could not change them without editing PHP.
 */

$frontline_pc_rows = array();

// Map the product's own attribute names to values, keyed by a normalised slug.
$frontline_pc_available = array();
$frontline_pc_names     = array();

foreach ( $frontline_pc_product->get_attributes() as $frontline_pc_name => $frontline_pc_attr ) {
	$frontline_pc_key = sanitize_title( str_replace( 'pa_', '', (string) $frontline_pc_name ) );

	// The catalogue carries both spellings of the operating-system attribute.
	if ( 'opperativsystem' === $frontline_pc_key ) {
		$frontline_pc_key = 'operativsystem';
	}

	$frontline_pc_available[ $frontline_pc_key ] = $frontline_pc_product->get_attribute( $frontline_pc_name );
	$frontline_pc_names[ $frontline_pc_key ]     = wc_attribute_label( $frontline_pc_name, $frontline_pc_product );
}

foreach ( $frontline_pc_slugs as $frontline_pc_slug ) {
	$frontline_pc_slug = sanitize_title( (string) $frontline_pc_slug );

	if ( empty( $frontline_pc_available[ $frontline_pc_slug ] ) ) {
		continue;
	}

	$frontline_pc_rows[] = array(
		'key'   => $frontline_pc_names[ $frontline_pc_slug ],
		'value' => $frontline_pc_available[ $frontline_pc_slug ],
	);
}

if ( ! empty( $attributes['showSku'] ) && $frontline_pc_product->get_sku() ) {
	$frontline_pc_rows[] = array(
		'key'   => __( 'SKU', 'frontline-pc' ),
		'value' => $frontline_pc_product->get_sku(),
	);
}

if ( empty( $frontline_pc_rows ) ) {
	return;
}

?>
<div <?php echo wp_kses_data( get_block_wrapper_attributes( array( 'class' => 'fl-specs' ) ) ); ?>>
	<?php foreach ( $frontline_pc_rows as $frontline_pc_row ) : ?>
		<div class="fl-specs__row">
			<span class="fl-specs__k"><?php echo esc_html( $frontline_pc_row['key'] ); ?></span>
			<span class="fl-specs__v"><?php echo esc_html( wp_strip_all_tags( $frontline_pc_row['value'] ) ); ?></span>
		</div>
	<?php endforeach; ?>
</div>
