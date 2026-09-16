<?php
/**
 * Event introduction block.
 *
 * @package Sariyah
 */
$image = get_field( 'image' );
$eyebrow = get_field( 'eyebrow' );
$title = get_field( 'title' );
$description = get_field( 'description' );
$organiser = get_field( 'organiser' );
$venue = get_field( 'venue' );
$date = get_field( 'event_date' );
$items = get_field( 'highlights' );
?>
<section class="sariyah-event-intro">
  <div class="sariyah-container sariyah-event-intro__grid">
    <div class="sariyah-event-intro__content">
      <?php if ( $eyebrow ) : ?><p class="sariyah-section-eyebrow"><?php echo esc_html( $eyebrow ); ?></p><?php endif; ?>
      <?php if ( $title ) : ?><h2><?php echo esc_html( $title ); ?></h2><?php endif; ?>
      <?php if ( $description ) : ?><div class="sariyah-rich-text"><?php echo wp_kses_post( wpautop( $description ) ); ?></div><?php endif; ?>
      <?php if ( is_array( $items ) && $items ) : ?>
        <ul class="sariyah-event-intro__list">
          <?php foreach ( $items as $item ) : ?>
            <li><?php echo esc_html( $item['text'] ?? '' ); ?></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
      <div class="sariyah-event-intro__meta">
        <?php if ( $organiser ) : ?><div><strong>Event Organiser</strong><span><?php echo esc_html( $organiser ); ?></span></div><?php endif; ?>
        <?php if ( $venue ) : ?><div><strong>Venue</strong><span><?php echo esc_html( $venue ); ?></span></div><?php endif; ?>
        <?php if ( $date ) : ?><div><strong>When</strong><span><?php echo esc_html( $date ); ?></span></div><?php endif; ?>
      </div>
    </div>
    <?php if ( is_array( $image ) && ! empty( $image['ID'] ) ) : ?>
      <figure class="sariyah-event-intro__image"><?php echo wp_get_attachment_image( (int) $image['ID'], 'large', false, array( 'loading' => 'lazy' ) ); ?></figure>
    <?php endif; ?>
  </div>
</section>