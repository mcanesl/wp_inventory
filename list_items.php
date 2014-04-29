<html>
  <head>
  
  <?php require_once("classes/class.Items.php");?>
    <meta charset=utf-8 />
    
    <link href="js/Datatables/media/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <link href="css/normalize.css" rel="stylesheet" type="text/css" />
    <script src="js/Datatables/media/js/jquery.js"></script>
    <script src="js/Datatables/media/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="css/wp_inventory.css" />
    
                <script type="text/javascript" charset="utf-8">
                        $(document).ready(function() {
                                $('.list_items_table').dataTable( {
                                        "bProcessing": true,
                                        "bServerSide": true,
                                        "sAjaxSource": "scripts/server_processing_items.php",
                                        "iDisplayLength": 10
                                } );
                        } );
                </script>
    
  </head>
    
     <body>
    <div class="list_container">
    
      <?php
      		session_start(); 
	
      if ($_SESSION['login']){
	     
	$db	= new Items ();
	$items = $db -> recoverItems();
	if ($items != null){	
		      echo '
		      <table class="list_items_table" class="display" width="100%">
			<thead>
				<tr>
					<th id="th_short">ID</th>
					<th id="th_long">Name</th>
					<th id="th_long">Manufacturer</th>
					<th id="th_short">Qty</th>
					<th id="th_short">Avble</th>
					<th id="th_ops">Operations</th>

				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="dataTables_empty">Loading data from server</td>
				</tr>
			</tbody>
			  </table>';
	}else{
			echo '<div class="error_msg">
					No items found... <b>Use the menu to insert new one.</b>
			       </div>';
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
