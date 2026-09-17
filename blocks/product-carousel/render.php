<?php
if ( ! function_exists( 'wc_get_products' ) ) { return; }
$title = get_field( 'title' ) ?: __( 'Shop our products', 'sariyah' );
$description = get_field( 'description' );
$count = max( 2, min( 20, (int) ( get_field( 'count' ) ?: 10 ) ) );
$source = get_field( 'source' ) ?: 'latest';
$args = array( 'limit' => $count, 'status' => 'publish', 'orderby' => 'date', 'order' => 'DESC' );
if ( 'bestselling' === $source ) { $args['orderby'] = 'popularity'; }
if ( 'sale' === $source ) { $args['on_sale'] = true; }
if ( 'featured' === $source ) { $args['featured'] = true; }
$products = wc_get_products( $args );
?>
<section class="sariyah-products sariyah-product-carousel"><div class="sariyah-container">
<?php if ( $title || $description ) : ?><header class="sariyah-products__heading"><h2><?php echo esc_html( $title ); ?></h2><?php if ( $description ) : ?><p><?php echo esc_html( $description ); ?></p><?php endif; ?></header><?php endif; ?>
<?php if ( $products ) : ?><div class="sariyah-product-carousel__track"><?php foreach ( $products as $product ) : ?><div class="sariyah-product-carousel__item"><?php sariyah_render_product_card( $product ); ?></div><?php endforeach; ?></div><?php endif; ?>
</div></section>
