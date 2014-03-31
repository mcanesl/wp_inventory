<html>
<head>
    <link rel="stylesheet" href="css/wp_inventory.css" />
    <link rel="stylesheet" href="css/hover-min.css " />
    <style type="text/css">
	  body {background-color:#f6f6f6;}
    </style> 
</head>
 
<body>

	<?php
		require_once('../../../wp-config.php');
		require_once('../../../wp-includes/wp-db.php');
		session_start();
		if ( isset ($_GET ['exit'])) {
			require_once('../../../wp-config.php');
			require_once('../../../wp-includes/wp-db.php');
			session_destroy();
			header ("Location: " . network_home_url() );			
			
		} 
		if ( $_SESSION['login']) {
			$home = network_home_url() ;
			echo '
				<div id="exit">
					<img src="images/nyam-cat_grey.png" width="440px"></img>				
					<div id="msg_exit"> Are you sure you want to quit? </div>
				</div>

				<div id="msg_confirm">
					     <a  class = "button wobble-to-top-right" href="?exit=true"target="_top">Yes, i\'m sure</a>

				</div>

				
			';
		}else {
			echo '<div class="error_msg">
					User not registered in the system.  Go to login window.
			       </div>';		
		}
	?>
</body>
</html>
