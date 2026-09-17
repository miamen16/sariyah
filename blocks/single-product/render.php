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
      <?php
      $gallery_ids = $product->get_gallery_image_ids();
      if ( $gallery_ids ) :
      ?><div class="sariyah-single-product__thumbs"><?php foreach ( $gallery_ids as $image_id ) : ?><span><?php echo wp_get_attachment_image( $image_id, 'woocommerce_thumbnail', false, array( 'loading' => 'lazy' ) ); ?></span><?php endforeach; ?></div><?php endif; ?>
    </div>
    <div class="sariyah-single-product__summary">
      <?php if ( $product->get_average_rating() > 0 ) : ?><div class="sariyah-single-product__rating"><?php echo wp_kses_post( wc_get_rating_html( $product->get_average_rating(), $product->get_rating_count() ) ); ?></div><?php endif; ?>
      <h1><?php echo esc_html( $product->get_name() ); ?></h1>
      <div class="sariyah-single-product__price"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>
      <?php if ( $product->get_short_description() ) : ?><div class="sariyah-single-product__excerpt"><?php echo wp_kses_post( wpautop( $product->get_short_description() ) ); ?></div><?php endif; ?>
      <?php if ( $product->is_purchasable() ) : ?>
        <?php if ( $product->is_type( 'simple' ) ) : ?>
          <?php echo do_shortcode( '[add_to_cart id="' . absint( $product->get_id() ) . '" show_price="false"]' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
        <?php else : ?>
          <a class="sariyah-button sariyah-button--primary" href="<?php echo esc_url( $product->get_permalink() ); ?>#variations"><?php esc_html_e( 'Choose options', 'sariyah' ); ?></a>
        <?php endif; ?>
      <?php endif; ?>
      <div class="sariyah-single-product__meta"><span><?php esc_html_e( 'SKU:', 'sariyah' ); ?> <?php echo esc_html( $product->get_sku() ?: '—' ); ?></span></div>
    </div>
  </div>
  <div class="sariyah-container sariyah-single-product__description"><?php echo wp_kses_post( apply_filters( 'the_content', $product->get_description() ) ); ?></div>
</section>
<?php
return ob_get_clean();
