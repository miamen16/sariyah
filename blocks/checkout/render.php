<?php
/**
 * WooCommerce checkout block wrapper.
 */
if ( ! function_exists( 'WC' ) ) {
    return;
}

ob_start();
?>
<section class="sariyah-checkout">
    <?php
    $checkout_block = '<!-- wp:woocommerce/checkout /-->';

    if ( function_exists( 'do_blocks' ) && class_exists( 'WP_Block_Type_Registry' ) && WP_Block_Type_Registry::get_instance()->is_registered( 'woocommerce/checkout' ) ) {
        echo do_blocks( $checkout_block ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    } elseif ( function_exists( 'do_shortcode' ) && WC()->cart ) {
        // Fallback for older WooCommerce versions that do not provide the Checkout block.
        echo do_shortcode( '[woocommerce_checkout]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
    ?>
</section>
