<html>
  <head>
  
  <?php require_once("classes/class.Items.php");?>
    <meta charset=utf-8 />
   
    <link href="css/normalize.css" rel="stylesheet" type="text/css" />
    <link href="css/hover-min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/wp_inventory.css" />
  </head>
    
     <body>
    <div class="container">
    
      <?php
      		session_start(); 
      
	
	
      if ($_SESSION['admin']){
      
      	$db	= new Items ();
	$item = $db -> recoverItemByID($_GET['id_item']);
	
	echo '<h3> Delete item</h3>';
	
	if (isset($_POST['delete'])){
	  $db	= new Items ();
	  $deletion = $db -> deleteItemByID($_GET['id_item']);
		if ($deletion==-1){
			echo '<div class="error_msg">
	    		An error occurs. The item has not been deleted. Check if there are asignations related to this item.
	  		</div>
	    		<a href="lists.php" target="operations_frame"><img src="images/back.png" width="16px" height="16px"></img> Back</a>';
		}else{
			echo '<div class="success_msg">
	    		<img src="images/bin-3.png" width="16px" height="16px"></img>  The item has been deleted successfully.
	  		</div>
	  		<a href="lists.php" target="operations_frame"><img src="images/back.png" width="16px" height="16px"></img> Back</a>';
		}
	}else{
	
	  echo '
	<p>You are going to delete the item: </p>
	<p><b>'.$item[0]->id_item.' - '.$item[0]->name.'</b></p>
	<p>Are you sure do you want to delete it?.</p>
	  <form id="delete_item" method="post" action="#">
	    <input type="hidden" name="id_item" value="'.$_GET['id_item'].'">
	    <input class = "button wobble-to-top-right" type="submit" id="delete" name="delete" value="Yes, delete">
	    <a href="lists.php" target="operations_frame"><img src="images/back.png" width="16px" height="16px"></img> Back</a>
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
