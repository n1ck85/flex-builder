<?php

  $tabsBlock = get_sub_field('tabs_block');

  $blockID = $tabsBlock['block_id'] ? 'id="' . $tabsBlock['block_id'] . '"' : '';
  $blockClass = $tabsBlock['block_class'] ? $tabsBlock['block_class'] : '';
  $blockWidth = $tabsBlock['block_width'] ? ' block-col-' . $tabsBlock['block_width'] : '';
  $blockHeight = $tabsBlock['block_height'] ? 'height:' . $tabsBlock['block_height'] . 'px' : '';
  $centerContent = $tabsBlock['center_content'] ? ' center-content' : '';
  $accordion = $tabsBlock['accordion'] ? true : false; ?>

  <div <?php echo $blockID; ?> class="tabs-block <?php echo $blockClass . $blockWidth . $blockAlign; ?>"><?php

  if ( isset($tabsBlock['tab']) ) :

    if ( $accordion ) { ?>

      <ul class="accordion"><?php

        foreach ( $tabsBlock['tab'] as $key => $tab ) { ?>

          <li class="accordion-tab a-tab-<? echo ++$key; ?>">
            <a class="accordion-tab-title" href="javascript:void(0)"><?php echo $tab['block_title']; ?></a>
            <div class="accordion-tab-content a-tab-<? echo ++$key; ?>"><?php echo $tab['block_content']; ?></div>
          </li>

        <?php } ?>
      </ul>
      <script type="text/javascript">
        jQuery(document).ready(function($){
          $("a.accordion-tab-title").click(function(){

            $(this).next().slideToggle();
            $(this).toggleClass('accordion-open');

          });
        });
      </script><?php

    }else { ?>

      <ul class="tabs"><?php
      //generate tabs
        foreach ( $tabsBlock['tab'] as $key => $tab ) { ?>

          <li class="tab tab-<? echo ++$key; echo $key == 1 ? ' current-tab' : ''; ?>"><a href="javascript:void(0)"><?php echo $tab['block_title']; ?></a></li><?php

        }; ?>
      </ul><?php

      //generate tab content ?>
      <div class="tab-content<?php echo $centerContent; ?>" <?php echo 'style="'. $blockHeight .'"' ?>><?php
        foreach ( $tabsBlock['tab'] as $key => $tabContent ) { ?>

            <div class="tab-content-inner tab-<?php echo ++$key; ?>" <?php echo $key > 1 ? 'style="display: none;"' : ''; ?>>

            <?php echo $tabContent['block_content']; ?>

            </div><?php

        } ?>
      </div>
      <script type="text/javascript">
        jQuery(document).ready(function($){
          $(".tab").click(function(){

            var el = $(this);

            $(".tab").removeClass('current-tab');
            el.addClass('current-tab');

            var tab = el.index();
            tab++;

            $('.tab-content-inner').hide();
            $('.tab-content-inner.tab-'+tab).fadeIn(500).addClass('current-tab-content');

          });
        });
      </script><?php
      }
    endif; ?>

  </div>
