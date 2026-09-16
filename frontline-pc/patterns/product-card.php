<?php
/**
 * Title: Product card
 * Slug: frontline-pc/product-card
 * Categories: frontline-pc, woocommerce
 * Inserter: no
 * Description: The single card design used by every product grid — front page, shop archives, category, search and cross-sells.
 *
 * The card carries one full-width primary action. The secondary "go to product"
 * arrow was dropped rather than shrunk: the image and title already link there.
 *
 * @package Frontline_PC
 */

?>
<!-- wp:woocommerce/product-image {"isDescendentOfQueryLoop":true,"showSaleBadge":true,"imageSizing":"single","saleBadgeAlign":"left","scale":"contain","aspectRatio":"4/3"} /-->

<!-- wp:group {"className":"fl-tiers__body","layout":{"type":"default"}} -->
<div class="wp-block-group fl-tiers__body">
	<!-- wp:post-terms {"term":"product_cat","className":"fl-tier-cat"} /-->

	<!-- wp:post-title {"level":3,"isLink":true,"__woocommerceNamespace":"woocommerce/product-collection/product-title"} /-->

	<!-- wp:frontline-pc/product-specs /-->

	<!-- wp:group {"className":"fl-tiers__price-row","layout":{"type":"default"}} -->
	<div class="wp-block-group fl-tiers__price-row">
		<!-- wp:group {"className":"fl-tiers__price-col","layout":{"type":"default"}} -->
		<div class="wp-block-group fl-tiers__price-col">
			<!-- wp:woocommerce/product-price {"isDescendentOfQueryLoop":true} /-->
			<!-- wp:frontline-pc/product-installment /-->
		</div>
		<!-- /wp:group -->

		<!-- wp:frontline-pc/product-stock /-->
	</div>
	<!-- /wp:group -->

	<!-- wp:group {"className":"fl-tiers__cta","layout":{"type":"default"}} -->
	<div class="wp-block-group fl-tiers__cta">
		<!-- wp:woocommerce/product-button {"isDescendentOfQueryLoop":true} /-->
	</div>
	<!-- /wp:group -->
</div>
<!-- /wp:group -->
