<?php
/**
 * WooCommerce shop/archive products.
 */
if ( ! function_exists( 'wc_get_products' ) ) {
    return;
}

$title   = function_exists( 'get_field' ) ? get_field( 'title' ) : '';
$count   = max( 1, min( 48, (int) ( function_exists( 'get_field' ) ? get_field( 'count' ) : 12 ) ) );
$columns = max( 2, min( 6, (int) ( function_exists( 'get_field' ) ? get_field( 'columns' ) : 4 ) ) );

$allowed_orderby = array( 'date', 'title', 'price', 'popularity', 'rating' );
$allowed_order    = array( 'ASC', 'DESC' );
$orderby          = isset( $_GET['orderby'] ) ? sanitize_key( wp_unslash( $_GET['orderby'] ) ) : 'date';
$order            = isset( $_GET['order'] ) ? strtoupper( sanitize_text_field( wp_unslash( $_GET['order'] ) ) ) : 'DESC';
$orderby          = in_array( $orderby, $allowed_orderby, true ) ? $orderby : 'date';
$order            = in_array( $order, $allowed_order, true ) ? $order : 'DESC';

$filter_category = isset( $_GET['product_cat'] ) ? sanitize_title( wp_unslash( $_GET['product_cat'] ) ) : '';
$filter_stock    = isset( $_GET['stock'] ) ? sanitize_key( wp_unslash( $_GET['stock'] ) ) : '';
$filter_min      = isset( $_GET['min_price'] ) ? wc_format_decimal( wp_unslash( $_GET['min_price'] ) ) : '';
$filter_max      = isset( $_GET['max_price'] ) ? wc_format_decimal( wp_unslash( $_GET['max_price'] ) ) : '';
$search_term     = is_search() && 'product' === get_query_var( 'post_type' ) ? sanitize_text_field( get_search_query() ) : '';

if ( '' !== $filter_min && (float) $filter_min < 0 ) {
    $filter_min = '0';
}
if ( '' !== $filter_max && (float) $filter_max < 0 ) {
    $filter_max = '';
}
if ( '' !== $filter_min && '' !== $filter_max && (float) $filter_min > (float) $filter_max ) {
    $filter_max = $filter_min;
}

$paged = max( 1, (int) get_query_var( 'paged' ), (int) get_query_var( 'page' ) );

$args = array(
    'limit'    => $count,
    'page'     => $paged,
    'paginate' => true,
    'status'   => 'publish',
    'orderby'  => $orderby,
    'order'    => $order,
);

if ( $search_term ) {
    $args['s'] = $search_term;
    $title = $title ?: sprintf( __( 'Search results for: %s', 'sariyah' ), $search_term );
}

if ( $filter_category ) {
    $args['category'] = array( $filter_category );
} elseif ( is_product_category() ) {
    $term = get_queried_object();
    if ( $term instanceof WP_Term ) {
        $args['category'] = array( $term->slug );
        $title = $title ?: $term->name;
    }
}

if ( '' !== $filter_min ) {
    $args['min_price'] = (float) $filter_min;
}

if ( '' !== $filter_max ) {
    $args['max_price'] = (float) $filter_max;
}

if ( 'instock' === $filter_stock ) {
    $args['stock_status'] = 'instock';
}

if ( ! $title ) {
    $title = __( 'Shop', 'sariyah' );
}

$products_result = wc_get_products( $args );
$products        = is_object( $products_result ) && isset( $products_result->products ) ? $products_result->products : array();
$total_pages     = is_object( $products_result ) && isset( $products_result->max_num_pages ) ? (int) $products_result->max_num_pages : 1;
$current_page    = min( $paged, max( 1, $total_pages ) );

$preserved_args = array();
if ( $filter_category ) {
    $preserved_args['product_cat'] = $filter_category;
}
if ( '' !== $filter_min ) {
    $preserved_args['min_price'] = $filter_min;
}
if ( '' !== $filter_max ) {
    $preserved_args['max_price'] = $filter_max;
}
if ( 'instock' === $filter_stock ) {
    $preserved_args['stock'] = 'instock';
}
if ( $search_term ) {
    $preserved_args['s']        = $search_term;
    $preserved_args['post_type'] = 'product';
}

