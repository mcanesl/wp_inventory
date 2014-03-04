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
	if (!empty($_SESSION['user'])){
	  echo "
	    <div id='listado_gestion_inventario'>
	    <form id='salir_cuenta_form' method='post' action='#'>
 	    <input type='submit' id='salir' name='salir' value='salir'>
	    </form>
	      <div class='ionTabs' id='menu_inventario_tabs' data-name='Tabs_Group_name'>
		<ul class='ionTabs__head'>
		  <li class='ionTabs__tab' data-target='Tab_1_name'><img src="; echo plugin_dir_url( __FILE__ ) . "images/devices.png"; echo " style='width: 18px; height: 18px'> Dispositivos</li>
		  <li class='ionTabs__tab' data-target='Tab_2_name'><img src="; echo plugin_dir_url( __FILE__ ) . "images/users.png"; echo " style='width: 18px; height: 18px'> Usuarios</li>
		  <li class='ionTabs__tab' data-target='Tab_3_name'><img src="; echo plugin_dir_url( __FILE__ ) . "images/asignations.png"; echo " style='width: 18px; height: 18px'> Asignaciones</li>
		</ul>
			    
		<div class='ionTabs__body'>
		  <div class='ionTabs__item' data-name='Tab_1_name'> 
			<p id='mensaje' style='margin-top: 10px; border: 1px solid black; background-color: #CEF6D8'></p>
			<p id='mensaje_error' style='margin-top: 10px; border: 1px solid black; background-color: #F5A9A9'></p>
			<input type='image' src="; echo plugin_dir_url( __FILE__ ) . "images/add.png"; echo " style='width: 18px; height: 18px'> Nuevo dispositivo

			
			<table id='listado_dispositivos' style='margin-top: 30px'>
			  <th>ID Dispositivo</th>
			  <th>Nombre</th>
			  <th>Descripción</th>
			  <th>Fabricante</th>
			  <th>Cantidad</th>
			  <th></th>
			  <tr>
			    <td><p>1</p></td>
			    <td><p>Chip 34556A</p></td>
			    <td><p>Chip electrónico de la muerte</p></td>
			    <td><p>Acersus S.L.</p></td>
			    <td><p>1</p></td>
			    <td>
			      <input type='image' src="; echo plugin_dir_url( __FILE__ ) . "images/edit.png"; echo " style='width: 18px; height: 18px' onclick='editarAsignacion()'>
			      <input type='image' src="; echo plugin_dir_url( __FILE__ ) . "images/delete.png"; echo " style='width: 18px; height: 18px'>
			    </td>				
			  </tr>
			</table>
		</div>
		
		<div class='ionTabs__item' data-name='Tab_2_name'>
		  <p id='mensaje' style='margin-top: 10px; border: 1px solid black; background-color: #CEF6D8'></p>
		  <p id='mensaje_error' style='margin-top: 10px; border: 1px solid black; background-color: #F5A9A9'></p>
		  <table id='listado_dispositivos' style='margin-top: 30px'>
		    <th>ID Usuario</th>
		    <th>Nombre</th>
		    <th>Apellidos</th>
		    <th>Correo</th>
		    <th>Despacho</th>
		    <th>Teléfono</th>
		    <th></th>
		    <tr>
		      <td><p>1</p></td>
		      <td><p>María</p></td>
		      <td><p>Pérez Caldera</p></td>
		      <td><p>mpcaldera@tsc.uc3m.es</p></td>
		      <td><p>4.1.D02</p></td>
		      <td><p>918850265</p></td>
		      <td>
			<input type='image' src="; echo plugin_dir_url( __FILE__ ) . "images/edit.png"; echo " style='width: 18px; height: 18px' onclick='editarAsignacion()'>
			<img src="; echo plugin_dir_url( __FILE__ ) . "images/delete.png"; echo " style='width: 18px; height: 18px'>
		      </td>				
		    </tr>
		  </table>
		</div>
		
		<div class='ionTabs__item' data-name='Tab_3_name'>
		  <p id='mensaje' style='margin-top: 10px; border: 1px solid black; background-color: #CEF6D8'></p>
		  <p id='mensaje_error' style='margin-top: 10px; border: 1px solid black; background-color: #F5A9A9'></p>
		  <input type='image' src="; echo plugin_dir_url( __FILE__ ) . "images/add.png"; echo " onclick='nuevaAsignacion()' style='width: 18px; height: 18px'> Nueva asignación				
		  <table id='listado_inventario' style='margin-top: 30px'>
		    <th>ID Asignacion</th>
		    <th>Usuario</th>
		    <th>Dispositivo</th>
		    <th>Fecha inicio</th>
		    <th>Fecha fin</th>
		    <th></th>
		    <tr>
		      <td><p>1</p></td>
		      <td><p>Mari Carmen Pérez</p></td>
		      <td><p>Sony Vaio P-512</p></td>
		      <td><p>06/04/2013</p></td>
		      <td><p>25/12/2014</p></td>
		      <td>
			<input type='image' src="; echo plugin_dir_url( __FILE__ ) . "images/edit.png"; echo " style='width: 18px; height: 18px' onclick='editarAsignacion()'>
			<input type='image' src="; echo plugin_dir_url( __FILE__ ) . "images/delete.png"; echo " style='width: 18px; height: 18px'>
		      </td>				
		    </tr>
		    <tr>
		      <td><p>2</p></td>
		      <td><p>Alicia Wonderland</p></td>
		      <td><p>Dispositivo R18</p></td>
		      <td><p>16/08/2013</p></td>
		      <td><p>25/12/2014</p></td>
		      <td>
			<input type='image' src="; echo plugin_dir_url( __FILE__ ) . "images/edit.png"; echo " style='width: 18px; height: 18px'>
			<input type='image' src="; echo plugin_dir_url( __FILE__ ) . "images/delete.png"; echo " style='width: 18px; height: 18px'>
		      </td>
		    </tr>
		    <tr>
		      <td><p>3</p></td>
		      <td><p>Darth Vader</p></td>
		      <td><p>Sable de luz</p></td>
		      <td><p>18/08/2013</p></td>
		      <td><p>25/12/2014</p></td>
		      <td>
			<input type='image' src="; echo plugin_dir_url( __FILE__ ) . "images/edit.png"; echo " style='width: 18px; height: 18px'>
			<input type='image' src="; echo plugin_dir_url( __FILE__ ) . "images/delete.png"; echo " style='width: 18px; height: 18px'>
		      </td>
		    </tr>
		    <tr>
		      <td><p>4</p></td>
		      <td><p>Akira Toriyama</p></td>
		      <td><p>Tomo manga n 16</p></td>
		      <td><p>15/10/2013</p></td>
		      <td><p>25/12/2014</p></td>
		      <td>
			<input type='image' src="; echo plugin_dir_url( __FILE__ ) . "images/edit.png"; echo " style='width: 18px; height: 18px'>
			<input type='image' src="; echo plugin_dir_url( __FILE__ ) . "images/delete.png"; echo " style='width: 18px; height: 18px'>
		      </td>
		    </tr>
		    <tr>
		      <td><p>5</p></td>
		      <td><p>Eichiro Oda</p></td>
		      <td><p>Tomo manga n 18</p></td>
		      <td><p>15/10/2013</p></td>
		      <td><p>25/12/2014</p></td>
		      <td>
			<input type='image' src="; echo plugin_dir_url( __FILE__ ) . "images/edit.png"; echo " style='width: 18px; height: 18px'>
			<input type='image' src="; echo plugin_dir_url( __FILE__ ) . "images/delete.png"; echo " style='width: 18px; height: 18px'>
		      </td>
		    </tr>
		    <tr>
		      <td><p>6</p></td>
		      <td><p>Willy Fog</p></td>
		      <td><p>Globo aeroestático</p></td>
		      <td><p>15/10/2013</p></td>
		      <td><p>25/12/2014</p></td>
		      <td>
			<inut type='image' src="; echo plugin_dir_url( __FILE__ ) . "images/edit.png"; echo " style='width: 18px; height: 18px'>
			<inut type='image' src="; echo plugin_dir_url( __FILE__ ) . "images/delete.png"; echo " style='width: 18px; height: 18px'>
		      </td>
		    </tr>
		  </table>
		  <p id='mensaje_asignacion'></p>
		</div>
			
		<div class='ionTabs__preloader'></div>
		</div>
		
	      </div>
	      
	      <script>
		function nuevaAsignacion(){
		  var x;
		  var dispositivo = prompt('Dispositivo');
		  var usuario = prompt('Usuario');
		  var fecha_inicio = prompt('Fecha inicio');
		  var fecha_fin = prompt('Fecha fin');

		  if(dispositivo != null){
		    x = 'Se ha agregado la asignación del dispositivo <b>' + dispositivo + '</b> al usuario <b>' + usuario + '</b>.';
		    document.getElementById('mensaje').innerHTML=x;
		    document.getElementById('mensaje_error').innerHTML=null;
		  }else{
		    x = 'No se ha podido añadir la asignación. Compruebe los datos introducidos.';
		    document.getElementById('mensaje_error').innerHTML=x;
		    document.getElementById('mensaje').innerHTML=null;
		  }
		}

		function editarAsignacion(){

		}
	      </script>
			
	      <script>    
		$.ionTabs('#menu_inventario_tabs'); //one tabs group
	      </script>
	    </div>
	  ";
	  
	}else{
	  echo "
	    <div id='login_gestion_inventario'>
	      <form id='login_gestion_inventario_form' method='post' action='#'>
		<table id='login_gestion_inventario_table'>
		  <tr>
		    <td><p>Usuario</p></td>
		    <td><input type='text' id='usuario' name='usuario'></td>
		  </tr>
		  <tr>
		    <td><p>Password</p></td>
		    <td><input type='password' id='password' name='password'></td>
		  </tr>
		</table>";

		if(isset($_POST['login'])){
		  if ($_POST['usuario'] == 'mcanes' && $_POST['password'] == '1234'){
		    $_SESSION['user'] = $_POST['usuario'];
		  }else{
		    echo "<p style='color:red'>Fallo en la autenticación. Revíse sus datos de acceso.</p>";
		  }
		} 
		echo "
		<input type='submit' name='login' id='login' value='Entrar'>
		<input type='reset' name='reset' id='reset' value='Reset'>
	      </form>
	    </div>
	  ";

	}

	if(isset($_POST['salir'])) {  
	  session_unset();
	  session_destroy();
	} 
}
		
?>
