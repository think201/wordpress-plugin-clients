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

if (version_compare(PHP_VERSION, '5.2', '<')) {
	if (is_admin() && (!defined('DOING_AJAX') || !DOING_AJAX)) {
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
		deactivate_plugins(__FILE__);
		wp_die(sprintf(__('Clients requires PHP 5.2 or higher, as does WordPress 3.2 and higher. The plugin has now disabled itself.', 'Mins To Read'), '<a href="http://wordpress.org/">', '</a>'));
	} else {
		return;
	}
}

if (!defined('CT_PATH')) {
	define('CT_PATH', plugin_dir_path(__FILE__));
}

if (!defined('CT_BASENAME')) {
	define('CT_BASENAME', plugin_basename(__FILE__));
}

if (!defined('CT_VERSION')) {
	define('CT_VERSION', '1.1.3');
}

if (!defined('CT_PLUGIN_DIR')) {
	define('CT_PLUGIN_DIR', dirname(__FILE__));
}

if (!defined('CT_LOAD_JS')) {
	define('CT_LOAD_JS', true);
}

if (!defined('CT_LOAD_CSS')) {
	define('CT_LOAD_CSS', true);
}

require_once CT_PLUGIN_DIR . '/includes/ct-install.php';
require_once CT_PLUGIN_DIR . '/includes/ct-admin.php';

register_activation_hook(__FILE__, array('CT_Install', 'activate'));
register_deactivation_hook(__FILE__, array('CT_Install', 'deactivate'));
register_uninstall_hook(__FILE__, array('CT_Install', 'delete'));

add_action('plugins_loaded', 'ClientsStart');

function ClientsStart() {
	$initObj = ct\CTAdmin::get_instance();
	$initObj->init();
}

function getClients($Config = array()) {
	$List = ct\CTData::getClientList($Config);

	return $List;
}

?>