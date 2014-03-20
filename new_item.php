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

    <div class="container">
    
      <?php
      	session_start(); 

      if ($_SESSION['admin']){
      echo '
	<form id="upload_form" enctype="multipart/form-data" method="post" action="#">
	  <h3> New item</h3>';
	  
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
	      $image 	=  base64_encode(fread(fopen($_FILES['image_file']['tmp_name'],"r"),$_FILES['image_file']['size']));
	      $items = $db -> insertItem($_POST['item'], $_POST['description'], $_POST['manufacturer'], $_POST['quantity'], $_POST['serial'], $_POST['id_uc3m'], $image);
	      
	      echo '<div class="success_msg">
		     <img src="images/plus.png" width="16px" height="16px"></img>   The new item has been uploaded with success.
	      </div>';
	}
      }
	  
	  
	  echo '
	  <fieldset id="inputs">
	  <table id = "new_item_table">
	    <tr>
	      <td><p>Item name</p></td>
	      <td><input id="item" name="item" type="text" placeholder="Item name" autofocus required>  </td>
      	      <td><p>Image file</p></td>
	      <td><input type="file"  name="image_file" id="image_file"></input></td>
	    </tr>
	    <tr>
	      <td><p>Manufacturer</p></td>
	      <td><input id="manufacturer" name="manufacturer" type="text" placeholder="Manufacturer" autofocus required>  </td>
      	      <td><p>Quantity</p></td>
	      <td><input id="quantity" name="quantity" type="number" placeholder="Quantity" autofocus required>  </td>
	    </tr>
	    <tr>
	      <td><p>Serial</p></td>
	      <td><input id="serial" name="serial" type="number" placeholder="Serial" autofocus >  </td>
	      <td><p>ID UC3M</p></td>
	      <td><input id="id_uc3m" name="id_uc3m" type="number" placeholder="ID UC3M" autofocus required>  </td>      
	    </tr>	    
    	    <tr>
      	      <td><p>Description</p></td>
	      <td><textarea id="description" name="description" style="height:120px;" placeholder="Description" autofocus > </textarea> </td>
	      <td><p>Issues</p></td>
	      <td><textarea id="issue" name="issue" type="text"   style="height:120px;" placeholder="Issues" autofocus > </textarea> </td>

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
