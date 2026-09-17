<?php
/**
 * Sariyah storefront hero.
 *
 * @package Sariyah
 */

$eyebrow     = get_field( 'eyebrow' ) ?: 'AHMAD TEA COLLECTION';
$title       = get_field( 'title' ) ?: 'الشاي اللي تحتاجه وأكثر';
$description = get_field( 'description' ) ?: 'اكتشف تشكيلة مختارة من الشاي الأسود والأخضر والفواكه والخلطات الفاخرة لكل لحظة.';
$primary     = get_field( 'primary_button' );
$secondary   = get_field( 'secondary_button' );
$background  = get_field( 'background_image' );
$style       = '';

if ( is_array( $background ) && ! empty( $background['url'] ) ) {
    $style = ' style="background-image:linear-gradient(90deg,rgba(42,24,19,.78),rgba(42,24,19,.25)),url(' . esc_url( $background['url'] ) . ');"';
}
?>
<section class="sariyah-hero"<?php echo $style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> >
    <div class="sariyah-hero__inner">
        <?php if ( $eyebrow ) : ?><p class="sariyah-hero__eyebrow"><?php echo esc_html( $eyebrow ); ?></p><?php endif; ?>
        <h1><?php echo esc_html( $title ); ?></h1>
        <?php if ( $description ) : ?><p class="sariyah-hero__description"><?php echo esc_html( $description ); ?></p><?php endif; ?>
        <div class="sariyah-hero__actions">
            <?php if ( is_array( $primary ) && ! empty( $primary['url'] ) ) : ?>
                <a class="sariyah-button sariyah-button--primary" href="<?php echo esc_url( $primary['url'] ); ?>"><?php echo esc_html( $primary['title'] ?? 'تسوق الآن' ); ?></a>
            <?php else : ?>
                <a class="sariyah-button sariyah-button--primary" href="<?php echo esc_url( function_exists( 'wc_get_page_permalink' ) ? wc_get_page_permalink( 'shop' ) : home_url( '/' ) ); ?>"><?php esc_html_e( 'تسوق الآن', 'sariyah' ); ?></a>
            <?php endif; ?>
            <?php if ( is_array( $secondary ) && ! empty( $secondary['url'] ) ) : ?>
                <a class="sariyah-button sariyah-button--secondary" href="<?php echo esc_url( $secondary['url'] ); ?>"><?php echo esc_html( $secondary['title'] ?? 'اكتشف تشكيلاتنا' ); ?></a>
            <?php endif; ?>
        </div>
    </div>
</section>