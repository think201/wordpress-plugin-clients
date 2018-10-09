<?php
namespace ct;

add_shortcode( "clients", array('ct\CTShortCodes', 'clients'));

class CTShortCodes
{
    public static function clients($attribs, $content = null, $code)
    {
        // All the attributes
        $ClientList = self::getClients($attribs);
    
        $Output = CTShortCodes::_processStyle($ClientList, $attribs);

        return $Output;
    }

    private static function getClients($Config)
    {
        $List = CTData::getClientList($Config);

        return $List;
    }

    private static function _processStyle($ClientList, $Config)
    {
        $Atts = shortcode_atts( array('style' => 'grid', 'numcols' => CT_SHRT_NUMCOLUMNS), $Config );

        switch ($Atts['style']) 
        {
            case "list":
                
                // List Style
                $StyledClients = CTShortCodes::_List($ClientList, $Config);
                break;
            
            case "grid":
               
                // Grid Style
                $StyledClients = CTShortCodes::_Grid($ClientList, $Config);
                break;
           
            case "slider":
               // Slider Style
                $StyledClients = CTShortCodes::_Slider($ClientList, $Config);
                break;
            
            default:

                // Call list style by default
                $StyledClients = CTShortCodes::_List($ClientList, $Config);                
        }

        return $StyledClients;
    }    

    public static function _List($ClientList, $Config)
    {
        require_once CT_PLUGIN_DIR .'/templates/ct-lists.php'; 
    }

    public static function _Grid($ClientList, $Config)
    {        
        require_once CT_PLUGIN_DIR .'/templates/ct-grid.php';     
    }

    public static function _Slider($ClientList, $Config)
    {        
        require_once CT_PLUGIN_DIR .'/templates/ct-slider.php';  
    }
}

?>