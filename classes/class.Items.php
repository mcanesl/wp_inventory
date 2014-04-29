<?php
require_once( dirname ( dirname ( dirname ( dirname ( dirname(__FILE__) ) ) ) ) . '/wp-config.php');
require_once( dirname ( dirname ( dirname ( dirname ( dirname(__FILE__) ) ) ) ) .  '/wp-includes/wp-db.php');


	class Items {
		private $database;
		function __construct(  ) {
		
		    global $wpdb, $table_prefix;
		    /*if(!isset($wpdb)){
		      require_once('../../../wp-config.php');
		      require_once('../../../wp-includes/wp-db.php');
		    }*/
		}

		function recoverItems (){
		    global $wpdb;
		    $query = "SELECT * FROM wp_inventory_item";
		    $items = $wpdb->get_results($query);
		    return ($items);
		}
		
		function recoverManufacturers (){
		    global $wpdb;
		    $query = "SELECT DISTINCT manufacturer FROM wp_inventory_item";
		    $manufacturers = $wpdb->get_results($query);
		    return ($manufacturers);
		}
		
		function recoverItemByID ($id_item){
		    global $wpdb;
		    $query = "SELECT * FROM wp_inventory_item WHERE id_item = ".$id_item;
		    $item = $wpdb->get_results($query);
		    return ($item);
		}

		function insertItem ($name, $description, $manufacturer, $quantity, $serial, $id_uc3m, $attendant, $location, $image, $issues){
		    global $wpdb;
		    $available = $quantity;
		    $name = stripslashes(utf8_encode($name));
		    $description = stripslashes(utf8_encode($description));
		    $manufacturer = stripslashes(utf8_encode($manufacturer));
		    $attendant = stripslashes(utf8_encode($attendant));
		    $serial = stripslashes(utf8_encode($serial));
		    $id_uc3m = stripslashes(utf8_encode($id_uc3m));
		    $location = stripslashes(utf8_encode($location));
		    $issues = stripslashes(utf8_encode($issues));
		    if ($wpdb->insert('wp_inventory_item',  
		    array('name' => $name, 'description' => $description, 'manufacturer' => $manufacturer, 'quantity' => $quantity, 'available' => $available, 'serial' => $serial, 'id_uc3m' => $id_uc3m, 'attendant' => $attendant, 'location' => $location, 'image' => $image, 'issues' => $issues), 
		    array( '%s', '%s', '%s','%d', '%s','%s', '%s', '%s' , '%s' , '%s', '%s') ) ===FALSE){
			return -1;
			}
		}	
		
		function deleteItemByID ($id_item){
		    global $wpdb;
		    $query ="DELETE FROM wp_inventory_item WHERE id_item =".$id_item;
		    if ($wpdb->query($query)===FALSE){
				return -1;
			}
		}
		
		function updateAvailableQuantityByID ($id_item, $available){
		    global $wpdb;
		    $query = "UPDATE wp_inventory_item SET available = " .$available. " WHERE id_item = ".$id_item;
		    if ($wpdb->query($query) ===FALSE){	
				return -1;
			}
		}
		
		function updateItemByID ($id_item, $name, $description, $manufacturer, $quantity, $available, $serial, $id_uc3m, $attendant, $location, $image, $issues){
		    global $wpdb;	    
		    $name = stripslashes(utf8_encode($name));
		    $description = stripslashes(utf8_encode($description));
		    $manufacturer = stripslashes(utf8_encode($manufacturer));
		    $attendant = stripslashes(utf8_encode($attendant));
		    $serial = stripslashes(utf8_encode($serial));
		    $id_uc3m = stripslashes(utf8_encode($id_uc3m));
		    $location = stripslashes(utf8_encode($location));
		    $issues = stripslashes(utf8_encode($issues));
		    $query = "UPDATE wp_inventory_item SET name = '" . $name . "',  description = '" . $description . "', manufacturer = '" . $manufacturer . "', quantity = " . $quantity . ", available = " . $available . ",  serial = '" . $serial . "', id_uc3m = '" . $id_uc3m . "', attendant = '" . $attendant . "' , location = '" . $location . "', image = '" . $image . "' , issues = '" . $issues . "' WHERE id_item = " .$id_item;
		    if ($wpdb->query($query)===FALSE){
			return -1;
			}
		}
	}
?>
