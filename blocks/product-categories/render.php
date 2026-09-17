<?php
/** Dynamic WooCommerce product categories. */
if ( ! function_exists( 'get_terms' ) ) {
    return;
}

$title       = get_field( 'title' ) ?: __( 'Shop by category', 'sariyah' );
$description = get_field( 'description' );
$count       = max( 1, min( 24, (int) ( get_field( 'count' ) ?: 8 ) ) );
$columns     = max( 2, min( 6, (int) ( get_field( 'columns' ) ?: 4 ) ) );

$terms = get_terms(
    array(
        'taxonomy'   => 'product_cat',
        'hide_empty' => true,
        'number'     => $count,
        'orderby'    => 'menu_order',
        'order'      => 'ASC',
    )
);
?>
<section class="sariyah-product-categories">
    <div class="sariyah-container">
        <?php if ( $title || $description ) : ?>
            <header class="sariyah-product-categories__heading">
                <?php if ( $title ) : ?><h2><?php echo esc_html( $title ); ?></h2><?php endif; ?>
                <?php if ( $description ) : ?><p><?php echo esc_html( $description ); ?></p><?php endif; ?>
            </header>
        <?php endif; ?>

        <?php if ( ! is_wp_error( $terms ) && $terms ) : ?>
            <div class="sariyah-product-categories__grid" style="--sariyah-category-columns:<?php echo esc_attr( $columns ); ?>">
                <?php foreach ( $terms as $term ) :
                    $link         = get_term_link( $term );
                    $thumbnail_id = (int) get_term_meta( $term->term_id, 'thumbnail_id', true );
                    if ( is_wp_error( $link ) ) {
                        continue;
                    }
                    ?>
                    <article class="sariyah-category-card">
                        <a class="sariyah-category-card__link" href="<?php echo esc_url( $link ); ?>">
                            <div class="sariyah-category-card__image">
                                <?php
                                if ( $thumbnail_id ) {
                                    echo wp_get_attachment_image( $thumbnail_id, 'woocommerce_thumbnail', false, array( 'loading' => 'lazy' ) );
                                } else {
                                    echo '<span aria-hidden="true"></span>';
                                }
                                ?>
                            </div>
                            <div class="sariyah-category-card__body">
                                <h3><?php echo esc_html( $term->name ); ?></h3>
                                <span><?php echo esc_html( sprintf( _n( '%d product', '%d products', $term->count, 'sariyah' ), $term->count ) ); ?></span>
                            </div>
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
