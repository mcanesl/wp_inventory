<html>
  <head>
  
  <?php require_once("classes/class.Items.php");?>
   <?php require_once("classes/class.Asignations.php");?>
    <meta charset=utf-8 />
   
    <link href="js/Datatables/media/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <link href="css/normalize.css" rel="stylesheet" type="text/css" />
    <script src="js/Datatables/media/js/jquery.js"></script>
    <script src="js/Datatables/media/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="css/wp_inventory.css" />
    
        
    <script>$(document).ready( function () {
      var table = $('#list_asignations_table').DataTable();
      });
    </script>
    
  </head>
    
     <body>
    <div class="container">
    
      <?php
      		session_start(); 
      
	
	
      if ($_SESSION['login']){
      
      	$db	= new Asignations();
	$asignations = $db -> recoverAsignationsByUser($_SESSION['login']);
	
	echo '<h3> User Profile</h3>
	<p>Your personal tab with your asignations.</p>
	    <table id="list_asignations_table" class="display" width="100%">
			<thead>
			  <tr>
			    <th>ID Asignation</th>
			    <th>User</th>
			    <th>Item</th>
			    <th>Asignation date</th>
			    <th>Give back</th>
			  </tr>
			</thead>
			<tbody>';
			
			foreach ($asignations as $key => $value) {
				    echo '
	
				<tr>
				  <td>'.$value->id_asignation.'</td>
				  <td>'.$value->user.'</td>
				  <td>'.$value->id_item.'</td>
				  <td>'.$value->asignation_date.'</td>
				  <td>
				      <a href="return_item.php?id_item='.$value->id_item.'", target="frame_operaciones"><img src="images/outgoing-2.png" width="16px" height="16px"></img></a>
				  </td>
				</tr>';
			}
			echo '	
			</tbody>
			</table>
	  ';
      }else{
		echo '<div class="error_msg">
				User not registered in the system.  Go to login window.
		       </div>';
      }
     ?>
  
    </div>
  </body>
</html>
