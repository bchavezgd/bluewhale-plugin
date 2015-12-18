<?php 

/*
 *  custom taxonomy
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