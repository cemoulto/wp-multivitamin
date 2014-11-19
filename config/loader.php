<?php

$function_path = pathinfo(__FILE__);

foreach ( glob($function_path['dirname'] . '/*.php') as $file) {
	if ( basename($file) !== 'loader.php' ) {
		include $file;
	}
}

?>
