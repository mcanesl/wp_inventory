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
		    if ($wpdb->insert('wp_inventory_asignation',  
		    array('user' => $user, 'id_item' => $id_item), 
		    array( '%s', '%d', '%d','%d') ) ===FALSE){
			return -1;
			}
		}
		
		function returnItemByID ($id_asignation, $date){
		    global $wpdb;
		    $query = "UPDATE wp_inventory_asignation SET expiry_date = '".$date."' WHERE id_asignation = ".$id_asignation;
		    if ($wpdb->query($query) ===FALSE){
			return -1;
			}
		}
		
		function recoverAsignationsByItem  ($item) {
		    global $wpdb;
		    $query = "SELECT * FROM wp_inventory_asignation WHERE id_item = '" .$item. "' ORDER BY asignation_date DESC LIMIT 40";
		    $asignations = $wpdb->get_results($query);
		    return ($asignations);
		
		}
		
		function recoverCurrentAsignationsByUser ($user){
		    global $wpdb;
		    $query = "SELECT * FROM wp_inventory_asignation WHERE user = '" .$user. "' AND expiry_date = '0000-00-00 00:00:00'";
		    $asignations = $wpdb->get_results($query);
		    return ($asignations);
		}
		
		function recoverClosedAsignationsByUser ($user){
		    global $wpdb;
		    $query = "SELECT * FROM wp_inventory_asignation WHERE user = '" .$user. "' AND expiry_date != '0000-00-00 00:00:00' ORDER BY expiry_date DESC LIMIT 40";
		    $asignations = $wpdb->get_results($query);
		    return ($asignations);
		}
	}

?>

