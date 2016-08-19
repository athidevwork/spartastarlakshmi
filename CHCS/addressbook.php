<?php
session_start();
$role=$_SESSION['role'];
//$pid=$_REQUEST['pid'];
 include("config_db1.php");
 $cmd=mysql_query("select * from settings where role='$role'");
 mysql_close($db1);
$sql=mysql_fetch_array($cmd);
$billrights=$sql['print_bill'];
$reqrights=$sql['print_request'];
$prerights=$sql['prescription'];

$uid=$_SESSION['uid'];
?>
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from aqvatarius.com/themes/atlant/html/pages-address-book.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2015 09:47:54 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>        
        <!-- META SECTION -->
        <title>Dpp-Address Book</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <!-- EOF CSS INCLUDE --> 
		<style>
		#users .list {
    padding-top: 20px;
}
</style>  
<link type="text/css" rel="stylesheet" media="all" href="chat/css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="chat/css/screen.css" />
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            
            <!-- START PAGE SIDEBAR -->
             <?php include('navication.php'); ?>

            <!-- END PAGE SIDEBAR -->
            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
                <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    <!-- TOGGLE NAVIGATION -->
                    <li class="xn-icon-button">
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>
                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    <!-- SEARCH -->
                    <li class="xn-search">
                        <form role="form">
                            <input type="text" name="search" placeholder="Search..."/>
                        </form>
                    </li>   
                    <!-- END SEARCH -->
                    <!-- POWER OFF -->
                    <li class="xn-icon-button pull-right last">
                        <a href="#"><span class="fa fa-power-off"></span></a>
                        <ul class="xn-drop-left animated zoomIn">
                      <!--      <li><a href="pages-lock-screen.html"><span class="fa fa-lock"></span> Lock Screen</a></li>-->
                            <li><a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span> Sign Out</a></li>
                        </ul>                        
                    </li> 
                    <!-- END POWER OFF -->
                    <!-- MESSAGES -->
                    <li class="xn-icon-button pull-right"> <a href="#"><span class="fa fa-comments"></span></a>
        <div id="new" class="informer informer-danger"></div>
        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
          <div class="panel-heading">
            <h3 class="panel-title"><span class="fa fa-comments"></span> Messages</h3>
            <div  class="pull-right"> <span id="new1" class="label label-danger"></span> </div>
          </div>
          <div id="appmsg" class="panel-body list-group list-group-contacts scroll" style="height: 200px;"> 
		  
		  
		  
		  
		  </div>
          <div class="panel-footer text-center"> <a href="messages.php">Show all messages</a> </div>
        </div>
      </li>
      <!-- END MESSAGES -->
      <!-- TASKS -->
	  <?php
		include("config_db2.php");
		$sqlx = mysql_query("SELECT * FROM patientdetails WHERE hold = 10");
		$cnt = mysql_num_rows($sqlx);
	  ?>
      <li class="xn-icon-button pull-right"> <a href="#"><span class="fa fa-tasks"></span></a>
        <div class="informer informer-warning"><?php echo $cnt ?></div>
        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
          <div class="panel-heading">
            <h3 class="panel-title"><span class="fa fa-tasks"></span> Tasks</h3>
            <div class="pull-right"> <span class="label label-warning"><?php echo $cnt ?> active</span> </div>
          </div>
          <div class="panel-body list-group scroll" style="height: 200px;">
		   <?php
		   		while($rsx = mysql_fetch_array($sqlx)){
					echo '<a class="list-group-item" href="pausecom.php?pid='.$rsx['patientid'].'"> <strong>'.$rsx['patientsalutation'].' '.$rsx['patientname'].'</strong><br />
						<div class="progress progress-small progress-striped active">
						<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 10%;">50%</div>
						</div><small class="text">'.$rsx['contactno'].', '.$rsx['address'].'</small> </a>';
				}
			?>
			</div>
          <!--<div class="panel-footer text-center"> <a href="#">Show all tasks</a> </div>-->
        </div>
      </li>
                    <!-- END LANG BAR -->
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->                    
                
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    
                    <li class="active">Address Book</li>
                </ul>
                <!-- END BREADCRUMB -->                                                
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-users"></span> Address Book <small> </small></h2>
                </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
				<div id="users">
                <div class="page-content-wrap">
                    
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="panel panel-default">
                                <div class="panel-body">
                                   
                                    <form class="form-horizontal">
                                        <div class="form-group">
                                            <div class="col-md-8">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <span class="fa fa-search"></span>
                                                    </div>
                                                    <input type="text"  class="form-control search" placeholder="Who are you looking for?"/>
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-primary">Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                              <a hrf="#" data-toggle="modal" data-target="#address" class="btn btn-success btn-block"><span class="fa fa-plus"></span> Add new contact</a>
                                            </div>
                                        </div>
                                    </form>                                    
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="row">
					 <ul class="list">
					  <?php 
					  include("config_db1.php");
					  $cmd="select * from address where createdby='$uid'";
					  $res=mysql_query($cmd);
					  $num=mysql_num_rows($res);
					  //echo $num;
					  if($num !=0)
					  {
					  while($rs=mysql_fetch_array($res))
					  {
					  ?>
                        <div class="col-md-3">
                            <!-- CONTACT ITEM -->
                            <div class="panel panel-default">
                                <div class="panel-body profile">
                                    <div class="profile-image">
                                        <img src="returnaddressimg.php?id=<?php echo $rs['id']; ?>" alt="<?php echo $rs['name']; ?>"/>
                                    </div>
                                    <div class="profile-data">
                                        <div class="profile-data-name name"><?php echo $rs['name']; ?></div>
                                        <div class="profile-data-title"><?php echo $rs['about']; ?></div>
                                    </div>
                                    <div class="profile-controls">
                                        <a href="#" onClick="editaddr(<?php echo $rs['id']; ?>)" class="profile-control-left"><span class="fa fa-info"></span></a>
                                        <a href="#" onClick="removeaddr(<?php echo $rs['id']; ?>)" class="profile-control-right"><span class="fa fa-times"></span></a>
                                    </div>
                                </div>                                
                                <div class="panel-body">                                    
                                    <div class="contact-info">
                                        <p class="born"><small>Mobile</small><br/><?php echo $rs['phone']; ?></p>
                                        <p><small>Email</small><br/><?php echo $rs['email']; ?></p>
                                        <p><small>Address</small><br/><?php echo $rs['address']; ?></p>                                   
                                    </div>
                                </div>                                
                            </div>
                            <!-- END CONTACT ITEM -->
                        </div>
						<?php }} else {
						echo "<small>No result Found </small>"; } ?>
						
                        
						
						
						 
						</ul>
						                       
                    </div>
                    

                </div>
				</div>
				<!--<div id="users">

  <input class="search" placeholder="Search" />
  <button class="sort" data-sort="name">
    Sort
  </button>
  <button  onClick="add()">
    Add
  </button>

  <ul class="list">
    <li>
      <h3 class="name">Jonny Stromberg</h3>
      <p class="born">1986</p>
    </li>
    <li>
      <h3 class="name">Jonas Arnklint</h3>
      <p class="born">1985</p>
    </li>
    <li>
      <h3 class="name">Martina Elm</h3>
      <p class="born">1986</p>
    </li>
    <li>
      <h3 class="name">Gustaf Lindqvist</h3>
      <p class="born">1983</p>
    </li>
  </ul>

