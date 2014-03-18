<html>
<head>
    <link rel="stylesheet" href="css/wp_inventory.css" />
    <link rel="stylesheet" href="css/toolbar.css" />
    <link rel="stylesheet" href="css/hover-min.css " />
    <script src="js/jquery/jquery-2.1.0.min.js"></script>



</head>
 
<body>

	<?php
		session_start(); 
		if ( $_SESSION['login'] and (! isset ($_GET ['exit']) )) {
				 
			echo '
				<nav id="toolbar_button">
					<a href="user_asignations.php" target="frame_operaciones" class="button hollow"><b><img src="images/user-4.png" width="24px" height="24px" title="User asignations"></img></b></a>
					<a href="operaciones.php" target="frame_operaciones" class="button hollow"><b><img src="images/list.png" width="24px" height="24px" title="General lists"></img></b></a>';
					
					if ($_SESSION['admin']){
					  echo '<a href="new_item.php" target="frame_operaciones" class="button hollow"><b><img src="images/compose-3.png" width="24px" height="24px" title="Add new item"></img></b></a>';
					}
					echo '
					<a href="about.php" target="frame_operaciones"><p class="button hollow"><b><img src="images/info.png" width="24px" height="24px" title="About"></img></b></p></a>
					<a href="exit.php" target="frame_operaciones" class="button hollow"><b><img src="images/out.png" width="24px" height="24px" title="Exit"></img></b></a>
					<p id="msgstatus">login as <b>'. $_SESSION['login'] .'	</b></p>
				 </nav>';
				 
			echo '
				<iframe id="frame_operaciones" name="frame_operaciones" src="operaciones.php" seamless></iframe>';
				 							
		}else {

			echo '<div class="error_msg">
					User not registered in the system.  Go to login window.
			       </div>';
		}
		

	?>
</body>
</html>


