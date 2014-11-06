<?php

foreach (glob("config/*.php") as $config_item) {
  include $config_item;
}

foreach (glob("config/post_types/*.php") as $post_type) {
  include $post_type;
}

?>
