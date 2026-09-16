<?php
/**
 * Title: Announcement bar
 * Slug: frontline-pc/announcement-bar
 * Categories: frontline-pc, banner
 * Description: Blue promise strip above the header.
 * Keywords: frakt, levering, usp, banner
 * Viewport Width: 1400
 *
 * @package Frontline_PC
 */

$frontline_pc_promises = array(
	__( 'Fri frakt over 1 500,–', 'frontline-pc' ),
	__( 'Bygget og testet i Norge', 'frontline-pc' ),
	__( 'Levering 3–5 dager', 'frontline-pc' ),
);

$frontline_pc_promises = array_values( array_filter( array_map( 'trim', $frontline_pc_promises ) ) );

if ( empty( $frontline_pc_promises ) ) {
	return;
}

$frontline_pc_last = count( $frontline_pc_promises ) - 1;

?>
<!-- wp:group {"tagName":"aside","className":"fl-announce","layout":{"type":"default"}} -->
<aside class="wp-block-group fl-announce">
	<?php foreach ( $frontline_pc_promises as $frontline_pc_i => $frontline_pc_promise ) : ?>
	<!-- wp:paragraph {"className":"fl-announce__item","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
	<p class="fl-announce__item" style="margin-top:0;margin-bottom:0"><?php echo esc_html( $frontline_pc_promise ); ?></p>
	<!-- /wp:paragraph -->

		<?php if ( $frontline_pc_i !== $frontline_pc_last ) : ?>
	<!-- wp:paragraph {"className":"fl-announce__sep","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
	<p class="fl-announce__sep" style="margin-top:0;margin-bottom:0" aria-hidden="true">·</p>
	<!-- /wp:paragraph -->
		<?php endif; ?>
	<?php endforeach; ?>
</aside>
<!-- /wp:group -->
