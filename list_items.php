<html>
  <head>
  
  <?php require_once("classes/class.Items.php");?>
    <meta charset=utf-8 />
    
    <link href="js/Datatables/media/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/normalize.css" rel="stylesheet" type="text/css" />
    <script src="js/Datatables/media/js/jquery.js"></script>
    <script src="js/Datatables/media/js/jquery.dataTables.js"></script>
    
<script>

$(document).ready(function() {	
	$('a[name=modal]').click(function(e) {
		e.preventDefault();
		var id = $(this).attr('href');
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		$('#mask').css({'width':maskWidth,'height':maskHeight});
	
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
	
		var winH = $(window).height();
		var winW = $(window).width();
              
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);

		$(id).fadeIn(2000); 
	
	});
	
	$('.window .close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		$('#mask').hide();
		$('.window').hide();
	});		
	
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});			

	$(window).resize(function () {
 		var box = $('#boxes .window');
 
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
      
        $('#mask').css({'width':maskWidth,'height':maskHeight});
               
        var winH = $(window).height();
        var winW = $(window).width();

        box.css('top',  winH/2 - box.height()/2);
        box.css('left', winW/2 - box.width()/2);
	 
	});
});

</script>
    
    <script>$(document).ready( function () {
      var table = $('#list_items_table').DataTable();
      });
    </script>
    
  </head>
    
     <body>
    <div class="container">
    
      <?php
      		session_start(); 
      
	
	
      if ($_SESSION['login']){
	     
	$db	= new Items ();
	$items = $db -> recoverItems();
	//print_r ($items);
	
	if ($items != null){
	
      echo '
      <a href="#dialog_new_item" name="modal"><img src="images/add.png" width="24px" height="24px"></img> Nuevo item</a>
      <p style="margin-top: 10px; margin-bottom: 20px; border: 1px solid black"></p>
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
	<tbody>';
	
	foreach ($items as $key => $value) {
	    echo '
	  <tr>
	    <td>'.$value->id_item.'</td>
	    <td>'.$value->name.'</td>
	    <td>'.$value->description.'</td>
	    <td>'.$value->manufacturer.'</td>
	    <td>'.$value->quantity.'</td>
	    <td>
		<a href="#dialog_delete_item" name="modal"><img src="images/delete.png" width="24px" height="24px"></img></a>
	    </td>
	  </tr>';
	  }
	  echo '
	</tbody>
      </table>';
      }else{
	echo '<p>No hay ningún item en la base de datos.</p>
	<button id="add_item">Añadir nuevo</button>';
      }
      }else{
	echo 'Usuario incorrecto';
      }
     ?>
     


      <div id="boxes">
	<div id="dialog_new_item" class="window">
	  <a href="#"class="close"/>Close it</a>
	  <div style="margin-top:10px;">
	    <iframe src="./new_item.php" width="100%" height="400px" frameborder="0"></iframe>
	  </div>
	</div>
	
	<div id="dialog_delete_item" class="window">
	  <a href="#"class="close"/>Close it</a>
	  <div style="margin-top:10px;">
	    <iframe src="./delete_item.php" width="100%" height="175px" frameborder="0"></iframe>
	  </div>
	</div>

	<div id="mask"></div>
      </div>


    </div>
  </body>
</html>