<html>
  <head>
    <meta charset=utf-8 />
    
    <link href="js/Datatables/media/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script src="js/Datatables/media/js/jquery.js"></script>
    <script src="js/Datatables/media/js/jquery.dataTables.js"></script>
    
  </head>
  <body>
    <script>$(document).ready( function () {
      var table = $('#list_items_table').DataTable();
      });
    </script>
    
    <div class="container">
    
    <?php       if ($_SESSION['login']){
    
	$db	= new Users ();
	$users = $db -> recoverUsers();
	print_r ($users);
	
	if ($users != null){
	  echo '
	    <table id="list_items_table" class="display" width="100%">
	      <thead>
		<tr>
		  <th>ID Item</th>
		  <th>Name</th>
		  <th>Description</th>
		  <th>Manufacturer</th>
		  <th>Quantity</th>
		</tr>
	      </thead>
	      <tbody>';
	      
	      foreach ($users as $key => $value) {
	      echo '
		<tr>
		  <td>001</td>
		  <td>System Architect</td>
		  <td>Edinburgh</td>
		  <td>Jax</td>
		  <td>2</td>
		</tr>';
		
		}
	      echo'
		
	      </tbody>
	    </table>';
	}else{
	  echo '<p>No hay ningún usuario en la base de datos.</p>
	}
      }else{
		echo 'Usuario incorrecto';
      }
    </div>
  </body>
</html>