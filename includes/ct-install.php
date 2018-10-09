<?php

class CT_Install
{

    //Function to Setup DB Tables
    public static function activate()
    {
        global $wpdb;

        $ct_clients = $wpdb->prefix.'ct_clients';
        $charset_collate = $wpdb->get_charset_collate();

        $ct_clients_query = "CREATE TABLE $ct_clients (
        id int(9) NOT NULL AUTO_INCREMENT,
        name varchar(100) NOT NULL,
        url varchar(300),
        description varchar(500),
        category varchar(100),
        logo varchar(550),
        isfeatured boolean DEFAULT 0,
        client_since datetime,   
        created_at datetime NOT NULL,
        updated_at datetime NOT NULL,
        misc varchar(50),
        status tinyint(5) DEFAULT 1,
        listorder tinyint(5) DEFAULT 0,
        PRIMARY KEY  (id)
        ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        dbDelta( $ct_clients_query );

        require_once 'ct-data.php';

        ct\CTData::addCategory('General');
        
    }

    public static function deactivate()
    {
      return true;
    }

    public static function delete()
    {
        global $wpdb;

        $table_prefix = $wpdb->prefix;

        $ct_clients = $table_prefix.'ct_clients';

        $ct_clients_query = "DROP TABLE $ct_clients;";
        
        $wpdb->query($ct_clients_query);
    }
}

?>