</div>-->
                <!-- END PAGE CONTENT WRAPPER -->                                                 
            </div>  
			
			          
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->

        <!-- MESSAGE BOX-->
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
                            <a href="logout.php" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->
<div id="address"  class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Contacts Details</h4>
      </div>
      <div class="modal-body">
        	
	
										
      <div class="col-md-12">  
	  <form id="jvalidate" method="post" action="saveadd.php" enctype="multipart/form-data" role="form" class="form-horizontal">
                                    <div class="panel-body">                                    
                                        	   
										<div class="form-group">
										 <div class="col-md-4">
                                            <label class="col-md-3 control-label">Name:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="name" id="name"/>
                                                
												</div>                                        
												   </div>
													
												 <div class="col-md-4">
                                            <label class="col-md-3 control-label">Mobile:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"  name="mobile" id="mobile"/>
                                               
												</div>                                        
												   </div>  
												   
												   
												   <div class="col-md-4">
                                            <label class="col-md-3 control-label">Email:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" Placeholder="Email Address"  name="email" id="email"/>
                                                
												</div>                                        
												   </div>
												   <br><br>
												     <div class="col-md-4">
                                            <label class="col-md-3 control-label">Address:</label>  
                                            <div class="col-md-9">
                                                <textarea class="form-control" Placeholder="Address..."  name="address1" id="address1"></textarea>
                                                
												</div>                                        
												   </div>
												   
												    <div class="col-md-4">
                                            <label class="col-md-3 control-label">About:</label>  
                                            <div class="col-md-9">
                                                <textarea class="form-control" Placeholder="About..."  name="about" id="about"></textarea>
                                                
												</div>                                        
												   </div>
												   
												   
												    <div class="col-md-4">
												    <div class="form-group">
                                <div class="col-md-12">
                                    <img style="float:right; cursor:pointer; margin-right:30px" src="img/default.png" height="200" width="200" id="img_prev" name="img_prev" />
    <input type="file" class="fileinput btn-danger" data-filename-placement="inside" id="photo" name="photo" onChange="readURL(this);"/>
                                </div>
                            </div> 
							</div>
							<script>
		function readURL(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$('#img_prev')
					.attr('src', e.target.result)
					.width(200)
				.height(200);
				};
				reader.readAsDataURL(input.files[0]);
			}
		}
	</script>
                       
										</div>
										
                                                                                                                            
                                        <div class="btn-group pull-right">
                                           
                                        </div>                                                                                                                          
                                    </div>                                               
                                   
                                          
      </div>
      <div class="modal-footer">
	  <button type="submit" name="submit" id="submit" class="btn btn-primary">Save</button>
		 </form>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</div>

