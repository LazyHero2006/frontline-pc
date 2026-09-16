<?php
/**
 * Frontline PC theme functions.
 *
 * @package Frontline_PC
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

define( 'FRONTLINE_PC_VERSION', '1.0.0' );

/**
 * Theme supports and translations.
 *
 * @since 1.0.0
 * @return void
 */
function frontline_pc_setup() {
	load_theme_textdomain( 'frontline-pc', get_template_directory() . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'editor-styles' );
	add_editor_style( 'assets/css/frontline.css' );

	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
	);

	add_theme_support(
		'custom-logo',
		array(
			'height'               => 30,
			'width'                => 168,
			'flex-height'          => true,
			'flex-width'           => true,
			'header-text'          => array( 'site-title' ),
			'unlink-homepage-logo' => false,
		)
	);

	/*
	 * WooCommerce. The gallery features are opt-in per WooCommerce docs and are
	 * required for the single-product gallery to zoom, light-box and slide.
	 *
	 * Image sizes are declared here rather than left to the options table, so
	 * the card box is predictable. Cropping stays an option (uncropped), because
	 * theme support cannot express it — see readme.txt.
	 */
	add_theme_support(
		'woocommerce',
		array(
			'thumbnail_image_width' => 600,
			'single_image_width'    => 900,
			'product_grid'          => array(
				'default_columns' => 3,
				'min_columns'     => 1,
				'max_columns'     => 4,
			),
		)
	);

	/*
	 * Lightbox and slider only. Declaring these is not sufficient on its own:
	 * WC_Template_Loader::add_support_for_product_page_gallery() force-adds all
	 * three gallery features for block themes, so hover zoom is switched off
	 * through WooCommerce's own filter below rather than by omission here.
	 */
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'frontline_pc_setup' );

/**
 * Front-end styles and scripts.
 *
 * @since 1.0.0
 * @return void
 */
