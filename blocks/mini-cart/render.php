<?php
/** WooCommerce mini cart. */
if ( ! function_exists( 'WC' ) || ! WC()->cart ) { return; }

$cart = WC()->cart;
?>
<aside class="sariyah-mini-cart" aria-label="<?php esc_attr_e( 'Shopping cart', 'sariyah' ); ?>">
  <div class="sariyah-mini-cart__header"><h2><?php esc_html_e( 'Your cart', 'sariyah' ); ?></h2><span><?php echo esc_html( $cart->get_cart_contents_count() ); ?></span></div>
  <?php if ( $cart->is_empty() ) : ?>
    <p class="sariyah-mini-cart__empty"><?php esc_html_e( 'Your cart is currently empty.', 'sariyah' ); ?></p>
  <?php else : ?>
    <ul class="sariyah-mini-cart__items">
      <?php foreach ( $cart->get_cart() as $cart_item_key => $cart_item ) :
        $product = $cart_item['data'];
        if ( ! $product || ! $product->exists() ) { continue; }
      ?>
        <li class="sariyah-mini-cart__item">
          <a href="<?php echo esc_url( $product->get_permalink( $cart_item ) ); ?>" class="sariyah-mini-cart__image"><?php echo wp_kses_post( $product->get_image( 'woocommerce_thumbnail' ) ); ?></a>
          <div class="sariyah-mini-cart__details"><a href="<?php echo esc_url( $product->get_permalink( $cart_item ) ); ?>"><?php echo esc_html( $product->get_name() ); ?></a><span><?php echo esc_html( $cart_item['quantity'] ); ?> × <?php echo wp_kses_post( $product->get_price_html() ); ?></span></div>
        </li>
      <?php endforeach; ?>
    </ul>
    <div class="sariyah-mini-cart__total"><strong><?php esc_html_e( 'Subtotal', 'sariyah' ); ?></strong><span><?php echo wp_kses_post( $cart->get_cart_subtotal() ); ?></span></div>
    <div class="sariyah-mini-cart__actions"><a class="sariyah-button" href="<?php echo esc_url( wc_get_cart_url() ); ?>"><?php esc_html_e( 'View cart', 'sariyah' ); ?></a><a class="sariyah-button sariyah-button--primary" href="<?php echo esc_url( wc_get_checkout_url() ); ?>"><?php esc_html_e( 'Checkout', 'sariyah' ); ?></a></div>
  <?php endif; ?>
</aside>
