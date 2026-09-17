<?php
$items = get_field( 'items' );
if ( ! is_array( $items ) || ! $items ) { return; }
?><section class="sariyah-trust-bar"><div class="sariyah-container"><div class="sariyah-trust-bar__grid"><?php foreach ( $items as $item ) : ?><div class="sariyah-trust-bar__item"><span class="sariyah-trust-bar__icon" aria-hidden="true"><?php echo esc_html( $item['icon'] ?? '✓' ); ?></span><div><strong><?php echo esc_html( $item['title'] ?? '' ); ?></strong><?php if ( ! empty( $item['text'] ) ) : ?><p><?php echo esc_html( $item['text'] ); ?></p><?php endif; ?></div></div><?php endforeach; ?></div></div></section>
