<html>
  <head>
  
  <?php require_once("classes/class.Items.php");?>
    <meta charset=utf-8 />
    
    <link href="Datatables/media/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script src="Datatables/media/js/jquery.js"></script>
    <script src="Datatables/media/js/jquery.dataTables.js"></script>
    
  </head>
  <body>
    <script>$(document).ready( function () {
      var table = $('#list_items_table').DataTable();
      });
    </script>
    
    <div class="container">
    
      <?php
      		session_start(); 

     
      $db	= new Items ();
      $db -> recoverItems();
      
	
	
      if ($_SESSION['login']){
      
      echo '
	        <img src="images/add.png" width="18px" height="18px"><p>New item </p>
      <table id="list_items_table" class="display" width="100%">
	<thead>
	  <tr>
	    <th>ID Item</th>
	    <th>Name</th>
	    <th>Description</th>
	    <th>Manufacturer</th>
	    <th>Quantity</th>
	    <th>Operations</th>
	  </tr>
	</thead>
	<tbody>
	  <tr>
	    <td>001</td>
	    <td>System Architect</td>
	    <td>Edinburgh</td>
	    <td>Jax</td>
	    <td>2</td>
	    <td><img src="images/edit.png" width="18px" height="18px"></td>
	  </tr>
	  <tr>
	    <td>002</td>
	    <td>Chip A04</td>
	    <td>Chip de la muerte</td>
	    <td>Aster S.A.</td>
	    <td>1</td>
	    	    <td>Borrar</td>
	  </tr>
	  <tr>
	    <td>003</td>
	    <td>Colilla</td>
	    <td>Colilla normal y corriente</td>
	    <td>Tresh</td>
	    <td>5</td>
	    	    <td>Borrar</td>
	  </tr>
	  <tr>
	    <td>004</td>
	    <td>System Architect</td>
	    <td>Caracola ola ola</td>
	    <td>Jax</td>
	    <td>2</td>
	    	    <td>Borrar</td>
	  </tr>
	  <tr>
	    <td>005</td>
	    <td>System Architect</td>
	    <td>Edinburgh</td>
	    <td>Jax</td>
	    <td>2</td>
	    	    <td>Borrar</td>
	  </tr>
	</tbody>
      </table>';
      }else{
	echo 'Usuario incorrecto';
      }
     ?>
     
     

      

    </div>
  </body>
</html>