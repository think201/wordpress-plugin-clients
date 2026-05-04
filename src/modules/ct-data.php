<?php
namespace ct;

class CTData
{
	public static function getClientList($Config)
	{
		global $wpdb;

		$Config = shortcode_atts(
			array(
				'get' => CT_SHRT_SHOWTYPE,
				'category' => CT_SHRT_CATEGORY,
				'numclients' => CT_SHRT_NUMCLIENTS,
				), $Config);

		$ct_clients = $wpdb->prefix.'ct_clients';	

		$Query = "SELECT * FROM ".$ct_clients." WHERE status = 1 ";

		// Check for featured or normal clients
		if($Config['get'] == 'featured')
		{
			$Query .= " AND isfeatured = 1 ";
		}

		if($Config['category'] != CT_SHRT_CATEGORY)
		{
			$Query .= " AND category = '".$Config['category']."' ";
		}

		$Query .= ' ORDER BY listorder ASC';

		if($Config['numclients'] != CT_SHRT_NUMCLIENTS)
		{
			$Query .= " LIMIT ".esc_sql($Config['numclients']);
		}

		$Data = $wpdb->get_results($Query);

		return CTData::_processList($Data);
	}

	public static function getClientInfo($id)
	{
		global $wpdb;

		$ct_clients = $wpdb->prefix.'ct_clients';	

		$Query = $wpdb->prepare( "SELECT * FROM $ct_clients WHERE id = %d AND status = %s", $id, 1);	
		$Data = $wpdb->get_row($Query);

		return $Data;
	}

	public static function _processList($List)
	{
		foreach($List as $Key => $Client)
		{
			$List[$Key]->url = addhttp($Client->url);
		}

		return $List;
	}

	public static function getCategories()
	{
		$Categories = get_option('_clients_categories');

		if(empty($Categories))
		{			
			return false;			
		}

		return $Categories;
	}

	public static function addCategory($Cat)
	{
		$isNew = false;
		$option_name = '_clients_categories';

		$Categories = get_option($option_name);

		if($Categories == false || !empty($CurData))
		{
			$isNew = true;
		}

		$CatSlug = sanitize_title($Cat);

		if($Categories != false AND array_key_exists($CatSlug, $Categories))
		{
			return false;
		}

		$Categories[$CatSlug] = $Cat;

		if($isNew)
		{
			add_option($option_name, $Categories, null, 'no');
		}			
		else
		{
			update_option($option_name, $Categories);	
		}

		return true;
	}	

	public static function deleteClient($id)
	{
		global $wpdb;

		$table_prefix = $wpdb->prefix;
		$ct_clients = $table_prefix.'ct_clients';
		
		$wpdb->delete( $ct_clients, array( 'id' => $id ), array( '%d' ) );

		return true;
	}
}
?>