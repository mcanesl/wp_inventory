<html>
  <head>
  
  <?php require_once("classes/class.Items.php");?>
    <meta charset=utf-8 />
    
    <link href="js/Datatables/media/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <link href="css/normalize.css" rel="stylesheet" type="text/css" />
    <script src="js/Datatables/media/js/jquery.js"></script>
    <script src="js/Datatables/media/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="css/wp_inventory.css" />
    
    
    <script>$(document).ready( function () {
      var table = $('#list_items_table').DataTable({'iDisplayLength': 10});
      });
    </script>
    
  </head>
    
     <body>
    <div class="list_container">
    
      <?php
      		session_start(); 
      
	
	
      if ($_SESSION['login']){
	     
	$db	= new Items ();
	$items = $db -> recoverItems();
	if ($items != null){	
		      echo '
		      <table id="list_items_table" class="display" width="100%">
			<thead>
			  <tr>
			    <th>ID Item</th>
			    <th>Name</th>
			    <th>Description</th>
			    <th>Manufacturer</th>
			    <th>Quantity</th>
			    <th>Operations</th>
			  </tr>
			</thead>
			<tbody>';
	
				foreach ($items as $key => $value) {
				    echo '
					  <tr>
						    <td>'.$value->id_item.'</td>
						    <td>'.$value->name.'</td>
						    <td>'.$value->description.'</td>
						    <td>'.$value->manufacturer.'</td>
						    <td>'.$value->quantity.'</td>
						    <td>
							<a href="item_details.php?id_item='.$value->id_item.'", target="frame_operaciones"><img src="images/zoom-in-2.png" width="16px" height="16px"></img></a>';
						    	
						    	if ($_SESSION['admin']){
							  echo '<a href="edit_item.php?id_item='.$value->id_item.'", target="frame_operaciones"><img src="images/pencil.png" width="16px" height="16px"></img></a>
							  <a href="delete_item.php?id_item='.$value->id_item.'", target="frame_operaciones"><img src="images/bin-3.png" width="16px" height="16px"></img></a>';
							}
							
							echo '
							<a href="asign_item.php?id_item='.$value->id_item.'", target="frame_operaciones"><img src="images/locked.png" width="16px" height="16px"></img></a>
						    </td>
					  </tr>';
				}
			 echo '
				</tbody>
			  </table>';
	}else{
			echo '<div class="error_msg">
					No items found... <b>Use the menu to insert new one.</b>
			       </div>';
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
