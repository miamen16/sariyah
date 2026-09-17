<?php
/**
 * WooCommerce cart block wrapper.
 */
if ( ! function_exists( 'WC' ) ) {
    return;
}

ob_start();
?>
<section class="sariyah-cart">
    <div class="sariyah-container">
        <?php
        $cart_block = '<!-- wp:woocommerce/cart /-->';

        if ( function_exists( 'do_blocks' ) && class_exists( 'WP_Block_Type_Registry' ) && WP_Block_Type_Registry::get_instance()->is_registered( 'woocommerce/cart' ) ) {
            echo do_blocks( $cart_block ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        } elseif ( function_exists( 'do_shortcode' ) ) {
            // Fallback for older WooCommerce versions that do not provide the Cart block.
            echo do_shortcode( '[woocommerce_cart]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }
        ?>
    </div>
</section>
<?php
return ob_get_clean();
