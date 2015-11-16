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