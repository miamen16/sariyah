<?php
/**
 * WooCommerce product filters.
 */
if ( ! function_exists( 'wc_get_min_max_price' ) ) {
    return;
}

$min_max   = wc_get_min_max_price();
$min_price = isset( $min_max['min_price'] ) ? (float) $min_max['min_price'] : 0;
$max_price = isset( $min_max['max_price'] ) ? (float) $min_max['max_price'] : 0;

$current_min = isset( $_GET['min_price'] ) ? max( 0, (float) wc_format_decimal( wp_unslash( $_GET['min_price'] ) ) ) : '';
$current_max = isset( $_GET['max_price'] ) ? max( 0, (float) wc_format_decimal( wp_unslash( $_GET['max_price'] ) ) ) : '';

$categories = get_terms(
    array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => true,
        'parent'     => 0,
        'orderby'    => 'name',
        'order'      => 'ASC',
    )
);

$stock = isset( $_GET['stock'] ) ? sanitize_key( wp_unslash( $_GET['stock'] ) ) : '';
$base_url = function_exists( 'is_product_category' ) && is_product_category() ? get_term_link( get_queried_object() ) : wc_get_page_permalink( 'shop' );
if ( is_wp_error( $base_url ) ) {
    $base_url = wc_get_page_permalink( 'shop' );
}
?>
<aside class="sariyah-product-filters" aria-label="<?php esc_attr_e( 'Product filters', 'sariyah' ); ?>">
    <form method="get" action="<?php echo esc_url( $base_url ); ?>">
        <?php if ( $categories && ! is_wp_error( $categories ) ) : ?>
            <fieldset>
                <legend><?php esc_html_e( 'Category', 'sariyah' ); ?></legend>
                <label><input type="radio" name="product_cat" value="" <?php checked( '', isset( $_GET['product_cat'] ) ? sanitize_title( wp_unslash( $_GET['product_cat'] ) ) : '' ); ?>> <?php esc_html_e( 'All categories', 'sariyah' ); ?></label>
                <?php foreach ( $categories as $category ) : ?>
                    <label><input type="radio" name="product_cat" value="<?php echo esc_attr( $category->slug ); ?>" <?php checked( $category->slug, isset( $_GET['product_cat'] ) ? sanitize_title( wp_unslash( $_GET['product_cat'] ) ) : '' ); ?>> <?php echo esc_html( $category->name ); ?></label>
                <?php endforeach; ?>
            </fieldset>
        <?php endif; ?>

        <fieldset>
            <legend><?php esc_html_e( 'Price range', 'sariyah' ); ?></legend>
            <div class="sariyah-product-filters__prices">
                <label><?php esc_html_e( 'From', 'sariyah' ); ?><input type="number" min="0" step="0.01" name="min_price" value="<?php echo esc_attr( $current_min ); ?>"<?php echo $max_price > 0 ? ' max="' . esc_attr( $max_price ) . '"' : ''; ?>></label>
                <label><?php esc_html_e( 'To', 'sariyah' ); ?><input type="number" min="0" step="0.01" name="max_price" value="<?php echo esc_attr( $current_max ); ?>"<?php echo $max_price > 0 ? ' max="' . esc_attr( $max_price ) . '"' : ''; ?>></label>
            </div>
            <?php if ( $min_price > 0 || $max_price > 0 ) : ?>
                <small><?php echo esc_html( sprintf( __( 'Available price range: %1$s – %2$s', 'sariyah' ), wc_price( $min_price ), wc_price( $max_price ) ) ); ?></small>
            <?php endif; ?>
        </fieldset>

        <fieldset>
            <legend><?php esc_html_e( 'Availability', 'sariyah' ); ?></legend>
            <label><input type="checkbox" name="stock" value="instock" <?php checked( $stock, 'instock' ); ?>> <?php esc_html_e( 'In stock only', 'sariyah' ); ?></label>
        </fieldset>

        <button type="submit"><?php esc_html_e( 'Apply filters', 'sariyah' ); ?></button>
        <a class="sariyah-product-filters__reset" href="<?php echo esc_url( $base_url ); ?>"><?php esc_html_e( 'Reset', 'sariyah' ); ?></a>
    </form>
</aside>
