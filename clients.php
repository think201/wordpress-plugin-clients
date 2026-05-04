<?php
/*
Plugin Name: Clients
Plugin URI: http://think201.com
Description: Clients provide you an easiest way to add and retrieve clients.
Author: Think201
Version: 1.1.4
Author URI: http://think201.com
License: GPL v1

Clients
Copyright (C) 2018, Think201 - hello@think201.com

 */

if (!defined('CT_PLUGIN_DIR')) {
	define('CT_PLUGIN_DIR', dirname(__FILE__));
}

if (!defined('CT_FILE_PATH')) {
	define('CT_FILE_PATH', __FILE__);
}

if(!defined('CT_PLUGIN_URL')) {
    define('CT_PLUGIN_URL', plugin_dir_url(__FILE__));
}


require_once CT_PLUGIN_DIR . '/src/core/core.php';
require_once CT_PLUGIN_DIR . '/src/core/loader.php';



?>