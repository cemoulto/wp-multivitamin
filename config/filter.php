<?php

// Customize Admin Menu Order
function filter_menu_order($menu_ord) {
  if (!$menu_ord) return true;
  return array(
    'example-1.php',
    'example-2.php'
  );
}
add_filter('menu_order', 'filter_menu_order');

// Add User Role class to Admin Body
function filter_role_class($classes) {
  global $current_user;
  $user_role = array_shift($current_user->roles);
  $classes .= 'role-'. $user_role;
  return $classes;
}
add_filter('admin_body_class', 'filter_role_class');

// Hide Admin Bar on Site
add_filter('show_admin_bar', '__return_false');

?>
