<html>
<head>
    <link rel="stylesheet" href="css/wp_inventory.css" />
    <link rel="stylesheet" href="css/toolbar.css" />
    <link rel="stylesheet" href="css/hover-min.css " />
    <link rel="stylesheet" href="css/jquery-ui.css " />
    <script src="js/jquery/jquery-2.1.0.min.js"></script>
    <script src="js/jquery/jquery-ui.js"></script>

	 <script>
		$(function() {
		$( "#tabs" ).tabs();
		});


		function iframeLoaded() {
		      var iFrameID = document.getElementById('operations_frame');
		      if(iFrameID) {
			    iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
		      }
		  }
	</script>


</head>
 
<body>

	<?php
		session_start(); 
		if ( $_SESSION['login'] and (! isset ($_GET ['exit']) )) {
				 
			echo '
				<div id="tabs">
					<ul>
						<li><a href="#tabs-1"><img src="images/user-4.png" width="24px" height="24px" title="User asignations"></img> User asignations</a></li>
						<li><a href="#tabs-2"><img src="images/list.png" width="24px" height="24px" title="General lists"></img> Lists</a></li>';

						if ($_SESSION['admin']){
						echo '
							<li><a href="#tabs-3"><img src="images/compose-3.png" width="24px" height="24px" title="Add new item"></img> New item</a></li>';
						}
					echo '
						<a href="exit.php" target="operations_frame" class="msgstatus"><img src="images/out.png" width="16px" height="16px" title="Exit"></img></a> 
						<a href="about.php" target="operations_frame" class="msgstatus"><img src="images/info.png" width="16px" height="16px" title="About"></img></a>				
					</ul>
					<div id="tabs-1">
						<iframe id="operations_frame" onload="iframeLoaded()" src="./user_asignations.php" width="100%" seamless frameborder="0"></iframe>
					</div>
					<div id="tabs-2">
						<iframe id="operations_frame" onload="iframeLoaded()" src="./lists.php" width="100%" seamless frameborder="0"></iframe>
					</div>
					<div id="tabs-3">
						<iframe id="operations_frame" onload="iframeLoaded()" src="./new_item.php" width="100%" seamless frameborder="0"></iframe>
					</div>
				</div>';
				
		}else {

			echo '<div class="error_msg">
					User not registered in the system.  Go to login window.
			       </div>';
		}
		

	?>
</body>
</html>


