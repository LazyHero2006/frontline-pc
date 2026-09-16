<?php
/**
 * Title: Hero — Real Gaming
 * Slug: frontline-pc/hero
 * Categories: frontline-pc, featured
 * Description: Navy gradient hero with eyebrow pill, headline, CTAs, rating and a product still with a glass spec strip.
 * Keywords: hero, forside, gaming, cta
 * Viewport Width: 1400
 *
 * @package Frontline_PC
 */

$frontline_pc_hero_image = get_template_directory_uri() . '/assets/images/hero-elite.webp';

$frontline_pc_stats = array(
	array( __( 'Byggetid', 'frontline-pc' ), __( '3–5 dg', 'frontline-pc' ) ),
	array( __( 'Stresstest', 'frontline-pc' ), __( '24 t', 'frontline-pc' ) ),
	array( __( 'Garanti', 'frontline-pc' ), __( '3 år', 'frontline-pc' ) ),
);

?>
<!-- wp:group {"tagName":"section","className":"fl-hero","layout":{"type":"default"}} -->
<section class="wp-block-group fl-hero">
	<!-- wp:html -->
	<div class="fl-hero__glow fl-hero__glow--a" aria-hidden="true"></div>
	<div class="fl-hero__glow fl-hero__glow--b" aria-hidden="true"></div>
	<!-- /wp:html -->

	<!-- wp:group {"className":"fl-wrap fl-hero__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group fl-wrap fl-hero__inner">

		<!-- wp:group {"className":"fl-hero__copy","layout":{"type":"default"}} -->
		<div class="wp-block-group fl-hero__copy">
			<!-- wp:group {"className":"fl-pill","layout":{"type":"default"}} -->
			<div class="wp-block-group fl-pill">
				<!-- wp:html -->
				<?php frontline_pc_the_icon( 'zap' ); ?>
				<!-- /wp:html -->

				<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
				<p style="margin-top:0;margin-bottom:0"><?php echo esc_html__( 'Real Gaming', 'frontline-pc' ); ?></p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->

			<!-- wp:heading {"level":1,"className":"fl-hero__title"} -->
			<h1 class="wp-block-heading fl-hero__title"><?php echo esc_html__( 'Velg din klasse.', 'frontline-pc' ); ?><br><?php echo esc_html__( 'Så tar maskinen resten.', 'frontline-pc' ); ?></h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"fl-hero__lede"} -->
			<p class="fl-hero__lede"><?php echo esc_html__( 'Tre ferdigbygde gaming-PCer — håndbygget i Norge, stresstestet i 24 timer og sendt ut klar til kamp. Ingen flaskehalser, ingen unnskyldninger.', 'frontline-pc' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:group {"className":"fl-hero__ctas","layout":{"type":"default"}} -->
			<div class="wp-block-group fl-hero__ctas">
				<!-- wp:html -->
				<a class="fl-btn fl-btn--accent" href="#maskiner"><?php echo esc_html__( 'Se maskinene', 'frontline-pc' ); ?><?php frontline_pc_the_icon( 'arrow-right' ); ?></a>
				<a class="fl-btn fl-btn--dark-ghost" href="#garanti"><?php echo esc_html__( '3 års garanti', 'frontline-pc' ); ?></a>
				<!-- /wp:html -->
			</div>
			<!-- /wp:group -->

		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"fl-hero__media","layout":{"type":"default"}} -->
		<div class="wp-block-group fl-hero__media">
			<!-- wp:image {"className":"fl-hero__frame","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image fl-hero__frame"><img src="<?php echo esc_url( $frontline_pc_hero_image ); ?>" alt="<?php echo esc_attr__( 'Frontline gaming-PC sett forfra', 'frontline-pc' ); ?>" width="1200" height="1200" fetchpriority="high" decoding="async"/></figure>
			<!-- /wp:image -->

			<!-- wp:group {"className":"fl-hero__strip","layout":{"type":"default"}} -->
			<div class="wp-block-group fl-hero__strip">
				<?php foreach ( $frontline_pc_stats as $frontline_pc_stat ) : ?>
				<!-- wp:group {"className":"fl-hero__stat","layout":{"type":"default"}} -->
				<div class="wp-block-group fl-hero__stat">
					<!-- wp:paragraph {"className":"fl-hero__stat-k","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
					<p class="fl-hero__stat-k" style="margin-top:0;margin-bottom:0"><?php echo esc_html( $frontline_pc_stat[0] ); ?></p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"className":"fl-hero__stat-v","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
					<p class="fl-hero__stat-v" style="margin-top:0;margin-bottom:0"><?php echo esc_html( $frontline_pc_stat[1] ); ?></p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
				<?php endforeach; ?>
			</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
