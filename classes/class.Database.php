<?php
	class Database {
	
		function __construct() {
		}
		
		
		function createInitialDatabase(){
		  global $wpdb;
		  $query_item = "CREATE TABLE IF NOT EXISTS wp_inventory_item (
		    id_item INTEGER NOT NULL AUTO_INCREMENT,
		    name VARCHAR(15) NOT NULL,
		    description VARCHAR(50) NOT NULL,
		    manufacturer VARCHAR(15) NOT NULL,
		    quantity INTEGER NOT NULL,
		    serial INTEGER NOT NULL,
		    id_uc3m INTEGER NOT NULL,
		    PRIMARY KEY (id_item)
		  )";
		  
		  $query_user = "CREATE TABLE IF NOT EXISTS wp_inventory_user (
		    user VARCHAR(15) NOT NULL,
		    name VARCHAR(15) NOT NULL,
		    surname VARCHAR(15) NOT NULL,
		    email VARCHAR(20) NOT NULL,
		    office VARCHAR(15) NOT NULL,
		    telephone VARCHAR(15) NOT NULL,
		    PRIMARY KEY (user)
		  )";
		  
		  $query_asignation = "CREATE TABLE IF NOT EXISTS wp_inventory_asignation (
		    id_asignation INTEGER NOT NULL AUTO_INCREMENT,
		    user VARCHAR(15) NOT NULL,
		    id_item INTEGER NOT NULL,
		    asignation_date DATE NOT NULL,
		    expiry_date DATE NOT NULL,
		    PRIMARY KEY(id_asignation),
		    FOREIGN KEY (user) REFERENCES wp_inventory_user(user),
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