<div id="edit"  class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Contacts Details</h4>
      </div>
      <div class="modal-body">
        	
	
										
      <div class="col-md-12">  
	  <form id="jvalidate" method="post" action="updateaddr.php" enctype="multipart/form-data" role="form" class="form-horizontal">
                                    <div class="panel-body">                                    
                                        	   
										<div class="form-group">
										 <div class="col-md-4">
                                            <label class="col-md-3 control-label">Name:</label>  
                                            <div class="col-md-9">
											  <input type="hidden" class="form-control" name="uidaddr" id="uidaddr"/>
                                                <input type="text" class="form-control" name="uname" id="uname"/>
                                                
												</div>                                        
												   </div>
													
												 <div class="col-md-4">
                                            <label class="col-md-3 control-label">Mobile:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"  name="umobile" id="umobile"/>
                                               
												</div>                                        
												   </div>  
												   
												   
												   <div class="col-md-4">
                                            <label class="col-md-3 control-label">Email:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" Placeholder="Email Address"  name="uemail" id="uemail"/>
                                                
												</div>                                        
												   </div>
												   <br><br>
												     <div class="col-md-4">
                                            <label class="col-md-3 control-label">Address:</label>  
                                            <div class="col-md-9">
                                                <textarea class="form-control" Placeholder="Address..."  name="uaddress1" id="uaddress1"></textarea>
                                                
												</div>                                        
												   </div>
												   
												    <div class="col-md-4">
                                            <label class="col-md-3 control-label">About:</label>  
                                            <div class="col-md-9">
                                                <textarea class="form-control" Placeholder="About..."  name="uabout" id="uabout"></textarea>
                                                
												</div>                                        
												   </div>
												   
												   
												    <div class="col-md-4">
												    <div class="form-group">
                                <div class="col-md-12">
                                    <img style="float:right; cursor:pointer; margin-right:30px" src="img/default.png" height="200" width="200" id="img" name="img" />
    <input type="file" class="fileinput btn-danger" data-filename-placement="inside" id="uph" name="uph" onChange="readURL1(this);"/>
                                </div>
                            </div> 
							</div>
							<script>
		function readURL1(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$('#img')
					.attr('src', e.target.result)
					.width(200)
				.height(200);
				};
				reader.readAsDataURL(input.files[0]);
			}
		}
	</script>
                       
										</div>
										
                                                                                                                            
                                        <div class="btn-group pull-right">
                                           
                                        </div>                                                                                                                          
                                    </div>                                               
                                   
                                          
      </div>
      <div class="modal-footer">
	  <button type="submit" name="submit" id="submit" class="btn btn-primary">Save</button>
		 </form>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</div>
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

        <!-- START THIS PAGE PLUGINS-->        
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
		<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
        <!-- END THIS PAGE PLUGINS-->        

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="js/settings.js"></script>
        
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>     
		<script type="text/javascript" src="js/list.js"></script>   
		<script type="text/javascript" src="chat/js/chat.js"></script> 
        <!-- END TEMPLATE -->

    <!-- END SCRIPTS --> 
    
    <!-- COUNTERS // NOT INCLUDED IN TEMPLATE -->
        <!-- GOOGLE -->
        <script type="text/javascript">
		function removeaddr(x)
		{
		//alert('');
		if(confirm("Are You sure want to delete this?")){
		$.ajax({
				type: "post",
				url: "removeaddr.php",
				data: {
					 id:x,
				},
				success: function(msg) {
				  alert(msg);
				  location.reload();
				}
			});
		}
		alert(x);
		}
		
		function editaddr(x)
		{
	 $('#uname').val("");
		 $('#uaddress1').val("");
		$('#uemail').val("");
		 $('#uabout').val("");
 		$('#umobile').val("");
		$('#uidaddr').val("");
			
			$.ajax({
				type: "post",
				url: "getaddr.php",
				data: {
					id:x,
				},
				success: function(msg) {
				alert(msg);
				   msg=$.trim(msg);
				   x=msg.split("~");
				   $('#uname').val(x[0]);
				   $('#uaddress1').val(x[3]);
				   $('#uemail').val(x[1]);
				   $('#uabout').val(x[2]);
				   $('#umobile').val(x[4]);
				   $('#uidaddr').val(x[5]);
				   $("#edit").modal('toggle');
				}
			});
		
		
		
		}
		
		
		function add()
		{
		var name = $('#name').val();
		var address1 = $('#address1').val();
		var email = $('#email').val();
		var about = $('#about').val();
		var name = $('#name').val();
			if(txt==1)
			return false;
			$.ajax({
				type: "post",
				url: "generateid.php",
				data: {
					branch: txt,
					date: $('#datepicker').val()
				},
				success: function(value) {
				   $('#patid').val(value);
				}
			});
		
		}
		$(document).ready(function() {
		
		
		var options = {
  valueNames: [ 'name', 'born' ]
};

var userList = new List('users', options);
});

          </script>
    </body>
	
