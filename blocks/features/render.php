<?php
/** Why attend block. */
$eyebrow = get_field( 'eyebrow' );
$title = get_field( 'title' );
$description = get_field( 'description' );
$features = get_field( 'features' );
?>
<section class="sariyah-features"><div class="sariyah-container">
  <div class="sariyah-features__heading">
    <?php if ( $eyebrow ) : ?><p class="sariyah-section-eyebrow"><?php echo esc_html( $eyebrow ); ?></p><?php endif; ?>
    <?php if ( $title ) : ?><h2><?php echo esc_html( $title ); ?></h2><?php endif; ?>
    <?php if ( $description ) : ?><p><?php echo esc_html( $description ); ?></p><?php endif; ?>
  </div>
  <?php if ( is_array( $features ) && $features ) : ?><div class="sariyah-features__grid">
    <?php foreach ( $features as $index => $feature ) : ?>
      <article class="sariyah-feature"><span><?php echo esc_html( str_pad( (string) ( $index + 1 ), 2, '0', STR_PAD_LEFT ) ); ?>.</span><h3><?php echo esc_html( $feature['title'] ?? '' ); ?></h3><p><?php echo esc_html( $feature['description'] ?? '' ); ?></p></article>
    <?php endforeach; ?>
  </div><?php endif; ?>
</div></section>