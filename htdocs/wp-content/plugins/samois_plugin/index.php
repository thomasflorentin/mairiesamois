<?php
/*
Plugin Name: Samois sur Seine Plugin
Author: Thomas Florentin
Version: 1.0
*/

define('SAMOIS_DIR', WP_PLUGIN_DIR.'/samois_plugin');
define('SAMOIS_PATH', '/'.str_replace(ABSPATH, '', SAMOIS_DIR));
define('SAMOIS_URL', WP_PLUGIN_URL.'/samois_plugin');


require_once(SAMOIS_DIR.'/acf.php');
require_once(SAMOIS_DIR.'/cpt/cpt-event.php');
require_once(SAMOIS_DIR.'/cpt/cpt-information.php');

