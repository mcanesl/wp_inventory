<html>
  <head>
  
  <?php require_once("classes/class.Items.php");?>
    <meta charset=utf-8 />
   
    <link href="css/normalize.css" rel="stylesheet" type="text/css" />
    <script src="js/Datatables/media/js/jquery.js"></script>
    <script src="js/Datatables/media/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="css/wp_inventory.css" />
  </head>
    
     <body>
    <div class="container">
    
      <?php
      		session_start(); 
      
	
	
      if ($_SESSION['login']){
      
      	$db	= new Items ();
	$item = $db -> recoverItemByID($_GET['id_item']);
	
	echo '<h3> Item details</h3>
	<p>Details about selected item.</p>
	<table id="item_table">
	<tr>
	  <td>
	    <div style= "width: 150px; height:150px; background-color: red"> <img sc="'.$item[0]->image.'"></img> </div>
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
		<td><p><b>ID UC3M</b></p></td>
		<td>'.$item[0]->id_uc3m.'</td>
	      </tr>
	    </table>
	     </td>
	    </tr>
	  </table>
	  
	  <p style="border: 1px solid black"></p>
	  
	    <p><img src="images/book-lines.png"> Asignations history.</p>
	    
	    <table id="list_items_table" class="display" width="100%">
			<thead>
			  <tr>
			    <th>ID Asignation</th>
			    <th>User</th>
			    <th>Item</th>
			    <th>Asignation date</th>
			    <th>Expiry date</th>
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
							<a href="item_details.php", target="frame_operaciones"><img src="images/zoom-in-2.png" width="16px" height="16px"></img></a>
						    	<img src="images/pencil.png" width="16px" height="16px"></img>
							<img src="images/bin-3.png" width="16px" height="16px"></img>
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