function frontline_pc_enqueue_assets() {
	$dir = get_template_directory();
	$uri = get_template_directory_uri();

	/*
	 * Versioned from the file's own mtime so a redeploy busts the browser cache
	 * on its own; FRONTLINE_PC_VERSION is only the fallback if the stat fails.
	 */
	$style = $dir . '/style.css';
	wp_enqueue_style(
		'frontline-pc-style',
		get_stylesheet_uri(),
		array(),
		file_exists( $style ) ? (string) filemtime( $style ) : FRONTLINE_PC_VERSION
	);

	$css = '/assets/css/frontline.css';
	wp_enqueue_style(
		'frontline-pc-main',
		$uri . $css,
		array( 'frontline-pc-style' ),
		file_exists( $dir . $css ) ? (string) filemtime( $dir . $css ) : FRONTLINE_PC_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'frontline_pc_enqueue_assets' );

/**
 * Register the theme's block pattern category.
 *
 * @since 1.0.0
 * @return void
 */
function frontline_pc_register_pattern_category() {
	if ( ! function_exists( 'register_block_pattern_category' ) ) {
		return;
	}

	register_block_pattern_category(
		'frontline-pc',
		array(
			'label'       => __( 'Frontline PC', 'frontline-pc' ),
			'description' => __( 'Sections from the Frontline PC front page design.', 'frontline-pc' ),
		)
	);
}
add_action( 'init', 'frontline_pc_register_pattern_category' );

/**
 * Fall back to the bundled logo if the Site Logo block has nothing to render.
 *
 * The header is correct from the first page load without importing anything
 * into the media library, and without hardcoding an <img> into the template.
 * Uploading a logo in the Site Editor sets custom_logo, the Site Logo block
 * then renders it, and this fallback steps aside.
 *
 * @since 1.0.0
 *
 * @param string              $block_content Rendered block markup.
 * @param array<string,mixed> $block         Parsed block, for its width attribute.
 * @return string
 */
function frontline_pc_site_logo_fallback( $block_content, $block = array() ) {
	if ( '' !== trim( (string) $block_content ) ) {
		return $block_content;
	}

	$logo = get_template_directory() . '/assets/images/logo-frontline-white.png';
	if ( ! file_exists( $logo ) ) {
		return $block_content;
	}

	/*
	 * Honour the block's own "Bildebredde" control, so the fallback scales with
	 * the same setting as a real logo would. Height follows the file's aspect
	 * ratio rather than a hardcoded number, which keeps the logo undistorted if
	 * the bundled artwork is ever replaced with a different shape.
	 */
	$size  = @getimagesize( $logo ); // phpcs:ignore WordPress.PHP.NoSilencedErrors.Discouraged -- Size is optional; the defaults below cover a failure.
	$width = isset( $block['attrs']['width'] ) ? (int) $block['attrs']['width'] : 90;

	if ( $width < 1 ) {
		$width = 90;
	}

	$height = ( $size && $size[0] ) ? (int) round( $width * ( $size[1] / $size[0] ) ) : (int) round( $width / 3 );

	return sprintf(
		'<div class="wp-block-site-logo"><a href="%1$s" class="custom-logo-link" rel="home"><img class="custom-logo" src="%2$s" width="%3$s" height="%4$s" alt="%5$s" decoding="async" /></a></div>',
		esc_url( home_url( '/' ) ),
		esc_url( get_template_directory_uri() . '/assets/images/logo-frontline-white.png' ),
		esc_attr( (string) $width ),
		esc_attr( (string) $height ),
		esc_attr( get_bloginfo( 'name' ) )
	);
}
add_filter( 'render_block_core/site-logo', 'frontline_pc_site_logo_fallback', 10, 2 );

/**
 * Register the theme's dynamic product blocks.
 *
 * These exist because the design's product card shows a spec table, a stock
 * pill and an instalment line that no core or WooCommerce block provides. Each
 * reads its product from block context, so the card stays real data.
 *
 * @since 1.0.0
 * @return void
 */
function frontline_pc_register_blocks() {
	foreach ( array( 'product-specs', 'product-stock', 'product-installment', 'product-price' ) as $block ) {
		$path = get_template_directory() . '/blocks/' . $block;

		if ( file_exists( $path . '/block.json' ) ) {
			register_block_type( $path );
		}
	}
}
add_action( 'init', 'frontline_pc_register_blocks' );

/**
 * Markup allowed inside an inline icon.
 *
 * @since 1.0.0
 * @return array<string, array<string, bool>>
 */
function frontline_pc_svg_allowed_html() {
	$shared = array(
		'fill'            => true,
		'stroke'          => true,
		'stroke-width'    => true,
		'stroke-linecap'  => true,
		'stroke-linejoin' => true,
		'd'               => true,
		'points'          => true,
		'x'               => true,
		'y'               => true,
		'x1'              => true,
		'x2'              => true,
		'y1'              => true,
		'y2'              => true,
		'cx'              => true,
		'cy'              => true,
		'r'               => true,
		'rx'              => true,
		'ry'              => true,
		'width'           => true,
		'height'          => true,
		'transform'       => true,
	);

	return array(
		'svg'      => array(
			'xmlns'           => true,
			'viewbox'         => true,
			'width'           => true,
			'height'          => true,
			'fill'            => true,
			'stroke'          => true,
			'stroke-width'    => true,
			'stroke-linecap'  => true,
			'stroke-linejoin' => true,
			'aria-hidden'     => true,
			'focusable'       => true,
			'class'           => true,
			'role'            => true,
		),
		'path'     => $shared,
		'circle'   => $shared,
		'rect'     => $shared,
		'line'     => $shared,
		'polyline' => $shared,
		'polygon'  => $shared,
		'ellipse'  => $shared,
		'g'        => $shared,
	);
}

/**
 * Return an inline Lucide icon.
 *
 * @since 1.0.0
 *
 * @param string $name    Icon name, e.g. "truck".
 * @param string $classes Extra classes for the wrapper.
 * @return string Escaped SVG markup, or an empty string if the icon is unknown.
 */
function frontline_pc_icon( $name, $classes = '' ) {
	static $icons = null;

	if ( null === $icons ) {
		$icons = (array) require get_template_directory() . '/inc/icons.php';
	}

	$name = sanitize_key( str_replace( '_', '-', (string) $name ) );

	if ( ! isset( $icons[ $name ] ) ) {
		return '';
	}

	$svg = sprintf(
		'<span class="fl-icon %1$s"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">%2$s</svg></span>',
		esc_attr( $classes ),
		$icons[ $name ]
	);

	return wp_kses( $svg, array_merge( frontline_pc_svg_allowed_html(), array( 'span' => array( 'class' => true ) ) ) );
}

/**
 * Echo an inline Lucide icon.
 *
 * @since 1.0.0
 *
 * @param string $name    Icon name.
 * @param string $classes Extra classes for the wrapper.
 * @return void
 */
function frontline_pc_the_icon( $name, $classes = '' ) {
	echo frontline_pc_icon( $name, $classes ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- frontline_pc_icon() returns wp_kses()'d markup.
}

/**
 * Live cart count for the header control.
 *
 * @since 1.0.0
 * @return int
 */
function frontline_pc_cart_count() {
	if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
		return 0;
	}

	return (int) WC()->cart->get_cart_contents_count();
}

/**
 * Markup allowed in the newsletter form.
 *
 * The wp_kses_post() allowlist strips form controls, so the placeholder form
 * needs its own. Icons are included because the field carries an inline SVG.
 *
 * @since 1.0.0
 * @return array<string, array<string, bool>>
 */
function frontline_pc_form_allowed_html() {
	return array_merge(
		frontline_pc_svg_allowed_html(),
		array(
			'form'   => array(
				'class'  => true,
				'action' => true,
				'method' => true,
			),
			'label'  => array(
				'class' => true,
				'for'   => true,
			),
			'span'   => array( 'class' => true ),
			'input'  => array(
				'type'         => true,
				'id'           => true,
				'name'         => true,
				'class'        => true,
				'value'        => true,
				'placeholder'  => true,
				'required'     => true,
				'autocomplete' => true,
				'aria-label'   => true,
			),
			'button' => array(
				'type'       => true,
				'class'      => true,
				'aria-label' => true,
			),
			'p'      => array( 'class' => true ),
		)
	);
}

/**
 * Show a single, most-specific product category in the card eyebrow.
 *
 * Every machine sits in the catch-all "Alle PC-er" bucket as well as its own
 * series, but the design's eyebrow shows one label. Rather than hardcode a slug,
 * the narrowest term wins — the one with the fewest products — which keeps the
 * series and drops the bucket whatever they are named.
 *
 * @since 1.0.0
 *
 * @param string   $block_content Rendered block markup.
 * @param array    $block         Parsed block.
 * @param WP_Block $instance      Block instance.
 * @return string
 */
function frontline_pc_single_card_category( $block_content, $block, $instance ) {
	$class = isset( $block['attrs']['className'] ) ? (string) $block['attrs']['className'] : '';

	if ( false === strpos( $class, 'fl-tier-cat' ) ) {
		return $block_content;
	}

	$post_id = isset( $instance->context['postId'] ) ? (int) $instance->context['postId'] : 0;

	if ( ! $post_id ) {
		return $block_content;
	}

	$terms = get_the_terms( $post_id, 'product_cat' );

	if ( is_wp_error( $terms ) || empty( $terms ) ) {
		return $block_content;
	}

	/**
	 * Filters product category slugs never shown in a card eyebrow.
	 *
	 * @since 1.0.0
	 *
	 * @param string[] $slugs   Category slugs to skip.
	 * @param int      $post_id Product being rendered.
	 */
	$excluded = (array) apply_filters( 'frontline_pc_card_excluded_categories', array(), $post_id );

	$terms = array_values(
		array_filter(
			$terms,
			static function ( $term ) use ( $excluded ) {
				return ! in_array( $term->slug, $excluded, true );
			}
		)
	);

	if ( empty( $terms ) ) {
		return $block_content;
	}

	usort(
		$terms,
		static function ( $a, $b ) {
			if ( $a->count === $b->count ) {
				return strcmp( $a->name, $b->name );
			}

			return $a->count <=> $b->count;
		}
	);

	$term = $terms[0];

	return sprintf(
		'<div class="%1$s"><a href="%2$s" rel="tag">%3$s</a></div>',
		esc_attr( trim( 'taxonomy-product_cat wp-block-post-terms ' . $class ) ),
		esc_url( (string) get_term_link( $term ) ),
		esc_html( $term->name )
	);
}
add_filter( 'render_block_core/post-terms', 'frontline_pc_single_card_category', 10, 3 );

/**
 * Build navigation-link block markup from classic menu items.
 *
 * @since 1.0.0
 *
 * @param array $items     Menu item objects, keyed by parent ID.
 * @param int   $parent_id Parent menu-item ID to render.
 * @return string
 */
function frontline_pc_menu_items_to_blocks( $items, $parent_id = 0 ) {
	$markup = '';

	if ( empty( $items[ $parent_id ] ) ) {
		return $markup;
	}

	foreach ( $items[ $parent_id ] as $item ) {
		$attrs = array(
			'label' => wp_strip_all_tags( $item->title ),
			'url'   => $item->url,
			'kind'  => 'custom',
		);

		$children = frontline_pc_menu_items_to_blocks( $items, (int) $item->ID );

		if ( '' !== $children ) {
			$markup .= '<!-- wp:navigation-submenu ' . wp_json_encode( $attrs ) . ' -->' . $children . '<!-- /wp:navigation-submenu -->';
			continue;
		}

		$markup .= '<!-- wp:navigation-link ' . wp_json_encode( $attrs ) . ' /-->';
	}

	return $markup;
}

/**
 * Seed a block navigation menu from the site's existing classic menu.
 *
 * Without this the Navigation block falls back to listing every published page.
 * The site's classic "Main Menu" is the agreed structure, so it is converted
 * once, on activation, into an editable wp_navigation post.
 *
 * @since 1.0.0
 * @return void
 */
function frontline_pc_seed_navigation() {
	$existing = get_posts(
		array(
			'post_type'      => 'wp_navigation',
			'post_status'    => array( 'publish', 'draft' ),
			'posts_per_page' => -1,
		)
	);

	foreach ( $existing as $nav ) {
		// A bare page-list is what core generates when it has nothing to show;
		// it is a placeholder, not a menu somebody built. Anything else is a
		// real menu and the theme leaves the site alone.
		if ( preg_match( '#^\s*<!--\s*wp:page-list\s*/-->\s*$#', (string) $nav->post_content ) ) {
			continue;
		}

		return;
	}

	$menu      = null;
	$locations = get_nav_menu_locations();

	foreach ( array( 'primary', 'menu_1', 'menu-1' ) as $location ) {
		if ( ! empty( $locations[ $location ] ) ) {
			$menu = wp_get_nav_menu_object( $locations[ $location ] );
			break;
		}
	}

	if ( ! $menu ) {
		$menus = wp_get_nav_menus();
		$menu  = ! empty( $menus ) ? $menus[0] : null;
	}

	if ( ! $menu ) {
		return;
	}

	$items = wp_get_nav_menu_items( $menu->term_id );

	if ( empty( $items ) ) {
		return;
	}

	$by_parent = array();

	foreach ( $items as $item ) {
		$by_parent[ (int) $item->menu_item_parent ][] = $item;
	}

	$content = frontline_pc_menu_items_to_blocks( $by_parent, 0 );

	if ( '' === $content ) {
		return;
	}

	/*
	 * Purely additive: one new wp_navigation post, never an edit of one that
	 * was already there. A core-generated page-list placeholder is left exactly
	 * as it was, and the Navigation block picks the newest menu anyway. This is
	 * the only row the theme writes, and deleting it restores the previous
	 * state completely.
	 */
	wp_insert_post(
		array(
			'post_type'    => 'wp_navigation',
			'post_title'   => $menu->name,
			'post_content' => $content,
			'post_status'  => 'publish',
		)
	);
}
add_action( 'after_switch_theme', 'frontline_pc_seed_navigation' );


/**
 * Show variable products as a "fra" starting price instead of a range.
 *
 * A range ("kr 21 999 – kr 23 499") reads as two prices and makes the card grid
 * ragged. The minimum is the honest headline; the configured price is shown
 * large above the add-to-cart button once a variation is chosen.
 *
 * @since 1.0.0
 *
 * @param string     $price_html Existing price markup.
 * @param WC_Product $product    Product being rendered.
 * @return string
 */
function frontline_pc_variable_price_from( $price_html, $product ) {
	if ( ! $product instanceof WC_Product_Variable ) {
		return $price_html;
	}

	$min = $product->get_variation_price( 'min', true );
	$max = $product->get_variation_price( 'max', true );

	if ( '' === $min ) {
		return $price_html;
	}

	$price = wc_price( $min ) . $product->get_price_suffix();

	/*
	 * Compared as numbers, not strings: get_variation_price() returns strings
	 * ("36990.00"), and a variable product whose variations all cost the same
	 * must not advertise a "from" price that promises a cheaper option.
	 * Rounded to the store's display precision so two prices that render
	 * identically are treated as identical.
	 */
	$precision = wc_get_price_decimals();

	if ( round( (float) $min, $precision ) === round( (float) $max, $precision ) ) {
		return $price;
	}

	return sprintf(
		'<span class="fl-price-from">%1$s</span> %2$s',
		esc_html__( 'fra', 'frontline-pc' ),
		$price
	);
}
add_filter( 'woocommerce_variable_price_html', 'frontline_pc_variable_price_from', 10, 2 );
add_filter( 'woocommerce_variable_sale_price_html', 'frontline_pc_variable_price_from', 10, 2 );

/**
 * Label the configured price on a variable product.
 *
 * Printed just before WooCommerce's (initially empty) .single_variation box and
 * revealed with CSS once that box has content, so the theme still authors no
 * JavaScript.
 *
 * @since 1.0.0
 * @return void
 */
function frontline_pc_variation_price_label() {
	printf(
		'<p class="fl-variation-label">%s</p>',
		esc_html__( 'Din pris', 'frontline-pc' )
	);
}
add_action( 'woocommerce_single_variation', 'frontline_pc_variation_price_label', 5 );

/**
 * Trim a trailing colon from product attribute labels.
 *
 * Several attributes in the catalogue are named with a trailing colon
 * ("Kabinett:", "Prosessor:") while others are not ("Lagringskapasitet"), so
 * the labels render inconsistently, and WooCommerce's own separator turns the
 * order summary into "Kabinett::". This normalises presentation only — the
 * underlying attribute names still need correcting in the product data.
 *
 * @since 1.0.0
 *
 * @param string $label Attribute label.
 * @return string
 */
function frontline_pc_trim_attribute_label( $label ) {
	return rtrim( trim( (string) $label ), ':' );
}
add_filter( 'woocommerce_attribute_label', 'frontline_pc_trim_attribute_label' );

/**
 * Switch off the gallery's hover zoom.
 *
 * The theme does not declare wc-product-gallery-zoom, but WooCommerce adds it
 * for every block theme in WC_Template_Loader, so it has to be turned off at
 * the point of use. The gallery opens in WooCommerce's own PhotoSwipe lightbox
 * on click instead.
 *
 * @since 1.0.0
 * @return bool
 */
function frontline_pc_disable_gallery_zoom() {
	return false;
}
add_filter( 'woocommerce_single_product_zoom_enabled', 'frontline_pc_disable_gallery_zoom', PHP_INT_MAX );

/**
 * Turn on FlexSlider's previous/next controls.
 *
 * WooCommerce ships the gallery carousel with directionNav off, leaving the
 * thumbnails as the only way to change image. The arrows are styled as overlay
 * controls in assets/css/frontline.css.
 *
 * @since 1.0.0
 *
 * @param array $options FlexSlider options.
 * @return array
 */
function frontline_pc_gallery_carousel_options( $options ) {
	$options['directionNav'] = true;

	return $options;
}
add_filter( 'woocommerce_single_product_carousel_options', 'frontline_pc_gallery_carousel_options' );

/**
 * Let the theme's checkout header replace WooCommerce's.
 *
 * WooCommerce's page-checkout template pins the header part to its own theme
 * ("theme":"woocommerce/woocommerce"), so simply shipping parts/checkout-header.html
 * is never reached. This repoints that one template part at the active theme so the
 * checkout shows the site logo instead of the site title. Nothing else about the
 * checkout is touched: no form markup, no block replacement, no gateway hooks.
 *
 * @since 1.0.0
 *
 * @param array $parsed_block A parsed block.
 * @return array
 */
function frontline_pc_use_theme_checkout_header( $parsed_block ) {
	if ( 'core/template-part' !== ( $parsed_block['blockName'] ?? '' ) ) {
		return $parsed_block;
	}

	$slug  = $parsed_block['attrs']['slug'] ?? '';
	$theme = $parsed_block['attrs']['theme'] ?? '';

	if ( 'checkout-header' === $slug && 'woocommerce/woocommerce' === $theme ) {
		$parsed_block['attrs']['theme'] = get_stylesheet();
	}

	return $parsed_block;
}
add_filter( 'render_block_data', 'frontline_pc_use_theme_checkout_header' );

/**
 * Hide the configured price while it matches the "fra" headline.
 *
 * WooCommerce already intends this: get_available_variation() only fills
 * price_html when the variation's price differs from the product minimum. Its
 * check compares the two with !==, and get_variation_price() returns a
 * formatted string ("21999.00") while get_price() may not, so the comparison
 * is true even when the prices are equal and the number gets printed twice.
 * This applies the same rule numerically, at the store's display precision.
 *
 * @since 1.0.0
 *
 * @param bool       $show      Whether to show the variation price.
 * @param WC_Product $product   Parent variable product.
 * @param WC_Product $variation The variation being rendered.
 * @return bool
 */
function frontline_pc_show_variation_price( $show, $product, $variation ) {
	if ( ! $product instanceof WC_Product_Variable || '' === $variation->get_price() ) {
		return $show;
	}

	$precision = wc_get_price_decimals();
	$min       = round( (float) $product->get_variation_price( 'min' ), $precision );
	$price     = round( (float) $variation->get_price(), $precision );

	return $min !== $price;
}
add_filter( 'woocommerce_show_variation_price', 'frontline_pc_show_variation_price', 10, 3 );

/**
 * Move Klarna's express checkout button next to the other express buttons.
 *
 * The Klarna plugin hooks its product-page express button onto
 * woocommerce_single_product_summary at priority 31, which in a block theme
 * lands below the product description. Stripe's Apple Pay / Google Pay buttons
 * use woocommerce_after_add_to_cart_form, directly under the add-to-cart
 * button, so the two express surfaces end up far apart. The plugin exposes no
 * placement setting — kec_placement only toggles cart/product, not position.
 *
 * This re-hooks the plugin's own callback onto the same hook Stripe uses. It
 * uses public WordPress APIs only: no plugin file is modified and no gateway
 * output is filtered. Return false from frontline_pc_move_klarna_express to
 * leave the plugin's placement untouched.
 *
 * @since 1.0.0
 * @return void
 */
function frontline_pc_relocate_klarna_express() {
	/**
	 * Filters whether the theme repositions Klarna's express checkout button.
	 *
	 * @since 1.0.0
	 *
	 * @param bool $move Whether to move the button. Default true.
	 */
	if ( ! apply_filters( 'frontline_pc_move_klarna_express', true ) ) {
		return;
	}

	global $wp_filter;

	$source = 'woocommerce_single_product_summary';
	$target = 'woocommerce_after_add_to_cart_form';

	if ( empty( $wp_filter[ $source ] ) ) {
		return;
	}

	foreach ( $wp_filter[ $source ]->callbacks as $priority => $callbacks ) {
		foreach ( $callbacks as $key => $callback ) {
			if ( ! is_array( $callback['function'] ) || ! is_object( $callback['function'][0] ) ) {
				continue;
			}

			if ( false === stripos( get_class( $callback['function'][0] ), 'Klarna' ) ) {
				continue;
			}

			if ( false === stripos( (string) $callback['function'][1], 'kec' ) ) {
				continue;
			}

			remove_action( $source, $callback['function'], $priority );
			add_action( $target, $callback['function'], 20, (int) $callback['accepted_args'] );
		}
	}
}
add_action( 'wp', 'frontline_pc_relocate_klarna_express', 99 );

/**
 * Register the editor scripts for the theme's dynamic blocks.
 *
 * Registered here rather than as "file:./index.js" so the dependencies can be
 * declared explicitly without shipping a generated *.asset.php next to each
 * script. These are editor-only: each block.json names the handle under
 * editorScript, and no block declares script or viewScript, so none of this
 * is enqueued on a front-end page.
 *
 * @since 1.0.0
 * @return void
 */
function frontline_pc_register_block_editor_scripts() {
	$blocks = array( 'product-stock', 'product-installment', 'product-specs', 'product-price' );
	$deps   = array( 'wp-blocks', 'wp-element', 'wp-block-editor', 'wp-i18n' );

	foreach ( $blocks as $block ) {
		$path = '/blocks/' . $block . '/index.js';

		if ( ! file_exists( get_template_directory() . $path ) ) {
			continue;
		}

		wp_register_script(
			'frontline-pc-' . $block . '-editor',
			get_template_directory_uri() . $path,
			$deps,
			(string) filemtime( get_template_directory() . $path ),
			true
		);
	}
}
add_action( 'init', 'frontline_pc_register_block_editor_scripts', 5 );

/**
 * Fall back to the bundled front-page pattern when the assigned front page has
 * no block content of its own.
 *
 * The front-page template renders the page's own content, so on a site whose
 * static front page was built with a page builder — or on a fresh install where
 * the Forside page has not been created yet — activating the theme would
 * otherwise render that foreign content, or nothing. This keeps activation
 * safe: the theme's canonical front page shows until a real Forside page exists.
 *
 * The moment the front page contains blocks, this steps out of the way.
 *
 * @since 1.0.0
 *
 * @param string $block_content Rendered block markup.
 * @return string
 */
function frontline_pc_front_page_fallback( $block_content ) {
	if ( ! is_front_page() || is_admin() ) {
		return $block_content;
	}

	$post_id = (int) get_queried_object_id();

	if ( $post_id && has_blocks( $post_id ) ) {
		return $block_content;
	}

	if ( ! function_exists( 'do_blocks' ) || ! class_exists( 'WP_Block_Patterns_Registry' ) ) {
		return $block_content;
	}

	$pattern = WP_Block_Patterns_Registry::get_instance()->get_registered( 'frontline-pc/front-page' );

	if ( ! $pattern || empty( $pattern['content'] ) ) {
		return $block_content;
	}

	return do_blocks( $pattern['content'] );
}
add_filter( 'render_block_core/post-content', 'frontline_pc_front_page_fallback' );

/**
 * Keep Elementor's editor away from a block-built front page.
 *
 * Elementor stays active for the existing content pages, so a block-built
 * Forside would otherwise get an "Edit with Elementor" button. One click there
 * would hand a page of 98 blocks to a builder that cannot read them.
 *
 * The guard is deliberately narrow: it only withdraws support from a page that
 * is built with blocks and that Elementor has never touched. A page holding
 * Elementor data keeps full support, because Elementor treats a withdrawn page
 * as non-Elementor and drops its stored edit mode and generated CSS — which
 * would take that page's layout down with it.
 *
 * @since 1.0.0
 *
 * @param bool $is_supported Whether Elementor supports editing this post.
 * @param int  $post_id      Post ID.
 * @return bool
 */
function frontline_pc_block_elementor_on_front_page( $is_supported, $post_id ) {
	/*
	 * Read-only by construction.
	 *
	 * Elementor consults this filter from both UI code and code that persists
	 * state (deleted_post cleanup, save_post, the REST field the block editor
	 * posts, WP-CLI). Answering anywhere but a plain admin screen render is
	 * what makes a display preference capable of changing stored data, so the
	 * filter declines to answer in every one of those contexts and returns the
	 * value Elementor came in with, untouched.
	 */
	if ( ! is_admin()
		|| wp_doing_ajax()
		|| wp_doing_cron()
		|| ( defined( 'REST_REQUEST' ) && REST_REQUEST )
		|| ( defined( 'WP_CLI' ) && WP_CLI )
		|| ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	) {
		return $is_supported;
	}

	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Reading the request method only; nothing is acted on.
	$method = isset( $_SERVER['REQUEST_METHOD'] ) ? strtoupper( sanitize_text_field( wp_unslash( $_SERVER['REQUEST_METHOD'] ) ) ) : 'GET';

	if ( 'GET' !== $method ) {
		return $is_supported;
	}

	global $pagenow;

	if ( ! in_array( $pagenow, array( 'post.php', 'post-new.php', 'edit.php' ), true ) ) {
		return $is_supported;
	}

	$post_id    = (int) $post_id;
	$front_page = (int) get_option( 'page_on_front' );

	if ( ! $front_page || $post_id !== $front_page ) {
		return $is_supported;
	}

	// Never withdraw support from a page Elementor already owns.
	if ( '' !== (string) get_post_meta( $post_id, '_elementor_data', true ) ) {
		return $is_supported;
	}

	if ( '' !== (string) get_post_meta( $post_id, '_elementor_edit_mode', true ) ) {
		return $is_supported;
	}

	return has_blocks( $post_id ) ? false : $is_supported;
}
add_filter( 'elementor/utils/is_post_support', 'frontline_pc_block_elementor_on_front_page', 10, 2 );
