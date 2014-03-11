<html>
  <head>
  
  <?php require_once("classes/class.Items.php");?>
  
    <meta charset=utf-8 />
   
    <link href="css/style.css" rel="stylesheet" type="text/css" />
  </head>
  <body>

    <div class="container_modal">
    
      <?php
      	session_start(); 

      if ($_SESSION['login']){
      echo '
	<form id="new_item_form" method="post" action="#">
	  <h3>Nuevo dispositivo</h3>
	  <p>Introduce los datos del nuevo dispositivo.</p>
	  <table id= "new_item_table"">
	    <tr>
	      <td><p>Nombre dispositivo</p></td>
	      <td><input type="text" name="name" required></td>
	    </tr>
	    <tr>
	      <td><p>Descripción</p></td>
	      <td><input type="text" name="description" required></td>
	    </tr>
	    <tr>
	      <td><p>Fabricante</p></td>
	      <td><input type="text" name="manufacturer" required></td>
	    </tr>
	    	    <tr>
	      <td><p>Cantidad</p></td>
	      <td><input type="text" name="quantity" required></td>
	    </tr>
	    	    <tr>
	      <td><p>ID de serie</p></td>
	      <td><input type="text" name="serial" required></td>
	    </tr>
	    	    	    <tr>
	      <td><p>ID UC3M</p></td>
	      <td><input type="text" name="id_uc3m" required></td>
	    </tr>
	  </table>
	  <input type="submit" id="save" name="save" value="Guardar">
	  <input type="reset" id="reset" name="reset" value="Reset">
	</form>';
	
      }else{
	echo 'Usuario incorrecto';
      }
      
      if (isset($_POST['save'])){
	    echo 'holaaaa';
		$db	= new Items ();
		$items = $db -> insertItem($_POST['name'], $_POST['description'], $_POST['manufacturer'], $_POST['quantity'], $_POST['serial'], $_POST['id_uc3m']);
      }
     ?>


    </div>
  </body>
</html>