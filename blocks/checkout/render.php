<?php
if ( ! function_exists( 'do_shortcode' ) || ! function_exists( 'WC' ) ) { return; }
if ( ! WC()->cart ) { return; }
echo do_shortcode( '[woocommerce_checkout]' );
