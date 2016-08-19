<?php
session_start();
$role=$_SESSION['role'];
date_default_timezone_set('Asia/Kolkata'); 
include("config_db1.php");
 $cmd=mysql_query("select * from settings where role='$role'");
 mysql_close($db1);
$sql=mysql_fetch_array($cmd);
?>
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from aqvatarius.com/themes/atlant/html/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2015 09:48:25 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>        
        <!-- META SECTION -->
        <title>DPP-Lab</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->    
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
                        <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a>                    </li>
                    <!-- END TOGGLE NAVIGATION -->
                    <!-- SEARCH -->
                    <li class="xn-search">
                        <form role="form">
                            <input type="text" name="ser" id="ser"  onBlur="get()" placeholder="Search..."/>
                        </form>
                    </li>   
                    <!-- END SEARCH -->
                    <!-- POWER OFF -->
                 <li class="xn-icon-button pull-right last">
                        <a href="#"><span class="fa fa-power-off"></span></a>
                        <ul class="xn-drop-left animated zoomIn">
                            <!--<li><a href="pages-lock-screen.html"><span class="fa fa-lock"></span> Lock Screen</a></li>-->
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
	 
                    <!-- END TASKS -->
                    <!-- LANG BAR -->
                    <!--<li class="xn-icon-button pull-right">
                        <a href="#"><span class="flag flag-gb"></span></a>
                        <ul class="xn-drop-left xn-drop-white animated zoomIn">
                            <li><a href="#"><span class="flag flag-gb"></span> English</a></li>
                            <li><a href="#"><span class="flag flag-de"></span> Deutsch</a></li>
                            <li><a href="#"><span class="flag flag-cn"></span> Chinese</a></li>
                        </ul>                        
                    </li> -->
                    <!-- END LANG BAR -->
                </ul>
                <!-- END X-NAVIGATION VERTICAL -->                    
                
                <!-- START BREADCRUMB -->
                <ul class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Lab </a></li>
                    
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span>  Lab</h2>
					
					<div class="pull-right">                            
                          <!-- <a href="#" onClick="addreq()" class="btn btn-danger"><span class="fa fa-book"></span> Add Requisition </a>-->
						   </div>
						 
                </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">                
                
                    <div class="row">
                        
                        <div class="col-md-12"> 
						 <div class="panel panel-default">   
						  <div class="panel-body">                    
						
                            <!-- START JQUERY VALIDATION PLUGIN -->
                           <?php  date_default_timezone_set('Asia/Kolkata'); ?>
                                    <form id="jvalidate" role="form" class="form-horizontal">
                                    <div class="panel-body">                                    
                                        <div class="form-group">
										 <div class="col-md-4">
                                            <label class="col-md-3 control-label">Patient ID:</label>  
                                            <div class="col-md-9">
                                                <input type="text" readonly="readonly" class="form-control" name="id" id="id"/>
                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
											   
                                   
                                                     <div class="col-md-4">
                                            <label class="col-md-3 control-label">Patient Name:</label>  
                                            <div class="col-md-9">
                                                <input type="text" readonly="readonly" class="form-control" name="name" id="name"/>
                                                  <span class="help-block"></span>  
												</div>                                        
												   </div>       
                       
										 <div class="col-md-4">
                                            <label class="col-md-3 control-label">Date</label>  
                                            <div class="col-md-9">
                                                <input type="text" readonly="readonly" class="form-control" value="<?php echo date("d/m/Y"); ?>" name="date"/>
                                               <span class="help-block"></span> 
												</div>                                        
												   </div>
										</div>	   
                                        <hr>
										<h3>Reports Details</h3>
								
										<div class="col-md-12">
										
										<center>
										<table id="dataTables-example" class="table table-striped table-bordered table-hover">
										<thead>
										<tr>
										<th>#</th>
										<th>Test&nbsp;</th>
										<th>Reports&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										<th style='display:none'>Notes</th>
										<th>Normal</th>
										<th>Bill.No</th>
										<th style='display:none'>id</th>
										<th style='display:none'>id</th>
										
										</tr>
										</thead>
										<tbody id="billing" name="billing">
										
										  </tbody>
                                </table></center>
										</div>
										
										   
												    
												      
												   
												   
												    
												   
												      
												    
												     
												     
                        <div class="btn-group pull-left">
                                           <!-- <button class="btn btn-primary" type="button" onClick="">Print</button>-->
                                            <a href="#" class="btn btn-primary" onClick="lab_generate_ip_report();return false;" >Generate Report</a>
                                        </div>
                                                                                                                            
                                        <div class="btn-group pull-right">
                                           <!-- <button class="btn btn-primary" type="button" onClick="">Print</button>-->
                                            <a href="#" class="btn btn-primary" onClick="save();return false;" >Save</a>
                                        </div>                                                                                                                          
                                    </div>                                               
                                    </form>
                       
                            
                            <!-- END JQUERY VALIDATION PLUGIN -->
                          
				
							
							
						
							</div>
							</div>
                            <!-- END JQUERY VALIDATION PLUGIN -->
                            </div>
							</div>
							
							
							
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
		
		
<div id="reportadd"  class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Report Details</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <form id="jvalidate" role="form" class="form-horizontal">
            <div class="panel-body">
              <div class="col-lg-12">
                
                <br>
              </div>
              
            </div>
            <div id="addreporttable" class="col-md-12">
              
            </div>
            
            
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onClick="savesubreport()">Save</button>
        <!--<button type="button" class="btn btn-primary" onClick="printbill()" data-dismiss="modal">Print</button>-->
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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
        
        <!-- THIS PAGE PLUGINS -->
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        
        <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>        
        <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-select.js'></script>        

        <script type='text/javascript' src='js/plugins/validationengine/languages/jquery.validationEngine-en.js'></script>
        <script type='text/javascript' src='js/plugins/validationengine/jquery.validationEngine.js'></script>        

        <script type='text/javascript' src='js/plugins/jquery-validation/jquery.validate.js'></script>                

        <script type='text/javascript' src='js/plugins/maskedinput/jquery.maskedinput.min.js'></script>
        <!-- END THIS PAGE PLUGINS -->               

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="js/settings.js"></script>
        
        <script type="text/javascript" src="js/plugins.js"></script>
        <script type="text/javascript" src="js/actions.js"></script>
        <!-- END TEMPLATE -->
        
        <script type="text/javascript">
		
		function save()
		{
		
		var name = $('#name').val();
		var id= $('#id').val();
		

		if(name=="")
		return false;
		if(id=="")
		return false;
		var tbody = $("#dataTables-example tbody");
		if (tbody.children().length == 0) {
			alert('No record Added');
			return false;
		}
		var checkbox_array = [];
		$("input:checkbox[name=lab_detail_tbl_colsample_ids]").each(function(){
			if($(this).is( ":checked" ))
				checkbox_array.push($(this).val());
			else
				checkbox_array.push('');
		});
		//console.log(checkbox_array[0]);
		//return false;
		var table = $("#dataTables-example");
		var asset = [];
		var i=0;
		table.find('tbody > tr').each(function (rowIndex, r) {
			var cols = [];
			
			$(this).find('td').each(function (colIndex, c) {
				cols.push(c.textContent);
				
			});
			
			//console.log(cols.toString());
			cols[8] = checkbox_array[i];
			asset.push(cols);
			i++;
		}); 
		//console.log(asset.toString());
		//return false;
		
		$.ajax({
		type: "POST",
		url: "save_lab_report_ip.php",
		data: { assets: asset,
		},
		success: function(msg) {
		alert(msg);
		get_iplab_list();
			
		}
	});
	}
		
		
		

		
				
				
	function get()
				{
				//alert('');
				$("#oldtable > tbody").html("");
				$("#dataTables-example > tbody").html("");
				var ser = $('#ser').val();
				ser=$.trim(ser);
				ser=ser.split('-');
				ser=ser[0];
				if(ser =="")
				return false;
			
			$.ajax({
		type: "POST",
		url: "returngetlab_ip.php",
		data: {ser:ser},
		success: function(msg) {
		var msg=$.trim(msg);
		//console.log(msg);
		//alert(ser);
		//return false;
		if(msg=='') {
		alert('Request Not Found');
		$('#name').val('');
		$('#id').val('');
		return false;
		}
		else {
		var y=msg.split('~');
		$('#name').val(y[1]);
		$('#id').val(y[0]);
		get_iplab_list();
		
		
		}
			
		}
	});
	}
	function lab_generate_ip_report(){
		 var checkValues = $('input[name=lab_detail_tbl_ids]:checked').map(function()
            {
                return $(this).val();
            }).get();
			
			var pid = $('#id').val();
			if(checkValues ==''){
				alert('Select Records to Generate Report');
				return false;
			}
			$.ajax({
		type: "POST",
		url: "returngetlabdteaillistwithreport_ip.php",
		data: {ids:checkValues,pid:pid},
		success: function(msg) {
		var msg=$.trim(msg);
		//console.log(msg);
		//alert(ser);
		//return false;
		if(msg=='') {
		console.log(msg);
		return false;
		}
		else {
		//	console.log(msg);
		//	return false;
		get_iplab_list();
		window.open("lab_ip_report_generate.php?pid="+pid+"&report_id="+msg);
		
		
		
		
		
		}
			
		}
	});
		
		
		
			
	}
	function get_iplab_list(){
		
		$.ajax({
		type: "POST",
		url: "returngetlabdteaillist_ip.php",
		data: {ser:$('#id').val()},
		success: function(msg) {
		var msg=$.trim(msg);
		//console.log(msg);
		//alert(ser);
		//return false;
		if(msg=='') {
		alert('Request Not Found');
		$('#name').val('');
		$('#id').val('');
		return false;
		}
		else {
		
		$('#dataTables-example').html(msg);
		
		
		
		
		
		}
			
		}
	});
	}
	function addreport(x) {
	$('#reportadd').modal('show');
	 	//alert(x);
		$('#addreporttable').empty();
	$.ajax({
		type: "POST",
		url: "returngetlabreport.php?id="+x,
		
		success: function(msg) {
		var msg=$.trim(msg);
		
		$('#addreporttable').append(msg);
		}
	});
	}
		
