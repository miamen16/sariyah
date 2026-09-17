<?php
/**
 * WooCommerce product card.
 */
if ( ! function_exists( 'wc_get_product' ) || ! class_exists( 'WC_Product' ) ) {
    return;
}

$product_id = function_exists( 'get_field' ) ? (int) get_field( 'product' ) : 0;
$product    = $product_id ? wc_get_product( $product_id ) : false;

if ( $product instanceof WC_Product ) {
    sariyah_render_product_card( $product );
}
