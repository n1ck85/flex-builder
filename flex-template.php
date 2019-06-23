<?php

/* Template Name: Flex Builder
 * Template Post Type: page
 *
 * The template for displaying all ACF page builder pages.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); ?>

	<div id="primary" <?php generate_do_element_classes( 'content' ); ?>>
		<main id="main" <?php generate_do_element_classes( 'main' ); ?>>
			<?php
			/**
			 * generate_before_main_content hook.
			 *
			 * @since 0.1
			 */
			do_action( 'generate_before_main_content' );

      //Show main page content if needed
      $showContent = get_field('show_content');
			$contained = get_field('content_contained');
      if ( $showContent ) : ?>
      <div class="main-content page-section">
        <div class="<?php echo $contained ? 'grid-container ' : ''; ?>page-section-inner"><?php

          while ( have_posts() ) : the_post();

            get_template_part( 'content', 'page' );

          endwhile; ?>
        </div>
      </div>

      <?php
      endif;

			// Get the page builder layout
			if( have_rows('sections') ) :

			    while ( have_rows('sections') ) : the_row();

							$section = get_sub_field('page_section');

							if( $section ) :
								$sectionID = $section['section_id'] ? 'id="' . $section['section_id'] . '"' : '';
								$sectionClass = $section['section_class'] ? $section['section_class'] : '';
								$fullWidthClass = $section['full_width'] ? 'full-width' : 'grid-container';
								$verticalAlign = $section['vertical_align'] ? 'v-align' : '';
								$backgroundImage = $section['section_background_image'] ? 'background-image:url(' . $section['section_background_image'] . ');' : '';
								$backgroundColor = $section['section_background_color'] ? 'background-color:' . $section['section_background_color'] . ';' : '';
								?>

		        	<div <?php echo $sectionID; ?> class="page-section <?php echo $sectionClass; ?>" style="<?php echo $backgroundColor . $backgroundImage; ?>">

								<?php if( $section['color_overlay'] ) : ?>

								 <div class="page-section-overlay"	style="<?php echo $backgroundColor; ?>">

								<?php endif; ?>

									<div class="inner-page-section <?php echo $fullWidthClass; ?> <?php echo $verticalAlign; ?>"><?php

									if ( have_rows('page_section') ) :

										while ( have_rows('page_section') ) : the_row();

										if( have_rows('block_selection') ) :

											while( have_rows('block_selection') ) : the_row();

												if( get_row_layout() == 'content_block_layout' ) :

												  include	WP_PLUGIN_DIR . '/flex-builder/blocks/content-block.php';

												endif;

												if( get_row_layout() == 'image_block_layout' ) :

													include WP_PLUGIN_DIR . '/flex-builder/blocks/image-block.php';

												endif;

												if( get_row_layout() == 'tabs_block_layout' ) :

													include WP_PLUGIN_DIR . '/flex-builderblocks/tabs-block.php';

												endif;

												if( get_row_layout() == 'gallery_block_layout' ) :

													include WP_PLUGIN_DIR . '/flex-builderblocks/gallery-block.php';

												endif;

												if( get_row_layout() == 'plain_text_block_layout' ) :

													include WP_PLUGIN_DIR . '/flex-builderblocks/plain-text-block.php';

												endif;

											endwhile; //block selection

										endif;

									endwhile; //sections

								endif; ?>

									</div>

								<?php if( $section['color_overlay'] ) : ?>

								</div><!-- bgOverlay -->

								<?php endif; ?>

							</div>

			        <?php	endif;

			    endwhile;

				endif;

			/**
			 * generate_after_main_content hook.
			 *
			 * @since 0.1
			 */
			do_action( 'generate_after_main_content' );
			?>
		</main><!-- #main -->
	</div><!-- #primary -->

	<?php
	/**
	 * generate_after_primary_content_area hook.
	 *
	 * @since 2.0
	 */
	do_action( 'generate_after_primary_content_area' );

	generate_construct_sidebars();

get_footer();
