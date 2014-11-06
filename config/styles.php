<?php

// Register and Enqueue Styles
function init_css() {
  // Set Site Styles
  if (!is_admin() && !is_login_page()) {
    // Define google font
    wp_register_style(
      $handle = 'fonts',
      $src = "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://fonts.googleapis.com/css?family=Oswald:400,300,700",
      $deps = array(),
      $ver = false,
      $media = all
    );
    // Define bootstrap styles
    wp_register_style(
      $handle = 'bootstrap',
      $src = get_bloginfo('template_directory') . '/css/bootstrap.min.css',
      $deps = array('fonts'),
      $ver = false,
      $media = screen
    );
    // Define main styles
    wp_register_style(
      $handle = 'styles',
      $src = get_stylesheet_uri(),
      $deps = array('fonts', 'bootstrap'),
      $ver = false,
      $media = screen
    );
    // Enqueue styles
    wp_enqueue_style( 'fonts' );
    wp_enqueue_style( 'bootstrap' );
    wp_enqueue_style( 'styles' );
  }
  // Set Admin Styles
  if (is_admin() || is_login_page()) {
    wp_register_style(
      $handle = 'admin_styles',
      $src = get_bloginfo('template_directory') . '/admin/admin.css',
      $deps = array(),
      $ver = false,
      $media = screen
    );
    wp_enqueue_style( 'admin_styles' );
  }
}

// Initialize Styles
add_action('init', 'init_css');

?>