// Build a clean base URL so hidden GET fields are not duplicated in the sorting form.
$current_url = remove_query_arg(
    array_merge(
        array( 'orderby', 'order', 'paged', 'page' ),
        array_keys( $preserved_args )
    )
);
?>
<section class="sariyah-shop-products">
  <div class="sariyah-container">
    <header class="sariyah-shop-products__header">
      <?php if ( $title ) : ?><h1><?php echo esc_html( $title ); ?></h1><?php endif; ?>
      <form class="sariyah-shop-products__sorting" method="get" action="<?php echo esc_url( $current_url ); ?>">
        <?php foreach ( $preserved_args as $name => $value ) : ?>
          <input type="hidden" name="<?php echo esc_attr( $name ); ?>" value="<?php echo esc_attr( $value ); ?>">
        <?php endforeach; ?>
        <label for="sariyah-shop-orderby"><?php esc_html_e( 'Sort by', 'sariyah' ); ?></label>
        <select id="sariyah-shop-orderby" name="orderby" onchange="this.form.submit()">
          <option value="date" <?php selected( $orderby, 'date' ); ?>><?php esc_html_e( 'Latest', 'sariyah' ); ?></option>
          <option value="popularity" <?php selected( $orderby, 'popularity' ); ?>><?php esc_html_e( 'Popularity', 'sariyah' ); ?></option>
          <option value="rating" <?php selected( $orderby, 'rating' ); ?>><?php esc_html_e( 'Rating', 'sariyah' ); ?></option>
          <option value="price" <?php selected( $orderby, 'price' ); ?>><?php esc_html_e( 'Price', 'sariyah' ); ?></option>
          <option value="title" <?php selected( $orderby, 'title' ); ?>><?php esc_html_e( 'Name', 'sariyah' ); ?></option>
        </select>
        <select name="order" onchange="this.form.submit()">
          <option value="DESC" <?php selected( $order, 'DESC' ); ?>><?php esc_html_e( 'Descending', 'sariyah' ); ?></option>
          <option value="ASC" <?php selected( $order, 'ASC' ); ?>><?php esc_html_e( 'Ascending', 'sariyah' ); ?></option>
        </select>
      </form>
    </header>

    <?php if ( $products ) : ?>
      <div class="sariyah-products__grid" style="--sariyah-product-columns:<?php echo esc_attr( $columns ); ?>">
        <?php foreach ( $products as $product ) : ?>
          <div><?php sariyah_render_product_card( $product ); ?></div>
        <?php endforeach; ?>
      </div>

      <?php if ( $total_pages > 1 ) : ?>
        <nav class="sariyah-pagination" aria-label="<?php esc_attr_e( 'Product pagination', 'sariyah' ); ?>">
          <?php
          echo wp_kses_post(
              paginate_links(
                  array(
                      'base'      => esc_url_raw( add_query_arg( 'paged', '%#%', $current_url ) ),
                      'format'    => '',
                      'current'   => $current_page,
                      'total'     => $total_pages,
                      'type'      => 'list',
                      'mid_size'  => 2,
                      'prev_text' => __( 'Previous', 'sariyah' ),
                      'next_text' => __( 'Next', 'sariyah' ),
                      'add_args'  => array_merge(
                          array(
                              'orderby' => $orderby,
                              'order'   => $order,
                          ),
                          $preserved_args
                      ),
                  )
              )
          );
          ?>
        </nav>
      <?php endif; ?>
    <?php else : ?>
      <div class="sariyah-shop-products__empty">
        <p><?php esc_html_e( 'No products found.', 'sariyah' ); ?></p>
        <a class="sariyah-button" href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>"><?php esc_html_e( 'Back to shop', 'sariyah' ); ?></a>
      </div>
    <?php endif; ?>
  </div>
</section>
