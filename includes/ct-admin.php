<?php
namespace ct;

class CTAdmin
{
    protected static $instance = null;

    public static function get_instance() 
    {
        // create an object
        NULL === self::$instance and self::$instance = new self;

        return self::$instance;
     }

    public function init()
    {   
        $this->fileInlcudes();

        add_action('admin_menu', array($this, 'menuItems')); 

        add_action( 'init', array($this, 'userFiles')); 
    }

    public function fileInlcudes()
    {
        require_once CT_PLUGIN_DIR .'/includes/post-requests.php';
        require_once CT_PLUGIN_DIR .'/includes/ct-data.php';
        require_once CT_PLUGIN_DIR .'/includes/ct-listtable.php';
        require_once CT_PLUGIN_DIR .'/includes/ct-helper.php';
        require_once CT_PLUGIN_DIR .'/includes/ct-shortcodes.php';
        require_once CT_PLUGIN_DIR .'/includes/ct.php';
    }

    public function menuItems()
    {
        add_menu_page('Clients', 'Clients', 'manage_options', 'ct-all-clients', array($this, 'pageAllClients'), 'dashicons-slides');

        $PageA = add_submenu_page( 'ct-all-clients', 'All Clients', 'All Clients', 'manage_options', 'ct-all-clients', array($this, 'pageAllClients') ); 
        $PageB = add_submenu_page( 'ct-all-clients', 'Add New', 'Add New', 'manage_options', 'ct-add-new', array($this, 'pageAddNew') );         
        $PageC = add_submenu_page( null, 'Edit Client', 'Edit Client', 'manage_options', 'ct-edit-client', array($this, 'pageEdit') ); 
        $PageD = add_submenu_page( 'ct-all-clients', 'Shortcodes', 'Shortcodes', 'manage_options', 'ct-shortcode', array($this, 'pageShortcodes') );                 
        $PageE = add_submenu_page( null, 'Catgories', 'Client Categories', 'manage_options', 'ct-categories', array($this, 'pageCategory') );         
       
        add_action('admin_print_scripts-' . $PageA, array($this, 'adminScriptStyles'));
        add_action('admin_print_scripts-' . $PageB, array($this, 'adminScriptStyles'));
        add_action('admin_print_scripts-' . $PageC, array($this, 'adminScriptStyles'));
        add_action('admin_print_scripts-' . $PageD, array($this, 'adminScriptStyles'));
        add_action('admin_print_scripts-' . $PageE, array($this, 'adminScriptStyles'));
    }

    public function adminScriptStyles()
    {
        if(is_admin()) 
        {
            wp_enqueue_media();        
            wp_enqueue_script( 'ct-ajax-request', plugins_url( 'public/js/ct-admin.js', dirname(__FILE__) ), array( 'jquery' ), false, true );
            wp_enqueue_script( 'ct-think201-validator', plugins_url( 'public/js/think201-validator.js', dirname(__FILE__) ), array( 'jquery' ), false, true );
            wp_localize_script( 'ct-ajax-request', 'CTAjax', array( 'ajaxurl' => plugins_url( 'admin-ajax.php' ) ) );
            
            wp_enqueue_style( 'ct-css', plugins_url( 'public/css/ct.css', dirname(__FILE__) ), array(), CT_VERSION, 'all' );
        }
    }

    public function userFiles()
    {
        if (!is_admin()) 
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
                wp_enqueue_style( 'ct-css', plugins_url( 'public/css/ct.css', dirname(__FILE__) ), array(), CT_VERSION, 'all' );
            }

            wp_enqueue_script( 'ct-user', plugins_url( 'public/js/ct-user.js', dirname(__FILE__) ), array( 'jquery' ), false, true );
        }
    }    

    public function pageAddNew()
    {
        require_once CT_PLUGIN_DIR .'/pages/admin-add-new.php';     
    }

    public function pageEdit()
    {
        require_once CT_PLUGIN_DIR .'/pages/admin-edit-client.php';     
    }    

    public function pageAllClients()
    {
        require_once CT_PLUGIN_DIR .'/pages/admin-all-clients.php';
    }

    public function pageShortcodes()
    {
        require_once CT_PLUGIN_DIR .'/pages/admin-shortcodes.php';
    }    

    public function pageCategory()
    {
        require_once CT_PLUGIN_DIR .'/pages/admin-categories.php';
    }       
}
?>