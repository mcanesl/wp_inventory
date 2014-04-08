<html>
  <head>
    <meta charset=utf-8 />
    
    <link href="js/Datatables/media/css/jquery.dataTables.css" rel="stylesheet" type="text/css" />
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <script src="js/Datatables/media/js/jquery.js"></script>
    <script src="js/Datatables/media/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="css/wp_inventory.css" />

    
  </head>
  <body>
    <script>$(document).ready( function () {
      var table = $('#list_users_table').DataTable();
      });
    </script>
    
    <div class="list_container">
    
    <?php
	require_once("classes/class.InventoryAuth.php");
	require_once('../../../wp-includes/option.php');
	
	session_start ();
    	if ($_SESSION['login']){
		$userbind 	=  get_option('user');
		$gtsuser	=  get_option('gts_group');
		$gtsadmin	=  get_option('gts_admin');
		$server		=  get_option('server');

		$ldap_c	= new InventoryAuth ( $server, $userbind, $gtsuser, $gtsadmin );
		
		$users =  $ldap_c -> UsersInGroup ( $gtsuser  ); 

		array_shift( $users );
	
		if ($users != null){
			echo '
				<table id="list_users_table" class="display" width="100%">
				<thead>
				<tr>
				  <th>Users in ' . $gtsuser . '</th>
				</tr>
				</thead>
				<tbody>';

			foreach ($users as $u ) {
				      echo '
						<tr>
						  <td>' . $u . ' </td>
						</tr>';		
			}
			echo'		
			      </tbody>
			    <tfoot>
				<tr>
		                        <th>.</th>
        		        </tr>
        		     </tfoot>			    
   			    </table>
			    ';

		}else{
			echo
				'<div class="error_msg">
					Unable to bind anonymously..
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
