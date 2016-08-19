<?php
session_start();

 date_default_timezone_set('Asia/Kolkata'); 
$role=$_SESSION['role'];
//$pid=$_REQUEST['pid'];
 include("config_db1.php");
 $cmd=mysql_query("select * from settings where role='$role'");
 mysql_close($db1);
$sql=mysql_fetch_array($cmd);



 date_default_timezone_set('Asia/Kolkata'); 
if(isset($_REQUEST['pid'])){
		$pid = $_REQUEST['pid'];
		include("config_db2.php");
		$sql = "SELECT patientid,patientname,age,gender FROM patientdetails WHERE patientid='$pid'";
		$result = mysql_query($sql);
		if(mysql_num_rows($result) != 0){
			$rs = mysql_fetch_array($result);
			$pid = $rs['patientid'];		
			$patientname = $rs['patientname'];
			$age = $rs['age'];
			$gender = $rs['gender'];
		}else{
			$pid = "";
			$patientname = "";
			$age = "";
			$gender = "";
		}
		mysql_close($db2);
	}
	else{
		$pid = "";
		$patientname = "";
		$age = "";
		$gender = "";		
	}
?>
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from aqvatarius.com/themes/atlant/html/pages-edit-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2015 09:47:47 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>        
        <!-- META SECTION -->
        <title>DPP- Manage Bill</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" href="css/cropper/cropper.min.css"/>
        <!--  EOF CSS INCLUDE -->        
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->   
		
		<style>
		table.dataTable tbody tr.sel {
    background-color: #B0BED9;
}
		.ui-autocomplete {
  z-index:2147483647;
}</style>

<link type="text/css" rel="stylesheet" media="all" href="chat/css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="chat/css/screen.css" />
      
<!--<script>

