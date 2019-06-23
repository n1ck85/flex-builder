<?php

  $contentBlock = get_sub_field('content_block');

  $blockID = $contentBlock['block_id'] ? 'id="' . $contentBlock['block_id'] . '"' : '';
  $blockClass = $contentBlock['block_class'] ? $contentBlock['block_class'] : '';
  $blockWidth = $contentBlock['block_width'] ? ' block-col-' . $contentBlock['block_width'] : '';
  $blockAlign = $contentBlock['v_align'] ? ' ' . $contentBlock['v_align'] : '';
  $content = $contentBlock['content'] ? $contentBlock['content'] : '';
  $centerContent = $contentBlock['center_content'] ? ' center-content' : '' ?>

  <div <?php echo $blockID; ?> class="content-block <?php echo $blockClass . $blockWidth . $blockAlign . $centerContent; ?>">
    <div class="content-block-inner">
      <?php echo $content; ?>
    </div>
  </div>
