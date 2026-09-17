<?php
if ( ! function_exists( 'do_shortcode' ) || ! function_exists( 'WC' ) ) { return ''; }

ob_start();
?>
<section class="sariyah-cart">
  <?php echo do_shortcode( '[woocommerce_cart]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</section>
<?php
return ob_get_clean();
