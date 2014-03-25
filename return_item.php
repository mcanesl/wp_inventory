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
      
      	$db_i	= new Items ();
	$item = $db_i -> recoverItemByID($_GET['id_item']);
	
	echo '<h3> Return Item</h3>';
	
	if (isset($_POST['return'])){
	
	  $date = date("Y-m-d H:i:s",time());
	  print $date;
	  $db_a	= new Asignations ();
	  $return = $db_a -> returnItemByID($_GET['id_asignation'], $date);

	if ($return == -1){
		echo '<div class="error_msg">
		Sorry, an error occurs. Please, check the information given.
		</div>
	    	<a href="operaciones.php" target="frame_operaciones"><img src="images/back.png" width="16px" height="16px"></img> Back</a>';
	}else{
		  
		  $new_available = $item[0]->available + 1;
		  
		  $update = $db_i -> updateAvailableQuantityByID ($_GET['id_item'], $new_available);

		if ($update == -1){
				echo '<div class="error_msg">
				Sorry, an error occurs. Please, check the information given.
				</div>
	    			<a href="operaciones.php" target="frame_operaciones"><img src="images/back.png" width="16px" height="16px"></img> Back</a>';
			}else{
				  echo '<div class="success_msg">
				    <img src="images/outgoing-2.png" width="16px" height="16px"></img>  The item has been returned successfully.
				  </div>
	    			<a href="operaciones.php" target="frame_operaciones"><img src="images/back.png" width="16px" height="16px"></img> Back</a>';
			}
		}
	}else{
	
	  echo '
	<p>You are going to return the item: </p>
	<p><b>'.$item[0]->id_item.' - '.$item[0]->name.'</b></p>
	<p>Are you sure do you want to return it?.</p>
	  <form id="return_item" method="post" action="#">
	    <input type="hidden" name="id_asignation" value="'.$_GET['id_asignation'].'">
	    <input type="hidden" name="id_item" value="'.$_GET['id_item'].'">
	    <input class = "button wobble-to-top-right" type="submit" id="return" name="return" value="Yes, return">
	    <a href="operaciones.php" target="frame_operaciones"><img src="images/back.png" width="16px" height="16px"></img> Back</a>
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
