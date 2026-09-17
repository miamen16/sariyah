<?php
/**
 * WooCommerce single product layout.
 *
 * @package Sariyah
 */

if ( ! function_exists( 'wc_get_product' ) || ! class_exists( 'WC_Product' ) ) {
    return;
}

$product = wc_get_product( get_the_ID() );
if ( ! $product instanceof WC_Product ) {
    return;
}

$image_id    = $product->get_image_id();
$gallery_ids = $product->get_gallery_image_ids();

if ( $product->is_purchasable() && 'variable' === $product->get_type() ) {
    wp_enqueue_script( 'wc-add-to-cart-variation' );
}
?>
<section class="sariyah-single-product">
  <div class="sariyah-container sariyah-single-product__layout">
    <div class="sariyah-single-product__gallery">
      <div class="sariyah-single-product__main-image">
        <?php
        if ( $image_id ) {
            echo wp_kses_post(
                wp_get_attachment_image(
                    $image_id,
                    'woocommerce_single',
                    false,
                    array(
                        'loading' => 'eager',
                    )
                )
            );
        } else {
            echo wp_kses_post( wc_placeholder_img( 'woocommerce_single' ) );
        }
        ?>
      </div>

      <?php if ( $image_id || $gallery_ids ) : ?>
        <div class="sariyah-single-product__thumbs" role="list" aria-label="<?php esc_attr_e( 'Product images', 'sariyah' ); ?>">
          <?php
          $thumb_ids = array_values( array_unique( array_filter( array_merge( array( $image_id ), $gallery_ids ) ) ) );
          foreach ( $thumb_ids as $index => $thumb_id ) :
              $full_image  = wp_get_attachment_image_src( $thumb_id, 'woocommerce_single' );
              $full_src    = $full_image ? $full_image[0] : wp_get_attachment_url( $thumb_id );
              $full_srcset = wp_get_attachment_image_srcset( $thumb_id, 'woocommerce_single' );
              $full_sizes  = wp_get_attachment_image_sizes( $thumb_id, 'woocommerce_single' );
              ?>
              <div role="listitem">
                <button
                  type="button"
                  class="sariyah-single-product__thumb<?php echo 0 === $index ? ' is-active' : ''; ?>"
                  aria-label="<?php echo esc_attr( sprintf( __( 'View product image %d', 'sariyah' ), $index + 1 ) ); ?>"
                  aria-pressed="<?php echo 0 === $index ? 'true' : 'false'; ?>"
                >
                  <?php
                  echo wp_kses_post(
                      wp_get_attachment_image(
                          $thumb_id,
                          'woocommerce_thumbnail',
                          false,
                          array(
                              'loading'          => 0 === $index ? 'eager' : 'lazy',
                              'data-full-image'  => $full_src,
                              'data-full-srcset' => $full_srcset ?: '',
                              'data-full-sizes'  => $full_sizes ?: '',
                          )
                      )
                  );
                  ?>
                </button>
              </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>

    <div class="sariyah-single-product__summary">
      <?php if ( $product->is_on_sale() ) : ?>
        <span class="sariyah-single-product__badge"><?php esc_html_e( 'Sale', 'sariyah' ); ?></span>
      <?php endif; ?>

      <?php if ( $product->get_average_rating() > 0 ) : ?>
        <div class="sariyah-single-product__rating" aria-label="<?php echo esc_attr( sprintf( __( 'Rated %s out of 5', 'sariyah' ), $product->get_average_rating() ) ); ?>">
          <?php echo wp_kses_post( wc_get_rating_html( $product->get_average_rating(), $product->get_rating_count() ) ); ?>
          <span>(<?php echo esc_html( $product->get_rating_count() ); ?>)</span>
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
          <span><strong><?php esc_html_e( 'SKU:', 'sariyah' ); ?></strong> <?php echo esc_html( $product->get_sku() ); ?></span>
        <?php endif; ?>
        <?php echo wp_kses_post( wc_get_stock_html( $product ) ); ?>
      </div>
    </div>
  </div>

  <div class="sariyah-container sariyah-single-product__description">
    <div class="sariyah-single-product__description-inner">
      <h2><?php esc_html_e( 'Product details', 'sariyah' ); ?></h2>
      <?php echo wp_kses_post( apply_filters( 'the_content', $product->get_description() ) ); ?>
    </div>
  </div>
</section>
