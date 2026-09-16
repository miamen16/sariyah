<?php
/** Speakers block. */
$eyebrow = get_field( 'eyebrow' );
$title = get_field( 'title' );
$description = get_field( 'description' );
$speakers = get_field( 'speakers' );
?>
<section class="sariyah-speakers"><div class="sariyah-container">
  <div class="sariyah-speakers__heading">
    <?php if ( $eyebrow ) : ?><p class="sariyah-section-eyebrow"><?php echo esc_html( $eyebrow ); ?></p><?php endif; ?>
    <?php if ( $title ) : ?><h2><?php echo esc_html( $title ); ?></h2><?php endif; ?>
    <?php if ( $description ) : ?><p><?php echo esc_html( $description ); ?></p><?php endif; ?>
  </div>
  <?php if ( is_array( $speakers ) && $speakers ) : ?><div class="sariyah-speakers__grid">
    <?php foreach ( $speakers as $speaker ) : $image = $speaker['image'] ?? null; ?>
      <article class="sariyah-speaker">
        <?php if ( is_array( $image ) && ! empty( $image['ID'] ) ) : ?><div class="sariyah-speaker__image"><?php echo wp_get_attachment_image( (int) $image['ID'], 'medium_large', false, array( 'loading' => 'lazy' ) ); ?></div><?php endif; ?>
        <div class="sariyah-speaker__content"><h3><?php echo esc_html( $speaker['name'] ?? '' ); ?></h3><p><?php echo esc_html( $speaker['role'] ?? '' ); ?></p></div>
      </article>
    <?php endforeach; ?>
  </div><?php endif; ?>
</div></section>