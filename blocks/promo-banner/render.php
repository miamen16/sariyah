<?php
$title = get_field( 'title' ) ?: __( 'Discover something new', 'sariyah' );
$text = get_field( 'text' );
$button = get_field( 'button' );
$image = get_field( 'image' );
$style = $image ? ' style="background-image:url(' . esc_url( wp_get_attachment_image_url( is_array( $image ) ? (int) ( $image['ID'] ?? 0 ) : (int) $image, 'large' ) ) . ')"' : '';
?>
<section class="sariyah-promo-banner"><div class="sariyah-container"><div class="sariyah-promo-banner__inner"<?php echo $style; ?>><div class="sariyah-promo-banner__content"><h2><?php echo esc_html( $title ); ?></h2><?php if ( $text ) : ?><p><?php echo esc_html( $text ); ?></p><?php endif; ?><?php if ( is_array( $button ) && ! empty( $button['url'] ) ) : ?><a class="sariyah-button" href="<?php echo esc_url( $button['url'] ); ?>" target="<?php echo esc_attr( $button['target'] ?? '_self' ); ?>"><?php echo esc_html( $button['title'] ?? __( 'Shop now', 'sariyah' ) ); ?></a><?php endif; ?></div></div></div></section>
