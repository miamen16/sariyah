<?php
/** WooCommerce single product layout. */
if ( ! function_exists( 'wc_get_product' ) ) { return ''; }

$product = wc_get_product( get_the_ID() );
if ( ! $product ) { return ''; }

ob_start();
?>
<section class="sariyah-single-product">
  <div class="sariyah-container sariyah-single-product__layout">
    <div class="sariyah-single-product__gallery">
      <?php echo wp_kses_post( $product->get_image( 'woocommerce_single' ) ); ?>
      <?php $gallery_ids = $product->get_gallery_image_ids(); ?>
      <?php if ( $gallery_ids ) : ?>
        <div class="sariyah-single-product__thumbs">
          <?php foreach ( $gallery_ids as $image_id ) : ?>
            <button type="button" class="sariyah-single-product__thumb" aria-label="<?php echo esc_attr( sprintf( __( 'View image %d', 'sariyah' ), $image_id ) ); ?>">
              <?php echo wp_kses_post( wp_get_attachment_image( $image_id, 'woocommerce_thumbnail', false, array( 'loading' => 'lazy' ) ) ); ?>
            </button>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="sariyah-single-product__summary">
      <?php if ( $product->get_average_rating() > 0 ) : ?><div class="sariyah-single-product__rating"><?php echo wp_kses_post( wc_get_rating_html( $product->get_average_rating(), $product->get_rating_count() ) ); ?></div><?php endif; ?>
      <h1><?php echo esc_html( $product->get_name() ); ?></h1>
      <div class="sariyah-single-product__price"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>
      <?php if ( $product->get_short_description() ) : ?><div class="sariyah-single-product__excerpt"><?php echo wp_kses_post( wpautop( $product->get_short_description() ) ); ?></div><?php endif; ?>
      <?php if ( $product->is_purchasable() ) : ?>
        <div class="sariyah-single-product__cart">
          <?php
do_action( 'woocommerce_' . $product->get_type() . '_add_to_cart' );
          if ( 'simple' === $product->get_type() ) {
              woocommerce_simple_add_to_cart();
          } elseif ( 'variable' === $product->get_type() ) {
              woocommerce_variable_add_to_cart();
          } elseif ( 'grouped' === $product->get_type() ) {
              woocommerce_grouped_add_to_cart();
          } elseif ( 'external' === $product->get_type() ) {
              woocommerce_external_add_to_cart();
          }
          ?>
        </div>
      <?php endif; ?>
      <div class="sariyah-single-product__meta"><span><?php esc_html_e( 'SKU:', 'sariyah' ); ?> <?php echo esc_html( $product->get_sku() ?: '—' ); ?></span></div>
    </div>
  </div>
  <div class="sariyah-container sariyah-single-product__description"><?php echo wp_kses_post( apply_filters( 'the_content', $product->get_description() ) ); ?></div>
</section>
<?php
return ob_get_clean();
