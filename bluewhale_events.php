<?php
/*
 * Plugin Name: bluewhale Events
 * Plugin URI:  http://elephantaviator.com
 * Description: Create and manage events for bluewhale jazz club
 * Version:     0.0.1
 * Author:      Brian Chavez
 * Author URI:  http://briandesignworks.com
 * Text Domain: bluewhale
 * Domain Path: /lang
 */

/*
 *  create event post type
 */
if (!function_exists('bluewhale_events')) {

// Register Custom Post Type
  function bluewhale_events() {

    $labels = array(
        'name' => _x('Events', 'Post Type General Name', 'bluewhale'),
        'singular_name' => _x('Event', 'Post Type Singular Name', 'bluewhale'),
        'menu_name' => __('Events', 'bluewhale'),
        'name_admin_bar' => __('Events', 'bluewhale'),
        'parent_item_colon' => __('Parent Event:', 'bluewhale'),
        'all_items' => __('All Events', 'bluewhale'),
        'add_new_item' => __('Add New Event', 'bluewhale'),
        'add_new' => __('Add New Event', 'bluewhale'),
        'new_item' => __('New Event', 'bluewhale'),
        'edit_item' => __('Edit Event', 'bluewhale'),
        'update_item' => __('Update Event', 'bluewhale'),
        'view_item' => __('View Event', 'bluewhale'),
        'search_items' => __('Search Event', 'bluewhale'),
        'not_found' => __('Event Not found', 'bluewhale'),
        'not_found_in_trash' => __('Event Not found in Trash', 'bluewhale'),
    );
    $args = array(
        'label' => __('Event', 'bluewhale'),
        'description' => __('Shows, opens, and other events. ', 'bluewhale'),
        'labels' => $labels,
        'supports' => array('title', 'editor', 'author', 'thumbnail', 'revisions',),
        'taxonomies' => array('genres'),
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'menu_icon' => 'dashicons-tickets',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'post',
    );
    register_post_type('events', $args);
  }

  add_action('init', 'bluewhale_events', 0);
}

/*
 *
 * custom taxonomy
 *
 */

if (!function_exists('bluewhale_genres')) {

// Register Custom Taxonomy
  function bluewhale_genres() {

    $labels = array(
        'name' => _x('Genres', 'Taxonomy General Name', 'bluewhale'),
        'singular_name' => _x('Genre', 'Taxonomy Singular Name', 'bluewhale'),
        'menu_name' => __('Genres', 'bluewhale'),
        'all_items' => __('All Genres', 'bluewhale'),
        'parent_item' => __('Parent Item', 'bluewhale'),
        'parent_item_colon' => __('Parent Item:', 'bluewhale'),
        'new_item_name' => __('New Genre Name', 'bluewhale'),
        'add_new_item' => __('Add New Genre', 'bluewhale'),
        'edit_item' => __('Edit Genre', 'bluewhale'),
        'update_item' => __('Update Genre', 'bluewhale'),
        'view_item' => __('View Genre', 'bluewhale'),
        'separate_items_with_commas' => __('Separate Genres with commas', 'bluewhale'),
        'add_or_remove_items' => __('Add or remove Genres', 'bluewhale'),
        'choose_from_most_used' => __('Choose from the most used Genres', 'bluewhale'),
        'popular_items' => __('Popular Genres', 'bluewhale'),
        'search_items' => __('Search Genres', 'bluewhale'),
        'not_found' => __('Genre Not Found', 'bluewhale'),
    );
    $args = array(
        'labels' => $labels,
        'hierarchical' => false,
        'public' => true,
        'show_ui' => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud' => true,
    );
    register_taxonomy('genres', array('events'), $args);
  }

  add_action('init', 'bluewhale_genres', 0);
}

/*
 *
 * add meta box
 *
 * inserts date to sort by.
 *
 */
/* Create one or more meta boxes to be displayed on the events editor screen. */

/*
 * Display the meta box on the edit screen.
 *
 * this code will show up on the edit screen for `events` CPT.
 *
 * does nothing as of 15-11-15
 *
 */

function bluewhale_meta_box($object, $box) {
  wp_nonce_field(basename(__FILE__), 'smashing_post_class_nonce');
  echo('<p> <label for="event-date">');
  _e("Day of the event, or start date (i.e. art exhibits).", 'bluewhale');
  echo('</label><br />');
  echo('<input class="widefat" type="date" name="event-date" id="event-date" value="');
  echo esc_attr(get_post_meta($object->ID, 'smashing_post_class', true));
  echo('" size="30" /></p>');
  /* see
   * http://www.smashingmagazine.com/2011/10/create-custom-post-meta-boxes-wordpress/#saving-the-meta-box-data
   *
   * for rest of article.
   */
}


function bluewhale_meta_boxes() {
  /**
   * Add a meta box to an edit form.
   *
   * @since 2.5.0
   *
   * @global array $wp_meta_boxes
   *
   * @param string           $id            String for use in the 'id' attribute of tags.
   * @param string           $title         Title of the meta box.
   * @param callback         $callback      Function that fills the box with the desired content.
   *                                        The function should echo its output.
   * @param string|WP_Screen $screen        Optional. The screen on which to show the box (like a post
   *                                        type, 'link', or 'comment'). Default is the current screen.
   * @param string           $context       Optional. The context within the screen where the boxes
   *                                        should display. Available contexts vary from screen to
   *                                        screen. Post edit screen contexts include 'normal', 'side',
   *                                        and 'advanced'. Comments screen contexts include 'normal'
   *                                        and 'side'. Menus meta boxes (accordion sections) all use
   *                                        the 'side' context. Global default is 'advanced'.
   * @param string           $priority      Optional. The priority within the context where the boxes
   *                                        should show ('high', 'low'). Default 'default'.
   * @param array            $callback_args Optional. Data that should be set as the $args property
   *                                        of the box array (which is the second parameter passed
   *                                        to your callback). Default null.
   *
   * $callback_args
   * An array of custom arguments you can pass
   * to your $callback function as the second parameter.
   *
   * default = null
   *
   */
  add_meta_box(
          'bluewhale-date', // $id
          esc_html__('Date of Event', 'bluewhale'), // $title,
          'bluewhale_meta_box', // $callback
          'events', // $screen  -> set to show up on events CPTs
          'side', // $context
          'default' // $priority
          // $callback_args
  );
}

/* setting up meta box for date */

function bluewhale_meta_boxes_setup() {
  /* Add meta boxes on the 'add_meta_boxes' hook. */
  add_action('add_meta_boxes', 'bluewhale_meta_boxes');
}

add_action('load-post.php', 'bluewhale_meta_boxes_setup');
add_action('load-post-new.php', 'bluewhale_meta_boxes_setup');
