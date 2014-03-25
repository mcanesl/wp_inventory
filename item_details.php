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
	<p>Details about selected item.</p>
	<table id="item_table">
	<tr>
	  <td>';
		if ($item[0]->image){
			echo '<div> <img src="get_image.php" width="180px" height="180px"></img> </div>';
		}else{
			echo '<div> <img src="images/image.png" width="180px" height="180px"></img> </div>';
		}

		echo'
	  </td>
	  <td>
	  <table id = "details_table">
	      <tr>
		<td><p><b>Item ID</b></p></td>
		<td>'.$item[0]->id_item.'</td>
	      </tr>
	      <tr>
		<td><p><b>Item name</b></p></td>
		<td>'.$item[0]->name.'</td>
	      </tr>
	      <tr>
		<td><p><b>Description</b></p></td>
		<td>'.$item[0]->description.'</td>
	      </tr>
	      <tr>
		<td><p><b>Manufacturer</b></p></td>
		<td>'.$item[0]->manufacturer.'</td>
	      </tr>
	      <tr>
		<td><p><b>Quantity</b></p></td>
		<td>'.$item[0]->quantity.' pieces</td>
	      </tr>
	      <tr>
		<td><p><b>Available</b></p></td>
		<td>'.$item[0]->available.' pieces</td>
	      </tr>
	      <tr>
		<td><p><b>Serial</b></p></td>
		<td>'.$item[0]->serial.'</td>
	      </tr>
	      <tr>
		<td><p><b>Inventory number</b></p></td>
		<td>'.$item[0]->id_uc3m.'</td>
	      </tr>
	      <tr>
		<td><p><b>Issues</b></p></td>
		<td>'.$item[0]->issues.'</td>
	      </tr>
	    </table>
	     </td>
	    </tr>
	  </table>
	  
	  <p style="border: 1px solid black"></p>
	  
	    <p><img src="images/book-lines.png"> Asignations history.</p>
	    
	    <table class="list_items_table" class="display" width="100%">
			<thead>
			  <tr>
			    <th>ID Asignation</th>
			    <th>User</th>
			    <th>Item</th>
			    <th>Asignation date</th>
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
