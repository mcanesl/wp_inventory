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
	  <h3>Borrar dispositivo</h3>
	  <p>¿Estás seguro de que deseas eliminar este dispositivo de la base de datos?</p>
	  <input type="submit" name="delete" value="Eliminar">
	  <input type="reset" name="cancel" value="Cancelar">
	</form>';
	
      }else{
	echo 'Usuario incorrecto';
      }
      
      if (isset($_POST['delete'])){
		$db	= new Items ();
		$items = $db -> deleteItem(39);
      }
     ?>


    </div>
  </body>
</html>