<?php

/*
 * Config
 * -------------------------------------------------------------------------- */

// Load functions in '/config'
require_once('config/loader.php');

// Admin bar resets
// add_action('init', 'remove_admin_bar'); // Global removes top admin bar
// add_action('init', 'remove_admin_bar_links'); // Removes admin bar links (Define which links in '/config/admin/reset.php')

// Post type resets
// add_action('init', 'globally_disable_posts'); // Disables the 'post' post type
// add_action('init', 'globally_disable_comments'); // Disables the 'comments' post type

// Admin dashboard resets
// add_action('init', 'remove_dashboard_widgets'); // Removes widgets from Dashboard (Define which widgets in '/config/admin/reset.php')

// Admin menu customization
// add_action('init', 'admin_menu_order'); // Invokes a custom admin menu order (Define the order in '/config/admin/menu.php')

// Post type additions
// add_action('init', 'post_example'); // Loads a placeholder custom post type (Found in '/config/models')

?>
