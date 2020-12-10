<?php
/*
Plugin Name: add-cpt
Plugin URI:
Description: Add custom post type.
Version: 1.0
Author: Qtd-dev
Author URI:
License: MIT
*/

namespace QTD\ProjectCPT;


//Set up autoloader
require __DIR__ . '/vendor/autoload.php';

//Define Constants
define( 'PROJECTCPT_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'PROJECTCPT_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Autoload the Init class
$project_init = new Init();
