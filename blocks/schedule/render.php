<?php
/** Schedule block. */
$eyebrow     = get_field( 'eyebrow' );
$title       = get_field( 'title' );
$description = get_field( 'description' );
$days        = get_field( 'days' );
?>
<section class="sariyah-schedule">
  <div class="sariyah-container">
    <div class="sariyah-schedule__heading">
      <?php if ( $eyebrow ) : ?><p class="sariyah-section-eyebrow"><?php echo esc_html( $eyebrow ); ?></p><?php endif; ?>
      <?php if ( $title ) : ?><h2><?php echo esc_html( $title ); ?></h2><?php endif; ?>
      <?php if ( $description ) : ?><p><?php echo esc_html( $description ); ?></p><?php endif; ?>
    </div>

    <?php if ( is_array( $days ) && $days ) : ?>
      <div class="sariyah-schedule__days">
        <?php foreach ( $days as $day_index => $day ) : ?>
          <section class="sariyah-schedule__day">
            <header class="sariyah-schedule__day-header">
              <span class="sariyah-schedule__day-date"><?php echo esc_html( $day['date'] ?? '' ); ?></span>
              <span class="sariyah-schedule__day-name"><?php echo esc_html( $day['day_name'] ?? '' ); ?></span>
            </header>

            <?php $sessions = $day['sessions'] ?? array(); ?>
            <?php if ( is_array( $sessions ) && $sessions ) : ?>
              <div class="sariyah-schedule__sessions">
                <?php foreach ( $sessions as $session ) : ?>
                  <?php
                  $image = $session['image'] ?? null;
                  $url   = $session['link']['url'] ?? '';
                  ?>
                  <article class="sariyah-session">
                    <div class="sariyah-session__time">
                      <?php echo esc_html( $session['start_time'] ?? '' ); ?>
                      <?php if ( ! empty( $session['end_time'] ) ) : ?>
                        <span><?php echo esc_html( $session['end_time'] ); ?></span>
                      <?php endif; ?>
                    </div>
                    <div class="sariyah-session__body">
                      <?php if ( ! empty( $session['category'] ) ) : ?><p class="sariyah-session__category"><?php echo esc_html( $session['category'] ); ?></p><?php endif; ?>
                      <h3><?php echo esc_html( $session['title'] ?? '' ); ?></h3>
                      <?php if ( ! empty( $session['description'] ) ) : ?><p><?php echo esc_html( $session['description'] ); ?></p><?php endif; ?>
                      <?php if ( ! empty( $session['speaker'] ) ) : ?><strong class="sariyah-session__speaker"><?php echo esc_html( $session['speaker'] ); ?></strong><?php endif; ?>
                      <?php if ( $url ) : ?>
                        <a href="<?php echo esc_url( $url ); ?>"<?php echo ! empty( $session['link']['target'] ) ? ' target="' . esc_attr( $session['link']['target'] ) . '" rel="noopener"' : ''; ?>>
                          <?php echo esc_html( $session['link']['title'] ?? 'Learn more' ); ?>
                        </a>
                      <?php endif; ?>
                    </div>
                    <?php if ( is_array( $image ) && ! empty( $image['ID'] ) ) : ?>
                      <div class="sariyah-session__image"><?php echo wp_get_attachment_image( (int) $image['ID'], 'medium', false, array( 'loading' => 'lazy' ) ); ?></div>
                    <?php endif; ?>
                  </article>
                <?php endforeach; ?>
              </div>
            <?php endif; ?>
          </section>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>