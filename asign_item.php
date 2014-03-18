<html>
  <head>
  
  <?php require_once("classes/class.Items.php");?>
  <?php require_once("classes/class.Asignations.php");?>
    <meta charset=utf-8 />
   
    <link href="css/normalize.css" rel="stylesheet" type="text/css" />
    <link href="css/hover-min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/wp_inventory.css" />
  </head>
    
     <body>
    <div class="container">
    
      <?php
      		session_start(); 
      
	
	
      if ($_SESSION['login']){
      
      	$db	= new Items ();
	$item = $db -> recoverItemByID($_GET['id_item']);
	
	echo '<h3> Asign item</h3>';
	
	if (isset($_POST['asign'])){
	  $db	= new Asignations ();
	  $item = $db -> asignItemByID($_SESSION['login'], $_GET['id_item']);
	  
	  echo '<div class="success_msg">
	    <img src="images/locked.png" width="16px" height="16px"></img>  The item has been asigned to you successfully.
	  </div>
	  <a href="operaciones.php" target="frame_operaciones">Back</a>';
	}else{
	
	  echo '
	<p>You are going to take the item: </p>
	<p><b>'.$item[0]->id_item.' - '.$item[0]->name.'</b></p>
	<p>Are you sure do you want to take it?.</p>
	  <form id="asign_item" method="post" action="#">
	    <input type="hidden" name="id_item" value="'.$_GET['id_item'].'">
	    <input class = "button wobble-to-top-right" type="submit" id="asign" name="asign" value="Yes, asign to me">
	    <a href="operaciones.php" target="frame_operaciones">Back</a>
	  </form>';
	
	}
      }else{
		echo '<div class="error_msg">
				User not registered in the system.  Go to login window.
		       </div>';
      }
     ?>
  
    </div>
  </body>
</html>
