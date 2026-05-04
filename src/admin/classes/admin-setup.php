<?php
namespace ct;

class AdminSetup
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
        $this->fileIncludes();
        add_action('admin_menu', array($this, 'menuItems')); 
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

    public function menuItems()
    {
        add_menu_page('Clients', 'Clients', 'manage_options', 'ct-all-clients', array($this, 'pageAllClients'), 'dashicons-slides');

        $PageA = add_submenu_page( 'ct-all-clients', 'All Clients', 'All Clients', 'manage_options', 'ct-all-clients', array($this, 'pageAllClients') ); 
        $PageB = add_submenu_page( 'ct-all-clients', 'Add New', 'Add New', 'manage_options', 'ct-add-new', array($this, 'pageAddNew') );         
        $PageC = add_submenu_page( '', 'Edit Client', 'Edit Client', 'manage_options', 'ct-edit-client', array($this, 'pageEdit') ); 
        $PageD = add_submenu_page( 'ct-all-clients', 'Shortcodes', 'Shortcodes', 'manage_options', 'ct-shortcode', array($this, 'pageShortcodes') );                 
        $PageE = add_submenu_page( '', 'Catgories', 'Client Categories', 'manage_options', 'ct-categories', array($this, 'pageCategory') );         
       
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
            wp_enqueue_script( 'ct-ajax-request', CT_PLUGIN_URL . 'build/js/admin.js', array( 'jquery' ), false, true );
            // wp_localize_script( 'ct-ajax-request', 'CTAjax', array( 'ajaxurl' => plugins_url( 'admin-ajax.php' ) ) );
            
            wp_enqueue_style( 'admin-css', CT_PLUGIN_URL . 'build/css/admin.css', array(), CT_VERSION, 'all' );
        }
    }

    public function pageAddNew()
    {
        Core::load('admin/views/admin-add-new.php');
    }

    public function pageEdit()
    {
        Core::load('admin/views/admin-edit-client.php');
    }    

    public function pageAllClients()
    {
        Core::load('admin/views/admin-all-clients.php');
    }

    public function pageShortcodes()
    {
        Core::load('admin/views/admin-shortcodes.php');
    }    

    public function pageCategory()
    {
        Core::load('admin/views/admin-categories.php');
    }       
}
?>