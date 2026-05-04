<?php
namespace ct;
/**
 * @package Internals
 */

// Action hook for AJAX Request
add_action('wp_ajax_page_add_new', array('ct\PostData', 'addNew'));
add_action('wp_ajax_page_add_category', array('ct\PostData', 'addNewCategory'));

class PostData
{
	public static function addNew()
	{
		// Get the form data
		$Data = self::getData();
		
		if(isset($_POST['update']))
		{
			// Insert data into DB
			$RetVal = self::updateData($Data);
		}
		else
		{
		// Insert data into DB
			$RetVal = self::addData($Data);
		}

		if($RetVal)
		{
			$msg = 'Successfully added';
		}
		else
		{
			$msg = 'Oops, there seems to be some issue.';
		}

		$response = array('status' => $RetVal, 'msg' 	=> $msg);
		
		wp_send_json($response);
	}

	public static function getData()
	{
		$Data = array();

		$Data['name'] 				= isset($_POST['name']) ? sanitize_text_field($_POST['name']) : ''; 	
		$Data['description'] 		= isset($_POST['description']) ? sanitize_text_field($_POST['description']) : ''; 	

		$Data['url'] 				= isset($_POST['url']) ? sanitize_text_field($_POST['url'] ): '#';		
		$Data['logo'] 				= isset($_POST['logo']) ? sanitize_text_field($_POST['logo']) : '';
		$Data['listorder'] 			= isset($_POST['listorder']) ? sanitize_text_field($_POST['listorder']) : 100;

		$Data['listorder'] 			= $Data['listorder'] == 0 ? 100 : intval($Data['listorder']);

		$Data['description'] 		= isset($_POST['description']) ? sanitize_text_field($_POST['description']) : '';		

		$Data['category'] 			= isset($_POST['category']) ? sanitize_text_field($_POST['category']) : ''; 
		$Data['isfeatured'] 		= $_POST['isfeatured'] == "1"? 1: 0;		


		$Data['created_at']     	= date('Y-m-d H:i:s');
		$Data['updated_at'] 		= date('Y-m-d H:i:s'); 

		$Data['misc'] 				= ''; 
		$Data['status'] 			= 1;

		return $Data;
	}

	public static function addData($Data)
	{
		global $wpdb;

		$table_prefix = $wpdb->prefix;
		$ct_clients = $table_prefix.'ct_clients';
		
		$wpdb->insert($ct_clients, $Data,	array('%s', '%s', '%s', '%s', '%s', '%s', '%d','%s', '%s','%s','%d') ); 

		return true;
	}

	public static function updateData($Data)
	{
		global $wpdb;

		$table_prefix = $wpdb->prefix;
		$ct_clients = $table_prefix.'ct_clients';

		$updateID = $_POST['update_id'];

		// Unsetting the Created Date
		unset($Data['created_at']);

		$wpdb->update($ct_clients, $Data, array('id'=> $updateID), $format = null, $where_format = null );
		
		return true;
	}

	public static function addNewCategory()
	{
		$RetVal = false;
		$Cat = $_POST['category'];

		$RetVal = CTData::addCategory($Cat);

		if($RetVal)
		{
			$msg = 'Successfully added';
		}
		else
		{
			$msg = "Issues adding the category. Make sure the same does'n exist.";
		}

		$response = array('status' => $RetVal, 'msg' 	=> $msg);
		
		wp_send_json($response);		
	}
}
?>