$(document).ready(function() {
    var table = $('#billreporttable').DataTable();
 
    $('#billreporttable tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('selected');
    } );
 
    $('#button').click( function () {
        alert( table.rows('.selected').data().length +' row(s) selected' );
    } );
} );
		

	</script>-->
		

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
                  
                    <!-- END TOGGLE NAVIGATION -->
                    <!-- SEARCH -->
                    <li class="xn-search">
                        <form role="form">
                            <input type="text" onBlur="dispid()" name="search" id="search" placeholder="Search..."/>
                        </form>
                    </li>   
                    <!-- END SEARCH -->
                    <!-- POWER OFF -->
                    <li class="xn-icon-button pull-right last">
                        <a href="#"><span class="fa fa-power-off"></span></a>
                        <ul class="xn-drop-left animated zoomIn">
                           <!-- <li><a href="pages-lock-screen.html"><span class="fa fa-lock"></span> Lock Screen</a></li>-->
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
					$quer=mysql_query("Select * from patientdetails where hold!=0");
					$tothold=mysql_num_rows($quer);
					mysql_close($db2);
					?>
                    <li class="xn-icon-button pull-right">
                        <a href="#"><span class="fa fa-tasks"></span></a>
                        <div class="informer informer-warning"><?php echo $tothold; ?></div>
                        <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
                            <div class="panel-heading">
                                <h3 class="panel-title"><span class="fa fa-tasks"></span> Hold</h3>                                
                                <div class="pull-right">
                                    <span class="label label-warning"><?php echo $tothold;?> holding</span>
                                </div>
                            </div>
                            <div class="panel-body list-group scroll" style="height: 200px;">  
							<?php while($ho=mysql_fetch_array($quer))
							{ 
							$per=$ho['hold'];
							?>                              
                                <a class="list-group-item" href="pausecom.php?pid=<?php echo $ho['patientid']; ?>">
                                    <strong><?php echo $ho['patientname']; ?></strong>
                                    <div class="progress progress-small progress-striped active">
                                        <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $per; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $per; ?>%;">50%</div>
                                    </div>
                                    <small class="text-muted">hold By: <?php echo $ho['holdby']; ?>, on <?php echo date('d  M  Y').' /'; echo $per; ?>%</small>
                                </a>
                                  <?php }?>                          
                            </div>     
                            <div class="panel-footer text-center">
                                <a href="pages-tasks.html">Show all tasks</a>
                            </div>                            
                        </div>                        
                    </li>
                    <!-- END TASKS -->
                    <!-- LANG BAR -->
                   
                    <!-- END LANG BAR -->
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->                    
                
                <!-- START BREADCRUMB -->
              <!--  <ul class="breadcrumb">
                    <li><a href="home.php">Home</a></li>
                    <li><a href="#">Registration</a></li>
                    
                </ul>-->
                <!-- END BREADCRUMB -->                                                
                
                <!-- PAGE TITLE -->
               
                <!-- END PAGE TITLE -->                     
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">
                
                    <div class="row">
					<div class="col-md-1">
					</div>
					<div class="col-md-10">
					
					 <div  class="panel panel-default">
                                
                            </div>
							</div>
							<div class="col-md-1">
							
							</div>
                        <div class="col-md-12">
						 
											 
                           
                                                            
                                <div class="panel panel-default tabs">                            
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Manage Billing</a></li>
                                      
                                     
                                    </ul>
									
                                    <div class="panel-body tab-content">
                                        
										
										<div class="tab-pane active" id="tab-first">
										<div class="row">
                                        
                                        <div class="col-md-12">
                                            <form id="bill1">
											
											
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Range</label>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input id="from" name="from" type="text" class="form-control datepicker" value="<?php $date = strtotime("-7 day");
echo date('Y-m-d', $date); ?> "/>
                                                    <span class="input-group-addon add-on"> - </span>
                                                    <input id="to" name="to" type="text" class="form-control datepicker" value="<?php echo date("Y-m-d"); ?>"/>
													</div>
                                                </div>
												<div class="col-md-3">
												<a href="#" class="btn btn-primary pull-left" onClick="getbill()">Search <span class="fa fa-floppy-o fa-right"></span></a>
												</div>
												
                                            </div>
											</form>
                                           
                                            
                                        </div>
										
										<!--<input type="button" onClick="f()">-->
										
                                        <div class="col-md-6">
                                             
											 
                                        </div>
										  <br/><br/>                                           

                                            
                                           <br><br>
                                        
										
											
											   <div class="col-md-12">
									
						
									
								 <div class="table-responsive">
									 <table id="billreporttable" class="table datatable" >
      <thead>
        <tr>
          <th>Sl. No</th>		
          <th>Patient Name</th>
          <th>Patient ID</th>
          <th>Professional Service</th>
		  <th>Fees</th>
          <th>Fees Recieved</th>
          <th>Date of Reciept</th>
		  <th>Action</th>
        </tr>
      </thead>
      <tbody>
	  </tbody>
	  </table>
	  </div>

						
					  			
							
 </div> 
										
                                   
									

					</div></div>
					
					
					                             
	<script>
function getbill()
{

from=$("#from").val();
to=$("#to").val();

if($("#from").val()=="" && $("#to").val()=="")
{
alert("Please Fill any one field");
return false;
}
var t = $('#billreporttable').DataTable();
$.ajax({
			type: "post",
			url: "getbill.php",
			data: $("#bill1").serialize(),
			
			success: function(msg) {
			//alert(msg);
			var msg=$.trim(msg);
			alert(msg);
			//$("#billreporttable > tbody").empty();	
			t.clear().draw(false);;	
			if(msg=="")
			{
			$("#billreporttable > tbody").append("<b>No Result Found</b>");
			return false;
			}
			
				var v=msg.split('@');
				var len=v.length;
			var j=1;	
		
		for (i = 0; i <len; i++) 
		{
		var s=j++;
		var x1= v[i].split("~");
		//$("#tbl").show();<a href="printing.php?pid='.$pid.'&maxid='.$maxid.'" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left" target="_blank"><span class="fa fa-print"></span></a>
		msg='<a href="#" onClick="edit('+x1[6]+');" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-pencil"></span></a> <a href="#" onClick="deletebill($(this));" alt="'+x1[6]+'" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-times"></span></a><a href="printbilling.php?billnumber='+x1[6]+'&patientid='+x1[1]+'" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left" target="_blank"><span class="fa fa-print"></span></a>';
		t.row.add([
        s,
        x1[0],
        x1[1],
		x1[2],
		x1[3],
		x1[4],
		x1[5],
		msg, 
    ]).draw();
		 <!--<div class="table-responsive"><table class="table datatable"><thead><tr><th>Study Center</th><th>Patient ID</th><th>Patient Name</th><th>Parents / Spouse Name</th><th>Age</th><th>Gender</th><th>Contact No.</th><th>Occupation</th><th>Address</th><th>Date</th><th>View</th></tr></thead><tbody>-->
		/*var txt = "<tr><td>"+s+"</td><td>"+x1[0]+"</td><td>"+x1[1]+"</td><td>"+x1[2]+"</td><td>"+x1[3]+"</td><td>"+x1[4]+"</td><td>"+x1[5]+"</td></tr>";
	t.append(txt).draw();*/
		}
		$('#bill1').trigger("reset");
				//alert(len);
				
			}
		});

//alert('');
}


