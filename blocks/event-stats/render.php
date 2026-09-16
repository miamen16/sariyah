<?php
/** Event statistics block. */
$items = get_field( 'stats' );
if ( ! is_array( $items ) || ! $items ) {
    return;
}
?>
<section class="sariyah-event-stats"><div class="sariyah-container sariyah-event-stats__grid">
<?php foreach ( $items as $item ) : ?>
  <div class="sariyah-event-stat"><strong><?php echo esc_html( $item['number'] ?? '0' ); ?></strong><span><?php echo esc_html( $item['label'] ?? '' ); ?></span></div>
<?php endforeach; ?>
</div></section>