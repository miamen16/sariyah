<?php
/**
 * WooCommerce helpers for Sariyah.
 *
 * @package Sariyah
 */

declare(strict_types=1);

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function sariyah_woocommerce_active(): bool {
    return class_exists( 'WooCommerce' );
}

function sariyah_render_product_card( WC_Product $product ): void {
    $product_id = $product->get_id();
    $classes    = 'sariyah-button sariyah-product-card__button';
    $url        = $product->get_permalink();
    $label      = __( 'View product', 'sariyah' );
    $attributes = '';

    if ( $product->is_purchasable() && $product->is_in_stock() && $product->is_type( 'simple' ) ) {
        $url        = $product->add_to_cart_url();
        $label      = $product->add_to_cart_text();
        $classes   .= ' add_to_cart_button ajax_add_to_cart';
        $attributes  = sprintf(
            ' data-quantity="1" data-product_id="%d" data-product_sku="%s" aria-label="%s"',
            $product_id,
            esc_attr( $product->get_sku() ),
            esc_attr( $product->add_to_cart_description() )
        );
    }
    ?>
    <article class="sariyah-product-card">
        <a class="sariyah-product-card__image" href="<?php echo esc_url( $product->get_permalink() ); ?>" aria-label="<?php echo esc_attr( $product->get_name() ); ?>">
            <?php echo wp_kses_post( $product->get_image( 'woocommerce_thumbnail', array( 'loading' => 'lazy' ) ) ); ?>
            <?php if ( $product->is_on_sale() ) : ?><span class="sariyah-product-card__badge"><?php esc_html_e( 'Sale', 'sariyah' ); ?></span><?php endif; ?>
        </a>
        <div class="sariyah-product-card__body">
            <?php if ( $product->get_average_rating() > 0 ) : ?>
                <div class="sariyah-product-card__rating" aria-label="<?php echo esc_attr( sprintf( __( 'Rated %s out of 5', 'sariyah' ), $product->get_average_rating() ) ); ?>"><?php echo wp_kses_post( wc_get_rating_html( $product->get_average_rating(), $product->get_rating_count() ) ); ?></div>
            <?php endif; ?>
            <h3 class="sariyah-product-card__title"><a href="<?php echo esc_url( $product->get_permalink() ); ?>"><?php echo esc_html( $product->get_name() ); ?></a></h3>
            <div class="sariyah-product-card__price"><?php echo wp_kses_post( $product->get_price_html() ); ?></div>
            <a class="<?php echo esc_attr( $classes ); ?>" href="<?php echo esc_url( $url ); ?>" rel="nofollow"<?php echo $attributes; ?>><?php echo esc_html( $label ); ?></a>
        </div>
    </article>
    <?php
}
