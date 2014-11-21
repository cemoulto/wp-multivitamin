<?php

/*
 * Load scripts
 * -------------------------------------------------------------------------- */

// Register and Enqueue Scripts
function init_js() {
  // Set Site Scripts
  if (!is_admin() && !is_login_page()) {
    // Redfine jQuery
    wp_deregister_script('jquery');
    wp_register_script(
      $handle = 'site-js-jquery',
      $src = "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js",
      $deps = array(),
      $ver = false,
      $in_footer = true
    );
    // Define Modernizr
    wp_register_script(
      $handle = 'site-js-modernizr',
      $src = "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.aspnetcdn.com/ajax/modernizr/modernizr-2.7.1.js",
      $deps = array(),
      $ver = false,
      $in_footer = false
    );
    // Define main vendor scripts
    wp_register_script(
      $handle = 'site-js-vendors',
      $src = get_bloginfo('template_directory') . '/assets/js/vendors.js',
      $deps = array('site-js-jquery'),
      $ver = false,
      $in_footer = true
    );
    // Define main scripts file
    wp_register_script(
      $handle = 'site-js-scripts',
      $src = get_bloginfo('template_directory') . '/assets/js/scripts.js',
      $deps = array('site-js-jquery', 'site-js-vendors'),
      $ver = false,
      $in_footer = true
    );
    // Enqueue scripts
    wp_enqueue_script( 'site-js-jquery' );
    wp_enqueue_script( 'site-js-modernizr' );
    wp_enqueue_script( 'site-js-vendors' );
    wp_enqueue_script( 'site-js-scripts' );
  }
  // Set Admin Scripts
  if (is_admin() || is_login_page()) {
    wp_register_script(
      $handle = 'admin-js-scripts',
      $src = get_bloginfo('template_directory') . '/admin/admin.js',
      $deps = array('jquery'),
      $ver = false
    );
    // Enqueue admin scripts
    wp_enqueue_script( 'admin-js-scripts' );
  }
}

// Initialize Scripts
add_action('init', 'init_js');

?>
