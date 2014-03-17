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
      
	
	
      if ($_SESSION['login']){
      
      	$db	= new Items ();
	$item = $db -> recoverItemByID($_GET['id_item']);
	
	echo '<h3> Edit item</h3>
	<p>Specify the new information of the item.</p>
	<p style="color:##848484; font-size: 13px"><i>NOTE: If your don\'t modify a field, it will preserve its old value.</i></p>';
	
	if (isset($_POST['edit'])){
	  $db	= new Items ();
	  $item = $db -> updateItemByID($_GET['id_item']);
	  
	  echo '<div class="success_msg">
	    The item has been edit successfully.
	  </div>
	  <a href="list_items.php" target="list_items_frame">Back</a>';
	}else{
	
	  echo '
	  <fieldset id="inputs">
	  <table id = "new_item_table">
	    <tr>
	      <td><p>Item name</p></td>
	      <td><input id="item" name="item" type="text" placeholder="'.$item[0]->name.'" autofocus required>  </td>
	    </tr>
	    <tr>
	      <td><p>Description</p></td>
	      <td><input id="description" name="description" type="text" placeholder="'.$item[0]->description.'" autofocus required>  </td>
	    </tr>
	    <tr>
	      <td><p>Manufacturer</p></td>
	      <td><input id="manufacturer" name="manufacturer" type="text" placeholder="'.$item[0]->manufacturer.'" autofocus required>  </td>
	    </tr>
	    <tr>
	      <td><p>Quantity</p></td>
	      <td><input id="quantity" name="quantity" type="number" placeholder="'.$item[0]->quantity.'" autofocus required>  </td>
	    </tr>
	    <tr>
	      <td><p>Serial</p></td>
	      <td><input id="serial" name="serial" type="number" placeholder="'.$item[0]->serial.'" autofocus required>  </td>
	    </tr>
	    <tr>
	      <td><p>ID UC3M</p></td>
	      <td><input id="id_uc3m" name="id_uc3m" type="number" placeholder="ID '.$item[0]->id_uc3m.'" autofocus required>  </td>
	    </tr>
	  </table>
	  </fieldset>
	  <form id="delete_item" method="post" action="#">
	    <input type="hidden" name="id_item" value="'.$_GET['id_item'].'">
	    <input class = "button wobble-to-top-right" type="submit" id="edit" name="edit" value="Edit item">
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