<script>
	updateOnlineStatus();
	setInterval("updateOnlineStatus()", 5000);
	function updateOnlineStatus() { 
		$.ajax({	
			url: 'update-online-status.php',
			type:'POST',
			success:function(){
			}
		});
	}


 $(document).ready(function(){

   setInterval(function(){ 
  
//
	
	$.ajax({
		type: "POST",
		url: "msgnotifi.php",
		
		success: function(msg) {
		//alert(msg);
		$('#appmsg').empty();
		var msg=$.trim(msg);
		if(msg=="0#")
		return false;
		msg=msg.split('#');
		x=msg[1].split('@');
		$("#notifi").text(msg[0]);
		$("#new").text(msg[0]);
		$("#new1").text(msg[0]);
		$.each( x, function( key,value ) {
		y=value.split('~');
		
		/*var txt='<a href="#" onClick="chatWith(y[0])" class="list-group-item"><div class="list-group-status status-away"></div><img src="return_profile_img.php?name='+y[0]+'" class="pull-left" alt="'+y[0]+'"/> <span class="contacts-title">'+y[0]+' </span><p>'+y[1]+'</p></a>';*/
		var txt='<a href="message.php"  class="list-group-item"><div class="list-group-status status-away"></div><img src="return_profile_img.php?name='+y[0]+'" class="pull-left" alt="'+y[0]+'"/> <span class="contacts-title">'+y[0]+' </span><p>'+y[1]+'</p></a>';
		//alert(txt);
		//chatWith(y[0]);
		//startChatSession();
		//$("#ddd").empty();
		//$('#ddd').load('chat/js/chat.js');
		//$("#ddd").load("chat/js/chat.js");
		$('#appmsg').append(txt);
		});
		}
});

if ($(".chatbox").is(":visible")) {
  startChatSession();
}
	
   
    }, 5000);
});
</script>
		 
<!-- Mirrored from aqvatarius.com/themes/atlant/html/pages-address-book.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2015 09:47:54 GMT -->
</html>






