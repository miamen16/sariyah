<?php
if ( ! function_exists( 'do_shortcode' ) || ! function_exists( 'WC' ) ) { return; }
?>
<section class="sariyah-my-account">
    <?php echo do_shortcode( '[woocommerce_my_account]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</section>
