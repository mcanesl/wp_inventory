<?php


	class Items {
	
		private $database;
		
		function __construct(  ) {
		
		  global $wpdb, $table_prefix;

		      if(!isset($wpdb))
			{
			  require_once('../../../wp-config.php');
			  require_once('../../../wp-includes/wp-db.php');
			}
		}
		
		function recoverItems (){
		global		$wpdb;
		  $query = "SELECT * FROM wp_inventory_item";
		  $items = $wpdb->query($query);
		  print_r ($items);
		}
		
	}

?>

