<html>
  <head>
  
  <?php require_once("classes/class.Items.php");?>
    <meta charset=utf-8 />
   
    <link href="css/normalize.css" rel="stylesheet" type="text/css" />
    <link href="css/hover-min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="css/wp_inventory.css" />
    <link href="css/uploadbar.css" rel="stylesheet" type="text/css" />
    <script src="js/uploadbar.js"></script>
  </head>
    
     <body>
    <div class="container">
    
      <?php
      		session_start(); 
      
	
	
      if ($_SESSION['admin']){
      
      	$db	= new Items ();
	$item = $db -> recoverItemByID($_GET['id_item']);
	
	echo '<h3> Edit item</h3>
	<p>Specify the new information of the item.</p>
	<p style="color:##848484; font-size: 13px"><i>NOTE: If your don\'t modify a field, it will preserve its old value.</i></p>';
	
	if (isset($_POST['edit'])){
	
	  if (($_POST['quantity'] !=null) && !is_numeric($_POST['quantity'])) {
		echo '<div class="error_msg">
		      Sorry, <i>quantity</i> field has to be a numberic value... <b>Check the information provided.</b>
	      </div>';
	    }else if (($_POST['quantity'] !=null) && !is_numeric($_POST['serial'])) {
		echo '<div class="error_msg">
		      Sorry, <i>serial</i> field has to be a numberic value... <b>Check the information provided.</b>
	      </div>';
	    }else if (($_POST['quantity'] !=null) && !is_numeric($_POST['id_uc3m'])) {
		echo '<div class="error_msg">
		      Sorry, <i>ID UC3M</i> field has to be a numberic value... <b>Check the information provided.</b>
	      </div>';
	    }else if (($_POST['quantity'] !=null) && strpos($_FILES['image_file']['type'], 'image')) {
		echo '<div class="error_msg">
		      Sorry, the file uploaded has to be an image... <b>Check the type of the image file selected.</b>
	      </div>';
	    }else{
	      $db	= new Items ();
	      $item = $db -> updateItemByID($_POST['id_item'], $_POST['item'], $_POST['description'], $_POST['manufacturer'], $_POST['quantity'], $_POST['serial'], $_POST['id_uc3m'], file_get_contents($_FILES['image_file']['tmp_name']));
	      echo '<div class="success_msg">
		<img src="images/compose-3.png" width="16px" height="16px"></img>  The item has been edit successfully.
	      </div>
	      <a href="operaciones.php" target="frame_operaciones">Back</a>';
	    }
	}else{
	
	  echo '
	  <form id="delete_item" method="post" action="#">
	  <fieldset id="inputs">
	  <table id = "new_item_table">
	    <tr>
	      <td><p>Item name</p></td>
	      <td><input id="item" name="item" type="text" placeholder="'.$item[0]->name.'" autofocus>  </td>
	    </tr>
	    <tr>
	      <td><p>Description</p></td>
	      <td><input id="description" name="description" type="text" placeholder="'.$item[0]->description.'" autofocus>  </td>
	    </tr>
	    <tr>
	      <td><p>Manufacturer</p></td>
	      <td><input id="manufacturer" name="manufacturer" type="text" placeholder="'.$item[0]->manufacturer.'" autofocus>  </td>
	    </tr>
	    <tr>
	      <td><p>Quantity</p></td>
	      <td><input id="quantity" name="quantity" type="number" placeholder="'.$item[0]->quantity.'" autofocus>  </td>
	    </tr>
	    <tr>
	      <td><p>Serial</p></td>
	      <td><input id="serial" name="serial" type="number" placeholder="'.$item[0]->serial.'" autofocus>  </td>
	    </tr>
	    <tr>
	      <td><p>ID UC3M</p></td>
	      <td><input id="id_uc3m" name="id_uc3m" type="number" placeholder="ID '.$item[0]->id_uc3m.'" autofocus>  </td>
	    </tr>
	  </table>
	  </fieldset>
	  	  <p style="border: 1px solid black"></p>
	  
	  <div>
	    <p><img src="images/image.png"> Select an image file.</p>
	    <div>
	      <input type="file" name="image_file" id="image_file" onchange="fileSelected();" /></div>
	    </div>
	    <div id="fileinfo">
		<div id="filename"></div>
		<div id="filesize"></div>
		<div id="filetype"></div>
		<div id="filedim"></div>
	    </div>
	    <div id="error">You should select valid image files only!</div>
	    <div id="error2">An error occurred while uploading the file</div>
	    <div id="abort">The upload has been canceled by the user or the browser dropped the connection</div>
	    <div id="warnsize">Your file is very big. We cant accept it. Please select more small file</div>

	    <div id="progress_info">
	      <div id="progress"></div>
	      <div id="progress_percent">&nbsp;</div>
	      <div class="clear_both"></div>
	      <div>
		<div id="speed">&nbsp;</div>
		<div id="remaining">&nbsp;</div>
		<div id="b_transfered">&nbsp;</div>
		<div class="clear_both"></div>
	      </div>
	      <div id="upload_response"></div>
	    </div>
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
