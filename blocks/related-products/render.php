<?php
/** WooCommerce related products. */
if ( ! function_exists( 'wc_get_related_products' ) || ! function_exists( 'wc_get_product' ) ) {
    return;
}

$product = wc_get_product( get_the_ID() );
if ( ! $product ) {
    return;
}

$ids = wc_get_related_products( $product->get_id(), 4 );
if ( ! $ids ) {
    return;
}

$products = array_filter( array_map( 'wc_get_product', $ids ) );
if ( ! $products ) {
    return;
}
?>
<section class="sariyah-related-products">
  <div class="sariyah-container">
    <header class="sariyah-products__heading"><h2><?php esc_html_e( 'Related products', 'sariyah' ); ?></h2></header>
    <div class="sariyah-products__grid" style="--sariyah-product-columns:4">
      <?php foreach ( $products as $related ) : ?>
        <?php if ( $related instanceof WC_Product ) : ?>
          <div><?php sariyah_render_product_card( $related ); ?></div>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  </div>
</section>
