<head>
    <link rel="stylesheet" href="js/ion.tabs-master/css/ion.tabs.css" />
    <link rel="stylesheet" href="js/ion.tabs-master/css/ion.tabs.skinBordered.css" />
    <link rel="stylesheet" href="css/normalize.css" />
</head>
<script src="js/jquery/jquery-2.1.0.min.js"></script>
<script src="js/ion.tabs-master/js/ion-tabs/ion.tabs.min.js "></script>

<body>



<div class="ionTabs" id="tabs_1" data-name="Tabs_Group_name">
    <ul class="ionTabs__head">
        <li class="ionTabs__tab" data-target="Tab_1_name">Tab 1 name</li>
        <li class="ionTabs__tab" data-target="Tab_2_name">Tab 2 name</li>
        <li class="ionTabs__tab" data-target="Tab_3_name">Tab 3 name</li>
    </ul>
    <div class="ionTabs__body">
        <div class="ionTabs__item" data-name="Tab_1_name">
	      <iframe src="./list_items.php" seamless ></iframe>
        </div>
        <div class="ionTabs__item" data-name="Tab_2_name">
            <iframe src="' . plugin_dir_url( __FILE__ ) . 'list_asignations.php" seamless ></iframe>
        </div>
        <div class="ionTabs__item" data-name="Tab_3_name">
            Tab 3 content
        </div>

        <div class="ionTabs__preloader"></div>
    </div>
</div>

<script>
// one tabs group
$.ionTabs("#tabs_1");  


var form = document.getElementById("form-id");

document.getElementById("go").addEventListener("click", function () {
  window.parent.location.href= "google.com";
});

</script>




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
			header ("Location: " . network_home_url() ); 
			
		}
		

	?>
	<form method="post"
		      enctype="application/x-www-form-urlencoded"
		      >
		<input type="hidden" name="exit" value="true">
 		<p><button id="go">exit</button></p>
 	</form>
	<a target="_parent" href="http://localhost/wordpress">link</a>
	




</body>
</html>


