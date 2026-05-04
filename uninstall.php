<?php

if (! defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

if (! defined('CT_PATH')) {
    define('CT_PATH', plugin_dir_path(__FILE__));
}

require_once CT_PATH . 'src/core/plugin-setup.php';

if (class_exists('clients\PluginSetup') && method_exists('clients\PluginSetup', 'delete')) {
    clients\PluginSetup::delete();
}
