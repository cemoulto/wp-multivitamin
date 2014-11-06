<?php

foreach (glob("config/**/*.php") as $config_item) {
  include $config_item;
}

?>
