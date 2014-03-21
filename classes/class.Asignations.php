<?php
	class Asignations {
		private $database;

		function __construct(  ) {
		    global $wpdb, $table_prefix;
		    if(!isset($wpdb)){
		      require_once('../../../wp-config.php');
		      require_once('../../../wp-includes/wp-db.php');
		    }
		}
		
		function asignItemByID ($user, $id_item){
		    global $wpdb;
		    $wpdb->insert('wp_inventory_asignation',  
		    array('user' => $user, 'id_item' => $id_item), 
		    array( '%s', '%d', '%d','%d') );
		}
		
		function returnItemByID ($user, $id_item){
		    global $wpdb;
		    $query = "DELETE FROM wp_inventory_asignation WHERE user = '" .$user. "' AND id_item = ".$id_item;
		    $wpdb->query($query);
		}
		
		function recoverAsignationsByItem  ($item) {
		    global $wpdb;
		    $query = "SELECT * FROM wp_inventory_asignation WHERE id_item = '" .$item. "'";
		    $asignations = $wpdb->get_results($query);
		    return ($asignations);
		
		}
		
		function recoverAsignationsByUser ($user){
		    global $wpdb;
		    $query = "SELECT * FROM wp_inventory_asignation WHERE user = '" .$user. "'";
		    $asignations = $wpdb->get_results($query);
		    return ($asignations);
		}
	}

?>

