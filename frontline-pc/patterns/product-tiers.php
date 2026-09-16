<?php
/**
 * Title: Product tiers grid
 * Slug: frontline-pc/product-tiers
 * Categories: frontline-pc, woocommerce, products
 * Description: Section intro plus a three-up Product Collection of featured machines, with spec rows, price, instalment estimate, stock badge and add-to-cart.
 * Keywords: produkter, grid, featured, woocommerce
 * Viewport Width: 1400
 *
 * @package Frontline_PC
 */

$frontline_pc_shop = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );

?>
<!-- wp:group {"tagName":"section","className":"fl-wrap fl-klasser","style":{"spacing":{"padding":{"top":"72px","bottom":"8px"}}},"layout":{"type":"default"}} -->
<section class="wp-block-group fl-wrap fl-klasser" style="padding-top:72px;padding-bottom:8px">
	<!-- wp:group {"className":"fl-section-head","layout":{"type":"default"}} -->
	<div class="wp-block-group fl-section-head">
		<!-- wp:group {"className":"fl-section-head__copy","layout":{"type":"default"}} -->
		<div class="wp-block-group fl-section-head__copy">
			<!-- wp:paragraph {"className":"fl-eyebrow"} -->
			<p class="fl-eyebrow"><?php echo esc_html__( 'Tre prisklasser', 'frontline-pc' ); ?></p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":2} -->
			<h2 class="wp-block-heading"><?php echo esc_html__( 'Fighter. Ghost. Titan.', 'frontline-pc' ); ?></h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p><?php echo esc_html__( 'Samme byggekvalitet i alle tre. Forskjellen er hvor høyt du sikter — 1080p, 1440p eller 4K uten kompromiss.', 'frontline-pc' ); ?></p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:html -->
		<a class="fl-link-arrow" href="<?php echo esc_url( $frontline_pc_shop ); ?>"><?php echo esc_html__( 'Sammenlign alle spesifikasjoner', 'frontline-pc' ); ?><?php frontline_pc_the_icon( 'arrow-right' ); ?></a>
		<!-- /wp:html -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","className":"fl-wrap fl-tiers","anchor":"maskiner","layout":{"type":"default"}} -->
<section class="wp-block-group fl-wrap fl-tiers" id="maskiner">
	<!-- wp:woocommerce/product-collection {"queryId":0,"query":{"perPage":3,"pages":1,"offset":0,"postType":"product","order":"asc","orderBy":"menu_order","search":"","exclude":[],"inherit":false,"taxQuery":{},"isProductCollectionBlock":true,"featured":true,"woocommerceOnSale":false,"woocommerceStockStatus":["instock","outofstock","onbackorder"],"woocommerceAttributes":[],"woocommerceHandPickedProducts":[]},"tagName":"div","displayLayout":{"type":"flex","columns":3,"shrinkColumns":true},"collection":"woocommerce/product-collection/featured"} -->
	<div class="wp-block-woocommerce-product-collection">
		<!-- wp:woocommerce/product-template -->
			<!-- wp:pattern {"slug":"frontline-pc/product-card"} /-->
		<!-- /wp:woocommerce/product-template -->

		<!-- wp:woocommerce/product-collection-no-results -->
			<!-- wp:paragraph {"className":"fl-prose"} -->
			<p class="fl-prose"><?php echo esc_html__( 'Ingen maskiner er merket som utvalgte akkurat nå. Merk tre produkter som «utvalgt» i WooCommerce for å fylle denne seksjonen.', 'frontline-pc' ); ?></p>
			<!-- /wp:paragraph -->
		<!-- /wp:woocommerce/product-collection-no-results -->
	</div>
	<!-- /wp:woocommerce/product-collection -->
</section>
<!-- /wp:group -->
