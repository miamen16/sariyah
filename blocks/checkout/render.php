<?php
if ( ! function_exists( 'do_shortcode' ) || ! function_exists( 'WC' ) || ! WC()->cart ) { return; }
?>
<section class="sariyah-checkout">
    <?php echo do_shortcode( '[woocommerce_checkout]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</section>
