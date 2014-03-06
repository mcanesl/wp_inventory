<?php


	class InventoryAuth {
	
		private $server;
		private $bind;
		private $group;
		private $groupadmin;
		private $ds;
	
	
		//user bind is something like uid = --login--, ou=People, dc=tsc, dc=uc3m,dc=es
		//replace --login-- with de real login when connect:
		function __construct( $server, $bind, $group, $groupadmin ) {
			$this -> server 	= $server;
			$this -> bind 		= $bind;
			$this -> group 		= $group;
			$this -> groupadmin 	= $groupadmin;
		}
		
		
	
		
		function connect ( $login, $passwd ) {
			
			if(!function_exists('ldap_connect')) {
				echo 'Function ldap_connect not found. Try install php5_ldapmodule. Maybe: yum install php-ldap';
				exit ();
			}
			
			$this -> ds 	= ldap_connect( $this -> server ) or die("Could not connect to {$this -> server}");


			$userbind = str_replace ( '--login--', $login, $this -> bind );		

			
			$login = ldap_bind( $this -> ds, $userbind, $passwd );			
		
			return $login;

		}
		

		function userInGroup ( $login, $passwd, $group ) {

			$salida = -1;
			if ( $this -> connect ( $login, $passwd ) ) {
				$sr=ldap_search($this -> ds,$group, "memberuid=$login");
				$salida =  ldap_count_entries($this -> ds,$sr) ;
			}
			//-1 not valid user (passwd, login)
			// 0 not in group
			// > 0 user in group
			return $salida;
		
		}	



	}

?>

