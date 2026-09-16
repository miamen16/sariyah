<?php
/** Pricing block. */
$eyebrow     = get_field( 'eyebrow' );
$title       = get_field( 'title' );
$description = get_field( 'description' );
$plans       = get_field( 'plans' );
?>
<section class="sariyah-pricing">
  <div class="sariyah-container">
    <div class="sariyah-pricing__heading">
      <?php if ( $eyebrow ) : ?><p class="sariyah-section-eyebrow"><?php echo esc_html( $eyebrow ); ?></p><?php endif; ?>
      <?php if ( $title ) : ?><h2><?php echo esc_html( $title ); ?></h2><?php endif; ?>
      <?php if ( $description ) : ?><p><?php echo esc_html( $description ); ?></p><?php endif; ?>
    </div>

    <?php if ( is_array( $plans ) && $plans ) : ?>
      <div class="sariyah-pricing__grid">
        <?php foreach ( $plans as $plan ) : ?>
          <?php
          $booked = isset( $plan['booked'] ) && '' !== $plan['booked'] ? min( 100, max( 0, (int) $plan['booked'] ) ) : null;
          $button = $plan['button'] ?? null;
          ?>
          <article class="sariyah-plan<?php echo ! empty( $plan['featured'] ) ? ' is-featured' : ''; ?>">
            <?php if ( ! empty( $plan['badge'] ) ) : ?><span class="sariyah-plan__badge"><?php echo esc_html( $plan['badge'] ); ?></span><?php endif; ?>
            <h3><?php echo esc_html( $plan['name'] ?? '' ); ?></h3>
            <div class="sariyah-plan__price"><?php echo esc_html( $plan['currency'] ?? '$' ); ?><strong><?php echo esc_html( $plan['price'] ?? '' ); ?></strong></div>
            <?php if ( ! empty( $plan['description'] ) ) : ?><p><?php echo esc_html( $plan['description'] ); ?></p><?php endif; ?>
            <?php if ( ! empty( $plan['vat_note'] ) ) : ?><small><?php echo esc_html( $plan['vat_note'] ); ?></small><?php endif; ?>

            <?php if ( null !== $booked ) : ?>
              <div class="sariyah-plan__progress"><span style="width:<?php echo esc_attr( $booked ); ?>%"></span></div>
              <p class="sariyah-plan__seats"><?php echo esc_html( $booked ); ?>% <?php echo esc_html( $plan['seat_text'] ?? 'seats booked' ); ?></p>
            <?php endif; ?>

            <?php if ( is_array( $button ) && ! empty( $button['url'] ) ) : ?>
              <a class="sariyah-button" href="<?php echo esc_url( $button['url'] ); ?>"<?php echo ! empty( $button['target'] ) ? ' target="' . esc_attr( $button['target'] ) . '" rel="noopener noreferrer"' : ''; ?>><?php echo esc_html( $button['title'] ?? 'Buy ticket' ); ?></a>
            <?php endif; ?>
          </article>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>