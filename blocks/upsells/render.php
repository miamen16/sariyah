<?php
if ( ! function_exists( 'wc_get_product' ) ) { return; }
$product = wc_get_product( get_the_ID() );
if ( ! $product ) { return; }
$ids = $product->get_upsell_ids();
$products = array_filter( array_map( 'wc_get_product', $ids ) );
if ( ! $products ) { return; }
$title = get_field( 'title' ) ?: __( 'You may also like', 'sariyah' );
?><section class="sariyah-products sariyah-upsells"><div class="sariyah-container"><header class="sariyah-products__heading"><h2><?php echo esc_html( $title ); ?></h2></header><div class="sariyah-products__grid" style="--sariyah-product-columns:4"><?php foreach ( $products as $item ) : ?><div><?php sariyah_render_product_card( $item ); ?></div><?php endforeach; ?></div></div></section>
