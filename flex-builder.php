<?php

/*

Plugin Name: Flex Builder

Description: Allows posts & pages to be built using a block style interface. Includes ACF PRO

Version:     1.0.0

License:     GPL2

License URI: http://www.gnu.org/licenses/gpl-3.0.html.

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see http://www.gnu.org/licenses/gpl-3.0.html.
*/

if ( ! defined( 'ABSPATH' ) ) :
	exit; // Exit if accessed directly
endif;

// Define path and URL to the ACF plugin.
define( 'FLEX_ACF_PATH', WP_PLUGIN_DIR . '/flex-builder/includes/acf/' );
define( 'FLEX_ACF_URL', plugin_dir_url( __FILE__ ) . 'includes/acf/' );

// Include the ACF plugin.
include_once( FLEX_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
function my_acf_settings_url( $url ) {
    return FLEX_ACF_URL;
}
add_filter('acf/settings/url', 'my_acf_settings_url');

function add_flex_builder_template_option ($templates) {

  $templates['flex-template.php'] = 'Flex Builder';

  return $templates;

}
add_filter ('theme_page_templates', 'add_flex_builder_template_option');

function add_flex_builder_template_location ($template) {

	$post = get_post();
	$page_template = get_post_meta( $post->ID, '_wp_page_template', true );

	if ('flex-template.php' == basename ($page_template)) {

	  $template = WP_PLUGIN_DIR . '/flex-builder/flex-template.php';

	}

	return $template;

}
add_filter ('template_include', 'add_flex_builder_template_location');

function enqueue_flex_builder_scripts_styles() {

	if ( is_page_template('flex-template.php') ) {

		wp_enqueue_style('flex-builder-css', plugins_url( 'flex-builder/flex-builder.css' ), false, '1.0.0' );//flex builder css

		wp_enqueue_script('featherlight-script', '//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.js', false, false, true);//featherlight script

		wp_enqueue_style('featherlight-css', '//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.min.css');//featherlight css

		wp_enqueue_style('featherlight-gallery-css', '//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.gallery.min.css');//featherlight gallery css

		wp_enqueue_script('featherlight-gallery-script', '//cdn.rawgit.com/noelboss/featherlight/1.7.13/release/featherlight.gallery.min.js', false, false, true);//featherlight gallery script

	}

}
add_action('wp_enqueue_scripts','enqueue_flex_builder_scripts_styles');

function flex_add_acf_field_groups() {

	require_once WP_PLUGIN_DIR . '/flex-builder/includes/acf-fields.php';

}
add_action('acf/init', 'flex_add_acf_field_groups');
