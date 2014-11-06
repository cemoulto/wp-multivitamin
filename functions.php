<?php

// Check if user is on the Login Page
function is_login_page() {
  return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}

// Customize Admin Menu Order
function filter_menu_order($menu_ord) {
  if (!$menu_ord) return true;
  return array(
    'example-1.php',
    'example-2.php'
  );
}

// Add User Role class to Admin Body
function filter_role_class($classes) {
  global $current_user;
  $user_role = array_shift($current_user->roles);
  $classes .= 'role-'. $user_role;
  return $classes;
}

// Define extra ACF Options Pages
function filter_acf_options( $settings ) {
	$settings['title'] = 'Options';
	$settings['pages'] = array('Global', 'Homepage', 'Footer');
	return $settings;
}

// Register and Enqueue Scripts
function init_js() {
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
    // Define Audio Player
    wp_register_script(
      $handle = 'audiojs',
      $src = get_bloginfo('template_directory') . '/audiojs/audio.min.js',
      $deps = array('jquery'),
      $ver = false,
      $in_footer = false
    );
    // Define main vendor scripts
    wp_register_script(
      $handle = 'vendors',
      $src = get_bloginfo('template_directory') . '/js/vendors.min.js',
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
    wp_enqueue_script( 'audiojs' );
    wp_enqueue_script( 'vendors' );
    wp_enqueue_script( 'scripts' );
  }
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

// Register and Enqueue Styles
function init_css() {
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

// Load WP Filters
function init_filters() {
  // Removes admin bar when previewing the website
  add_filter('show_admin_bar', '__return_false');
}

// Custom Post Types
function init_post_types() {
  /* function custom_post() {
    $singular = 'Custon Post';
    $plural ='Custom Posts';
    $labels = array(
      'name'               => _x( $plural, 'post type general name' ),
      'singular_name'      => _x( $singular, 'post type singular name' ),
      'add_new'            => _x( 'Add New', $singular ),
      'add_new_item'       => __( 'Add New {$singular}' ),
      'edit_item'          => __( 'Edit {$singular}' ),
      'new_item'           => __( 'New {$singular}' ),
      'all_items'          => __( 'All {$plural}' ),
      'view_item'          => __( 'View {$singular}' ),
      'search_items'       => __( 'Search {$plural}' ),
      'not_found'          => __( 'No {$plural} found' ),
      'not_found_in_trash' => __( 'No {$plural} found in the Trash' ),
      'parent_item_colon'  => '',
      'menu_name'          => $plural
    );
    $args = array(
      'labels'        => $labels,
      'description'   => 'Holds our custom {$plural}',
      'public'        => true,
      'menu_position' => 20,
      'supports'      => array( 'title' ),
      'has_archive'   => true,
    );
    register_post_type( 'custom_post', $args );
  } */
}

// Define Theme Support
add_theme_support('menus');
add_theme_support('automatic-feed-links');
add_theme_support('post-thumbnails');

// Initialize Functions
add_action('init', 'init_js');
add_action('init', 'init_css');
add_action('init', 'init_filters');
add_action('init', 'init_post_types');

// Add Filters
add_filter('menu_order', 'filter_menu_order');
add_filter('admin_body_class', 'filter_role_class');
add_filter('acf/options_page/settings', 'filter_acf_options');

?>
