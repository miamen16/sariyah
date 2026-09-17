<?php
/** WooCommerce cart block wrapper. */
if ( ! function_exists( 'do_shortcode' ) || ! function_exists( 'WC' ) ) {
    return;
}

ob_start();
?>
<section class="sariyah-cart">
    <div class="sariyah-container">
        <?php echo do_shortcode( '[woocommerce_cart]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
    </div>
</section>
<?php
return ob_get_clean();
