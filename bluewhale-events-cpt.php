<?php
// events cpt

// Register Custom Post Type
  function bluewhale_events() {

    $singular = 'Event';
    $plural = 'Events';
    $slug = str_replace( ' ', '_', strtolower( $singular ) );
    $labels = array(
        'name'              => $plural,
        'singular_name'     => $singular,
        'add_new'           => 'Add New',
        'add_new_item'      => 'Add New ' . $singular,
        'edit'              => 'Edit',
        'edit_item'         => 'Edit ' . $singular,
        'new_item'          => 'New ' . $singular,
        'view'              => 'View ' . $singular,
        'view_item'         => 'View ' . $singular,
        'search_term'       => 'Search ' . $plural,
        'parent'            => 'Parent ' . $singular,
        'not_found'         => 'No ' . $plural .' found',
        'not_found_in_trash'    => 'No ' . $plural .' in Trash'
        );

    $args = array(
        'label'             => __('Event', 'bluewhale'),
        'description'       => __('Shows, opens, and other events. ', 'bluewhale'),
        'labels'            => $labels,
        'supports'          => array('title', 'editor', 'author', 'thumbnail', 'revisions',),
        'taxonomies'        => array('genres'),
        'hierarchical'      => false,
        'public'            => true,
        'show_ui'           => true,
        'show_in_menu'      => true,
        'menu_position'     => 5,
        'menu_icon'         => 'dashicons-tickets',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export'        => true,
        'has_archive'       => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type'   => 'post',
        //'register_meta_box_cb' => 'bluewhale_date_meta',
    );
    register_post_type('Events', $args);
  }

  add_action('init', 'bluewhale_events', 0);

