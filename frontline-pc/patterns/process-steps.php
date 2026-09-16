<?php
/**
 * Title: Process — four steps
 * Slug: frontline-pc/process-steps
 * Categories: frontline-pc, featured
 * Description: Dark gradient band with four frosted glass tiles describing the build process.
 * Keywords: prosess, garanti, bygging, steg
 * Viewport Width: 1400
 *
 * @package Frontline_PC
 */

$frontline_pc_steps = array(
	array( '01', 'target', __( 'Du velger klasse', 'frontline-pc' ), __( 'Fighter, Ghost, Titan eller Prism. Er du usikker, svarer vi innen en time.', 'frontline-pc' ) ),
	array( '02', 'wrench', __( 'Vi bygger for hånd', 'frontline-pc' ), __( 'Kabelføring, montering og BIOS-oppsett gjøres av én tekniker i Norge.', 'frontline-pc' ) ),
	array( '03', 'activity', __( '24 timer stresstest', 'frontline-pc' ), __( 'Full last på GPU, CPU og minne. Temperaturlogg følger med i esken.', 'frontline-pc' ) ),
	array( '04', 'truck', __( 'Levert klar til kamp', 'frontline-pc' ), __( 'Windows installert, drivere oppdatert. Slå på og spill — 3–5 dager.', 'frontline-pc' ) ),
);

?>
<!-- wp:group {"tagName":"section","className":"fl-section-dark","anchor":"garanti","layout":{"type":"default"}} -->
<section class="wp-block-group fl-section-dark" id="garanti">
	<!-- wp:html -->
	<div class="fl-section-dark__glow" aria-hidden="true"></div>
	<!-- /wp:html -->

	<!-- wp:group {"className":"fl-wrap fl-section-dark__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group fl-wrap fl-section-dark__inner">
		<!-- wp:paragraph {"className":"fl-eyebrow fl-eyebrow--on-dark"} -->
		<p class="fl-eyebrow fl-eyebrow--on-dark"><?php echo esc_html__( 'Slik bygger vi', 'frontline-pc' ); ?></p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":2} -->
		<h2 class="wp-block-heading"><?php echo esc_html__( 'Fire steg fra bestilling til første kamp', 'frontline-pc' ); ?></h2>
		<!-- /wp:heading -->

		<!-- wp:group {"className":"fl-steps","layout":{"type":"default"}} -->
		<div class="wp-block-group fl-steps">
			<?php foreach ( $frontline_pc_steps as $frontline_pc_step ) : ?>
			<!-- wp:group {"className":"fl-glass-tile","layout":{"type":"default"}} -->
			<div class="wp-block-group fl-glass-tile">
				<!-- wp:html -->
				<div class="fl-glass-tile__top">
					<?php frontline_pc_the_icon( $frontline_pc_step[1] ); ?>
					<span class="fl-glass-tile__nr"><?php echo esc_html( $frontline_pc_step[0] ); ?></span>
				</div>
				<!-- /wp:html -->

				<!-- wp:heading {"level":3} -->
				<h3 class="wp-block-heading"><?php echo esc_html( $frontline_pc_step[2] ); ?></h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph -->
				<p><?php echo esc_html( $frontline_pc_step[3] ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
			<?php endforeach; ?>
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
