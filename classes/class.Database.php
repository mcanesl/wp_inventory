<?php
	class Database {
	
		function __construct() {
			global $wpdb;
			$wpdb->query("ALTER DATABASE " .$wpdb->dbname. " CHARACTER SET utf8");
		}
		
		
		function createInitialDatabase(){
		  global $wpdb;
		  
		  $prefix = $wpdb->prefix;
		  
		  $query_item = 'CREATE TABLE IF NOT EXISTS ' . $prefix . 'inventory_item (
		    id_item INTEGER NOT NULL AUTO_INCREMENT,
		    name VARCHAR(50) NOT NULL,
		    description VARCHAR(200),
		    manufacturer VARCHAR(50) NOT NULL,
		    quantity INTEGER NOT NULL,
		    available INTEGER,
		    serial VARCHAR(25),
		    id_uc3m VARCHAR(25),
		    attendant VARCHAR(50),
		    location VARCHAR(50),
		    image MEDIUMBLOB,
		    issues VARCHAR(200),
		    PRIMARY KEY (id_item)
		  )';
		  
		  
		  $query_asignation = 'CREATE TABLE IF NOT EXISTS ' . $prefix . 'inventory_asignation (
		    id_asignation INTEGER NOT NULL AUTO_INCREMENT,
		    user VARCHAR(15) NOT NULL,
		    id_item INTEGER NOT NULL,
		    asignation_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
		    expiry_date TIMESTAMP,
		    PRIMARY KEY(id_asignation),
		    FOREIGN KEY (id_item) REFERENCES ' . $prefix . 'inventory_item(id_item)
		  )';
		  

		$query_asignation_item = 'CREATE VIEW ' . $prefix . 'inventory_asignation_user AS (select id_asignation, ' . $prefix . 'inventory_asignation.id_item, name, user,DATE_FORMAT (asignation_date,\'%d/%m/%Y\') AS asignation_date, DATE_FORMAT ( expiry_date,\'%d/%m/%Y\') AS expiry_date  from ' . $prefix . 'inventory_asignation, ' . $prefix . 'inventory_item  where ' . $prefix . 'inventory_item.id_item = ' . $prefix . 'inventory_asignation.id_item)';
		  
		  
		  $wpdb->query($query_item);
		  //$wpdb->query($query_user);
		  $wpdb->query($query_asignation);
  		  $wpdb->query($query_asignation_item);
			
		}
		
		function dropDatabase (){
		  global $wpdb;
		  
		  $query_item = "DROP TABLE IF EXISTS ' . $prefix . 'inventory_item";
		  $query_user = "DROP TABLE IF EXISTS ' . $prefix . 'inventory_user";
		  $query_asignation = "DROP TABLE IF EXISTS ' . $prefix . 'inventory_asignation";
		  
		  $wpdb->query($query_asignation);
		  $wpdb->query($query_item);
		  $wpdb->query($query_user);
		  
		}
	}
?>
