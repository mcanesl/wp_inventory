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
		require_once('../../../wp-config.php');
		require_once('../../../wp-includes/wp-db.php');
		session_destroy();
		echo '<div class="error_msg">Session closed successfully.</div>';
	?>
</body>
</html>
