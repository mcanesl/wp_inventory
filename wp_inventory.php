<?php
/*
Plugin Name: WP Inventory
Plugin URI: 
Description: Plugin para la gestión de inventario. Permite añadir, modificar, eliminar y visualizar asignaciones usuario-item.
Author: Marta Canes
Version: 1.4
Author URI: https://github.com/mcanesl
*/

//Plugin shortcode
add_shortcode( 'gestion', 'wp_inventory');

// run the install scripts upon plugin activation
register_activation_hook(__FILE__,'wp_inventory_install');

// run the uninstall script upon plugin deletion
register_uninstall_hook(__FILE__,'wp_inventory_uninstall');

// create custom plugin settings menu
add_action('admin_menu', 'create_options_menu');

//Plugin style and js
add_action('wp_head', AddStyle);
add_action('wp_head', AddJS);

require_once("classes/class.InventoryAuth.php");
require_once("classes/class.Database.php");
require_once("classes/class.Items.php");

session_start();

function AddJS (){
	echo "
	  <script src='"; echo plugin_dir_url( __FILE__ ) . "js/jquery/jquery-2.1.0.min.js"; echo "'></script>
	  <script src='"; echo plugin_dir_url( __FILE__ ) . "js/ion.tabs-master/js/ion-tabs/ion.tabs.min.js"; echo "'></script>";
}
function AddStyle (){
	echo "
	  <link rel='stylesheet' href= '"; echo plugin_dir_url( __FILE__ ) . "js/ion.tabs-master/css/ion.tabs.css"; echo "'/>
	  <link rel='stylesheet' href= '"; echo plugin_dir_url( __FILE__ ) . "css/wp_inventory.css"; echo "'/>
	  <link rel='stylesheet' href= '"; echo plugin_dir_url( __FILE__ ) . "css/normalize.css";echo "'/>";
	  
}

 				
function wp_inventory_install() {
  $db	= new Database ();
  $db -> createInitialDatabase();
 
}

function wp_inventory_uninstall() {
  $db	= new Database ();
  $db -> dropDatabase();
 
}

function wp_inventory(){

		if ( $_POST ['username'] and $_POST ['password'] and ! $_SESSION['login']) {
			$ldap_c	= new InventoryAuth ( get_option('server'), get_option('user'), get_option('gts_group'), get_option('gts_group_admin') );
			$r = $ldap_c -> userInGroup ( $_POST ['username'], $_POST ['password'], get_option('gts_group'));	
			if ( $r  > 0) {
				$_SESSION['login'] = $_POST ['username'];

			} else {
				$error = true;
			}
			
			$r = $ldap_c -> userInGroup ( $_POST ['username'], $_POST ['password'], get_option('gts_group_admin') );	
			$r = $ldap_c -> userInGroup ( $_POST ['username'], $_POST ['password'], get_option('gts_group_admin') );	
			if ( $r  > 0) {
				$_SESSION['admin'] =  true;
			}

		}
		
		
		if ( $error ) {
			echo '<div class="error_msg">Sorry, invalid user or password...</div>';
		}
		
		if ( $_SESSION['login'] ) {
			echo '<div style="width:700px; margin-top:-55px;">
				<iframe id="frame_principal" name="frame_principal" src="' . plugin_dir_url( __FILE__ ) . 'main.php" seamless height="100px" width="100%"></iframe>
				</div>
			      ';

		} else {
			echo '
				<form id="login" method="post" enctype="application/x-www-form-urlencoded" action="#">
					<fieldset id="inputs">
						<input id="username" name="username" type="text" placeholder="Username" autofocus required>   
						<input id="password" name="password" type="password" placeholder="Password" required>
					</fieldset>
					<fieldset id="actions">
						<input type="submit" id="submit" value="Log in">
						<a href="https://www.tsc.uc3m.es/incidencias">Need support?</a>
					 </fieldset>
				 </form>
				'
				;


		}
}

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
    <p>Introduce LDAP information</p>
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
    <input type="submit" name="submit" class="button-primary" value="<?php _e('Save') ?>" />
    </p>

</form>
</div>
<?php } 
?>
