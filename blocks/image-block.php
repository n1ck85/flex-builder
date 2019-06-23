<?php

$imageBlock = get_sub_field('image_block');

if( $imageBlock ) :

  $blockID = $imageBlock['block_id'] ? 'id="' . $imageBlock['block_id'] . '"' : '';
  $blockClass = $imageBlock['block_class'] ? ' ' . $imageBlock['block_class'] : '';
  $blockWidth = $imageBlock['block_width'] ? ' block-col-' . $imageBlock['block_width'] : '';
  $blockAlign = $imageBlock['v_align'] ? ' ' . $imageBlock['v_align'] : '';
  $imgBg = $imageBlock['img_as_bg'] ? ' img-as-bg' : '';
  $imgOverlay = $imageBlock['img_overlay'] ? $imageBlock['img_overlay'] : '';
  $overlayColor = $imageBlock['overlay_color'] ? 'background-color:' . $imageBlock['overlay_color'] . ';' : '';
  $textColor = $imageBlock['text_color'] ? 'color:' . $imageBlock['text_color'] . ';' : '';
  $imgHeight = $imageBlock['image_height'] ? 'height:' . $imageBlock['image_height'] . 'px;' : '';
  $imgFullHeight = $imageBlock['img_full_height'] ? ' img-full-height' : '';
  $imageSize = $imageBlock['image_size'] ? $imageBlock['image_size'] : 'large';
  $caption = $imageBlock['caption'];

  $image = $imageBlock['image'] ? $imageBlock['image'] : ''; ?>

  <div <?php echo $blockID; ?> class="image-block<?php echo $blockClass . $blockWidth . $blockAlign . $imgBg . $imgFullHeight; ?>">
    <div class="image-block-inner">
      <figure>
      <?php
      if( $image ) :
        echo wp_get_attachment_image($image['ID'], $imageSize, false, array('style' => $imgHeight ));
      else :
        echo 'no image seleted';
      endif;

      if( $imgBg && $imgOverlay ) : ?>
      <div class="image-overlay" style="<?php echo $overlayColor; ?>">
      <?php endif;
      if( $caption ) : ?>
        <figcaption class="grid-container" style="<?php echo $textColor; ?>"><?php echo $caption; ?></figcaption>
      <?php endif;
      if( $imgBg && $imgOverlay ) : ?>
      </div>
      <?php endif; ?>
      </figure>
    </div>
  </div>
  <?php endif; ?>
