<head>
    <link rel="stylesheet" href="js/ion.tabs-master/css/ion.tabs.css" />
    <link rel="stylesheet" href="js/ion.tabs-master/css/ion.tabs.skinBordered.css" />
    <link rel="stylesheet" href="css/normalize.css" />
</head>
<script src="js/jquery/jquery-2.1.0.min.js"></script>
<script src="js/ion.tabs-master/js/ion-tabs/ion.tabs.min.js "></script>

<body>




<script>
// one tabs group
$.ionTabs("#tabs_1");  

</script>




	<?php
		session_start(); 
		if ( $_SESSION['login'] and (! $_POST ['exit']) ) {
			echo 'Bienvenido ' . $_SESSION['login'] . '<br>';
			if ( $_SESSION['admin'] ) {
				echo 'wow eres admin...';
				echo '
				      <div class="ionTabs" id="tabs_1" data-name="Tabs_Group_name">
					  <ul class="ionTabs__head">
					      <li class="ionTabs__tab" data-target="Tab_1_name">Listado de items:</li>
					      <li class="ionTabs__tab" data-target="Tab_2_name">Listado de asignaciones:</li>
					      <li class="ionTabs__tab" data-target="Tab_3_name">Operaciones</li>
					  </ul>
					  <div class="ionTabs__body">
					      <div class="ionTabs__item" data-name="Tab_1_name">
						    <iframe src="./list_items.php" height="600px" width="100%" seamless ></iframe>
					      </div>
					      <div class="ionTabs__item" data-name="Tab_2_name">
						    <iframe src="./list_asignations.php" height="600px" width="100%" seamless ></iframe>
					      </div>
					      <div class="ionTabs__item" data-name="Tab_3_name">
      						  <iframe src="www.google.es" seamless ></iframe>
					      </div>

					      <div class="ionTabs__preloader"></div>
					  </div>
				      </div>
				      ';
				 echo '
					<script>
					    $.ionTabs("#tabs_1"); // one tabs group
					</script>
				      ';	
			}
		}else {
			echo 'Usuario no registrado en el sistema... ';
		}
		if ( $_POST ['exit'] ) {
			session_destroy();
			header ("Location: " . network_home_url() );
			#header ("Location: http://localhost/wordpress" ); 
			
			
		}
		

	?>
	<form method="post"
		      enctype="application/x-www-form-urlencoded"
		      >
		<input type="hidden" name="exit" value="true">
 		<p><button id="go">exit</button></p>
 	</form>
	




</body>
</html>


