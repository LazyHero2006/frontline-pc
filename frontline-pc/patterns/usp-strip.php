<?php
/**
 * Title: USP / trust strip
 * Slug: frontline-pc/usp-strip
 * Categories: frontline-pc, featured
 * Description: Five trust points on white, under the hero.
 * Keywords: usp, trust, garanti, frakt, betaling
 * Viewport Width: 1400
 *
 * @package Frontline_PC
 */

$frontline_pc_usps = array(
	array( 'wrench', __( 'Bygget i Norge', 'frontline-pc' ) ),
	array( 'shield-check', __( 'Norsk garanti & service', 'frontline-pc' ) ),
	array( 'truck', __( 'Fri frakt over 1 500,–', 'frontline-pc' ) ),
	array( 'credit-card', __( 'Delbetaling: Klarna & Vipps', 'frontline-pc' ) ),
	array( 'package-check', __( 'Levering 3–5 dager', 'frontline-pc' ) ),
);

?>
<!-- wp:group {"tagName":"section","className":"fl-usp","layout":{"type":"default"}} -->
<section class="wp-block-group fl-usp">
	<!-- wp:group {"className":"fl-wrap fl-usp__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group fl-wrap fl-usp__inner">
		<?php foreach ( $frontline_pc_usps as $frontline_pc_usp ) : ?>
		<!-- wp:group {"className":"fl-usp__item","layout":{"type":"default"}} -->
		<div class="wp-block-group fl-usp__item">
			<!-- wp:html -->
			<?php frontline_pc_the_icon( $frontline_pc_usp[0] ); ?>
			<!-- /wp:html -->

			<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
			<p style="margin-top:0;margin-bottom:0"><?php echo esc_html( $frontline_pc_usp[1] ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
		<?php endforeach; ?>
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
