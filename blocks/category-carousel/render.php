<?php
$terms = get_terms( array( 'taxonomy' => 'product_cat', 'hide_empty' => true, 'number' => max( 2, min( 20, (int) ( get_field( 'count' ) ?: 10 ) ) ), 'orderby' => 'menu_order', 'order' => 'ASC' ) );
$title = get_field( 'title' ) ?: __( 'Explore categories', 'sariyah' );
if ( is_wp_error( $terms ) || ! $terms ) { return; }
?>
<section class="sariyah-product-categories sariyah-category-carousel"><div class="sariyah-container"><header class="sariyah-product-categories__heading"><h2><?php echo esc_html( $title ); ?></h2></header><div class="sariyah-category-carousel__track">
<?php foreach ( $terms as $term ) : $link = get_term_link( $term ); if ( is_wp_error( $link ) ) { continue; } $thumbnail_id = (int) get_term_meta( $term->term_id, 'thumbnail_id', true ); ?><a class="sariyah-category-carousel__item" href="<?php echo esc_url( $link ); ?>"><div class="sariyah-category-carousel__image"><?php echo $thumbnail_id ? wp_get_attachment_image( $thumbnail_id, 'woocommerce_thumbnail', false, array( 'loading' => 'lazy' ) ) : ''; ?></div><strong><?php echo esc_html( $term->name ); ?></strong></a><?php endforeach; ?>
</div></div></section>
