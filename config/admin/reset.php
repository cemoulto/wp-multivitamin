<?php

/*
 * Disable admin bar
 * -------------------------------------------------------------------------- */

function remove_admin_bar() {
	add_filter( 'show_admin_bar', '__return_false' );
	function hide_admin_bar() {
		echo '<style>
			html { padding-top: 0 !important; }
			div#wpadminbar { display: none; }
		</style>';
	}
	add_action('admin_head', 'hide_admin_bar');
}
add_action('init', 'remove_admin_bar');

/*
* Disable posts
* -------------------------------------------------------------------------- */

/*
// Disable support for posts in post types
function disable_posts_post_types_support() {
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		if(post_type_supports($post_type, 'post')) {
			remove_post_type_support($post_type, 'post');
		}
	}
}
add_action('admin_init', 'disable_posts_post_types_support');

// Remove posts page in menu
function disable_posts_admin_menu() {
	remove_menu_page('edit.php');
}
add_action('admin_menu', 'disable_posts_admin_menu');
*/

/*
 * Disable comments
 * -------------------------------------------------------------------------- */

/*
// Disable support for comments and trackbacks in post types
function disable_comments_post_types_support() {
	$post_types = get_post_types();
	foreach ($post_types as $post_type) {
		if(post_type_supports($post_type, 'comments')) {
			remove_post_type_support($post_type, 'comments');
			remove_post_type_support($post_type, 'trackbacks');
		}
	}
}
add_action('admin_init', 'disable_comments_post_types_support');

// Remove comments page in menu
function disable_comments_admin_menu() {
	remove_menu_page('edit-comments.php');
}
add_action('admin_menu', 'disable_comments_admin_menu');

// Redirect any user trying to access comments page
function disable_comments_admin_menu_redirect() {
	global $pagenow;
	if ($pagenow === 'edit-comments.php') {
		wp_redirect(admin_url()); exit;
	}
}
add_action('admin_init', 'disable_comments_admin_menu_redirect');
*/

/*
 * Remove dashboard items
 * -------------------------------------------------------------------------- */

//Remove  WordPress Welcome Panel
remove_action('welcome_panel', 'wp_welcome_panel');

// Remove posts metabox from dashboard
function disable_posts_dashboard() {
	remove_meta_box('dashboard_quick_press', 'dashboard', 'normal');
}
add_action('admin_init', 'disable_posts_dashboard');

// Remove comments metabox from dashboard
function disable_comments_dashboard() {
	remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
}
add_action('admin_init', 'disable_comments_dashboard');

// Remove news from dashboard
function disable_news_dashboard() {
	remove_meta_box('dashboard_primary', 'dashboard', 'normal');
}
add_action('admin_init', 'disable_news_dashboard');


?>
