<?php

/*
 * Utility functions
 * -------------------------------------------------------------------------- */

// Check if user is on the Login Page
function is_login_page() {
  return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
}

?>
