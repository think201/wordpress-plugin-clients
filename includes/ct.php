<?php
namespace ct;

// Action hook for AJAX Request
add_action('wp_ajax_ct_create_shortcode', array('ct\Clients', 'createShortcode'));

class Clients
{
    public static function createShortcode()
    {
        $RetVal = true;

        $Config = self::getConfig();

        $ShortCode = self::formShortcode($Config).'<br>'.self::formMethodCode($Config);

        if($RetVal)
        {
            $msg = 'Generated Shortcode Successfully.';
        }
        else
        {
            $msg = 'Oops, there seems to be some issue.';
        }

        $response = array('status' => $RetVal, 'msg' => $msg, 'shortcode' => $ShortCode);
        
        wp_send_json($response);        
    }

    private static function getConfig()
    {
        $Data = array();

        $Data['get']        = isset($_POST['get']) ? sanitize_text_field($_POST['get']) : CT_SHRT_SHOWTYPE;
        $Data['category']   = isset($_POST['category']) ? $_POST['category'] : CT_SHRT_CATEGORY;

        $Data['style']          = isset($_POST['style']) ? sanitize_text_field($_POST['style']) : CT_SHRT_STYLE;
        $Data['numclients']     = isset($_POST['numclients']) ? sanitize_text_field($_POST['numclients']) : CT_SHRT_NUMCLIENTS;
        $Data['numcols']         = isset($_POST['numcols']) ? sanitize_text_field($_POST['numcols']) : CT_SHRT_NUMCOLUMNS;

        $Data['showlogo'] = isset($_POST['showlogo']) ? $_POST['showlogo'] : false;
        $Data['showname'] = isset($_POST['showname']) ? $_POST['showname'] : false;

        $Data['class']  = isset($_POST['class']) ? $_POST['class'] : '';

        return $Data;
    }

    private static function formShortcode($Config)
    {
        $SC = 'Shortcode:<br><br>[clients ';

        if($Config['get'] != CT_SHRT_SHOWTYPE)
        {
            $SC .= ' get="'.$Config['get'].'"';    
        }

        if($Config['category'] != CT_SHRT_CATEGORY)
        {        
            $SC .= ' category="'.$Config['category'].'"';
        }

        if($Config['style'] != CT_SHRT_STYLE)
        { 
            $SC .= ' style="'.$Config['style'].'"';
        }

        if($Config['numclients'] != CT_SHRT_NUMCLIENTS)
        { 
            $SC .= ' numclients="'.$Config['numclients'].'"';
        }

        if($Config['numcols'] != CT_SHRT_NUMCOLUMNS)
        { 
            $SC .= ' numcols="'.$Config['numcols'].'"';
        }

        if(!empty($Config['class']))
        {
            $SC .= ' class="'.$Config['class'].'"';
        }

        $SC .= ']';

        return $SC;
    }

    private static function formMethodCode($Config)
    {
        $Methods = "<br><br>For Developers <br>
        <pre>
        if(function_exists('getClients'))
        {
            \$args = array(";

        if($Config['get'] != CT_SHRT_SHOWTYPE)
        {
            $Methods .= ' get => "'.$Config['get'].'"';    
        }

        if($Config['category'] != CT_SHRT_CATEGORY)
        {        
            $Methods .= ' category => "'.$Config['category'].'"';
        }                

        if($Config['numclients'] != CT_SHRT_NUMCLIENTS)
        { 
            $Methods .= ' numclients => "'.$Config['numclients'].'"';
        }

        $Methods .=  ");

            \$ClientList = getClients(\$args);
        }
        </pre>
        ";

        return $Methods;
    }    

}

?>