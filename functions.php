<?php
if ( function_exists( 'add_theme_support' ) ):
  add_theme_support( 'menus' );
  add_theme_support( 'automatic-feed-links' );
  add_theme_support( 'post-thumbnails' );
endif;

if ( function_exists('register_sidebars') ):
  register_sidebar(array(
    'name'=>'Sidebar',
    'before_title'=>'<h4>',
    'after_title'=>'</h4>'
  ));
endif;

function load_scripts() {
    // Register main JS file (Change to scripts.min.js in production)
    wp_register_script( 'scripts', get_bloginfo('template_directory') . '/js/scripts.js');
    // Load Scripts
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'scripts' );
}    
add_action('init', 'load_scripts');
?>
