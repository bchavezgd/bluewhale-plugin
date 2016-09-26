<?php

/*
 *  custom taxonomy
 */

if (!function_exists('bluewhale_genres')) {

// Register Custom Taxonomy
  function bluewhale_genres() {

    $singular = "Genre";
    $plural = "Genres";

    $labels = array(
        'name' => _x($plural, 'Taxonomy General Name', 'bluewhale'),
        'singular_name' => _x($singular, 'Taxonomy Singular Name', 'bluewhale'),
        'menu_name' => __($plural, 'bluewhale'),
        'all_items' => __('All' . $plural, 'bluewhale'),
        'parent_item' => __('Parent' . $plural, 'bluewhale'),
        'parent_item_colon' => __('Parent {$singular}:', 'bluewhale'),
        'new_item_name' => __('New {$singular} Name', 'bluewhale'),
        'add_new_item' => __('Add New ' . $singular, 'bluewhale'),
        'edit_item' => __('Edit ' . $singular, 'bluewhale'),
        'update_item' => __('Update ' . $singular, 'bluewhale'),
        'view_item' => __('View ' . $singular, 'bluewhale'),
        'separate_items_with_commas' => __('Separate '.$plural . ' with commas', 'bluewhale'),
        'add_or_remove_items' => __('Add or remove' . $plural, 'bluewhale'),
        'choose_from_most_used' => __('Choose from the most used' . $plural, 'bluewhale'),
        'popular_items' => __('Popular ' . $plural, 'bluewhale'),
        'search_items' => __('Search' . $plural, 'bluewhale'),
        'not_found' => __($singular. ' Not Found', 'bluewhale'),
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
    register_taxonomy('genres', array('events', 'artists'), $args);
  }

  add_action('init', 'bluewhale_genres', 0);
}
