<?php
	class Database {
	
		function __construct() {
		}
		
		
		function createInitialDatabase(){
		  global $wpdb;
		  $query_item = "CREATE TABLE IF NOT EXISTS wp_inventory_item (
		    id_item INTEGER NOT NULL AUTO_INCREMENT,
		    name VARCHAR(15) NOT NULL,
		    description VARCHAR(50),
		    manufacturer VARCHAR(15) NOT NULL,
		    quantity INTEGER NOT NULL,
		    available INTEGER,
		    serial INTEGER,
		    id_uc3m INTEGER,
		    image MEDIUMBLOB,
		    issues VARCHAR(50),
		    PRIMARY KEY (id_item)
		  )";
		  
		  $query_asignation = "CREATE TABLE IF NOT EXISTS wp_inventory_asignation (
		    id_asignation INTEGER NOT NULL AUTO_INCREMENT,
		    user VARCHAR(15) NOT NULL,
		    id_item INTEGER NOT NULL,
		    asignation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
		    expiry_date TIMESTAMP,
		    PRIMARY KEY(id_asignation),
		    FOREIGN KEY (id_item) REFERENCES wp_inventory_item(id_item)
		  )";
		  
		  $wpdb->query($query_item);
		  $wpdb->query($query_user);
		  $wpdb->query($query_asignation);
			
		}
		
		function dropDatabase (){
		  global $wpdb;
		  
		  $query_item = "DROP TABLE IF EXISTS wp_inventory_item";
		  $query_user = "DROP TABLE IF EXISTS wp_inventory_user";
		  $query_asignation = "DROP TABLE IF EXISTS wp_inventory_asignation";
		  
		  $wpdb->query($query_asignation);
		  $wpdb->query($query_item);
		  $wpdb->query($query_user);
		  
		}
	}

?>

