<?php
/**
 * Title: Sariyah Shop Homepage
 * Slug: sariyah/homepage
 * Categories: featured
 * Inserter: true
 *
 * WooCommerce storefront layout for Sariyah.
 */
?>
<!-- wp:sariyah/hero /-->
<!-- wp:sariyah/trust-bar /-->
<!-- wp:sariyah/product-categories /-->
<!-- wp:sariyah/best-sellers /-->
<!-- wp:sariyah/promo-banner /-->
<!-- wp:sariyah/featured-products /-->
<!-- wp:sariyah/product-carousel /-->
<!-- wp:sariyah/sale-products /-->
<!-- wp:sariyah/latest-products /-->
<!-- wp:sariyah/newsletter /-->
<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"5rem","bottom":"5rem","left":"1rem","right":"1rem"}}}} -->
<div class="wp-block-group alignfull" style="padding-top:5rem;padding-right:1rem;padding-bottom:5rem;padding-left:1rem"><div class="wp-block-group__inner-container">
<!-- wp:heading {"level":2} -->
<h2 class="wp-block-heading">Latest news and blog</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Keep up with the latest Sariyah news, stories and updates.</p>
<!-- /wp:paragraph -->
<!-- wp:query {"query":{"perPage":3,"postType":"post","order":"desc","orderBy":"date"},"displayLayout":{"type":"flex","columns":3}} -->
<div class="wp-block-query">
<!-- wp:post-template -->
<!-- wp:post-featured-image {"isLink":true,"height":"220px"} /-->
<!-- wp:post-title {"isLink":true} /-->
<!-- wp:post-date /-->
<!-- wp:post-excerpt {"moreText":"Read more"} /-->
<!-- /wp:post-template -->
</div>
<!-- /wp:query -->
</div></div>
<!-- /wp:group -->
