<html>
  <head>
  
  <?php require_once("classes/class.Items.php");?>
    <meta charset=utf-8 />

    <link href="css/wp_inventory.css" rel="stylesheet" type="text/css" />
    <link href="css/uploadbar.css" rel="stylesheet" type="text/css" />
    <link href="css/hover-min.css" rel="stylesheet" type="text/css" />
    <link href="css/jquery-ui.css" rel="stylesheet" type="text/css" />
    <script src='"; echo plugin_dir_url( __FILE__ ) . "js/jquery/jquery-2.1.0.min.js"; echo "'></script>
    <script src="//code.jquery.com/jquery-1.9.1.js"></script>
    <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
    <script src="js/uploadbar.js"></script>
  </head>
    
     <body>
    <div class="container">
    
      <?php
      		session_start(); 
      
	
	
      if ($_SESSION['admin']){

	     
	$db_m	= new Items ();
	$manufacturers = $db_m -> recoverManufacturers();
	
	$tags = '';
	
	foreach ($manufacturers as $key => $value) {
	  $tags = $tags . '"'. $value->manufacturer . '",';
	}

	echo '
	  <script>
	  $(function() {
	    var availableTags = ['.
	    $tags.'
	    ];
	    $( "#manufacturer" ).autocomplete({
	    source: availableTags
	    });
	  });
	</script>';
	
      
      	$db	= new Items ();
	$item = $db -> recoverItemByID($_GET['id_item']);
	
	echo '<h3> Edit item</h3>
	<p>Specify the new information of the item.</p>
	<p style="color:##848484; font-size: 13px"><i>NOTE: If your don\'t modify a field, it will preserve its old value.</i></p>';
	
	if (isset($_POST['edit'])){
	
	  $name = $item[0]->name;
	  $description = $item[0]->description;
	  $manufacturer = $item[0]->manufacturer;
	  $quantity = $item[0]->quantity;
	  $available = $item[0]->available;
	  $serial = $item[0]->serial;
	  $id_uc3m = $item[0]->id_uc3m;
	  $attendant = $item[0]->attendant;
	  $location = $item[0]->location;
	  $image = $item[0]->image;
	  $issues = $item[0]->issues;


	  if (($_POST['quantity'] !=null) && !is_numeric($_POST['quantity'])) {
		echo '<div class="error_msg">
		      Sorry, <i>quantity</i> field has to be a numberic value... <b>Check the information provided.</b>
	      </div>
	      <a href="lists.php" target="operations_frame2"><img src="images/back.png" width="16px" height="16px"></img> Back</a>';
	    }else if (!empty($_FILES['image_file']['tmp_name']) && (strpos($_FILES['image_file']['type'],'image')===FALSE)) {
		echo '<div class="error_msg">
		      Sorry, the file uploaded has to be an image... <b>Check the type of the image file selected.</b>
	      </div>
		<a href="lists.php" target="operations_frame2"><img src="images/back.png" width="16px" height="16px"></img> Back</a>';
	    }else{ 
	      if($_POST['item']!=null){
		$name = $_POST['item'];
	      }
	      
	      if($_POST['description']!=null){
		$replace=$_POST['description'];
		$replace=str_replace("\r","<br>",$replace);
		$description = $replace;
	      }
	      
	      if($_POST['manufacturer']!=null){
		$manufacturer = $_POST['manufacturer'];
	      }

	      if($_POST['quantity']!=null){
		$available = ($_POST['quantity'] - $quantity) + $available;
		$quantity = $_POST['quantity'];
	      }
	      
	      if($_POST['serial']!=null){
		$serial = $_POST['serial'];
	      }
	      
	      if($_POST['id_uc3m']!=null){
		$id_uc3m = $_POST['id_uc3m'];
	      }

	      if($_POST['attendant']!=null){
		$attendant = $_POST['attendant'];
	      }

	      if($_POST['location']!=null){
		$location = $_POST['location'];
	      }
	      
	      if($_FILES['image_file']['tmp_name']!=null){
		$image 	=  base64_encode(fread(fopen($_FILES['image_file']['tmp_name'],"r"),$_FILES['image_file']['size']));
	      }
	      
	      if($_POST['issues']!=null){
		$replace=$_POST['issues'];
		$replace=str_replace("\r","<br>",$replace);
		$issues = $replace;
	      }
	      
	      
	      $db	= new Items ();	      
	      $update = $db -> updateItemByID($_POST['id_item'], $name, $description, $manufacturer, $quantity, $available, $serial, $id_uc3m, $attendant, $location, $image, $issues);

		if ($update == -1){
			echo '<div class="error_msg">
			Sorry, an error occurs. Please, check the information given.
			</div>
	    		<a href="lists.php" target="operations_frame2"><img src="images/back.png" width="16px" height="16px"></img> Back</a>';
		}else{

		      echo '<div class="success_msg">
			<img src="images/compose-3.png" width="16px" height="16px"></img>  The item has been edit successfully.
		      </div>
	    		<a href="lists.php" target="operations_frame2"><img src="images/back.png" width="16px" height="16px"></img> Back</a>';
		}
	    }
	}else{
	
	  echo '
	  <form id="delete_item"  enctype="multipart/form-data"  method="post" action="#">
	  <fieldset id="inputs">
	  <table id = "new_item_table">
	    <tr>
		<input type="hidden" name="id_item" value="'.$_GET['id_item'].'">
	      <td><p>Item name</p></td>
	      <td><input id="item" name="item" type="text" placeholder="'.$item[0]->name.'" autofocus maxlength="50">  
		</td>
      	      <td><p>Image file</p></td>
	      <td><input type="file"  name="image_file" id="image_file"></input></td>
	    </tr>
	    <tr>
	      <td><p>Manufacturer</p></td>
	      <td><input id="manufacturer" name="manufacturer" type="text" placeholder="'.$item[0]->manufacturer.'" autofocus maxlength="50">  </td>
      	      <td><p>Quantity</p></td>
	      <td><input id="quantity" name="quantity" type="number" placeholder="'.$item[0]->quantity.'" autofocus maxlength="5">  </td>
	    </tr>
	    <tr>
	      <td><p>Serial</p></td>
	      <td><input id="serial" name="serial" type="text" placeholder="'.$item[0]->serial.'" autofocus maxlength="25">  </td>
	      <td><p>Inventory number</p></td>
	      <td><input id="id_uc3m" name="id_uc3m" type="text" placeholder="'.$item[0]->id_uc3m.'" autofocus maxlength="25">  </td>      
	    </tr>	
	    <tr>
	      <td><p>Attendant</p></td>
	      <td><input id="attendant" name="attendant" type="text" placeholder="'.$item[0]->attendant.'" autofocus maxlength="25">  </td>
	      <td><p>Location</p></td>
	      <td><input id="location" name="location" type="text" placeholder="'.$item[0]->location.'" autofocus maxlength="25">  </td>      
	    </tr>    
    	    <tr>
      	      <td><p>Description</p></td>
	      <td><textarea id="description" name="description" rows="9" cols="22" maxlength="150" placeholder="'.$item[0]->description.'"></textarea></td>
	      <td><p>Issues</p></td>
	      <td><textarea id="issues" name="issues" rows="9" cols="22" maxlength="150" placeholder="'.$item[0]->issues.'"></textarea></td>

	    </tr>	    	    
	  </table>
	  </fieldset>

	<div id="buttons">
	    <input class = "button wobble-to-top-right" type="submit" id="edit" name="edit" value="Edit item">
	    <a href="lists.php" target="operations_frame2"><img src="images/back.png" width="16px" height="16px"></img> Back</a>
	</div>
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
