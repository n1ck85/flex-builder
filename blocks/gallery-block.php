<?php

  $galleryBlock = get_sub_field('gallery_block');

  $blockID = $galleryBlock['block_id'] ? 'id="' . $galleryBlock['block_id'] . '"' : '';
  $blockClass = $galleryBlock['block_class'] ? $galleryBlock['block_class'] : '';
  $blockWidth = $galleryBlock['block_width'] ? ' block-col-' . $galleryBlock['block_width'] : '';
  $images = $galleryBlock['gallery'] ? $galleryBlock['gallery'] : '';
  $imageSize = $galleryBlock['image_size'] ? $galleryBlock['image_size'] : 'large';
  $imageHeight = $galleryBlock['image_height'] ? 'height:' . $galleryBlock['image_height'] . 'px;': false;
  $columns = $galleryBlock['columns'];
  $centerContent = $galleryBlock['center_content'] ? ' center-content' : '';
  $showCaptions = $galleryBlock['show_captions'] ? true : false;

  switch ( $columns ) {
    case '1' :
        $columns = 'gallery-col-1';
        $rows = 1;
        break;
    case '2' :
        $columns = 'gallery-col-2';
        $rows = 2;
        break;
    case '3' :
        $columns = 'gallery-col-3';
        $rows = 3;
        break;
    case '4' :
        $columns = 'gallery-col-4';
        $rows = 4;
        break;
    case '5' :
        $columns = 'gallery-col-5';
        $rows = 5;
        break;
    case '6' :
        $columns = 'gallery-col-6';
        $rows = 6;
        break;
    default: $columns = 'gallery-col-3';
  }
  ?>

  <div <?php echo $blockID; ?> class="gallery-block <?php echo $blockClass . $blockWidth . $blockAlign . $centerContent; ?>">
    <div class="gallery-block-inner">
      <?php

      if( $images ): ?>

        <ul>
          <?php foreach( $images as $image ): ?>
            <li class="<?php echo $columns; ?>">
              <figure>
                <a href="<?php echo $image['url']; ?>">
                   <?php echo wp_get_attachment_image( $image['ID'], $imageSize, false, array('style' => $imageHeight ) );
                   if ( $image['caption'] && $showCaptions ) { ?>
                     <figcaption><?php echo $image['caption']; ?></figcaption><?php
                   } ?>
                </a>
              </figure>
            </li>
          <?php endforeach; ?>
        </ul>

      <?php endif; ?>
    </div>
  </div>

<script>
  jQuery(document).ready(function($){

    $('.gallery-block ul li img').each(function(){
      if( !$(this).attr('style') ) {
        $(this).css('height', $(this).width());
      }
    });

    $('.gallery-block ul li a').featherlightGallery({
        previousIcon: '<i class="fas fa-angle-left"></i>',
		    nextIcon: '<i class="fas fa-angle-right"></i>',
    });

    $.featherlightGallery.prototype.afterContent = function() {
      var caption = this.$currentTarget.find('figcaption').text();
          this.$instance.find('.caption').remove();
          if( caption.length > 0 ) {
            $('<div class="caption">').text(caption).appendTo(this.$instance.find('.featherlight-content'));
          }
    };

  });
</script>
