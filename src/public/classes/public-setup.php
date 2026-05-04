<?php
namespace ct;

class PublicSetup
{
    protected static $instance = null;

    public static function get_instance()
    {
        // create an object
        null === self::$instance and self::$instance = new self;

        return self::$instance;
    }

    public function init()
    {
        $this->fileIncludes();

        add_action('init', [$this, 'publicScriptStyles']);
    }

    public function fileIncludes()
    {
        Core::load('modules/post-requests.php');
        Core::load('modules/ct-data.php');
        Core::load('modules/ct-listtable.php');
        Core::load('modules/ct-helper.php');
        Core::load('modules/ct-shortcodes.php');
        Core::load('modules/ct.php');
    }

    public function publicScriptStyles()
    {
        $RedlofPluginConfig = get_option('wp_redlof_plugins_config', false);

        if($RedlofPluginConfig !== false AND isset($RedlofPluginConfig['ct_css']) AND $RedlofPluginConfig['ct_css'])
        {
            $CssSet = true;
        }
        else 
        {
            $CssSet = false;
        }            

        if($CssSet == false)
        {
            wp_enqueue_style( 'ct-css', CT_PLUGIN_URL . 'build/css/public.css', array(), CT_VERSION, 'all' );
        }

        wp_enqueue_script( 'ct-user', CT_PLUGIN_URL . 'build/js/public.js', array( 'jquery' ), false, true );
    }

}
