<?php
/** WooCommerce product card. */
if ( ! function_exists( 'wc_get_product' ) ) {
    return;
}

$product_id = (int) get_field( 'product' );
$product    = $product_id ? wc_get_product( $product_id ) : false;

if ( $product instanceof WC_Product ) {
    wp_enqueue_script( 'wc-add-to-cart' );
    sariyah_render_product_card( $product );
}
