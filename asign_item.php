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
	
	echo '<h3> Assign item</h3>';
	
	if (isset($_POST['asign'])){
	
	  if ($item[0]->available <=0){
	    echo '<div class="error_msg">
	      Sorry, there is no available item units.
	    </div>
	    <a href="lists.php" target="operations_frame2"><img src="images/back.png" width="16px" height="16px"></img> Back</a>';
	  }else{
	    $db_a	= new Asignations ();
	    $asignation = $db_a -> asignItemByID($_SESSION['login'], $_GET['id_item']);

		if ($asignation == -1){
			echo '<div class="error_msg">
	    		Sorry, an error occurs. Please, check the information given.
	  		</div>
	  		<a href="lists.php" target="operations_frame2"><img src="images/back.png" width="16px" height="16px"></img> Back</a>';
		}else{
	    
		    $newAvailable = ($item[0]->available) - 1;
		    $update = $db_i -> updateAvailableQuantityByID($item[0]->id_item, $newAvailable);

			if ($update == -1){
				echo '<div class="error_msg">
		    		Sorry, an error occurs. Please, check the information given.
		  		</div>
		  		<a href="lists.php" target="operations_frame2"><img src="images/back.png" width="16px" height="16px"></img> Back</a>';
			}else{
				 echo '<div class="success_msg">
				      <img src="images/locked.png" width="16px" height="16px"></img>  The item has been assigned to you successfully.
				    </div>
				    <a href="lists.php" target="operations_frame2"><img src="images/back.png" width="16px" height="16px"></img> Back</a>';
			}
		}
	}
	}else{
	
	  echo '
	<p>You are going to take the item: </p>
	<p><b>'.$item[0]->id_item.' - '.stripslashes(utf8_decode($item[0]->name)).'</b></p>
	<p>Are you sure do you want to take it?.</p>
	  <form id="asign_item" method="post" action="#">
	    <input type="hidden" name="id_item" value="'.$_GET['id_item'].'">
	    <input class = "button wobble-to-top-right" type="submit" id="asign" name="asign" value="Yes, assign to me">
	    <a href="lists.php" target="operations_frame2"><img src="images/back.png" width="16px" height="16px"></img> Back</a>
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
