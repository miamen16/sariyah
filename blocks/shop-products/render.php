<?php
/** WooCommerce shop/archive products. */
if ( ! function_exists( 'wc_get_products' ) ) { return; }

$title   = get_field( 'title' ) ?: ( is_product_category() ? single_term_title( '', false ) : __( 'Shop', 'sariyah' ) );
$count   = max( 1, min( 48, (int) ( get_field( 'count' ) ?: 12 ) ) );
$columns = max( 2, min( 6, (int) ( get_field( 'columns' ) ?: 4 ) ) );
$order   = get_query_var( 'order' ) ?: 'DESC';
$orderby = get_query_var( 'orderby' ) ?: 'date';

$args = array(
    'limit'   => $count,
    'status'  => 'publish',
    'orderby' => in_array( $orderby, array( 'date', 'title', 'price', 'popularity', 'rating' ), true ) ? $orderby : 'date',
    'order'   => 'ASC' === strtoupper( $order ) ? 'ASC' : 'DESC',
);
if ( is_product_category() ) {
    $term = get_queried_object();
    if ( $term instanceof WP_Term ) { $args['category'] = array( $term->slug ); }
}
$products = wc_get_products( $args );
?>
<section class="sariyah-shop-products">
  <div class="sariyah-container">
    <?php if ( $title ) : ?><header class="sariyah-products__heading"><h1><?php echo esc_html( $title ); ?></h1></header><?php endif; ?>
    <?php if ( $products ) : ?>
      <div class="sariyah-products__grid" style="--sariyah-product-columns:<?php echo esc_attr( $columns ); ?>">
        <?php foreach ( $products as $product ) : ?><div><?php sariyah_render_product_card( $product ); ?></div><?php endforeach; ?>
      </div>
    <?php else : ?><p class="sariyah-products__empty"><?php esc_html_e( 'No products found.', 'sariyah' ); ?></p><?php endif; ?>
  </div>
</section>