function edit(x)
{
//$('#old').val('0');
$('#total').val('0');
$('#pay').val('0');
var bill=x;
$('#bbill').modal('toggle');
		$.ajax({
		type: "POST",
		url: "get-bill-details.php",
		data: {bill:x},
		success: function(msg) {
		var msg=$.trim(msg);
		
		//var txt = "<tr><td>"+s+"</td><td>"+x1[0]+"</td><td>"+x1[1]+"</td><td>"+x1[2]+"</td></tr>";
	$("#dis").append(msg);
		
		}
		
	});
}



</script>
                                                        
                                        
										
										
										
										
										
										
										
										
										
                                    </div>
                                 
									
                                </div>                                
                            
                            </form>
                            
                        </div>
                    </div>                    
                    
                </div>
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
        
		
	
      

        <!-- MODALS -->
		<div id="bbill"  class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Billing Details</h4>
      </div>
      <div class="modal-body">
        <div id="dis">
		
		
		</div>	
	
										
      
      <div class="modal-footer">
	  <button type="button" class="btn btn-primary" onClick="save()" data-dismiss="modal">Save</button>
	   <!--<button type="button" class="btn btn-primary" onClick="printbill()" data-dismiss="modal">Print</button>-->
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
</div>
        <!--<div class="modal animated fadeIn" id="modal_change_photo" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="smallModalHead">Change photo</h4>
                    </div>                    
                    <form id="cp_crop" method="post" action="crop.php">
                    <div class="modal-body">
                        <div class="text-center" id="cp_target">Use form below to upload file. Only .jpg files.</div>
                        <input type="hidden" name="cp_img_path" id="cp_img_path"/>
                        <input type="hidden" name="ic_x" id="ic_x"/>
                        <input type="hidden" name="ic_y" id="ic_y"/>
                        <input type="hidden" name="ic_w" id="ic_w"/>
                        <input type="hidden" name="ic_h" id="ic_h"/>                        
                    </div>                    
                    </form>
                    <form id="cp_upload" method="post" enctype="multipart/form-data" action="upload.php">
                    <div class="modal-body form-horizontal form-group-separated">
                        <div class="form-group">
                            <label class="col-md-4 control-label">New Photo</label>
                            <div class="col-md-4">
                                <input type="file" class="fileinput btn-info"  name="file" id="cp_photo" data-filename-placement="inside" title="Select file"/>
                            </div>                            
                        </div>                        
                    </div>
                    </form>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success disabled" id="cp_accept">Accept</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>-->
        
        <!--<div class="modal animated fadeIn" id="modal_change_password" tabindex="-1" role="dialog" aria-labelledby="smallModalHead" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="smallModalHead">Change password</h4>
                    </div>
                    <div class="modal-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer faucibus, est quis molestie tincidunt</p>
                    </div>
                    <div class="modal-body form-horizontal form-group-separated">                        
                        <div class="form-group">
                            <label class="col-md-3 control-label">Old Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="old_password"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">New Password</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="new_password"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Repeat New</label>
                            <div class="col-md-9">
                                <input type="password" class="form-control" name="re_password"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Proccess</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>-->        
        <!-- EOF MODALS -->
        
        <!-- BLUEIMP GALLERY -->
            
        <!-- END BLUEIMP GALLERY -->        
        
        <!-- START PRELOADS -->
        <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->          
        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
	
	
		
  		<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
        
        <script type="text/javascript" src="js/plugins/jquery/jquery-migrate.min.js"></script>
        <!-- END PLUGINS -->

        <!-- START THIS PAGE PLUGINS-->
		<script type="text/javascript" src="js/demo_tables.js"></script>          
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script> 
		<script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>  
		        <script type="text/javascript" src="js/plugins/tableexport/tableExport.js"></script>
	<script type="text/javascript" src="js/plugins/tableexport/jquery.base64.js"></script>
	<script type="text/javascript" src="js/plugins/tableexport/html2canvas.js"></script>
	<script type="text/javascript" src="js/plugins/tableexport/jspdf/libs/sprintf.js"></script>
	<script type="text/javascript" src="js/plugins/tableexport/jspdf/jspdf.js"></script>   
        
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
        <script type="text/javascript" src="js/plugins/form/jquery.form.js"></script>
		<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>                
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
        <script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
        <script type='text/javascript' src='js/plugins/maskedinput/jquery.maskedinput.min.js'></script>
        <script type="text/javascript" src="js/plugins/cropper/cropper.min.js"></script>
		<script type="text/javascript" src="js/faq.js"></script>
        <!-- END THIS PAGE PLUGINS-->        

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="js/settings.js"></script>        
        
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>
		
        <!--<script type="text/javascript" src="chat/js/jquery.js"></script>-->
