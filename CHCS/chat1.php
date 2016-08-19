<?php
	session_start();
	include("config_db1.php");
	if(!isset($_SESSION['username']) || (trim($_SESSION['username']) == '')) {
		header("location: index.php");
		exit();
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>        
        <!-- META SECTION -->
        <title>DPP-Chat</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->   
		<script type="text/javascript" src="chat.js"></script>
		<script type="text/javascript">
	var chat = new Chat('<?php echo $file; ?>');
	chat.init();
	chat.getUsers(<?php echo "'" . $name ."','" .$_SESSION['username'] . "'"; ?>);
	var name = '<?php echo $_SESSION['username'];?>';
</script>
		<script type="text/javascript" src="settings.js"></script> 

    </head>

<body data-default-background-img="assets/images/other_images/bg2.jpg" data-overlay="true" data-overlay-opacity="0.35">
<!-- Outer Container -->
          <div class="page-container">
		   <?php include('navication.php'); ?>
		   <div class="page-content">
		   
		   <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    <!-- SEARCH -->
                    <li class="xn-search">
                        <form role="form">
                            <input type="text" id="search" onBlur="dispid()" name="search" placeholder="Search..."/>
                        </form>
                    </li>   
                    <!-- END SEARCH -->
                    <!-- POWER OFF -->
                    <li class="xn-icon-button pull-right last">
                        <a href="#"><span class="fa fa-power-off"></span></a>
                        <ul class="xn-drop-left animated zoomIn">
                            <li><a href="pages-lock-screen.html"><span class="fa fa-lock"></span> Lock Screen</a></li>
                            <li><a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span> Sign Out</a></li>
                        </ul>                        
                    </li> 
                    <!-- END POWER OFF -->
                    <!-- MESSAGES -->
                    <li class="xn-icon-button pull-right">
                        <a href="#"><span class="fa fa-comments"></span></a>
                        <div class="informer informer-danger">4</div>
                        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="fa fa-comments"></span> Messages</h3>                                
                                <div class="pull-right">
                                    <span class="label label-danger">4 new</span>                                </div>
                            </div>
                            <div class="panel-body list-group list-group-contacts scroll" style="height: 200px;">
                                <a href="#" class="list-group-item">
                                    <div class="list-group-status status-online"></div>
                                    <img src="assets/images/users/user2.jpg" class="pull-left" alt="John Doe"/>
                                    <span class="contacts-title">John Doe</span>
                                    <p>Praesent placerat tellus id augue condimentum</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <div class="list-group-status status-away"></div>
                                    <img src="assets/images/users/user.jpg" class="pull-left" alt="Dmitry Ivaniuk"/>
                                    <span class="contacts-title">Dmitry Ivaniuk</span>
                                    <p>Donec risus sapien, sagittis et magna quis</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <div class="list-group-status status-away"></div>
                                    <img src="assets/images/users/user3.jpg" class="pull-left" alt="Nadia Ali"/>
                                    <span class="contacts-title">Nadia Ali</span>
                                    <p>Mauris vel eros ut nunc rhoncus cursus sed</p>
                                </a>
                                <a href="#" class="list-group-item">
                                    <div class="list-group-status status-offline"></div>
                                    <img src="assets/images/users/user6.jpg" class="pull-left" alt="Darth Vader"/>
                                    <span class="contacts-title">Darth Vader</span>
                                    <p>I want my money back!</p>
                                </a>                            </div>     
                            <div class="panel-footer text-center">
                                <a href="pages-messages.html">Show all messages</a>                            </div>                            
                        </div>                        
                    </li>
                    <!-- END MESSAGES -->
                    <!-- TASKS -->
                    <li class="xn-icon-button pull-right">
                        <a href="#"><span class="fa fa-tasks"></span></a>
                        <div class="informer informer-warning">3</div>
                        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="fa fa-tasks"></span> Tasks</h3>                                
                                <div class="pull-right">
                                    <span class="label label-warning">3 active</span>                                </div>
                            </div>
                            <div class="panel-body list-group scroll" style="height: 200px;">                                
                                <a class="list-group-item" href="#">
                                    <strong>Phasellus augue arcu, elementum</strong>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">50%</div>
                                    </div>
                                    <small class="text-muted">John Doe, 25 Sep 2015 / 50%</small>                                </a>
                                <a class="list-group-item" href="#">
                                    <strong>Aenean ac cursus</strong>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">80%</div>
                                    </div>
                                    <small class="text-muted">Dmitry Ivaniuk, 24 Sep 2015 / 80%</small>                                </a>
                                <a class="list-group-item" href="#">
                                    <strong>Lorem ipsum dolor</strong>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%;">95%</div>
                                    </div>
                                    <small class="text-muted">John Doe, 23 Sep 2015 / 95%</small>                                </a>
                                <a class="list-group-item" href="#">
                                    <strong>Cras suscipit ac quam at tincidunt.</strong>
                                    <div class="progress progress-small">
                                        <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">100%</div>
                                    </div>
                                    <small class="text-muted">John Doe, 21 Sep 2015 /</small><small class="text-success"> Done</small>                                </a>                            </div>     
                            <div class="panel-footer text-center">
                                <a href="pages-tasks.html">Show all tasks</a>                            </div>                            
                        </div>                        
                    </li>
                    <!-- END TASKS -->
                    <!-- LANG BAR -->
                    <li class="xn-icon-button pull-right">
                        <a href="#"><span class="flag flag-gb"></span></a>
                        <ul class="xn-drop-left xn-drop-white animated zoomIn">
                            <li><a href="#"><span class="flag flag-gb"></span> English</a></li>
                            <li><a href="#"><span class="flag flag-de"></span> Deutsch</a></li>
                            <li><a href="#"><span class="flag flag-cn"></span> Chinese</a></li>
                        </ul>                        
                    </li> 
                    <!-- END LANG BAR -->
                </ul>
				
				<ul class="breadcrumb push-down-0">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Pages</a></li>                    
                    <li class="active">Messages</li>
                </ul>
  <!-- #left-sidebar -->
 
  
  
  <div class="content-frame">                                    
                    <!-- START CONTENT FRAME TOP -->
                    <div class="content-frame-top">                        
                        <div class="page-title">                    
                            <h2><span class="fa fa-comments"></span> Messages</h2>
                        </div>  
						                                                  
                        <div class="pull-right">                            
                            <button class="btn btn-danger"><span class="fa fa-book"></span> Contacts</button>
                            <button class="btn btn-default content-frame-right-toggle"><span class="fa fa-bars"></span></button>
                        </div>                           
                    </div>
                    <!-- END CONTENT FRAME TOP -->
                    
                    <!-- START CONTENT FRAME RIGHT -->
                    <div class="content-frame-right">
                        
                        <div class="list-group list-group-contacts border-bottom push-down-10">
						
						<?php 
						$cmd="select * from user_login";
						$res=mysql_query($cmd);
						while($rs=mysql_fetch_array($res))
						{
						if($rs['username']!=$_SESSION['username']) {
						echo
                            '<a href="#" class="list-group-item" onClick="history(\''.$rs['username'].'\')">                                 
                                <div class="list-group-status status-online"></div>
                                <img src="assets/images/users/user.jpg" class="pull-left" alt="Dmitry Ivaniuk">
                                <span class="contacts-title">'.$rs['username'].'</span>';
								if($rs['role']==1)
                                echo '<p>Admin</p>';
								else
								 echo '<p>User</p>';
                            echo '</a> ';
							} }
							?>   
                                                    </div>
                        
						
						<script>
						function history(x)
						{
						//alert(x);
						var s=x;
						$("#msg").empty();
						$("#sendbox").empty();
						var msg='<div class="panel panel-default push-up-10"><div class="panel-body panel-body-search"><div class="input-group"> <div class="input-group-btn"><button class="btn btn-default"><span class="fa fa-camera"></span></button><button class="btn btn-default"><span class="fa fa-chain"></span></button></div><input type="text" id="sent" class="form-control" placeholder="Your message..."/><div class="input-group-btn"><button class="btn btn-default" onClick="upload(\''+x+'\')">Send</button></div></div></div></div>';
		$("#sendbox").append(msg);
							$.ajax({
		type: "POST",
		url: "getmsg.php",
		data: {x:x},
		success: function(msg) {
		var msg=$.trim(msg);
		

		if(msg=="")
		{
		alert('No conversation found');
		return false;
		}
		var v=msg.split('#');
		var len=v.length;
		//alert(len);
		var j=1;
		for (i = 0; i <len; i++) 
		{
		var s=j++;
		var x1= v[i].split("~");
		//$("#tbl").show();
		if(x!=x1[0])
		{
		var txt='<div class="item in item-visible"><div class="image"><img src="return_profile_img.php?name='+x1[0]+'" alt="'+x1[0]+'"></div><div class="text"><div class="heading"><a href="#">'+x1[4]+'('+x1[0]+')</a><span class="date">'+x1[3]+'</span></div>'+x1[2]+'</div></div>';
		}
		else
		{
		var txt='<div class="item item-visible"><div class="image"><img src="return_profile_img.php?name='+x1[0]+'" alt="'+x1[0]+'"></div><div class="text"><div class="heading"><a href="#">'+x1[4]+'('+x1[0]+')</a><span class="date">'+x1[3]+'</span></div>'+x1[2]+','+x1[4]+'</div></div>';
		}
		
		
	$("#msg").prepend(txt);
		
		}
		
		
		
		}
		});
		$("#msg1").html(s);
						}
						
						
	function upload(x)
	{
	var sent=$("#sent").val();
	//alert(sent);
	$.ajax({
		type: "POST",
		url: "sentmsg.php",
		data: {x:x, 
		sent:sent,},
		success: function(msg) {
		var msg=$.trim(msg);
		if(msg!="")
		{
/*		var txt='<div class="item in item-visible"><div class="image"><img src="assets/images/users/user2.jpg" alt="John Doe"></div><div class="text"><div class="heading"><a href="#">'+msg+'</a><span class="date">'+new Date($.now());+'</span></div>'+sent+'dfds</div></div>';*/
		var ms=msg.split("(");
		var txt = '<div class="item in item-visible"><div class="image"><img src="return_profile_img.php?name='+ms[0]+'"></div><div class="text"><div class="heading"><a href="#">'+msg+'</a><span class="date">'+new Date($.now())+'</span></div>'+sent+'</div></div>';
		$("#msg").append(txt);
		//alert(sent);
		$("#sent").val("");
		}
		
		
		
		}
		
	});
	
		//alert(x);
	}
	
	
						</script>
					
                        <div class="block">
                            <h4>Discuss</h4>
                            <div class="list-group list-group-simple">                                
                                 
								 
								 
								 
                            </div>
                        </div>
                    </div>
					 <div style="display:none" id="msg1"></div>
                    <!-- END CONTENT FRAME RIGHT -->
                
                    <!-- START CONTENT FRAME BODY -->
			
					
                    <div class="content-frame-body content-frame-body-left">
                        
                             <div id="msg"  class="messages messages-img">
							
                            
                         
                        </div>                   
                        <div id="sendbox">
						
						
                        </div>
                    </div>
					
					
					
					
                    <!-- END CONTENT FRAME BODY -->      
                </div>
  <!-- end: Left Sidebar -->
  
  <!-- #main-content -->
  
  <!-- Footer -->
  </div>
  <!-- end: Footer -->
</div>
<!-- #outer-container -->
<!-- end: Outer Container -->
<!-- Modal -->
<!-- DO NOT MOVE, EDIT OR REMOVE - this is needed in order for popup content to be populated in it -->
<!-- Javascripts-->

<!-- Jquery and Bootstrap JS -->
<div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="pages-login.html" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->                        
        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>        
        <!-- END PLUGINS -->

        <!-- THIS PAGE PLUGINS -->
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <!-- END PAGE PLUGINS -->     

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="js/settings.js"></script>
        
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>        
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->         
    
    <!-- COUNTERS // NOT INCLUDED IN TEMPLATE -->
        <!-- GOOGLE -->
        <div id="serachdis" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Search result</h4>
      </div>
      <div class="modal-body">
        	
	
										
      <div class="col-md-12">  
                        <table class="table" border="1" cellpadding="5" cellspacing="5">
<thead>
	<tr>
		<th>Branch</th>
		<th>Patient ID</th>
		<th>Patient Name</th>
		<th>Parents / Spouse Name</th>
		<th>Age</th>
		<th>Gender</th>
		<th>Contact No.</th>
		<th>Occupation</th>
		<th>Address</th>
		<th>Date</th>
		<th>View</th>		
	</tr>
</thead>
	<tbody id="divserachdis">	
	<tbody></table>                   
									
											 
											
                                        </div>
										
                                        	
	
      </div>
      <div class="modal-footer">
	  <button type="button" class="btn btn-default" onClick="updateddiog()" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
        <!-- END GOOGLE -->
        
        <!-- YANDEX -->
        <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter25836617 = new Ya.Metrika({id:25836617,
                            webvisor:true,
                            accurateTrackBounce:true});
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
        </script>
        <noscript><div><img src="http://mc.yandex.ru/watch/25836617" style="position:absolute; left:-9999px;" alt="" /></div></noscript>     
        <!-- END YANDEX -->
    <!-- END COUNTERS // NOT INCLUDED IN TEMPLATE -->
</body>
	<script>
		$(document).ready(function(){
   setInterval(function(){ 
  
	var s=$("#msg1").text();
	
	$.ajax({
		type: "POST",
		url: "getupdatemsg.php",
		data:{s:s,},
		success: function(msg) {
		//alert(msg);
		var msg=$.trim(msg);
		if(msg=="")
		return false;
		
		var v=msg.split('#');
		var len=v.length;
		//alert(len);
		var j=1;
		for (i = 0; i <len; i++) 
		{
		var s=j++;
		var x1= v[i].split("~");
		//$("#tbl").show();
		var txt='<div class="item item-visible"><div class="image"><img src="return_profile_img.php?name='+x1[0]+'" alt="John Doe"></div><div class="text"><div class="heading"><a href="#">'+x1[0]+'</a><span class="date">'+x1[3]+'</span></div>'+x1[2]+'</div></div>';
		
	$("#msg").append(txt);
		
		}
		
		}
});
	
   
    }, 5000);
}); </script>

  <script>
  function dispid()
  {
  
  var ser=$("#search").val();
 	if(ser=="")
  return false;
  $.ajax({
			type: "post",
			url: "search.php?ser="+ser,
			success: function(msg) {
			//alert(msg);
				$("#divserachdis").html(msg);
			}
		});
		$('#serachdis').modal('toggle');
  
  }
		$(document).ready(function() {
 	$.ajax({
		type: "GET",
		url: "return_name.php",
		success: function(msg) {
		//alert(msg);
			var availableTags = msg.split("~");
			$( "#search" ).autocomplete({
			  source: availableTags
			});
		}
	});
});
</script>
</html>
