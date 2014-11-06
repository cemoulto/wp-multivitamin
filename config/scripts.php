<?php

// Register and Enqueue Scripts
function init_js() {
  // Set Site Scripts
  if (!is_admin() && !is_login_page()) {
    // Redfine jQuery
    wp_deregister_script('jquery');
    wp_register_script(
      $handle = 'jquery',
      $src = "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js",
      $deps = array(),
      $ver = false,
      $in_footer = true
    );
    // Define Modernizr
    wp_register_script(
      $handle = 'modernizr',
      $src = "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.aspnetcdn.com/ajax/modernizr/modernizr-2.7.1.js",
      $deps = array(),
      $ver = false,
      $in_footer = false
    );
    // Define main vendor scripts
    wp_register_script(
      $handle = 'vendors',
      $src = get_bloginfo('template_directory') . '/js/vendors.js',
      $deps = array('jquery'),
      $ver = false,
      $in_footer = true
    );
    // Define main scripts file
    wp_register_script(
      $handle = 'scripts',
      $src = get_bloginfo('template_directory') . '/js/scripts.js',
      $deps = array('jquery', 'vendors', 'audiojs'),
      $ver = false,
      $in_footer = true
    );
    // Enqueue scripts
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'modernizr' );
    wp_enqueue_script( 'vendors' );
    wp_enqueue_script( 'scripts' );
  }
  // Set Admin Scripts
  if (is_admin() || is_login_page()) {
    wp_register_script(
      $handle = 'admin-scripts',
      $src = get_bloginfo('template_directory') . '/admin/admin.js',
      $deps = array('jquery'),
      $ver = false
    );
    wp_enqueue_script( 'admin-scripts' );
  }
}

// Initialize Scripts
add_action('init', 'init_js');

?>
