<?php

function admin_menu_order() {
  function order($menu_ord) {
    if (!$menu_ord) return true;
    return array(
      'index.php', // Dashboard
      'separator1', // First separator
      'edit.php', // Posts
      'edit-comments.php', // Posts
      'edit.php?post_type=page', // Pages
      'edit.php?post_type=post_example', // Pages
      'separator2', // Second separator
      'upload.php', // Media
      'themes.php', // Appearance
      'plugins.php', // Plugins
      'users.php', // Users
      'tools.php', // Tools
      'options-general.php', // Settings
      'edit.php?post_type=acf', // Advanced Custom Fields
      'separator-last', // Last separator
    );
  }
  add_filter('custom_menu_order', 'order'); // Activate custom_menu_order
  add_filter('menu_order', 'order');
}

?>
