<?php

/*
 * Globally hide top admin bar
 * -------------------------------------------------------------------------- */

function remove_admin_bar() {
	add_filter( 'show_admin_bar', '__return_false' );
	function hide_admin_bar() {
		echo '<style type="text/css">
			#wpadminbar {
				display: none !important;
			}
			html {
				padding-top: 0 !important;
			}
			@media screen and (max-width: 782px) {
				#wpadminbar {
					display: block !important;
				}
				html {
					padding-top: 46px !important;
				}
			}
			@media screen and (max-width: 600px) {
				#wpadminbar {
					display: block !important;
				}
				html {
					padding-top: 0 !important;
				}
			}
		</style>';
	}
	add_action( 'admin_head', 'hide_admin_bar' );
}

/*
 * Remove items from admin bar navigation
 * -------------------------------------------------------------------------- */

function remove_admin_bar_links() {
	function link_config() {
	    global $wp_admin_bar;
	    // $wp_admin_bar->remove_menu('wp-logo');          // Remove the WordPress logo
	    // $wp_admin_bar->remove_menu('about');            // Remove the about WordPress link
	    // $wp_admin_bar->remove_menu('wporg');            // Remove the WordPress.org link
	    // $wp_admin_bar->remove_menu('documentation');    // Remove the WordPress documentation link
	    // $wp_admin_bar->remove_menu('support-forums');   // Remove the support forums link
	    // $wp_admin_bar->remove_menu('feedback');         // Remove the feedback link
	    // $wp_admin_bar->remove_menu('site-name');        // Remove the site name menu
	    // $wp_admin_bar->remove_menu('view-site');        // Remove the view site link
	    // $wp_admin_bar->remove_menu('updates');          // Remove the updates link
	    // $wp_admin_bar->remove_menu('comments');         // Remove the comments link
	    // $wp_admin_bar->remove_menu('new-content');      // Remove the content link
	    // $wp_admin_bar->remove_menu('w3tc');             // If you use w3 total cache remove the performance link
	    // $wp_admin_bar->remove_menu('my-account');       // Remove the user details tab
	}
	add_action('wp_before_admin_bar_render', 'link_config');
}

/*
* Globally disable posts
* -------------------------------------------------------------------------- */

function globally_disable_posts() {
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
}

/*
 * Globally disable comments
 * -------------------------------------------------------------------------- */

function globally_disable_comments() {
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
}

/*
 * Remove dashboard items
 * -------------------------------------------------------------------------- */

function remove_dashboard_widgets() {
	// remove_action('welcome_panel', 'wp_welcome_panel'); // Remove  WordPress Welcome Panel
	function dashboard_widgets() {
		// remove_meta_box('dashboard_quick_press', 'dashboard', 'normal'); // Remove posts metabox from dashboard
		// remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // Remove comments metabox from dashboard
		// remove_meta_box('dashboard_primary', 'dashboard', 'normal'); // Remove news from dashboard
		// remove_meta_box('dashboard_activity', 'dashboard', 'normal'); // Remove activity from dashboard
		// remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); // Remove at a glance from dashboard
	}
	add_action('admin_menu', 'dashboard_widgets');
}

?>
