<?php
if ( ! function_exists( 'WC' ) || ! WC()->cart ) { return; }
$ids = WC()->cart->get_cross_sells();
$products = array_filter( array_map( 'wc_get_product', $ids ) );
if ( ! $products ) { return; }
$title = get_field( 'title' ) ?: __( 'You may also need', 'sariyah' );
?><section class="sariyah-products sariyah-cross-sells"><div class="sariyah-container"><header class="sariyah-products__heading"><h2><?php echo esc_html( $title ); ?></h2></header><div class="sariyah-products__grid" style="--sariyah-product-columns:4"><?php foreach ( $products as $item ) : ?><div><?php sariyah_render_product_card( $item ); ?></div><?php endforeach; ?></div></div></section>
