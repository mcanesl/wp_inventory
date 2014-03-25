<html>
<head>
    <link rel="stylesheet" href="js/ion.tabs-master/css/ion.tabs.css" />
    <link rel="stylesheet" href="js/ion.tabs-master/css/ion.tabs.skinBordered.css" />
    <link rel="stylesheet" href="css/style.css" />
    <script src="js/jquery/jquery-2.1.0.min.js"></script>
    <link rel="stylesheet" href="css/wp_inventory.css" />
    <script src="js/ion.tabs-master/js/ion-tabs/ion.tabs.min.js "></script>
</head>
<body>
	<script type="text/javascript">
		function iframeLoadedItems() {
		      var iFrameID = document.getElementById('list_items_frame');
		      if(iFrameID) {
			    // here you can make the height, I delete it first, then I make it again
			    iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
		      }
		  }

		  function iframeLoadedUsers() {
			var iFrameID = document.getElementById('list_users_frame');
			if(iFrameID) {
			    // here you can make the height, I delete it first, then I make it again
			    iFrameID.height = "660px";
			    iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
			}
		  }
	</script> 

	<script>
		// one tabs group
		$.ionTabs("#tabs_1");

	</script>




	<?php
		session_start ();
		if ( $_SESSION['login']) {
			echo '
			      <div class="ionTabs" id="tabs_1" data-name="Tabs_Group_name">
				  <ul class="ionTabs__head">
				      <li class="ionTabs__tab" data-target="Tab_1_name">Items list</li>
				      <li class="ionTabs__tab" data-target="Tab_2_name">Asignations list</li>
				      <li class="ionTabs__tab" data-target="Tab_3_name">Users list</li>
				  </ul>
				  <div class="ionTabs__body" style="height:435px;">
				      <div class="ionTabs__item" data-name="Tab_1_name">
					    <iframe id="list_items_frame" onload="iframeLoadedItems()" src="./list_items.php" width="100%" seamless height="450px"frameborder="0"></iframe>
				      </div>
      				      <div class="ionTabs__item" data-name="Tab_2_name" >
					    <iframe id="list_items_frame" onload="iframeLoadedUsers()" src="./list_asignations.php" width="100%" seamless height="450px" frameborder="0"></iframe>
				      </div>				      
      				      <div class="ionTabs__item" data-name="Tab_3_name">
					    <iframe id="list_items_frame" onload="iframeLoadedUsers()" src="./list_users.php" width="100%" seamless frameborder="0" height="450px"></iframe>
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
		}else {
			echo '<div class="error_msg">
					User not registered in the system.  Go to login window.
			       </div>';
		}
		

	?>
	




</body>
</html>

