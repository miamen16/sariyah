<?php
if ( ! function_exists( 'wc_get_products' ) ) { return; }
$title = get_field( 'title' ) ?: __( 'Special offers', 'sariyah' );
$description = get_field( 'description' );
$count = max( 1, min( 24, (int) ( get_field( 'count' ) ?: 8 ) ) );
$columns = max( 2, min( 6, (int) ( get_field( 'columns' ) ?: 4 ) ) );
$products = wc_get_products( array( 'limit' => $count, 'status' => 'publish', 'on_sale' => true, 'orderby' => 'date', 'order' => 'DESC' ) );
?>
<section class="sariyah-products sariyah-products--sale"><div class="sariyah-container">
<?php if ( $title || $description ) : ?><header class="sariyah-products__heading"><?php if ( $title ) : ?><h2><?php echo esc_html( $title ); ?></h2><?php endif; ?><?php if ( $description ) : ?><p><?php echo esc_html( $description ); ?></p><?php endif; ?></header><?php endif; ?>
<?php if ( $products ) : ?><div class="sariyah-products__grid" style="--sariyah-product-columns:<?php echo esc_attr( $columns ); ?>"><?php foreach ( $products as $product ) : ?><div><?php sariyah_render_product_card( $product ); ?></div><?php endforeach; ?></div><?php else : ?><p class="sariyah-products__empty"><?php esc_html_e( 'No products are currently on sale.', 'sariyah' ); ?></p><?php endif; ?>
</div></section>
