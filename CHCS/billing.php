<?php
session_start();
$role=$_SESSION['role'];
date_default_timezone_set('Asia/Kolkata'); 
include("config_db1.php");
 $cmd=mysql_query("select * from settings where role='$role'");
 mysql_close($db1);
 
$sql=mysql_fetch_array($cmd);
$print_bill=$sql['billingop'];
$lab=$sql['labreports'];
if($sql['billingop'] !=1)
{
echo '<script>alert("You could not access this page");</script>';
//header('Location :home.php');
echo '<script>window.location.href="home.php"</script>';
exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from aqvatarius.com/themes/atlant/html/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2015 09:48:25 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>        
        <!-- META SECTION -->
        <title>DPP-Billing</title>            
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
                            <input type="text" name="ser" id="ser"  onBlur="get()" placeholder="Search Patient for billing..."/>
							<input type="hidden" id="print_bill" value="<?php echo $print_bill; ?>">
							<input type="hidden" id="lab" value="<?php echo $lab; ?>">
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
                    <li><a href="#">Billing </a></li>
                    
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span>  Billing OP</h2>
					
					<div class="pull-right">                            
                           <!--<a href="#" onClick="addreq()" class="btn btn-danger"><span class="fa fa-book"></span> Add Requisition </a>-->
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
                                                <input type="text"  style="font-weight:bold;width:160px; color:#000;" readonly class="form-control" name="pat_id" id="pat_id"/>
                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
											   
                                   
                                                     <div class="col-md-4">
                                            <label class="col-md-3 control-label">Pat Name:</label>  
                                            <div class="col-md-9">
                                                <input type="text" style="font-weight:bold;width:160px; color:#000;" readonly class="form-control" name="name" id="name"/>
                                                  <span class="help-block"></span>  
												</div>                                        
												   </div>       
                       
										 <div class="col-md-4">
                                            <label class="col-md-3 control-label">Date</label>  
                                            <div class="col-md-9">
                                                <input type="datetime" style="font-weight:bold;width:160px; color:#000;"  class="form-control datepicker" value="<?php echo date("d/m/Y h:i:sa"); ?>" name="date"/>
                                               <span class="help-block"></span> 
												</div>                                        
												   </div>
										</div>	
                                        <div class="form-group">
										 <div class="col-md-4">
                                            <label class="col-md-3 control-label">Pat. IP ID:</label>  
                                            <div class="col-md-9">
                                                <input type="text"  style="font-weight:bold;width:160px; color:#000;" readonly class="form-control" name="ip_id" id="ip_id"/>
                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
                                                   </div>  
												<!-------LAB DETAILS------>   
                                        <hr>
										<h3>Lab Details<input type="hidden" name="billing_numbr" id="billing_numbr" value="<?php  echo date-time(yyyyMMddHHmmss);?>"></h3>
										<div class="form-group">
										 <div class="col-md-8"><div class="col-md-12">
                                            <div class="col-md-5">
                                              <select name="lab_detail" id="lab_detail" onChange="get_display_lab_det()" class="select" style="font-weight:bold;width:160px;">
													 <option value="0">Select Lab</option>
                                                         <?php
					include("config_db1.php");
					$cmd_inves_list_query = mysql_query("select * from investigation");
					while($cmd_inves_list_array = mysql_fetch_array($cmd_inves_list_query)){
						?>
						<option value="<?php echo $cmd_inves_list_array['id']; ?>"><?php echo $cmd_inves_list_array['title']; ?></option>
						<?php
					}
					
				  ?>
                        </select>												                                    
												   </div>
											   
                                   
                                            <div class="col-md-4">
                                        <select id="lab_full_det" data-live-search="true" class="form-control select" onFocus="get_amount()" onChange="get_amount()">
                                          <option value="">Select Details</option>
                                        </select>
                                                        </div>                                        
                                                   
                                                   <div class="col-md-2">
                                            <input type="text" id="fees1" name="fees1" class="form-control"  placeholder="Fees">
                                                        </div>                                        
												   <div class="col-md-1">
                                           <a href="#" onClick="add_lab_sublist(lab_detail.value,lab_full_det.value,pat_id.value,fees1.value);return false;" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-plus"></span></a>                                   
												   </div>
                                                  
                                                    </div> </div>    
										</div>
                                        
<div class="form-group">
            <div class="col-md-10">
				<center>
                <div id="lab_sublist_list_div" align="center">
					<table id="list123" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Lab</th>
                        <th>Lab Details</th>
                        <th>Fees</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>

                     </tbody>
                    </table>
                    </div>
				</center>
			</div>
		</div>               
		
		<!----SERVICES IN OP BILLING---->
		  <div class="form-group">
                                                              <label class="col-md-1 control-label"><h3>Services:</h3></label>  
                                     

                   
                     </div>             
					 <div class="form-group">

          <div class="col-md-4"><div class="col-md-12">
            <div class="col-md-7" >
                        <select name="service2" id="service2" class="form-control select"  style="font-weight:bold;" >
                     <option value="">Select Details</option><?php 
					include("config_db1.php");
					$cmd_ser = "select id,service_name,types,amount from service_creation";
					$res_ser = mysql_query($cmd_ser);
					while($rs_ser = mysql_fetch_array($res_ser)){
								$service_name=$rs_ser['service_name'];
								$types=$rs_ser['types'];
								$amount=$rs_ser['amount'];
								$id=$rs_ser['id'];
					?>
                    	<option value="<?php echo $id?>"><?php echo $service_name."/".$types?></option>
                        <?php }?>
                        </select>   
               </div>
            <div class="col-md-3">
                 <input type="text" style="font-weight:bold"  class="form-control" name="service_no2" id="service_no2"/>             
            </div>   
          
            <div class="col-md-2">
                <a href="#"  onClick="add_servicess(service2.value,service_no2.value,pat_id.value);return false;" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-plus"></span></a>         </div> 
                </div></div>
                
          </div>
 <div class="form-group">
                
            <div class="col-md-5">
				<center>
					
                        <div id="service2_list_div">
                        <table id="services_ids" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Services</th>
                        <th>Timing</th>
                        <th>Amount</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         
                        </tbody>
                        </table>

                        </div>
				</center>
			</div>
            

        </div>     
                                       <!-- BILLING MANUAL DETAILS-->  
                                        <hr>
										<h3>Billing Details</h3>
										<div class="form-group">
										 <div class="col-md-4">
                                            <label class="col-md-3 control-label">Description:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="des" id="des"/>
                                              <span class="help-block"></span> 
												</div>                                        
												   </div>
											   
                                   
                                                     <div class="col-md-4">
                                            <label class="col-md-3 control-label">Fees:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"  name="fees" id="fees"/>
                                              <span class="help-block"></span> 
												</div>                                        
												   </div>  
												   <div class="col-md-1">
                                           <a href="#"  onClick="add_fees_sublist(pat_id.value,name.value,ip_id.value,des.value,fees.value);return false;" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-plus"></span></a>                                   
												   </div>     
										</div>
										<div class="col-md-12">
										 <div id="fees_sublist_div">
                        <table id="dataTables-example" class="table table-striped table-bordered table-hover" width="75%">
										<thead>
										<tr>
										<th>#</th>
										<th>Description</th>
										<th>Fees</th>
										<th>Action</th>
										</tr>
										</thead>
										 <tbody>
                       
                        </tbody>
                                </table></div>
</div>										
										<div id="tbl" style="display:none">
										<div class="col-md-8">
										
										
										<center>
										<table id="oldtable" class="table table-striped table-bordered table-hover">
										<thead>
										<tr>
										<th>#</th>
										<th>Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										<th>Fees&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										<th>Pay&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										</tr>
										</thead>
										<tbody>
										
										  </tbody>
                                </table>
								</center>
										</div>
										</div>
                                        
										<div class="col-md-4">
                                            <label class="col-md-4 control-label">Old Balance:</label>  
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" value="0" name="old" id="old" readonly />
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
												   </div> 
                                        <div id="total_div">
										
										 <div class="col-md-4">
                                            <label class="col-md-3 control-label">Total:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="<?php echo $total_fees; ?>" style=" font-weight:bold" readonly  name="total" id="total"/>
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
												   </div> 
                                                   
												    <div class="col-md-4">
                                            <label class="col-md-3 control-label">Pay:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"  onBlur="cal()" name="pay" id="pay"/>
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
												   </div>  </div> 
												   
												   
												   <div class="col-md-5">
                                            <label class="col-md-6 control-label">Remaining Balance(to be paid):</label>  
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" value="0" name="bal" id="bal" readonly />
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
												   </div> 
												   
												    
                                                   <?php $billnumber= date-time(yyyyMMddHHmmss); ?>
						<script>
function contactsform(url)
{
		window.open ('/dpp_2/printbill.php?patientid='+pat_id.value+'&billnumber='+billing_numbr.value);
}
</script>											     												     
                                        <div class="btn-group pull-right">
                                         <!--   <button class="btn btn-primary" type="button" onClick="print_bill()">Print</button>-->
                                            <div class="col-md-4"><a href="#" class="btn btn-primary" onClick="save();return false;" >Pay</a></div>
											<div class="col-md-4">  <button class="btn btn-primary" type="button" onClick="print_bill_preview()">Preview Bill</button></div>
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
		<div class="message-box message-box-success animated fadeIn" id="message-box-success">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-check"></span> Success</div>
                    <div class="mb-content">
                        <div id="appendmsg">
						</div>
                    </div>
                    <div class="mb-footer">
                        <a href="billing.php" class="btn btn-default btn-lg pull-right" >Close</a>
                    </div>
                </div>
            </div>
        </div>
		
		<div class="message-box message-box-danger animated fadeIn" id="message-box-error">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-times"></span> Error</div>
                    <div class="mb-content">
                        <div id="appenderror">
						</div>
                    </div>
                    <div class="mb-footer">
                        <button class="btn btn-default btn-lg pull-right mb-control-close">Close</button>
                    </div>
                </div>
            </div>
        </div>
		
		<div class="message-box message-box-info animated fadeIn" id="message-box-info">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-info"></span> Info</div>
                    <div class="mb-content">
					<div id="appendinfo">
						</div>
                       
                    </div>
                    <div class="mb-footer">
						<div class="pull-right">
                        <button class="btn btn-default btn-lg" onClick="removebtn()">Close</button>
						</div>
                    </div>
                </div>
			</div>
		</div>
		
		
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
		function removebtn() {
	$('#message-box-info').toggle();
	}
		function addreq()
		{
		
		var id= $('#id').val();
		//alert(id);
		$.ajax({
		type: "POST",
		url: "add_req.php",
		data: { 
		id:id,
		},
		success: function(msg) {
		//alert(msg);
		msg=$.trim(msg);
		if(msg !='no') {
		$("#dataTables-example > tbody").append(msg);
		
			var i=1;
			var sum=0;
			$( "#dataTables-example tbody tr" ).each( function(){
		 $(this).find("td").eq(0).text(i++);
  			var s=$(this).find("td").eq(2).text();
			// s=parseInt(s);
			// alert(s);
			sum += Number(s);
			//alert(sum);
		});
			//alert(sum);
			$("#total").val(sum);
			cal();
			}
			else
			return false;
		}
		
	});
		
		
		}
		function add_servicess(service2,service_no2,pat_id)
{	
/*alert(service2);
alert(service_no2);
	
*/	
	var pat_id = $('#pat_id').val();
		if (pat_id == "") {
			alert('Select Patient');
			return false;
		}
	if ($('#service_no2').val() == "") {
			alert('Enter the Service Days/Hours!');
			return false;
		}
		$.ajax({
			type: "post",
			url: "add_billing_service.php",
			//url: "billing_total.php", 
			data: {
				service_no : service_no2,
				service : service2,
				pat_id : pat_id,
				//mrd_no : ip_no,
				},
			success: function(msg) {
				jQuery("#service2_list_div").html(msg);	
				get_total_amt(pat_id);
				//$('#service_no2').val('');
				//$('#service2').val('');
			}

		});
}	
	function delete_servicess(serviceid,chart_ot,ref_no)
{
		$.ajax({
			type: "post",
			url: "delservice_billing.php", 
			data: {
				serviceid : serviceid,chart_ot : chart_ot,ref_no : ref_no,
				patient_id :$('#pat_id').val(),
				ip_no : '',
				},
			success: function(msg) {
				jQuery("#service2_list_div").html(msg);
				get_total_amt($('#pat_id').val());
			}
		});
}
function get_service_details()
	{
		var ser = $('#ser').val();
				ser=$.trim(ser);
				ser=ser.split('-');
				ser=ser[0];
				ip_no=ser[3];
				$.ajax({
			type: "post",
			url: "billing_service_list.php", 
			data: {
				pat_id : ser,
				ip_no  : ip_no,
				},
			success: function(msg) {
				jQuery("#service2_list_div").html(msg);	
			}
		});
		
		
		}
	
	function save_lab()
	{
		
	$.ajax({
			type: "post",
			url: "save_lab.php", 
			data: {
				pat_id : pat_id,
				},
			success: function(msg) {
				//$("#total_div").load(location.href + " #total_div");
//					jQuery("#total_div").html(msg);

			}
		});
		
		}	
		
		function print_bill_preview(){
			var pat_id = $('#pat_id').val();
			var bill= $('#print_bill').val();
			if(pat_id == ''){
				alert('Select Patient');
				return false;
			}else{
				if(bill==1) {
					var win=window.open('printbillint.php?patientid='+pat_id);
				}
			}
		}
		function display_checkbox()
		{
			if($('#physiotheraphy').is( ":checked" )){
				document.getElementById('table1').style.display="block";	
			}else{
				document.getElementById('table1').style.display="none";	
			}
		}
		
		
		function save()
		{
		//alert('');
			var pat_id = $('#pat_id').val();
			if(pat_id==''){
				alert('Select OP Patient');
				return false;
			}
		var pay = $('#pay').val();
		var total = $('#total').val();
		var name = $('#name').val();
		var id= $('#pat_id').val();
		var bal = $('#bal').val();
		var tbody = $("#dataTables-example tbody,#fees_id tbody");
		var err=0;
		if (tbody.children().length == 0) {
			var err=1;
		}
		
		if(err==1 && (total=="" || total =='0.00' || total=='0'))
		return false;
		if(pay=="")
		return false;
		if(name=="")
		return false;
		if(id=="")
		return false;
		
	
		table = $("#dataTables-example");
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
		url: "save_bill.php",
		data: { assets: asset,
		pay:pay,
		total:total,
		id:id,
		bal:bal,
		pat_id:pat_id,
		bill_number:<?php echo $billnumber; ?>,
		},
		success: function(msg) {
		//console.log(msg);
		//return false;
		var msg=$.trim(msg);
		var x=msg.split("~");
			var bill= $('#print_bill').val();
		//alert(msg);
		
		//alert(bill);
		if(x[0]=='Success')
		{
		if(bill==1) {
			var win=window.open('printbill.php?patientid='+id+'&billnumber='+x[1]);
		}	
		//alert(bill);
		//return false;
		$('#message-box-success').modal('toggle');
		$("#appendmsg").empty();
		if(bill==1) {
			msg='<p><span class="fa fa-check">Bill No:<a href="printbill.php?patientid='+id+'&billnumber='+x[1]+'" target="_blank">'+x[1]+'</a> Generated</span></p>';
		}else{
			msg='<p><span class="fa fa-check">Bill Generated.</span></p>';
		}
	$("#appendmsg").append(msg);
	
	//$('#message-box-update').toggle();
	}
	
	else
		{
	$("#appenderror").empty();
	msg='<p><span class="fa fa-check">Error Occured During Billing Try again !</span></p>';
	$("#appenderror").append(msg);
	$('#message-box-error').toggle();
	
	}
		
		//window.location.reload();
		//window.location.href=window.location.href;
	}	
		
	});
	}
		
		
		function delItem(x){	
		$("#total").val("");
	var row = x.closest("tr");
	 //row.find("td").eq(4).text("0");
		row.remove();
		 var sum=0;
		 var i=1;
		 $( "#dataTables-example tbody tr" ).each( function(){
		 $(this).find("td").eq(0).text(i++);
  			var s=$(this).find("td").eq(2).text();

			sum += Number(s);
			});
			$("#total").val(sum);
			var bal = $('#old').val();
		var pay = $('#pay').val();
		var total = $('#total').val();
		var amt=Number(total)-Number(pay);
		var due=Number(amt)+Number(bal);
		//alert(due);
		$('#bal').val(due);
			//cal();
			//$("#total").val(sum);
}

		function cal()
		{
		//alert($('#billing').text());
		//var tbody = $("#dataTables-example tbody");

		//if (tbody.children().length == 0) {
    	//alert('Table Sholud not blank');
		//$('#pay').val("");
		//return false;
		//}
		var old = $('#old').val();
		var pay = $('#pay').val();
		var total = $('#total').val();
		var amt=Number(total)-Number(pay);
		//var due=Number(amt)+Number(old);
		var due=Number(amt);
		if(due < 0)
		{
			alert("Pay amount should not greater than Total amount.");
			$('#pay').val(0);
			return false;
		}
		$('#bal').val(due);
		
		//alert(due);
		}
