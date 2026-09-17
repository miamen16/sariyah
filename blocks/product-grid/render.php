<?php
/** Dynamic WooCommerce product grid. */
if ( ! function_exists( 'wc_get_products' ) ) {
    return;
}

$title       = get_field( 'title' ) ?: __( 'Our products', 'sariyah' );
$description = get_field( 'description' );
$source      = get_field( 'source' ) ?: 'latest';
$count       = max( 1, min( 24, (int) ( get_field( 'count' ) ?: 8 ) ) );
$columns     = max( 2, min( 6, (int) ( get_field( 'columns' ) ?: 4 ) ) );
$category    = get_field( 'category' );

$args = array('limit'=>$count,'status'=>'publish','visibility'=>'visible');
if ( 'featured' === $source ) { $args['featured'] = true; }
if ( 'sale' === $source ) { $args['on_sale'] = true; }
if ( $category ) { $args['category'] = is_object($category) ? $category->slug : (array) $category; }
if ( 'bestselling' === $source ) { $args['orderby'] = 'popularity'; $args['order'] = 'DESC'; }
else { $args['orderby'] = 'date'; $args['order'] = 'DESC'; }
$products = wc_get_products( $args );
?>
<section class="sariyah-products sariyah-products--grid">
  <div class="sariyah-container">
    <?php if ( $title || $description ) : ?><header class="sariyah-products__heading"><h2><?php echo esc_html( $title ); ?></h2><?php if ( $description ) : ?><p><?php echo esc_html( $description ); ?></p><?php endif; ?></header><?php endif; ?>
    <?php if ( $products ) : ?><div class="sariyah-products__grid" style="--sariyah-product-columns:<?php echo esc_attr( $columns ); ?>"><?php foreach ( $products as $product ) : ?><div><?php sariyah_render_product_card( $product ); ?></div><?php endforeach; ?></div><?php else : ?><p class="sariyah-products__empty"><?php esc_html_e( 'No products found.', 'sariyah' ); ?></p><?php endif; ?>
  </div>
</section>
