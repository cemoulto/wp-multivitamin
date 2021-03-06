<?php

// Define Post
function post_type_example() {
  $singular = 'Example';
  $plural ='Examples';
  $labels = array(
    'name'               => _x( $plural, 'post type general name' ),
    'singular_name'      => _x( $singular, 'post type singular name' ),
    'add_new'            => _x( 'Add New', $singular ),
    'add_new_item'       => __( 'Add New ' . $singular ),
    'edit_item'          => __( 'Edit ' . $singular ),
    'new_item'           => __( 'New ' . $singular ),
    'all_items'          => __( 'All ' . $plural ),
    'view_item'          => __( 'View ' . $singular ),
    'search_items'       => __( 'Search ' . $plural ),
    'not_found'          => __( 'No ' . $plural . ' found' ),
    'not_found_in_trash' => __( 'No ' . $plural . ' found in the Trash' ),
    'parent_item_colon'  => '',
    'menu_name'          => $plural
  );
  $args = array(
    'labels'        => $labels,
    'description'   => 'Holds our custom ' . $plural,
    'public'        => true,
    'menu_position' => null,
    'supports'      => array('title'),
    'has_archive'   => true,
  );
  register_post_type('example', $args);
}

?>
