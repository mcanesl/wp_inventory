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
	     
	$db	= new Items ();
	$manufacturers = $db -> recoverManufacturers();
	
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

      echo '
	<form id="upload_form" enctype="multipart/form-data" method="post" action="#">
	  <h3> New item</h3>';
	  
	  if (isset($_POST['save'])){
      
	    if (empty($_POST['item']) || empty($_POST['manufacturer']) || empty($_POST['quantity'])){
	      echo '<div class="error_msg">
		      Sorry, we need you fill in all the required gaps (marked as *)... <b>Check the information provided.</b>
	      </div>';
	      
	    }else if (!is_numeric($_POST['quantity'])) {
		echo '<div class="error_msg">
		      Sorry, <i>quantity</i> field has to be a numberic value... <b>Check the information provided.</b>
	      </div>';
	    }else if (!empty($_FILES['image_file']['tmp_name']) && (strpos($_FILES['image_file']['type'],'image')===FALSE)) {
		echo '<div class="error_msg">
		      Sorry, the file uploaded has to be an image... <b>Check the type of the image file selected.</b>
	      </div>
		<a href="new_item.php" target="operations_frame3"><img src="images/back.png" width="16px" height="16px"></img> Back</a>';
	    }else{
	      $db	= new Items ();
	      $image 	=  base64_encode(fread(fopen($_FILES['image_file']['tmp_name'],"r"),$_FILES['image_file']['size']));

		$replace_desc=$_POST['description'];
		$replace_desc=str_replace("\r","<br>",$replace_desc);
		$description = $replace_desc;

		$replace_iss=$_POST['issues'];
		$replace_iss=str_replace("\r","<br>",$replace_iss);
		$issues = $replace_iss;

	      $insert = $db -> insertItem($_POST['item'], $description, $_POST['manufacturer'], $_POST['quantity'], $_POST['serial'], $_POST['id_uc3m'], $_POST['attendant'], $_POST['location'], $image, $issues);
	      
		if ($insert ==-1){
			echo '<div class="error_msg">
	    		Sorry, an error occurs. Please, check the information given.
	  		</div>
	  		<a href="new_item.php" target="operations_frame3"><img src="images/back.png" width="16px" height="16px"></img> Back</a>';
		}else{
		      echo '<div class="success_msg">
			     <img src="images/plus.png" width="16px" height="16px"></img>   The new item has been uploaded with success.
		      </div>
			<a href="new_item.php" target="operations_frame3"><img src="images/back.png" width="16px" height="16px"></img> Back</a>';
		}
	}
      }
	  
	  
	  echo '
	  <fieldset id="inputs">
	  <table id = "new_item_table">
	    <tr>
	      <td><p>Item name (*)</p></td>
	      <td><input id="item" name="item" type="text" placeholder="Item name" autofocus required maxlength="50">  </td>
      	      <td><p>Image file</p></td>
	      <td><input type="file"  name="image_file" id="image_file"></input></td>
	    </tr>
	    <tr>
	      <td><p>Manufacturer (*)</p></td>
	      <td><input id="manufacturer" name="manufacturer" type="text" placeholder="Manufacturer" autofocus required maxlength="50">  </td>
      	      <td><p>Quantity (*)</p></td>
	      <td><input id="quantity" name="quantity" type="number" placeholder="Quantity" autofocus required maxlength="5">  </td>
	    </tr>
	    <tr>
	      <td><p>Serial</p></td>
	      <td><input id="serial" name="serial" type="text" placeholder="Serial" autofocus maxlength="25">  </td>
	      <td><p>Inventory number</p></td>
	      <td><input id="id_uc3m" name="id_uc3m" type="text" placeholder="ID UC3M" autofocus maxlength="25">  </td>      
	    </tr>
	    <tr>
	      <td><p>Attendant</p></td>
	      <td><input id="attendant" name="attendant" type="text" placeholder="Attendant" autofocus maxlength="25">  </td>
	      <td><p>Location</p></td>
	      <td><input id="location" name="location" type="text" placeholder="Location" autofocus maxlength="25">  </td>      
	    </tr>	    
    	    <tr>
      	      <td><p>Description</p></td>
	      <td><textarea id="description" name="description" rows="9" cols="22" maxlength="150" placeholder="Description"></textarea></td>
	      <td><p>Issues</p></td>
	      <td><textarea id="issues" name="issues" rows="9" cols="22" maxlength="150" placeholder="Issues"></textarea></td>

	    </tr>	    	    
	  </table>
	  </fieldset>
	  

	               
	  <div id="buttons">
	    <input type="submit" class="button wobble-to-top-right" id="save" name="save" value="Guardar">
	    <input type="reset" class="button wobble-to-top-right" id="reset" name="reset" value="Reset">
	  </div>
	</form>';
	
      }else{
		echo '<div class="error_msg">
				User not registered in the system.  Go to login window.
		       </div>';
      }
     
      
      function bytesToSize1024($bytes, $precision = 2) {
	    $unit = array('B','KB','MB');
	    return @round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), $precision).' '.$unit[$i];
	}
     ?>


    </div>
  </body>
</html>
