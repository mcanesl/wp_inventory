<html>
<head>
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/wp_inventory.css" />
    <link rel="stylesheet" href="css/toolbar.css" />
    <link rel="stylesheet" href="css/hover-min.css " />
    <script src="js/jquery/jquery-2.1.0.min.js"></script>



</head>
 
<body>

	<?php
		session_start(); 
		if ( $_SESSION['login'] and (! isset ($_GET ['exit']) )) {
			/*echo '
				<div id="toolbar">
					<nav>
						  <ul>
						    <li class="active"><a href="#dialog_new_item" name="modal"><img src="images/add.png" width="55" alt="new item"></img></a></li>
						    <li><img src="images/delete.png" width="55" alt="delete item"><a href="#"></a></img></li>
						    <li><img src="images/about.png" width="55" alt="info"><a href="#"></a></img></li>
						    <li><a alt="exit" href="?exit=true"><img src="images/exit.png" width="55" alt="exit"></img></a></li>
						    <li class="status">login as <b>'. $_SESSION['login'] .'	</b></li>
						  </ul>
						  
					</nav>				
				 </div>';*/
				 
			echo '
				<nav id="toolbar_button">
					<a href="operaciones.php" target="frame_operaciones" class="button hollow"><b>list</b></a>
					<a href="new_item.php" target="frame_operaciones" class="button hollow"><b>new</b></a>
					<a href="about.php" target="frame_operaciones"><p class="button hollow"><b>about</b></p></a>
					<a href="exit.php" target="frame_operaciones" class="button hollow"><b>exit()</b></a>
					<p id="msgstatus">login as <b>'. $_SESSION['login'] .'	</b></p>
				 </nav>';
				 
			echo '
				<iframe id="frame_operaciones" name="frame_operaciones" src="operaciones.php" seamless></iframe>';
				 							
		}else {

			echo '<div class="error_msg">
					User not registered in the system.  Go to login window.
			       </div>';
		}
/*		if ( isset ( $_GET ['exit']) ) {
			require_once('../../../wp-config.php');
			require_once('../../../wp-includes/wp-db.php');
			session_destroy();			
			//header ("Location: " . network_home_url() );			
		}*/
		

	?>
</body>
</html>


