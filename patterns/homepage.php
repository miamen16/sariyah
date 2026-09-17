<?php
/**
 * Title: Sariyah Tea Store Homepage
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
<!-- wp:group {"align":"full","className":"sariyah-home-news"} -->
<div class="wp-block-group alignfull sariyah-home-news">
  <div class="wp-block-group__inner-container">
    <!-- wp:heading {"level":2} -->
    <h2 class="wp-block-heading">آخر الأخبار والمقالات</h2>
    <!-- /wp:heading -->
    <!-- wp:paragraph -->
    <p>اكتشف قصص الشاي، النصائح، والوصفات والأخبار الجديدة.</p>
    <!-- /wp:paragraph -->
    <!-- wp:query {"query":{"perPage":3,"postType":"post","order":"desc","orderBy":"date"},"displayLayout":{"type":"flex","columns":3}} -->
    <div class="wp-block-query">
      <!-- wp:post-template -->
      <!-- wp:post-featured-image {"isLink":true,"height":"220px"} /-->
      <!-- wp:post-title {"isLink":true} /-->
      <!-- wp:post-date /-->
      <!-- wp:post-excerpt {"moreText":"اقرأ المزيد"} /-->
      <!-- /wp:post-template -->
    </div>
    <!-- /wp:query -->
  </div>
</div>
<!-- /wp:group -->