function get_total_amt(id)
{
		$.ajax({
			type: "post",
			url: "billing_total.php", 
			data: {
				id : id,
				},
			success: function(msg) {
				//$("#total_div").load(location.href + " #total_div");
					jQuery("#total_div").html(msg);
			}
		});
	
	}
	
	
function get_sum_total()
{
	var ser = $('#ser').val();
				ser=$.trim(ser);
				ser=ser.split('-');
				ser=ser[0];
				$.ajax({
			type: "post",
			url: "billing_total.php", 
			data: {
				id : ser,
				},
			success: function(msg) {
				jQuery("#total_div").html(msg);	
			}
		});
	
	}
function get_details()
{
	var ser = $('#ser').val();
				ser=$.trim(ser);
				ser=ser.split('-');
				ser=ser[0];
				$.ajax({
			type: "post",
			url: "billing_list.php", 
			data: {
				pat_id : ser,
				},
			success: function(msg) {
				jQuery("#fees_sublist_div").html(msg);	
			}
		});
	
	}
	
	function get_op_details()
{
	var ser = $('#ser').val();
				ser=$.trim(ser);
				ser=ser.split('-');
				ser=ser[0];
				$.ajax({
			type: "post",
			url: "op_lablist.php", 
			data: {
				pat_id : ser,
				},
			success: function(msg) {
				jQuery("#lab_sublist_list_div").html(msg);	
			}
		});
	
	}
	
	
	
	function get_list()
	{
		
		
	var ser = $('#ser').val();
				ser=$.trim(ser);
				ser=ser.split('-');
				ser=ser[0];
				$.ajax({
			type: "post",
			url: "billing_list.php", 
			data: {
				pat_id : ser,
				},
			success: function(msg) {
				jQuery("#fees_sublist_div").html(msg);	
			}
		});
	
	
		}
		
		

