<?php
namespace ct;

class Core
{

    public static function load($path, $args = array())
    {
        extract($args, EXTR_SKIP);
        return include CT_PLUGIN_DIR . '/src/' . $path;
    }
}
