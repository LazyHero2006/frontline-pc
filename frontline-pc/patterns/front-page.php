<?php
/**
 * Title: Forside — alle seksjoner
 * Slug: frontline-pc/front-page
 * Categories: frontline-pc, featured
 * Description: Hele forsiden som redigerbare blokker: hero, USP-linje, produktgrid, byggeprosess og support/nyhetsbrev. Sett inn i en side og velg den som statisk forside.
 * Keywords: forside, hero, seksjoner
 * Viewport Width: 1400
 *
 * The canonical front page lives here so the layout is under version control
 * and a fresh install can reproduce it. The live site keeps its own copy as
 * ordinary page content, editable in the block editor.
 *
 * @package Frontline_PC
 */

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
				<span class="fl-icon "><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M4 14a1 1 0 0 1-.78-1.63l9.9-10.2a.5.5 0 0 1 .86.46l-1.92 6.02A1 1 0 0 0 13 10h7a1 1 0 0 1 .78 1.63l-9.9 10.2a.5.5 0 0 1-.86-.46l1.92-6.02A1 1 0 0 0 11 14z" /></svg></span>				<!-- /wp:html -->

				<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
				<p style="margin-top:0;margin-bottom:0">Real Gaming</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->

			<!-- wp:heading {"level":1,"className":"fl-hero__title"} -->
			<h1 class="wp-block-heading fl-hero__title">Velg din klasse.<br>Så tar maskinen resten.</h1>
			<!-- /wp:heading -->

			<!-- wp:paragraph {"className":"fl-hero__lede"} -->
			<p class="fl-hero__lede">Tre ferdigbygde gaming-PCer — håndbygget i Norge, stresstestet i 24 timer og sendt ut klar til kamp. Ingen flaskehalser, ingen unnskyldninger.</p>
			<!-- /wp:paragraph -->

			<!-- wp:group {"className":"fl-hero__ctas","layout":{"type":"default"}} -->
			<div class="wp-block-group fl-hero__ctas">
				<!-- wp:html -->
				<a class="fl-btn fl-btn--accent" href="#maskiner">Se maskinene<span class="fl-icon "><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 12h14" /><path d="m12 5 7 7-7 7" /></svg></span></a>
				<a class="fl-btn fl-btn--dark-ghost" href="#garanti">3 års garanti</a>
				<!-- /wp:html -->
			</div>
			<!-- /wp:group -->

		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"fl-hero__media","layout":{"type":"default"}} -->
		<div class="wp-block-group fl-hero__media">
			<!-- wp:image {"className":"fl-hero__frame","sizeSlug":"full","linkDestination":"none"} -->
			<figure class="wp-block-image fl-hero__frame"><img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/hero-elite.webp' ); ?>" alt="Frontline gaming-PC sett forfra" width="1200" height="1200" fetchpriority="high" decoding="async"/></figure>
			<!-- /wp:image -->

			<!-- wp:group {"className":"fl-hero__strip","layout":{"type":"default"}} -->
			<div class="wp-block-group fl-hero__strip">
								<!-- wp:group {"className":"fl-hero__stat","layout":{"type":"default"}} -->
				<div class="wp-block-group fl-hero__stat">
					<!-- wp:paragraph {"className":"fl-hero__stat-k","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
					<p class="fl-hero__stat-k" style="margin-top:0;margin-bottom:0">Byggetid</p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"className":"fl-hero__stat-v","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
					<p class="fl-hero__stat-v" style="margin-top:0;margin-bottom:0">3–5 dg</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
								<!-- wp:group {"className":"fl-hero__stat","layout":{"type":"default"}} -->
				<div class="wp-block-group fl-hero__stat">
					<!-- wp:paragraph {"className":"fl-hero__stat-k","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
					<p class="fl-hero__stat-k" style="margin-top:0;margin-bottom:0">Stresstest</p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"className":"fl-hero__stat-v","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
					<p class="fl-hero__stat-v" style="margin-top:0;margin-bottom:0">24 t</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
								<!-- wp:group {"className":"fl-hero__stat","layout":{"type":"default"}} -->
				<div class="wp-block-group fl-hero__stat">
					<!-- wp:paragraph {"className":"fl-hero__stat-k","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
					<p class="fl-hero__stat-k" style="margin-top:0;margin-bottom:0">Garanti</p>
					<!-- /wp:paragraph -->

					<!-- wp:paragraph {"className":"fl-hero__stat-v","style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
					<p class="fl-hero__stat-v" style="margin-top:0;margin-bottom:0">3 år</p>
					<!-- /wp:paragraph -->
				</div>
				<!-- /wp:group -->
							</div>
			<!-- /wp:group -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","className":"fl-usp","layout":{"type":"default"}} -->
<section class="wp-block-group fl-usp">
	<!-- wp:group {"className":"fl-wrap fl-usp__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group fl-wrap fl-usp__inner">
				<!-- wp:group {"className":"fl-usp__item","layout":{"type":"default"}} -->
		<div class="wp-block-group fl-usp__item">
			<!-- wp:html -->
			<span class="fl-icon "><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" /></svg></span>			<!-- /wp:html -->

			<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
			<p style="margin-top:0;margin-bottom:0">Bygget i Norge</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
				<!-- wp:group {"className":"fl-usp__item","layout":{"type":"default"}} -->
		<div class="wp-block-group fl-usp__item">
			<!-- wp:html -->
			<span class="fl-icon "><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z" /><path d="m9 12 2 2 4-4" /></svg></span>			<!-- /wp:html -->

			<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
			<p style="margin-top:0;margin-bottom:0">Norsk garanti &amp; service</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
				<!-- wp:group {"className":"fl-usp__item","layout":{"type":"default"}} -->
		<div class="wp-block-group fl-usp__item">
			<!-- wp:html -->
			<span class="fl-icon "><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2" /><path d="M15 18H9" /><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14" /><circle cx="17" cy="18" r="2" /><circle cx="7" cy="18" r="2" /></svg></span>			<!-- /wp:html -->

			<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
			<p style="margin-top:0;margin-bottom:0">Fri frakt over 1 500,–</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
				<!-- wp:group {"className":"fl-usp__item","layout":{"type":"default"}} -->
		<div class="wp-block-group fl-usp__item">
			<!-- wp:html -->
			<span class="fl-icon "><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect width="20" height="14" x="2" y="5" rx="2" /><line x1="2" x2="22" y1="10" y2="10" /></svg></span>			<!-- /wp:html -->

			<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
			<p style="margin-top:0;margin-bottom:0">Delbetaling: Klarna &amp; Vipps</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
				<!-- wp:group {"className":"fl-usp__item","layout":{"type":"default"}} -->
		<div class="wp-block-group fl-usp__item">
			<!-- wp:html -->
			<span class="fl-icon "><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="m16 16 2 2 4-4" /><path d="M21 10V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l2-1.14" /><path d="m7.5 4.27 9 5.15" /><polyline points="3.29 7 12 12 20.71 7" /><line x1="12" x2="12" y1="22" y2="12" /></svg></span>			<!-- /wp:html -->

			<!-- wp:paragraph {"style":{"spacing":{"margin":{"top":"0","bottom":"0"}}}} -->
			<p style="margin-top:0;margin-bottom:0">Levering 3–5 dager</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->
			</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","className":"fl-wrap fl-klasser","style":{"spacing":{"padding":{"top":"72px","bottom":"8px"}}},"layout":{"type":"default"}} -->
<section class="wp-block-group fl-wrap fl-klasser" style="padding-top:72px;padding-bottom:8px">
	<!-- wp:group {"className":"fl-section-head","layout":{"type":"default"}} -->
	<div class="wp-block-group fl-section-head">
		<!-- wp:group {"className":"fl-section-head__copy","layout":{"type":"default"}} -->
		<div class="wp-block-group fl-section-head__copy">
			<!-- wp:paragraph {"className":"fl-eyebrow"} -->
			<p class="fl-eyebrow">Tre prisklasser</p>
			<!-- /wp:paragraph -->

			<!-- wp:heading {"level":2} -->
			<h2 class="wp-block-heading">Fighter. Ghost. Titan.</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Samme byggekvalitet i alle tre. Forskjellen er hvor høyt du sikter — 1080p, 1440p eller 4K uten kompromiss.</p>
			<!-- /wp:paragraph -->
		</div>
		<!-- /wp:group -->

		<!-- wp:html -->
		<a class="fl-link-arrow" href="/products/">Sammenlign alle spesifikasjoner<span class="fl-icon "><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M5 12h14" /><path d="m12 5 7 7-7 7" /></svg></span></a>
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
		<!-- /wp:woocommerce/product-template -->

		<!-- wp:woocommerce/product-collection-no-results -->
			<!-- wp:paragraph {"className":"fl-prose"} -->
			<p class="fl-prose">Ingen maskiner er merket som utvalgte akkurat nå. Merk tre produkter som «utvalgt» i WooCommerce for å fylle denne seksjonen.</p>
			<!-- /wp:paragraph -->
		<!-- /wp:woocommerce/product-collection-no-results -->
	</div>
	<!-- /wp:woocommerce/product-collection -->
</section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","className":"fl-section-dark","anchor":"garanti","layout":{"type":"default"}} -->
<section class="wp-block-group fl-section-dark" id="garanti">
	<!-- wp:html -->
	<div class="fl-section-dark__glow" aria-hidden="true"></div>
	<!-- /wp:html -->

	<!-- wp:group {"className":"fl-wrap fl-section-dark__inner","layout":{"type":"default"}} -->
	<div class="wp-block-group fl-wrap fl-section-dark__inner">
		<!-- wp:paragraph {"className":"fl-eyebrow fl-eyebrow--on-dark"} -->
		<p class="fl-eyebrow fl-eyebrow--on-dark">Slik bygger vi</p>
		<!-- /wp:paragraph -->

		<!-- wp:heading {"level":2} -->
		<h2 class="wp-block-heading">Fire steg fra bestilling til første kamp</h2>
		<!-- /wp:heading -->

		<!-- wp:group {"className":"fl-steps","layout":{"type":"default"}} -->
		<div class="wp-block-group fl-steps">
						<!-- wp:group {"className":"fl-glass-tile","layout":{"type":"default"}} -->
			<div class="wp-block-group fl-glass-tile">
				<!-- wp:html -->
				<div class="fl-glass-tile__top">
					<span class="fl-icon "><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><circle cx="12" cy="12" r="10" /><circle cx="12" cy="12" r="6" /><circle cx="12" cy="12" r="2" /></svg></span>					<span class="fl-glass-tile__nr">01</span>
				</div>
				<!-- /wp:html -->

				<!-- wp:heading {"level":3} -->
				<h3 class="wp-block-heading">Du velger klasse</h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph -->
				<p>Fighter, Ghost, Titan eller Prism. Er du usikker, svarer vi innen en time.</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
						<!-- wp:group {"className":"fl-glass-tile","layout":{"type":"default"}} -->
			<div class="wp-block-group fl-glass-tile">
				<!-- wp:html -->
				<div class="fl-glass-tile__top">
					<span class="fl-icon "><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" /></svg></span>					<span class="fl-glass-tile__nr">02</span>
				</div>
				<!-- /wp:html -->

				<!-- wp:heading {"level":3} -->
				<h3 class="wp-block-heading">Vi bygger for hånd</h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph -->
				<p>Kabelføring, montering og BIOS-oppsett gjøres av én tekniker i Norge.</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
						<!-- wp:group {"className":"fl-glass-tile","layout":{"type":"default"}} -->
			<div class="wp-block-group fl-glass-tile">
				<!-- wp:html -->
				<div class="fl-glass-tile__top">
					<span class="fl-icon "><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M22 12h-2.48a2 2 0 0 0-1.93 1.46l-2.35 8.36a.25.25 0 0 1-.48 0L9.24 2.18a.25.25 0 0 0-.48 0l-2.35 8.36A2 2 0 0 1 4.49 12H2" /></svg></span>					<span class="fl-glass-tile__nr">03</span>
				</div>
				<!-- /wp:html -->

				<!-- wp:heading {"level":3} -->
				<h3 class="wp-block-heading">24 timer stresstest</h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph -->
				<p>Full last på GPU, CPU og minne. Temperaturlogg følger med i esken.</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
						<!-- wp:group {"className":"fl-glass-tile","layout":{"type":"default"}} -->
			<div class="wp-block-group fl-glass-tile">
				<!-- wp:html -->
				<div class="fl-glass-tile__top">
					<span class="fl-icon "><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M14 18V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v11a1 1 0 0 0 1 1h2" /><path d="M15 18H9" /><path d="M19 18h2a1 1 0 0 0 1-1v-3.65a1 1 0 0 0-.22-.624l-3.48-4.35A1 1 0 0 0 17.52 8H14" /><circle cx="17" cy="18" r="2" /><circle cx="7" cy="18" r="2" /></svg></span>					<span class="fl-glass-tile__nr">04</span>
				</div>
				<!-- /wp:html -->

				<!-- wp:heading {"level":3} -->
				<h3 class="wp-block-heading">Levert klar til kamp</h3>
				<!-- /wp:heading -->

				<!-- wp:paragraph -->
				<p>Windows installert, drivere oppdatert. Slå på og spill — 3–5 dager.</p>
				<!-- /wp:paragraph -->
			</div>
			<!-- /wp:group -->
					</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->

<!-- wp:group {"tagName":"section","className":"fl-wrap fl-support","anchor":"support","layout":{"type":"default"}} -->
<section class="wp-block-group fl-wrap fl-support" id="support">
	<!-- wp:group {"className":"fl-support__panel","layout":{"type":"default"}} -->
	<div class="wp-block-group fl-support__panel">

		<!-- wp:group {"className":"fl-support__left","layout":{"type":"default"}} -->
		<div class="wp-block-group fl-support__left">
			<!-- wp:heading {"level":2} -->
			<h2 class="wp-block-heading">Usikker på hvilken klasse?</h2>
			<!-- /wp:heading -->

			<!-- wp:paragraph -->
			<p>Send oss spillene dine og skjermen du bruker. Vi svarer med én anbefaling — ikke et prisark.</p>
			<!-- /wp:paragraph -->

			<!-- wp:html -->
			<div class="fl-support__ctas">
				<a class="fl-btn fl-btn--md fl-btn--accent" href="/kontakt-oss/"><span class="fl-icon "><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" /></svg></span>Chat med oss</a>
							</div>
			<!-- /wp:html -->
		</div>
		<!-- /wp:group -->

		<!-- wp:group {"className":"fl-support__right","layout":{"type":"default"}} -->
		<div class="wp-block-group fl-support__right">
			<!-- wp:paragraph {"className":"fl-eyebrow"} -->
			<p class="fl-eyebrow">Nyhetsbrev</p>
			<!-- /wp:paragraph -->

			<!-- wp:paragraph -->
			<p>Nye bygg, lagerslipp og kampanjer — én e-post i måneden. Ingen støy.</p>
			<!-- /wp:paragraph -->

			<!-- wp:html -->
			<form class="fl-newsletter" action="" method="post">
					<label class="screen-reader-text" for="fl-newsletter-email">E-postadresse</label>
					<span class="fl-newsletter__field"><span class="fl-icon "><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect width="20" height="16" x="2" y="4" rx="2" /><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" /></svg></span><input type="email" id="fl-newsletter-email" name="fl_email" placeholder="din@epost.no" autocomplete="email" required /></span>
					<button type="submit" class="fl-btn fl-btn--md fl-btn--primary">Meld meg på</button>
				</form>			<!-- /wp:html -->

			<!-- wp:html -->
			<p class="fl-note"><span class="fl-icon "><svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false"><rect width="18" height="11" x="3" y="11" rx="2" ry="2" /><path d="M7 11V7a5 5 0 0 1 10 0v4" /></svg></span>Vi deler aldri e-posten din.</p>
			<!-- /wp:html -->
		</div>
		<!-- /wp:group -->
	</div>
	<!-- /wp:group -->
</section>
<!-- /wp:group -->
