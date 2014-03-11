<?php
	class Items {
		private $database;

		function __construct(  ) {
		    global $wpdb, $table_prefix;
		    if(!isset($wpdb)){
		      require_once('../../../wp-config.php');
		      require_once('../../../wp-includes/wp-db.php');
		    }
		}

		function recoverItems (){
		    global $wpdb;
		    $query = "SELECT * FROM wp_inventory_item";
		    $items = $wpdb->get_results($query);
		    return ($items);
		}

		function insertItem ($name, $description, $manufacturer, $quantity, $serial, $id_uc3m){
		    global $wpdb;
		    $wpdb->insert('wp_inventory_item',  
		    array('name' => $name, 'description' => $description, 'manufacturer' => $manufacturer, 'quantity' => $quantity, 'serial' => $serial, 'id_uc3m' => $id_uc3m), 
		    array( '%s', '%s', '%s','%d', '%d','%d') );

		}	
		
		function deleteItem ($id_item){
		    global $wpdb;
		    $query ="DELETE FROM wp_inventory_item WHERE id_item =".$id_item;
		    echo $query;
		    $wpdb->query( $wpdb->prepare($query));
		}
	}

?>

