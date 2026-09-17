<?php
/** WooCommerce single product layout. */
if ( ! function_exists( 'wc_get_product' ) ) {
    return;
}

$product = wc_get_product( get_the_ID() );
if ( ! $product instanceof WC_Product ) {
    return;
}

ob_start();
?>
<section class="sariyah-single-product">
  <div class="sariyah-container sariyah-single-product__layout">
    <div class="sariyah-single-product__gallery">
      <?php
      $image_id = $product->get_image_id();
      if ( $image_id ) {
          echo wp_kses_post( wp_get_attachment_image( $image_id, 'woocommerce_single' ) );
      } else {
          echo wp_kses_post( wc_placeholder_img( 'woocommerce_single' ) );
      }
      ?>
      <?php $gallery_ids = $product->get_gallery_image_ids(); ?>
      <?php if ( $gallery_ids ) : ?>
        <div class="sariyah-single-product__thumbs" role="list" aria-label="<?php esc_attr_e( 'Product images', 'sariyah' ); ?>">
          <?php foreach ( $gallery_ids as $index => $image_id ) : ?>
            <?php
            $full_image  = wp_get_attachment_image_src( $image_id, 'woocommerce_single' );
            $full_src    = $full_image ? $full_image[0] : wp_get_attachment_url( $image_id );
            $full_srcset = wp_get_attachment_image_srcset( $image_id, 'woocommerce_single' );
            $full_sizes  = wp_get_attachment_image_sizes( $image_id, 'woocommerce_single' );
            ?>
            <button type="button" class="sariyah-single-product__thumb" role="listitem" aria-label="<?php echo esc_attr( sprintf( __( 'View product image %d', 'sariyah' ), $index + 2 ) ); ?>" aria-pressed="false">
              <?php
              echo wp_kses_post(
                  wp_get_attachment_image(
                      $image_id,
                      'woocommerce_thumbnail',
                      false,
                      array(
                          'loading'         => 'lazy',
                          'data-full-image' => $full_src,
                          'data-full-srcset' => $full_srcset ?: '',
                          'data-full-sizes' => $full_sizes ?: '',
                      )
                  )
              );
              ?>
            </button>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="sariyah-single-product__summary">
      <?php if ( $product->get_average_rating() > 0 ) : ?>
        <div class="sariyah-single-product__rating" aria-label="<?php echo esc_attr( sprintf( __( 'Rated %s out of 5', 'sariyah' ), $product->get_average_rating() ) ); ?>">
          <?php echo wp_kses_post( wc_get_rating_html( $product->get_average_rating(), $product->get_rating_count() ) ); ?>
        </div>
      <?php endif; ?>
      <h1><?php echo esc_html( $product->get_name() ); ?></h1>
      <div class="sariyah-single-product__price"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>
      <?php if ( $product->get_short_description() ) : ?>
        <div class="sariyah-single-product__excerpt"><?php echo wp_kses_post( wpautop( $product->get_short_description() ) ); ?></div>
      <?php endif; ?>
      <?php if ( $product->is_purchasable() ) : ?>
        <div class="sariyah-single-product__cart">
          <?php
          switch ( $product->get_type() ) {
              case 'simple':
                  woocommerce_simple_add_to_cart();
                  break;
              case 'variable':
                  woocommerce_variable_add_to_cart();
                  break;
              case 'grouped':
                  woocommerce_grouped_add_to_cart();
                  break;
              case 'external':
                  woocommerce_external_add_to_cart();
                  break;
          }
          ?>
        </div>
      <?php endif; ?>
      <div class="sariyah-single-product__meta">
        <?php if ( $product->get_sku() ) : ?>
          <span><?php esc_html_e( 'SKU:', 'sariyah' ); ?> <?php echo esc_html( $product->get_sku() ); ?></span>
        <?php endif; ?>
        <?php echo wp_kses_post( wc_get_stock_html( $product ) ); ?>
      </div>
    </div>
  </div>
  <div class="sariyah-container sariyah-single-product__description">
    <?php echo wp_kses_post( apply_filters( 'the_content', $product->get_description() ) ); ?>
  </div>
</section>
<?php
return ob_get_clean();
