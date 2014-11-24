<?php

// Register and Enqueue Styles
function init_css() {

  // Set Site Styles
  if (!is_admin() && !is_login_page()) {

    // Define vendor styles
    wp_register_style(
      $handle = 'site-vendors',
      $src = get_bloginfo('template_directory') . '/assets/css/vendors.css',
      $deps = array(),
      $ver = null,
      $media = 'screen'
    );
    wp_enqueue_style('site-styles');

    // Define main styles
    wp_register_style(
      $handle = 'site-styles',
      $src = get_bloginfo('template_directory') . '/assets/css/styles.css',
      $deps = array('site-vendors'),
      $ver = null,
      $media = 'screen'
    );
    wp_enqueue_style('site-vendors');

  }

  // Set Admin Styles
  if (is_admin() || is_login_page()) {

    // Define main admin styles
    wp_register_style(
      $handle = 'admin-styles',
      $src = get_bloginfo('template_directory') . '/assets/css/admin.css',
      $deps = array(),
      $ver = null,
      $media = 'screen'
    );
    wp_enqueue_style('admin-styles');

  }
}

// Initialize Styles
add_action('init', 'init_css');

?>
