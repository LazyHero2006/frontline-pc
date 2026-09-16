<?php
/**
 * Title: Header
 * Slug: frontline-pc/header
 * Categories: frontline-pc, header
 * Block Types: core/template-part/header
 * Description: Sticky navy glass header — logo, primary navigation, search and the live mini-cart.
 * Keywords: header, meny, navigasjon, handlekurv
 * Viewport Width: 1400
 *
 * @package Frontline_PC
 */

$frontline_pc_search = wp_json_encode(
	array(
		'label'          => __( 'Søk', 'frontline-pc' ),
		'showLabel'      => false,
		'placeholder'    => __( 'Søk etter maskiner', 'frontline-pc' ),
		'buttonText'     => __( 'Søk', 'frontline-pc' ),
		'buttonPosition' => 'button-only',
		'buttonUseIcon'  => true,
		'className'      => 'fl-search',
	)
);

$frontline_pc_nav = wp_json_encode(
	array(
		'className'              => 'fl-header__nav',
		'overlayMenu'            => 'mobile',
		'overlayBackgroundColor' => 'navy-900',
		'overlayTextColor'       => 'white',
		'icon'                   => 'menu',
		'layout'                 => array(
			'type'           => 'flex',
			'justifyContent' => 'left',
			'flexWrap'       => 'wrap',
			'orientation'    => 'horizontal',
		),
	)
);

?>
<!-- wp:html -->
<a class="fl-skip-link screen-reader-text" href="#fl-main"><?php echo esc_html__( 'Hopp til innhold', 'frontline-pc' ); ?></a>
<!-- /wp:html -->

<!-- wp:pattern {"slug":"frontline-pc/announcement-bar"} /-->

<!-- wp:group {"tagName":"header","className":"fl-header","layout":{"type":"default"}} -->
<header class="wp-block-group fl-header">
	<!-- wp:group {"className":"fl-wrap fl-header__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group fl-wrap fl-header__inner">
		<!-- wp:site-logo {"width":168} /-->

		<!-- wp:navigation <?php echo $frontline_pc_nav; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- wp_json_encode() output forms block-comment attributes; escaping would corrupt the JSON. ?> /-->

		<!-- wp:group {"className":"fl-header__actions","layout":{"type":"default"}} -->
		<div class="wp-block-group fl-header__actions">
			<!-- wp:search <?php echo $frontline_pc_search; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- wp_json_encode() output forms block-comment attributes; escaping would corrupt the JSON. ?> /-->

			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
			<!-- wp:woocommerce/mini-cart /-->
			<?php endif; ?>
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</header>
<!-- /wp:group -->
