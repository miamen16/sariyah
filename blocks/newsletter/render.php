<?php
$title = get_field( 'title' ) ?: __( 'Stay in the loop', 'sariyah' );
$text = get_field( 'text' );
$action = get_field( 'action_url' );
$button = get_field( 'button_text' ) ?: __( 'Subscribe', 'sariyah' );
?><section class="sariyah-newsletter"><div class="sariyah-container"><div class="sariyah-newsletter__inner"><div><h2><?php echo esc_html( $title ); ?></h2><?php if ( $text ) : ?><p><?php echo esc_html( $text ); ?></p><?php endif; ?></div><form class="sariyah-newsletter__form" action="<?php echo esc_url( $action ?: '#' ); ?>" method="post"><label class="screen-reader-text" for="sariyah-newsletter-email"><?php esc_html_e( 'Email address', 'sariyah' ); ?></label><input id="sariyah-newsletter-email" type="email" name="email" placeholder="<?php esc_attr_e( 'Your email address', 'sariyah' ); ?>" required><button type="submit"><?php echo esc_html( $button ); ?></button></form></div></div></section>
