<?php
/** Gallery block. */
$eyebrow=get_field('eyebrow'); $title=get_field('title'); $description=get_field('description'); $gallery=get_field('gallery');
?>
<section class="sariyah-gallery"><div class="sariyah-container"><div class="sariyah-gallery__heading"><?php if($eyebrow): ?><p class="sariyah-section-eyebrow"><?php echo esc_html($eyebrow); ?></p><?php endif; ?><?php if($title): ?><h2><?php echo esc_html($title); ?></h2><?php endif; ?><?php if($description): ?><p><?php echo esc_html($description); ?></p><?php endif; ?></div>
<?php if(is_array($gallery)&&$gallery): ?><div class="sariyah-gallery__grid"><?php foreach($gallery as $image): if(is_array($image)&&!empty($image['ID'])): ?><figure><?php echo wp_get_attachment_image((int)$image['ID'],'large',false,array('loading'=>'lazy')); ?><?php if(!empty($image['caption'])): ?><figcaption><?php echo esc_html($image['caption']); ?></figcaption><?php endif; ?></figure><?php endif; endforeach; ?></div><?php endif; ?></div></section>