<?php
/**
 * Title: Support + newsletter
 * Slug: frontline-pc/support-newsletter
 * Categories: frontline-pc, call-to-action
 * Description: Split panel — navy advice CTA beside a newsletter sign-up.
 * Keywords: support, kontakt, nyhetsbrev, cta
 * Viewport Width: 1400
 *
 * @package Frontline_PC
 */

/**
 * Filters the support phone number shown beside the chat CTA.
 *
 * Empty by default: the artboard's number was a placeholder in a live Oslo
 * range, so the theme ships no number at all. Return a real one in E.164 form
 * (e.g. "+4712345678") to restore the button.
 *
 * @since 1.0.0
 *
 * @param string $number Phone number, empty to hide the button.
 */
$frontline_pc_phone = (string) apply_filters( 'frontline_pc_support_phone', '' );

/**
 * Filters the newsletter form action.
 *
 * The theme ships markup only — there is deliberately no subscriber backend.
 * Point this at your ESP's endpoint, or hook frontline_pc_newsletter_form to
 * replace the whole form with a plugin's shortcode output.
 *
 * @since 1.0.0
 *
 * @param string $action Form action URL. Empty submits to the current page.
 */
$frontline_pc_newsletter_action = (string) apply_filters( 'frontline_pc_newsletter_action', '' );

?>
<!-- wp:group {"tagName":"section","className":"fl-wrap fl-support","anchor":"support","layout":{"type":"default"}} -->
<section class="wp-block-group fl-wrap fl-support" id="support">
	<!-- wp:group {"className":"fl-support__panel","layout":{"type":"default"}} -->
	<div class="wp-block-group fl-support__panel">

		<!-- wp:group {"className":"fl-support__left","layout":{"type":"default"}} -->
		<div class="wp-block-group fl-support__left">
			<!-- wp:heading {"level":2} -->
			<h2 class="wp-block-heading"><?php echo esc_html__( 'Usikker på hvilken klasse?', 'frontline-pc' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p><?php echo esc_html__( 'Send oss spillene dine og skjermen du bruker. Vi svarer med én anbefaling — ikke et prisark.', 'frontline-pc' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:html -->
			<div class="fl-support__ctas">
				<a class="fl-btn fl-btn--md fl-btn--accent" href="<?php echo esc_url( home_url( '/contact-us/' ) ); ?>"><?php frontline_pc_the_icon( 'message-square' ); ?><?php echo esc_html__( 'Chat med oss', 'frontline-pc' ); ?></a>
				<?php if ( '' !== $frontline_pc_phone ) : ?>
				<a class="fl-btn fl-btn--md fl-btn--dark-outline" href="<?php echo esc_url( 'tel:' . $frontline_pc_phone ); ?>"><?php frontline_pc_the_icon( 'phone' ); ?><?php echo esc_html( $frontline_pc_phone ); ?></a>
				<?php endif; ?>
			</div>
			<!-- /wp:html -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"fl-support__right","layout":{"type":"default"}} -->
		<div class="wp-block-group fl-support__right">
			<!-- wp:paragraph {"className":"fl-eyebrow"} -->
			<p class="fl-eyebrow"><?php echo esc_html__( 'Nyhetsbrev', 'frontline-pc' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph -->
			<p><?php echo esc_html__( 'Nye bygg, lagerslipp og kampanjer — én e-post i måneden. Ingen støy.', 'frontline-pc' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:html -->
			<?php
			/*
			 * TODO: markup only — no subscriber storage, no double opt-in, no
			 * consent logging. Wire it up before collecting addresses.
			 */
			$frontline_pc_form = sprintf(
				'<form class="fl-newsletter" action="%1$s" method="post">
					<label class="screen-reader-text" for="fl-newsletter-email">%2$s</label>
					<span class="fl-newsletter__field">%3$s<input type="email" id="fl-newsletter-email" name="fl_email" placeholder="%4$s" autocomplete="email" required /></span>
					<button type="submit" class="fl-btn fl-btn--md fl-btn--primary">%5$s</button>
				</form>',
				esc_url( $frontline_pc_newsletter_action ),
				esc_html__( 'E-postadresse', 'frontline-pc' ),
				frontline_pc_icon( 'mail' ),
				esc_attr__( 'din@epost.no', 'frontline-pc' ),
				esc_html__( 'Meld meg på', 'frontline-pc' )
			);

			/**
			 * Filters the newsletter form markup.
			 *
			 * Return a plugin's shortcode output here to replace the placeholder
			 * form wholesale.
			 *
			 * @since 1.0.0
			 *
			 * @param string $frontline_pc_form Rendered form markup.
			 */
			echo wp_kses( apply_filters( 'frontline_pc_newsletter_form', $frontline_pc_form ), frontline_pc_form_allowed_html() );
			?>
			<!-- /wp:html -->

			<!-- wp:html -->
			<p class="fl-note"><?php frontline_pc_the_icon( 'lock' ); ?><?php echo esc_html__( 'Vi deler aldri e-posten din.', 'frontline-pc' ); ?></p>
			<!-- /wp:html -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