function savesubreport() {
		//alert('');
		table = $("#subreport");
    var asset = [];
    table.find('tbody > tr').each(function (rowIndex, r) {
        var cols = [];
        $(this).find('td').each(function (colIndex, c) {
            cols.push(c.textContent);
        });
        asset.push(cols);
    }); 
	//alert('');
	
		$.ajax({
		type: "POST",
		url: "savelabsub.php",
		data: { assets: asset,
		},
		success: function(msg) {
		alert(msg);
		//var msg=$.trim(msg);
		
		//$('#addreporttable').append(msg);
		}
	});
}
				
				$(document).ready(function() {
 	$.ajax({
		type: "GET",
		url: "return_detail.php",
		success: function(msg) {
			var availableTags = msg.split("~");
			$( "#ser" ).autocomplete({
			  source: availableTags
			});
		}
	});
	
	$.ajax({
		type: "GET",
		url: "returnsymptom.php",
		success: function(msg) {
			var availableTags = msg.split("~");
			$( "#pid" ).autocomplete({
			  source: availableTags
			});
		}
	});
		});                                   



        </script> 
		
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
    <!-- END SCRIPTS -->          

    <!-- COUNTERS // NOT INCLUDED IN TEMPLATE -->
        <!-- GOOGLE -->
                
        <!-- END GOOGLE -->
        
        <!-- YANDEX -->
        
             
        <!-- END YANDEX -->
    <!-- END COUNTERS // NOT INCLUDED IN TEMPLATE -->
    </body>

<!-- Mirrored from aqvatarius.com/themes/atlant/html/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2015 09:48:33 GMT -->
</html>






