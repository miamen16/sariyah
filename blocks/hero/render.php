<?php
/**
 * Sariyah Hero block.
 *
 * @package Sariyah
 */

$eyebrow      = get_field( 'eyebrow' ) ?: 'WELCOME TO SARIYAH';
$title        = get_field( 'title' ) ?: 'Create unforgettable events and experiences';
$description  = get_field( 'description' ) ?: 'Bring people together through meaningful events, inspiring speakers and memorable moments.';
$primary      = get_field( 'primary_button' );
$secondary    = get_field( 'secondary_button' );
$background   = get_field( 'background_image' );
$style        = '';

if ( is_array( $background ) && ! empty( $background['url'] ) ) {
    $style = ' style="background-image:linear-gradient(rgba(17,24,39,.68),rgba(17,24,39,.68)),url(' . esc_url( $background['url'] ) . ');"';
}
?>
<section class="sariyah-hero"<?php echo $style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?> >
    <div class="sariyah-hero__inner">
        <?php if ( $eyebrow ) : ?><p class="sariyah-hero__eyebrow"><?php echo esc_html( $eyebrow ); ?></p><?php endif; ?>
        <h1><?php echo esc_html( $title ); ?></h1>
        <?php if ( $description ) : ?><p class="sariyah-hero__description"><?php echo esc_html( $description ); ?></p><?php endif; ?>
        <div class="sariyah-hero__actions">
            <?php if ( is_array( $primary ) && ! empty( $primary['url'] ) ) : ?>
                <a class="sariyah-button sariyah-button--primary" href="<?php echo esc_url( $primary['url'] ); ?>"><?php echo esc_html( $primary['title'] ?? 'Get Started' ); ?></a>
            <?php endif; ?>
            <?php if ( is_array( $secondary ) && ! empty( $secondary['url'] ) ) : ?>
                <a class="sariyah-button sariyah-button--secondary" href="<?php echo esc_url( $secondary['url'] ); ?>"><?php echo esc_html( $secondary['title'] ?? 'View Schedule' ); ?></a>
            <?php endif; ?>
        </div>
    </div>
</section>