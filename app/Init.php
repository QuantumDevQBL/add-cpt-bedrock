<?php

namespace QTD\ProjectCPT;

// Set up plugin class
class Init {

  function __construct() {

    // Include all post types
    foreach (glob(PROJECTCPT_PLUGIN_DIR . "app/types/*.php") as $filename) {
      include $filename;
    }
  }
}
