<?php
/*
 * Plugin Name: bluewhale Events
 * Plugin URI:  http://elephantaviator.com/plugins
 * Description: Create and manage events for bluewhale jazz club
 * Version:     0.1.2
 * Author:      Brian Chavez
 * Author URI:  http://briandesignworks.com
 * Text Domain: bluewhale
 * Domain Path: /lang
 */

//Exit if accessed directly
if ( ! defined( 'ABSPATH' ) )  {
	exit;
}

function bluewhale_meta_box_setup() {
  /* Add meta boxes on the 'add_meta_boxes' hook. */
  add_action('add_meta_boxes', 'bluewhale_meta_box');

  /* Adds Save meta box function to 'save post meta' hook */
  add_action('save_post', 'bluewhale_save_meta', 10, 2);
}

/* defines screens on which meta boxes appear */
add_action('load-post.php', 'bluewhale_meta_box_setup');
add_action('load-post-new.php', 'bluewhale_meta_box_setup');

$dir = plugin_dir_path( __FILE__ );

function bluewhale_admin_scripts() {

  wp_register_script(
    'bluewhale-admin-scripts',
    plugins_url('js/bluewhale-admin.js', __FILE__),
    [
      'jquery',
      'jquery-ui-datepicker'
    ],
    '151211',
    true
  );

  wp_register_style(
    'bluewhale-datepicker',
    plugins_url('css/datepicker.css', __FILE__)
  );

  wp_register_style(
    'bluewhale-admin-style',
    plugins_url('css/bluewhale_event_details.css', __FILE__), ['bluewhale-datepicker']
  );

  wp_enqueue_style('bluewhale-admin-style');
  wp_enqueue_script('bluewhale-admin-scripts');
}

add_action( 'admin_enqueue_scripts', 'bluewhale_admin_scripts' );

include( $dir . 'bluewhale-tax.php');

include( $dir . 'bluewhale-events-cpt.php');
include( $dir . 'bluewhale-events-mtb.php');

include( $dir . 'bluewhale-artist-cpt.php');
