<HEAD>
<TITLE>Basic HTML Sample Page</TITLE>
</HEAD>

<BODY BGCOLOR="WHITE">

	<H1>A Simple Sample Web Page</H1>

	<?php
	
		require_once ( '../classes/class.InventoryAuth.php');
	
		//Estos valores deberian estar en la configuracion del wordpress:
		$userbind 	= 'uid = --login--, ou=People, dc=tsc, dc=uc3m,dc=es';
		$gtsuser	= 'cn=gts, ou=Group,DC=tsc,DC=uc3m,DC=es';
		$gtsadmin	= 'cn=gts, ou=Group,DC=tsc,DC=uc3m,DC=es';
		$server		= 'umbriel.tsc.uc3m.es';

		session_start(); 
	
		if ( $_POST ['login'] and $_POST ['passwd'] and ! $_SESSION['login']) {
			$ldap_c	= new InventoryAuth ( $server, $userbind, $gtsuser, $gtsadmin );
			$r = $ldap_c -> userInGroup ( $_POST ['login'], $_POST ['passwd'], $gtsuser );	
			if ( $r  > 0) {
				$_SESSION['login'] = $_POST ['login'];
				#header ("Location: mostrar.php");

			} else {
				$error = true;
			}
			
			$r = $ldap_c -> userInGroup ( $_POST ['login'], $_POST ['passwd'], $gtsadmin );	
			$r = $ldap_c -> userInGroup ( $_POST ['login'], $_POST ['passwd'], $gtsadmin );	
			if ( $r  > 0) {
				$_SESSION['admin'] =  true;
			}
			header ("Location: login.php");  

		}
		
		
		if ( $error ) {
			echo 'Usuario incorrecto';
		}
		
		if ( $_SESSION['login'] ) {
			echo '
				<iframe src="mostrar.php" seamless></iframe>
			      ';

		} else {
			echo '
				<form method="post"
					      enctype="application/x-www-form-urlencoded"
					      action="#">
					 <p><label>login: <input name=login required></label></p>
			 		 <p><label>passwd: <input name= passwd required type=password></label></p>
			 		  <p><button>Go !!!!</button></p>
				</form>';
		}
	
	?>




</BODY>