<script type="text/javascript" src="chat/js/chat.js"></script>
       <!-- <script type="text/javascript" src="js/demo_edit_profile.js"></script>-->
        <!-- END TEMPLATE -->

    <!-- END SCRIPTS -->
	
    <!-- COUNTERS // NOT INCLUDED IN TEMPLATE -->
        <!-- GOOGLE -->
		<script>
		function deletebill(x)
		{
		var bill = x.attr('alt');
		//alert(bill);
		if(confirm("Do you sure  to delete this record?")){
		//var bill=x;
		$.ajax({
		type: "POST",
		data: {bill:bill,},
		url: "deletebill.php",
		
		success: function(msg) {
		//alert(msg);
		var msg=$.trim(msg);
		if(msg == 'ok')
			x.closest('td').html('Deleted');
			else	
			alert(msg);
				}
		});
	}else 
	return false;	
}


</script>
		<script>
		/*$(document).ready(function(){
   setInterval(function(){ 
  
	
	
	$.ajax({
		type: "POST",
		url: "getupdatemsg.php",
		
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
		chatWith(x1[0]);
	
		
		}
		
		}
});
	
   
    }, 5000);
});*/ </script>
		 
		




		
        <!--<script type="text/javascript">
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','../../../../www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-36783416-1', 'aqvatarius.com');
          ga('send', 'pageview');
        </script>-->        
        <!-- END GOOGLE -->
        
        <!-- YANDEX -->
        <!--<script type="text/javascript">
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
        </script>-->
        <!--<noscript><div><img src="http://mc.yandex.ru/watch/25836617" style="position:absolute; left:-9999px;" alt="" /></div></noscript>    --> 
        <!-- END YANDEX -->
    <!-- END COUNTERS // NOT INCLUDED IN TEMPLATE -->
    
    </body>
	<!--<script>
		$(document).ready(function() {
		
    var table = $('#reporttable').DataTable();
    
    $('#reporttable tbody').on( 'click', 'tr', function (){
        $(this).toggleClass('sel');
    } );
	 } );
	</script>-->
	<script>

$(document).ready(function() {
    var table = $('#billreporttable1').DataTable();
 
    $('#billreporttable tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('sel');
		hi();
    } );
 
   
} );
		

	</script> 
	
	<script>
function hi()
{
//alert('');
var s="";
$("#billreporttbody").html("");
var s =$('.sel').html();
var collection = $(".sel");
collection.each(function() {
var g=$(this).html();
g="<tr>"+g+"</tr>";
  $("#billreporttbody").append(g);  
});
//alert($('.sel').length); 

}


 $(document).ready(function(){

   setInterval(function(){ 
  
	
	
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
		
		var txt='<a href="message.php" class="list-group-item"><div class="list-group-status status-away"></div><img src="return_profile_img.php?name='+y[0]+'" class="pull-left" alt="'+y[0]+'"/> <span class="contacts-title">'+y[0]+' </span><p>'+y[1]+'</p></a>';
		//alert(txt);
		$('#appmsg').append(txt);
		});
		}
});
	
  // alert('');
    }, 5000);
});
</script> 
 
<!-- Mirrored from aqvatarius.com/themes/atlant/html/pages-edit-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2015 09:47:54 GMT -->
</html>




