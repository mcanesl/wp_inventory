<?php
/*
Plugin Name: Gestion inventario
Plugin URI: 
Description: No description.
Author: Marta Canes
Version: 0.1
Author URI: 
*/


// Now we set that function up to execute when the admin_notices action is called
add_shortcode( 'gestion', 'gestion_inventario' );

session_start();

function gestion_inventario(){

	if (!empty($_SESSION['user'])){
	echo "



		<div id='listado_gestion_inventario'>
				<input type='image' src='https://cdn3.iconfinder.com/data/icons/eightyshades/512/14_Add-128.png' onclick='nuevaAsignacion()' style='width: 18px; height: 18px'> Nueva asignación
				
				<p id='mensaje' style='margin-top: 10px; border: 1px solid black; background-color: #CEF6D8'></p>
				<p id='mensaje_error' style='margin-top: 10px; border: 1px solid black; background-color: #F5A9A9'></p>
				<script>
				function nuevaAsignacion()
				{
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
						<input type='image' src='http://icons.iconarchive.com/icons/visualpharm/icons8-metro-style/256/Editing-Edit-icon.png' style='width: 18px; height: 18px' onclick='editarAsignacion()'>
						<img src='https://cdn2.iconfinder.com/data/icons/flat-ui-icons-24-px/24/cross-24-512.png' style='width: 18px; height: 18px'>
					</td>				
				</tr>
				<tr>
					<td><p>2</p></td>
					<td><p>Alicia Wonderland</p></td>
					<td><p>Dispositivo R18</p></td>
					<td><p>16/08/2013</p></td>
					<td><p>25/12/2014</p></td>
					<td>
						<img src='http://icons.iconarchive.com/icons/visualpharm/icons8-metro-style/256/Editing-Edit-icon.png' style='width: 18px; height: 18px'>
						<img src='https://cdn2.iconfinder.com/data/icons/flat-ui-icons-24-px/24/cross-24-512.png' style='width: 18px; height: 18px'>
					</td>
				</tr>
				<tr>
					<td><p>3</p></td>
					<td><p>Darth Vader</p></td>
					<td><p>Sable de luz</p></td>
					<td><p>18/08/2013</p></td>
					<td><p>25/12/2014</p></td>
					<td>
						<img src='http://icons.iconarchive.com/icons/visualpharm/icons8-metro-style/256/Editing-Edit-icon.png' style='width: 18px; height: 18px'>
						<img src='https://cdn2.iconfinder.com/data/icons/flat-ui-icons-24-px/24/cross-24-512.png' style='width: 18px; height: 18px'>
					</td>
				</tr>
				<tr>
					<td><p>4</p></td>
					<td><p>Akira Toriyama</p></td>
					<td><p>Tomo manga n 16</p></td>
					<td><p>15/10/2013</p></td>
					<td><p>25/12/2014</p></td>
					<td>
						<img src='http://icons.iconarchive.com/icons/visualpharm/icons8-metro-style/256/Editing-Edit-icon.png' style='width: 18px; height: 18px'>
						<img src='https://cdn2.iconfinder.com/data/icons/flat-ui-icons-24-px/24/cross-24-512.png' style='width: 18px; height: 18px'>
					</td>
				</tr>
				<tr>
					<td><p>5</p></td>
					<td><p>Eichiro Oda</p></td>
					<td><p>Tomo manga n 18</p></td>
					<td><p>15/10/2013</p></td>
					<td><p>25/12/2014</p></td>
					<td>
						<img src='http://icons.iconarchive.com/icons/visualpharm/icons8-metro-style/256/Editing-Edit-icon.png' style='width: 18px; height: 18px'>
						<img src='https://cdn2.iconfinder.com/data/icons/flat-ui-icons-24-px/24/cross-24-512.png' style='width: 18px; height: 18px'>
					</td>
				</tr>
				<tr>
					<td><p>6</p></td>
					<td><p>Willy Fog</p></td>
					<td><p>Globo aeroestático</p></td>
					<td><p>15/10/2013</p></td>
					<td><p>25/12/2014</p></td>
					<td>
						<img src='http://icons.iconarchive.com/icons/visualpharm/icons8-metro-style/256/Editing-Edit-icon.png' style='width: 18px; height: 18px'>
						<img src='https://cdn2.iconfinder.com/data/icons/flat-ui-icons-24-px/24/cross-24-512.png' style='width: 18px; height: 18px'>
					</td>
				</tr>
			</table>
			<p id='mensaje_asignacion'></p>
		</div>
	";
	}
	else
	{
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

					if(isset($_POST['login']))
					{
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