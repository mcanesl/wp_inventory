<?php


	class Users {
	
		private $database;
		
		function __construct(  ) {
		
		  global $wpdb, $table_prefix;

		      if(!isset($wpdb))
			{
			  require_once('../../../wp-config.php');
			  require_once('../../../wp-includes/wp-db.php');
			}
		}
		
		function recoverUsers (){
		  global		$wpdb;
		  $query = "SELECT * FROM wp_inventory_user";
		  $users = $wpdb->get_results($query);
		  return ($users);
		}
		
	}

?>