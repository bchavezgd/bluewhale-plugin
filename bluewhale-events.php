<?php
/*
 * Plugin Name: bluewhale Events
 * Plugin URI:  http://elephantaviator.com
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

$dir = plugin_dir_path( __FILE__ );

function bluewhale_admin_scripts() {

  wp_register_script('bluewhale-scripts', plugins_url('js/bluewhale-admin.js', __FILE__), array('jquery', 'jquery-ui-datepicker'), '151211', true);

  wp_register_style('bluewhale-datepicker', plugins_url('css/datepicker.css', __FILE__));
  wp_register_style('bluewhale-admin-style', plugins_url('css/bluewhale_event_details.css', __FILE__), ['bluewhale-datepicker']);

  wp_enqueue_style('bluewhale-admin-style');
  wp_enqueue_script('bluewhale-scripts');
}

add_action( 'admin_enqueue_scripts', 'bluewhale_admin_scripts' );

include( $dir . 'bluewhale-events-cpt.php');
include( $dir . 'bluewhale-events-tax.php');
include( $dir . 'bluewhale-events-mtb.php');



/*
require ( $dir . 'bluewhale-artist-cpt.php');
require ( $dir . 'bluewhale-artist-tax.php');
require ( $dir . 'bluewhale-artist-mtb.php');
*/