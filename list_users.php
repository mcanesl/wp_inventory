<html>
  <head>
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
    
    <?php       if ($_SESSION['login']){
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
	<tbody>
	  <tr>
	    <td>001</td>
	    <td>System Architect</td>
	    <td>Edinburgh</td>
	    <td>Jax</td>
	    <td>2</td>
	  </tr>
	  <tr>
	    <td>002</td>
	    <td>Chip A04</td>
	    <td>Chip de la muerte</td>
	    <td>Aster S.A.</td>
	    <td>1</td>
	  </tr>
	  <tr>
	    <td>003</td>
	    <td>Colilla</td>
	    <td>Colilla normal y corriente</td>
	    <td>Tresh</td>
	    <td>5</td>
	  </tr>
	  <tr>
	    <td>004</td>
	    <td>System Architect</td>
	    <td>Caracola ola ola</td>
	    <td>Jax</td>
	    <td>2</td>
	  </tr>
	  <tr>
	    <td>005</td>
	    <td>System Architect</td>
	    <td>Edinburgh</td>
	    <td>Jax</td>
	    <td>2</td>
	  </tr>
	</tbody>
      </table>';
      
      }else{
		echo 'Usuario incorrecto';
      }
    </div>
  </body>
</html>