<html>
<head>
    <link rel="stylesheet" href="css/wp_inventory.css" />
    <style type="text/css">
	  body {background-color:#f6f6f6;}
    </style> 
</head>
 
<body>

	<?php
		session_start(); 
		if ( $_SESSION['login']) {
			echo '
				<div id="about">
					<img src="images/gato2.png" width="340px"></img>
					<div class="texto">Wordpress inventory management</div>
					<ul>
						<li><a href="https://github.com/mcanesl">Marta Canes López</li>
						<li><a href="http://www.bluethinking.com">Saúl Blanco Fortes</a></li>
					</ul>
				</div>
			';
		}
	?>
</body>
</html>