function add_fees_sublist(id,name,ip_id,des,fees)
{
	//alert(id);alert(name);alert(ip_id);alert(des);alert(fees);
		if(id==''){
			alert('Select OP Patient');
			return false;
		}
		if ($('#des').val() == "") {
			alert('Enter Description');
			return false;
		}
		if ($('#fees').val() == "") {
			alert('Enter Amount');
			return false;
		}
		
		$.ajax({
			type: "post",
			url: "add_fees.php", 
			data: {
				id : id,
				name: name,
				ip_id : ip_id,
				des : des,
				fees: fees,
				},
			success: function(msg) {
				jQuery("#fees_sublist_div").html(msg);	
				//alert("id=="+id);
				get_total_amt(id);
				$('#des').val('');
				$('#fees').val('');
				
			}
		});

}

	function delete_fee(id,patient_id)
{
		$.ajax({
			type: "post",
			url: "delete_fees.php", 
			data: {
				id : id,patient_id : patient_id,},
			success: function(msg) {
				jQuery("#fees_sublist_div").html(msg);
				get_total_amt(patient_id);
			}
		});
}
	
		
            var jvalidate = $("#jvalidate").validate({
                ignore: [],
                rules: {                                            
                       
                        id: {
                                required: true
                               
                        },
                        
                        name: {
                                required: true,
                                
                        },
                        pay: {
                                required: true,
                              
                        },
                        
                        
                       
                    },			
   			 	
					
    	                                   
                }); 
				
				
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
			//alert(ser);
			$.ajax({
		type: "POST",
		url: "returngetop.php",
		data: {ser:ser},
		success: function(msg) {
			//alert(msg);
		var msg=$.trim(msg);
		//alert(msg);
		if(msg=='~~0+#0' || msg=='~~~0+#0') {
		$('#message-box-info').toggle();
		$("#appendinfo").empty();
	msg='<p><span class="fa fa-check">Request Not Found !</span></p>';
	$("#appendinfo").append(msg);
		//alert('');
		$('#name').val('');
		$('#pat_id').val('');
		
		return false;
		}
		else {
		var y=msg.split('+');
		var x=y[0].split('~');
		$('#name').val(x[1]);
		$('#pat_id').val(x[0]);
		$('#ip_id').val(x[2]);
		
		$('#old').val(x[3]);
		var z=y[1].split('#');
		var last=z[1];
		
		var v=z[0].split('@');
		var j=0;
		for (i = 0; i <last; i++) 
		{
		var s=j++;
		var x1= v[i].split("~");
		$("#tbl").show();
		var txt = "<tr><td>"+s+"</td><td>"+x1[0]+"</td><td>"+x1[1]+"</td><td>"+x1[2]+"</td></tr>";
	$("#oldtable > tbody").append(txt);
		
		}
		
		get_lab_details_billing();
		get_list();
		get_service_details();
		get_total_amt(id);
		}
		var lab=$("#lab").val();
		if(lab==1)
		addreq();
			
		}
	});

	}
				
				$(document).ready(function() {
 	$.ajax({
		type: "GET",
		url: "return_detailop.php",
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
<script>
function get_display_lab_det()
{
	var inves=$('#lab_detail').val();
	if(inves=='' || inves==0)
		return false;
			$.ajax({
		type: "POST",
		url: "getinvesreport.php",
		data: {inves:inves,},
		success: function(msg) {
			
			
			$("#lab_full_det").empty().selectpicker('refresh');
			if(msg !=''){
				var opt = msg.split("~");
				$.each( opt, function( i, val ) {
				var id = val.split("+");
					$("#lab_full_det").append("<option title='"+id[0]+"' value='"+id[1]+"'>"+id[0]+"</option>").selectpicker('refresh');			 
				  });
			}
			get_amount();
			 }
		});
		}
		
		
		
		function get_amount()
{
	var inves_det=$('#lab_detail').val();
	var fees_det=$('#lab_full_det').val();
			$.ajax({
		type: "POST",
		url: "get_amountdetails.php",
		data: {
			inves_det:inves_det,
			fees_det:fees_det,
		},
		success: function(msg) {
			$("#fees1").val(msg);
			 }
		});
		}
function add_lab_sublist(lab_det,lab_full_det,patient_id,fees)
{		
		if(patient_id ==''){
			alert('Select OP Patient');
			return false;
		}
		if ($('#lab_detail').val() == "" || $('#lab_detail').val() == 0) {
			alert('Select Lab!!!');
			return false;
		}
		if ($('#lab_full_det').val() == "") {
			alert('Select Lab Details!!!');
			return false;
		}
		
		if(fees==''){
			fees=0;
		}
		

		$.ajax({
			type: "post",
			url: "add_lab_detailsop.php", 
			data: {
				lab_det : lab_det,
				lab_full_det : lab_full_det,
				fees : fees,
				patient_id : patient_id,
				action:'add',
				},
			success: function(msg) {
				
							//$("#lab_detail").val('');
							//$("#lab_full_det").val('');
							//$("#fees1").val('');
				jQuery("#lab_sublist_list_div").html(msg);	
				get_total_amt(patient_id);
			}
		});

}
function get_lab_details_billing()
		{
			//alert($('#pat_id').val());
		$.ajax({
			type: "post",
			url: "add_lab_detailsop.php", 
			data: {
				patient_id : $('#pat_id').val(),
				action:'list',
				
				},
			success: function(msg) {
				//console.log(msg);
				jQuery("#lab_sublist_list_div").html(msg);	
				//$('#depart2').val('');
				//$('#consultant2').val('');
				//$('#visit2').val('');
				get_total_amt($('#pat_id').val());
			}
		});

}
function delete_iplabpatient_details(id,sample_no,patient_id)
{
	//alert(id);
	//alert(patient_id);
		$.ajax({
			type: "post",
			url: "add_lab_detailsop.php", 
			data: {
				id : id,
				sample_no:sample_no,
				patient_id : patient_id,
				action:'delete',
				},
			success: function(msg) {
				console.log(msg);
				jQuery("#lab_sublist_list_div").html(msg);	
				get_total_amt(patient_id);
			}
		});

}

function delete_patient_details(id,patient_id)
{
	//alert(id);
	//alert(patient_id);
		$.ajax({
			type: "post",
			url: "deletelabdetails.php", 
			data: {
				id : id,
				patient_id : patient_id,
				},
			success: function(msg) {
				jQuery("#lab_sublist_list_div").html(msg);	
				get_total_amt(patient_id);
			}
		});

}
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






