<html>
<head>
    <link rel="stylesheet" href="css/wp_inventory.css" />
    <link rel="stylesheet" href="css/toolbar.css" />
    <link rel="stylesheet" href="css/hover-min.css " />
    <link rel="stylesheet" href="css/jquery-ui.css " />
    <script src="js/jquery/jquery-2.1.0.min.js"></script>
    <script src="js/jquery/jquery-ui.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">

	 <script>
		$(function() {
			$('#tabs').tabs();
			
		});
		 $(function() {
			$('#dialog-confirm').dialog({
			autoOpen: false,
			resizable: false,
			height:240,
			modal: true,
				buttons: {
					"Yes, I'm sure": function() {
						window.location.assign("exit.php")
						$( this ).dialog( "close" );
					},
					Cancel: function() {
						$( this ).dialog( "close" );
					}
				}
			});
		 });

		function iframeLoaded1() {
		      var iFrameID = document.getElementById('operations_frame1');
		      if(iFrameID) {
			    iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
		      }
		  }

		function iframeLoaded2() {
		      var iFrameID = document.getElementById('operations_frame2');
		      if(iFrameID) {
			    iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
		      }
		  }

		function iframeLoaded3() {
		      var iFrameID = document.getElementById('operations_frame3');
		      if(iFrameID) {
			    iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
		      }
		  }

		$(document).on('click', '#refresh-1', function( event ) {
			var ifr =  document.getElementsByName('operations_frame1')[0];
			ifr.src = ifr.src;
		});

		$(document).on('click', '#refresh-2', function( event ) {
			var ifr =  document.getElementsByName('operations_frame2')[0];
			ifr.src = ifr.src;
		});

		$(document).on('click', '#refresh-3', function( event ) {
			var ifr =  document.getElementsByName('operations_frame3')[0];
			ifr.src = ifr.src;
		});


		function dialog() {
      			$( "#dialog-confirm" ).dialog( "open" );
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
						<li ><a id="refresh-1" href="#tabs-1"><img src="images/user-4.png" width="24px" height="24px" title="User asignations"></img> User asignations</a></li>
						<li><a id="refresh-2" href="#tabs-2"><img src="images/list.png" width="24px" height="24px" title="General lists"></img> Lists</a></li>';

						if ($_SESSION['admin']){
						echo '
							<li><a id="refresh-3" href="#tabs-3"><img src="images/compose-3.png" width="24px" height="24px" title="Add new item"></img> New item</a></li>';
						}
					echo '
						<img class="msgstatus" src="images/out.png" onclick="dialog()" width="16px" height="16px" title="Exit"></img>	
					</ul>
					<div id="tabs-1">
						<iframe id="operations_frame1" name="operations_frame1" onload="iframeLoaded1()" src="./user_asignations.php" width="100%" seamless frameborder="0"></iframe>
					</div>
					<div id="tabs-2">
						<iframe id="operations_frame2" name="operations_frame2" onload="iframeLoaded2()" src="./lists.php" width="100%" seamless frameborder="0"></iframe>
					</div>
					<div id="tabs-3">
						<iframe id="operations_frame3" name="operations_frame3" onload="iframeLoaded3()" src="./new_item.php" width="100%" seamless frameborder="0"></iframe>
					</div>
				</div>';
				
		}else {

			echo '<div class="error_msg">
					User not registered in the system.  Go to login window.
			       </div>';
		}

	echo '			<div id="dialog-confirm" title="Exit">
					<p>Are you sure do you want to exit?</p>
				</div>';
		

	?>
</body>
</html>


