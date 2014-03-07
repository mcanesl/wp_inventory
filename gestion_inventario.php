<?php
/*
Plugin Name: Gestion inventario
Plugin URI: 
Description: Plugin para la gestión de inventario. Permite añadir, modificar, eliminar y visualizar asignaciones usuario-item.
Author: Marta Canes
Version: 0.1
Author URI: 
*/

//Plugin shortcode
add_shortcode( 'gestion', 'gestion_inventario' );

//Plugin style and js
add_action('wp_head', AddStyle);
add_action('wp_head', AddJS);

require_once("classes/class.InventoryAuth.php");

session_start();

function AddJS (){
	echo "
	  <script src='"; echo plugin_dir_url( __FILE__ ) . "js/jquery/jquery-2.1.0.min.js"; echo "'></script>
	  <script src='"; echo plugin_dir_url( __FILE__ ) . "js/ion.tabs-master/js/ion-tabs/ion.tabs.min.js"; echo "'></script>";
}
function AddStyle (){
	echo "
	  <link rel='stylesheet' href= '"; echo plugin_dir_url( __FILE__ ) . "js/ion.tabs-master/css/ion.tabs.css"; echo "'/>
	  <link rel='stylesheet' href= '"; echo plugin_dir_url( __FILE__ ) . "js/ion.tabs-master/css/ion.skinBordered.css"; echo "'/>
	  <link rel='stylesheet' href= '"; echo plugin_dir_url( __FILE__ ) . "css/normalize.css"; echo "'/>";

}

function gestion_inventario(){
		//Estos valores deberian estar en la configuracion del wordpress:
		$userbind 	= 'uid = --login--, ou=People, dc=tsc, dc=uc3m,dc=es';
		$gtsuser	= 'cn=gts, ou=Group,DC=tsc,DC=uc3m,DC=es';
		$gtsadmin	= 'cn=gts, ou=Group,DC=tsc,DC=uc3m,DC=es';
		$server		= 'umbriel.tsc.uc3m.es';

	
		if ( $_POST ['login'] and $_POST ['passwd'] and ! $_SESSION['login']) {
			$ldap_c	= new InventoryAuth ( $server, $userbind, $gtsuser, $gtsadmin );
			$r = $ldap_c -> userInGroup ( $_POST ['login'], $_POST ['passwd'], $gtsuser );	
			if ( $r  > 0) {
				$_SESSION['login'] = $_POST ['login'];
				#header ("Location: mostrar.php");

			} else {
				$error = true;
			}
			
			$r = $ldap_c -> userInGroup ( $_POST ['login'], $_POST ['passwd'], $gtsadmin );	
			$r = $ldap_c -> userInGroup ( $_POST ['login'], $_POST ['passwd'], $gtsadmin );	
			if ( $r  > 0) {
				$_SESSION['admin'] =  true;
			}

		}
		
		
		if ( $error ) {
			echo 'Usuario incorrecto';
		}
		
		if ( $_SESSION['login'] ) {
			echo '
				<iframe src="' . plugin_dir_url( __FILE__ ) . 'mostrar.php" seamless target="parent"></iframe>
			      ';

		} else {
			echo '
				<form method="post"
					      enctype="application/x-www-form-urlencoded"
					      action="#">
					 <p><label>login: <input name=login required></label></p>
			 		 <p><label>passwd: <input name= passwd required type=password></label></p>
			 		  <p><button>Go !!!!</button></p>
				</form>';
		}
}

// create custom plugin settings menu
add_action('admin_menu', 'create_options_menu');

function create_options_menu() {

	add_menu_page('WP Inventory', 'WP Inventory', 'administrator', __FILE__, 'options_page',plugins_url('/images/icon.png', __FILE__));
	
	add_action( 'admin_init', 'register_options' );
}


function register_options() {
	register_setting( 'options-group', 'server' );
	register_setting( 'options-group', 'user' );
	register_setting( 'options-group', 'gts_group' );
	register_setting( 'options-group', 'gts_group_admin' );
}

function options_page() {
?>
<div class="wrap">
<h2>WP Inventory</h2>

<form method="post" action="options.php">
    <?php settings_fields( 'options-group' ); ?>
    <p>Some information about this admin page.</p>
    <table class="form-table">
        <tr valign="top">
        <th scope="row">LDAP Server</th>
        <td><input type="text" name="server" value="<?php echo get_option('server'); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">DN User</th>
        <td><input type="text" name="user" value="<?php echo get_option('user'); ?>" /></td>
        </tr>
        <th scope="row">DN GTS Group</th>
        <td><input type="text" name="gts_group" value="<?php echo get_option('gts_group'); ?>" /></td>
        </tr>
        <tr valign="top">
        <th scope="row">DN GTS Group Admin</th>
        <td><input type="text" name="gts_group_admin" value="<?php echo get_option('gts_group_admin'); ?>" /></td>
        </tr>
       
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save') ?>" />
    </p>

</form>
</div>
<?php } 


?>
