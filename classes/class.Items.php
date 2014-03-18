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
		
		function recoverItemByID ($id_item){
		    global $wpdb;
		    $query = "SELECT * FROM wp_inventory_item WHERE id_item = ".$id_item;
		    $item = $wpdb->get_results($query);
		    return ($item);
		}

		function insertItem ($name, $description, $manufacturer, $quantity, $serial, $id_uc3m, $image){
		    global $wpdb;
		    $available = $quantity;
		    $wpdb->insert('wp_inventory_item',  
		    array('name' => $name, 'description' => $description, 'manufacturer' => $manufacturer, 'quantity' => $quantity, 'available' => $available, 'serial' => $serial, 'id_uc3m' => $id_uc3m, 'image' => $image), 
		    array( '%s', '%s', '%s','%d', '%d','%d', '%d', '%s') );
		}	
		
		function deleteItemByID ($id_item){
		    global $wpdb;
		    $query ="DELETE FROM wp_inventory_item WHERE id_item =".$id_item;
		    $wpdb->query($query);
		}
		
		function updateItemByID ($id_item, $name, $description, $manufacturer, $quantity, $serial, $id_uc3m, $image){
		    global $wpdb;
		    $query = "UPDATE wp_inventory_item SET";
		    
		    if ($name !=null){
		      $query = $query . " name = '" . $name . "'"; 
		    }
		    
		    if ($description != null){
		      $query = $query . ", description = '" . $description . "'"; 
		    }
		    
		    if ($manufacturer != null){
		      $query = $query . ", manufacturer = '" . $manufacturer . "'"; 
		    }
		    
		    if ($quantity != null){
		      $query = $query . ", quantity = " . $quantity; 
		    }
		    if ($serial != null){
		      $query = $query . ", serial = " . $serial; 
		    }
		    
		    if ($id_uc3m != null){
		      $query = $query . ", id_uc3m = " . $id_uc3m; 
		    }
		    
		    if ($image != null){
		      $query = $query . ", image = '" . $image . "'"; 
		    }
		    
		    $query = $query . " WHERE id_item = " .$id_item;
		    
		    $wpdb->query( $wpdb->prepare($query));
		}
	}

?>

