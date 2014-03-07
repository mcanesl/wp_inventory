<HEAD>
<TITLE>Wellcome</TITLE>
</HEAD>

<BODY BGCOLOR="WHITE">


	<?php
		session_start(); 
		if ( $_SESSION['login'] and (! $_POST ['exit']) ) {
			echo 'Bienvenido ' . $_SESSION['login'] . '<br>';
			if ( $_SESSION['admin'] ) {
				echo 'wow eres admin...';
			}
		}else {
			echo 'No se quien eres... ';
		}
		if ( $_POST ['exit'] ) {
			session_destroy();
			header ("Location: login.php#"); 
			
		}
		

	?>
	<form method="post"
		      enctype="application/x-www-form-urlencoded"
		      action="#">
		<input type="hidden" name="exit" value="true">
 		<p><button>exit</button></p>
	</form>

</BODY>
