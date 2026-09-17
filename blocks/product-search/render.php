<?php
/**
 * WooCommerce product search form.
 */

$action = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
$placeholder = function_exists( 'get_field' ) ? get_field( 'placeholder' ) : '';
$placeholder = $placeholder ?: __( 'Search products…', 'sariyah' );
$input_id = function_exists( 'wp_unique_id' ) ? wp_unique_id( 'sariyah-product-search-input-' ) : 'sariyah-product-search-input';
$search_value = get_search_query();
?>
<div class="sariyah-product-search">
    <form role="search" method="get" action="<?php echo esc_url( $action ); ?>">
        <label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>"><?php esc_html_e( 'Search products', 'sariyah' ); ?></label>
        <input id="<?php echo esc_attr( $input_id ); ?>" type="search" name="s" value="<?php echo esc_attr( $search_value ); ?>" placeholder="<?php echo esc_attr( $placeholder ); ?>">
        <input type="hidden" name="post_type" value="product">
        <button type="submit"><?php esc_html_e( 'Search', 'sariyah' ); ?></button>
    </form>
</div>
