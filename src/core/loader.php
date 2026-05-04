<?php
namespace ct;


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


if (!defined('CT_LOAD_JS')) {
	define('CT_LOAD_JS', true);
}

if (!defined('CT_LOAD_CSS')) {
	define('CT_LOAD_CSS', true);
}

Core::load('core/plugin-setup.php');

register_activation_hook(CT_FILE_PATH, ['ct\PluginSetup', 'activate']);
register_deactivation_hook(CT_FILE_PATH, ['ct\PluginSetup', 'deactivate']);


if (is_admin()) {
    // load admin setup
    Core::load('admin/classes/admin-setup.php');
    add_action('plugins_loaded', function () {
        $initObj = AdminSetup::get_instance();
        $initObj->init();
    });


} 
else {
    // // load public setup
    // Core::load('public/classes/public-setup.php');

    // add_action('plugins_loaded', function () {
    //     $initObj = PublicSetup::get_instance();
    //     $initObj->init();
    // });
}