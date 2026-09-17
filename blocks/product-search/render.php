<?php
$action = function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' );
$placeholder = get_field( 'placeholder' ) ?: __( 'Search products…', 'sariyah' );
?><div class="sariyah-product-search"><form role="search" method="get" action="<?php echo esc_url( $action ); ?>"><label class="screen-reader-text" for="sariyah-product-search-input"><?php esc_html_e( 'Search products', 'sariyah' ); ?></label><input id="sariyah-product-search-input" type="search" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php echo esc_attr( $placeholder ); ?>"><input type="hidden" name="post_type" value="product"><button type="submit"><?php esc_html_e( 'Search', 'sariyah' ); ?></button></form></div>
