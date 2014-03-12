<html>
<head>
    <link rel="stylesheet" href="js/ion.tabs-master/css/ion.tabs.css" />
    <link rel="stylesheet" href="js/ion.tabs-master/css/ion.tabs.skinBordered.css" />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="css/wp_inventory.css" />
    <link rel="stylesheet" href="css/toolbar.css" />
    <script src="js/jquery/jquery-2.1.0.min.js"></script>
    <script src="js/ion.tabs-master/js/ion-tabs/ion.tabs.min.js "></script>
<script>
// one tabs group
$.ionTabs("#tabs_1");  
</script>

<script type="text/javascript">
  function iframeLoadedItems() {
      var iFrameID = document.getElementById('list_items_frame');
      if(iFrameID) {
            // here you can make the height, I delete it first, then I make it again
            iFrameID.height = "";
            iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
      }   
  }
  
    function iframeLoadedUsers() {
      var iFrameID = document.getElementById('list_users_frame');
      if(iFrameID) {
            // here you can make the height, I delete it first, then I make it again
            iFrameID.height = "";
            iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
      }   
  }
</script> 

<script>

$(document).ready(function() {	

	//select all the a tag with name equal to modal
	$('a[name=modal]').click(function(e) {
		//Cancel the link behavior
		e.preventDefault();
		
		//Get the A tag
		var id = $(this).attr('href');
	
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(1000);	
		$('#mask').fadeTo("slow",0.8);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 
	
	});
	
	//if close button is clicked
	$('.window .close').click(function (e) {
		//Cancel the link behavior
		e.preventDefault();
		
		$('#mask').hide();
		$('.window').hide();
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
	});			

	$(window).resize(function () {
	 
 		var box = $('#boxes .window');
 
        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
      
        //Set height and width to mask to fill up the whole screen
        $('#mask').css({'width':maskWidth,'height':maskHeight});
               
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();

        //Set the popup window to center
        box.css('top',  winH/2 - box.height()/2);
        box.css('left', winW/2 - box.width()/2);
	 
	});
	
});

</script>




</head>
 
<body>

	<?php
		session_start(); 
		if ( $_SESSION['login'] and (! $_GET ['exit']) ) {
			echo '
				<div id="toolbar">
					<nav>
						  <ul>
						    <li class="active"><a href="#dialog_new_item" name="modal"><img src="images/add.png" width="55" alt="new item"></img></a></li>
						    <li><img src="images/delete.png" width="55" alt="delete item"><a href="#"></a></img></li>
						    <li><img src="images/about.png" width="55" alt="info"><a href="#"></a></img></li>
						    <li><a alt="exit" href="?exit=true"><img src="images/exit.png" width="55" alt="exit"></img></a></li>
						    <li class="status">login as <b>'. $_SESSION['login'] .'	</b></li>
						  </ul>

					</nav>				
				 </div>';
				 
				 
				 
			if ( $_SESSION['admin'] ) {
				echo '
				      <div class="ionTabs" id="tabs_1" data-name="Tabs_Group_name">
					  <ul class="ionTabs__head">
					      <li class="ionTabs__tab" data-target="Tab_1_name">Listado de items:</li>
					  </ul>
					  <div class="ionTabs__body">
					      <div class="ionTabs__item" data-name="Tab_1_name">
						    <iframe id="list_items_frame" onload="iframeLoadedItems()" src="./list_items.php" width="100%" seamless frameborder="0"></iframe>
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
			echo '
			
			      <div id="boxes">
				<div id="dialog_new_item" class="window">
				  <a href="#"class="close"/>Close it</a>
				  <div style="margin-top:10px;">
				    <iframe src="./new_item.php" width="100%" height="400px" frameborder="0"></iframe>
				  </div>
				</div>
	
				<div id="dialog_delete_item" class="window">
				  <a href="#"class="close"/>Close it</a>
				  <div style="margin-top:10px;">
				    <iframe src="./delete_item.php" width="auto" height="auto" frameborder="0"></iframe>
				  </div>
				</div>

				<div id="mask"></div>
			      </div>
			  ';
			
			
		}else {
			echo '<div class="error_msg">
					User not registered in the system.  Go to login window.
			       </div>';
		}
		if ( $_GET ['exit'] ) {
			session_destroy();
			header ("Location: " . network_home_url() );
			#header ("Location: http://localhost/wordpress" ); 
			
			
		}
		

	?>
	




</body>
</html>


