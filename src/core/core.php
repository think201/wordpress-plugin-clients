<?php
namespace ct;

class Core
{

    public static function load($path)
    {
        return require_once CT_PLUGIN_DIR . '/src/' . $path;
    }
}
