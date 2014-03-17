<html>
  <head>
  
  <?php require_once("classes/class.Items.php");?>
  
    <meta charset=utf-8 />
   
    <link href="css/wp_inventory.css" rel="stylesheet" type="text/css" />
    <link href="css/uploadbar.css" rel="stylesheet" type="text/css" />
    <link href="css/hover-min.css" rel="stylesheet" type="text/css" />
    <script src="js/uploadbar.js"></script>
  </head>
  <body>

    <div class="new_item_container">
    
      <?php
      	session_start(); 

      if ($_SESSION['login']){
      echo '
	<form id="upload_form" enctype="multipart/form-data" method="post" action="#">
	  <h3> New item</h3>
	  <p>Introduce the information of the new item.</p>';
	  
	  if (isset($_POST['save'])){
      
	    if (empty($_POST['item']) || empty($_POST['description']) || empty($_POST['manufacturer']) || empty($_POST['quantity']) || empty($_POST['serial']) || empty($_POST['id_uc3m']) ){
	      echo '<div class="error_msg">
		      Sorry, we need you fill in all the required gaps... <b>Check the information provided.</b>
	      </div>';
	      
	    }else if (!is_numeric($_POST['quantity'])) {
		echo '<div class="error_msg">
		      Sorry, <i>quantity</i> field has to be a numberic value... <b>Check the information provided.</b>
	      </div>';
	    }else if (!is_numeric($_POST['serial'])) {
		echo '<div class="error_msg">
		      Sorry, <i>serial</i> field has to be a numberic value... <b>Check the information provided.</b>
	      </div>';
	    }else if (!is_numeric($_POST['id_uc3m'])) {
		echo '<div class="error_msg">
		      Sorry, <i>ID UC3M</i> field has to be a numberic value... <b>Check the information provided.</b>
	      </div>';
	    }else if (strpos($_FILES['image_file']['type'], 'image')) {
		echo '<div class="error_msg">
		      Sorry, the file uploaded has to be an image... <b>Check the type of the image file selected.</b>
	      </div>';
	    }else{
	      $db	= new Items ();
	      $items = $db -> insertItem($_POST['item'], $_POST['description'], $_POST['manufacturer'], $_POST['quantity'], $_POST['serial'], $_POST['id_uc3m'], file_get_contents($_FILES['image_file']['tmp_name']));
	      
	      echo '<div class="success_msg">
		      The new item has been uploaded with success.
	      </div>';
	}
      }
	  
	  
	  echo '
	  <fieldset id="inputs">
	  <table id = "new_item_table">
	    <tr>
	      <td><p>Item name</p></td>
	      <td><input id="item" name="item" type="text" placeholder="Item name" autofocus required>  </td>
	    </tr>
	    <tr>
	      <td><p>Description</p></td>
	      <td><input id="description" name="description" type="text" placeholder="Description" autofocus required>  </td>
	    </tr>
	    <tr>
	      <td><p>Manufacturer</p></td>
	      <td><input id="manufacturer" name="manufacturer" type="text" placeholder="Manufacturer" autofocus required>  </td>
	    </tr>
	    <tr>
	      <td><p>Quantity</p></td>
	      <td><input id="quantity" name="quantity" type="number" placeholder="Quantity" autofocus required>  </td>
	    </tr>
	    <tr>
	      <td><p>Serial</p></td>
	      <td><input id="serial" name="serial" type="number" placeholder="Serial" autofocus required>  </td>
	    </tr>
	    <tr>
	      <td><p>ID UC3M</p></td>
	      <td><input id="id_uc3m" name="id_uc3m" type="number" placeholder="ID UC3M" autofocus required>  </td>
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
	               
	  <div id="buttons">
	    <input type="submit" class="button wobble-to-top-right" id="save" name="save" value="Guardar">
	    <input type="reset" class="button wobble-to-top-right" id="reset" name="reset" value="Reset">
	  </div>
	</form>';
	
      }else{
	echo 'Usuario incorrecto';
      }
     
      
      function bytesToSize1024($bytes, $precision = 2) {
	    $unit = array('B','KB','MB');
	    return @round($bytes / pow(1024, ($i = floor(log($bytes, 1024)))), $precision).' '.$unit[$i];
	}
     ?>


    </div>
  </body>
</html>