<html>
  <head>
  
  <?php 
  	require_once("classes/class.Items.php");
	require_once("classes/class.Asignations.php");
  	
  ?>
    <meta charset=utf-8 />
    <link href="js/Datatables/media/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <link href="css/normalize.css" rel="stylesheet" type="text/css" />
    <script src="js/Datatables/media/js/jquery.js"></script>
    <script src="js/Datatables/media/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="css/wp_inventory.css" />
    
    <script>$(document).ready( function () {
      var table = $('.list_items_table').DataTable();
      });
    </script>
  </head>
    
     <body>
    <div class="container">
    
      <?php
      		session_start(); 
      
	
	
      if ($_SESSION['login']){
      
      	$db	= new Items ();
	$item = $db -> recoverItemByID($_GET['id_item']);
	
	$fp = fopen('/tmp/img.64', 'w');
	fwrite($fp, $item[0]->image );
	fclose($fp);
	
      	$asig			= new Asignations();
	$item_asignations 	= $asig -> recoverAsignationsByItem (  $item[0]->id_item );

	

	echo '<h3> Item details</h3>
	<p>Details about selected item.
	<a id="link_right" href="lists.php" target="operations_frame2"><img src="images/back.png" width="16px" height="16px"></img> Back</a></p>
	 <table id = "details_table">
	      <tr>
		<td id="td_dark" style="width: 200px"><p><b>ID Item</b></p></td>
		<td id="td_medium">'.$item[0]->id_item.'</td>
	      </tr>
	      <tr>
		<td id="td_medium"><p><b>Item name</b></p></td>
		<td>'.stripslashes(utf8_decode($item[0]->name)).'</td>
	      </tr>
	      <tr>
		<td id="td_dark"><p><b>Manufacturer</b></p></td>
		<td id="td_medium">'.stripslashes(utf8_decode($item[0]->manufacturer)).'</td>
	      </tr>
	      <tr>
		<td id="td_medium"><p><b>Quantity</b></p></td>
		<td>'.$item[0]->quantity.' pieces</td>
	      </tr>
	      <tr>
		<td id="td_dark"><p><b>Available</b></p></td>
		<td id="td_medium">'.$item[0]->available.' pieces</td>
	      </tr>
	      <tr>
		<td id="td_medium"><p><b>Serial</b></p></td>
		<td>'.stripslashes(utf8_decode($item[0]->serial)).'</td>
	      </tr>
	      <tr>
		<td id="td_dark"><p><b>Inventory number</b></p></td>
		<td id="td_medium">'.stripslashes(utf8_decode($item[0]->id_uc3m)).'</td>
	      </tr>
	      <tr>
		<td id="td_medium"><p><b>Attendant</b></p></td>
		<td>'.stripslashes(utf8_decode($item[0]->attendant)).'</td>
	      </tr>
	      <tr>
		<td id="td_dark"><p><b>Location</b></p></td>
		<td id="td_medium">'.stripslashes(utf8_decode($item[0]->location)).'</td>
	      </tr>
	      <tr>
		<td id="td_medium"><p><b>Description</b></p></td>
		<td>'.stripslashes(utf8_decode($item[0]->description)).'</td>
	      </tr>
	      <tr>
		<td id="td_dark"><p><b>Issues</b></p></td>
		<td id="td_medium">'.stripslashes(utf8_decode($item[0]->issues)).'</td>
	      </tr>
	      <tr>
		<td colspan="2" id="td_image">'; if ($item[0]->image){
				echo '<div> <img src="get_image.php" width="150px" height="150px" style="margin-top: 30px"></img> </div>';
			}else{
				echo '<div> <img src="images/image.png" width="150px" height="150px" style="margin-top: 30px"></img> </div>';
			}
		echo '</td>
	      </tr>
	    </table>
	  
	  <p style="border: 1px solid black"></p>
	  
	    <p><img src="images/book-lines.png"> Assignations history.</p>
	    
	    <table class="list_items_table" class="display" width="100%">
			<thead>
			  <tr>
			    <th id="th_short">ID</th>
			    <th>User</th>
			    <th>Item</th>
			    <th>Assignation date</th>
			    <th>Devolution date</th>
			  </tr>
			</thead>
			<tbody>';
	
				foreach ($item_asignations as $value ) {
					$db_i = new Items();
				    $item = $db_i -> recoverItemByID($value->id_item);
				    echo '
					  <tr>
						  <td>'.$value->id_asignation.'</td>
						  <td>'.$value->user.'</td>
						  <td>'.$item[0]->name.'</td>
						  <td>'.$value->asignation_date.'</td>
						  <td>'.$value->expiry_date.'</td>
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
