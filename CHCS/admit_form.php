<?php
session_start();
$role=$_SESSION['role'];

$sql = array();
$print_bill='';
date_default_timezone_set('Asia/Kolkata'); 
		include("config_db2.php");
		$mrdno = $_GET['mrd_no'];
		 function get_admitdate($inv_pat_id)
						 {
							$cmd1 = "select create_date from inv_patient where inv_pat_id='$inv_pat_id'";
							$res1 = mysql_query($cmd1);
							while($rs1 = mysql_fetch_array($res1))
							{
								$create_date = $rs1['create_date'];
							} 
							 return $create_date;
							 }
                        
						 
						 $cmd = "select inv_pat_id,create_date from inv_patient WHERE patientid='$mrdno' order by id DESC LIMIT 1";
							$res = mysql_query($cmd);
							while($rs = mysql_fetch_array($res))
							{
								$inv_pat_id = $rs['inv_pat_id'];
								//$admit_date=get_admitdate($inv_pat_id);
								$admit_date = $rs['create_date'];
							}
                     $cmd=mysql_query("select * from settings where role='$role'");
					 if(isset($sql['print_bill'])){
$print_bill=$sql['print_bill'];
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
		
		<link href="css/bootstrap/bootstrap-datetimepicker.css" rel="stylesheet">		
        <!-- EOF CSS INCLUDE -->    
		
       <script type="text/javascript">

$('#submit').on('click', function(e){
   e.preventDefault();
});

function update_patient(source,mrd_no,ward,room,room_alloc_date,depart,consultant,type,update_id)
		{
			
			
   if ($('#source').val() == "") {
			alert('Source Name cannot be left blank!');
			return false;
		}
		if ($('#ward').val() == "") {
			alert('Ward Name cannot be left blank!');
			return false;
		}
		if ($('#room').val() == "" || $('#room').val() === "undefined") {
			alert('Room cannot be left blank!');
			return false;
		}
		
		if ($('#depart').val() == "") {
			alert('Department Name cannot be left blank!');
			return false;
		}
		
		
		if ($('#type_pat').val() == "") {
			alert('Type Name cannot be left blank!');
			return false;
		}
		
if(source!='')
{
		$.ajax({
        type: "POST",
		url: "invisit_patient_db.php",
		data: "source="+source+"&mrd_no="+mrd_no+"&ward="+ward+"&room="+room+"&room_alloc_date="+room_alloc_date+"&depart="+depart+"&consultant="+consultant+"&type="+type+"&update_id="+update_id+"&action=update_patient",
		success: function(msg){
			console.log(msg);
			var x=msg.split("~");
				if(x[0] == 'admitted'){
					var ipno = x[1];
				var info='IPNO:'+ipno+' Patient Admitted';
				$("#confirm_infomsg .infomsg").empty();
				$("#confirm_infomsg .infomsg").append(info);
				$('#confirm_infomsg')
				.modal({ backdrop: 'static', keyboard: false })
				.one('click', '[data-value]', function (e) {
				if($(this).data('value')) {
					window.close();	
					}
				});
				
				}else if(x[0] == 'failure'){
					var errmsg = x[1];
					var info=errmsg;
				$(".infomsg").empty();
				$(".infomsg").append(info);
				$('#myModal_infomsg').modal('show');
				return false;
				}
			//alert(msg);
			
		//jQuery("#get_patient_entries1_div").html(msg);
		
		
		}
			});
}
       }
function get_ward_room_det()
{
	var ward=$('#ward option:selected').val();
			$.ajax({
		type: "POST",
		url: "getroomno.php",
		data: {ward:ward,},
		success: function(msg) {
			//alert(msg);
			var opt = msg.split("~");
			$("#room").empty().selectpicker('refresh');
			$.each( opt, function( i, val ) {
			var id = val.split("+");
	  			$("#room").append("<option title='"+id[0]+"' value='"+id[1]+"'>"+id[0]+"</option>").selectpicker('refresh');			 
			  });
			 }
		});
		} 
function get_depart_det()
{
	var depart=$('#depart option:selected').val();
	console.log(depart);
			$.ajax({
		type: "POST",
		url: "getdoctor.php",
		data: {depart:depart,},
		success: function(msg) {
			var opt = msg.split("~");
			$("#consultant").empty().selectpicker('refresh');
			$.each( opt, function( i, val ) {
			var id = val.split("+");
	  			$("#consultant").append("<option title='"+id[0]+"' value='"+id[1]+"'>"+id[0]+"</option>").selectpicker('refresh');			 
			  });
			 }
		});
		} 		
</script>
<style type="text/css">
	.ui-dialog {overflow: visible;}

</style>
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container" style="background:#33414E;">
            
            <!-- START PAGE SIDEBAR -->
            <!-- END PAGE SIDEBAR -->
            
            <!-- PAGE CONTENT -->
            <div class="page-content" >
                
           <div class="page-content-wrap">
                
                    <div class="row">
                        
                        <div class="col-md-12"> 
						 <div class="panel panel-default">   
						  <div class="panel-body" style="background:#33414E;" >                    
						
                            <!-- START JQUERY VALIDATION PLUGIN -->
                           <?php  date_default_timezone_set('Asia/Kolkata');   ?>
                                    <form id="jvalidate" role="form" class="form-horizontal">
                                    <div class="panel-body">
                                    <h5 style="color:#FFF">Source</h5>
                                        <div class="form-group">
										 <div class="col-md-4" align="left">
                                            <div class="col-md-9" style="background:rgba(0, 0, 0, 0.2);border:0px;  background: rgba(0, 0, 0, 0.2);  padding: 10px 15px;  color: #CCC;  line-height: 20px;  height: auto;  -webkit-transition: all 200ms ease;  -moz-transition: all 200ms ease;  -ms-transition: all 200ms ease;  -o-transition: all 200ms ease;  transition: all 200ms ease;">
                                                <select name="source" id="source" class="form-control select">
                                                <option value="">Select Source</option>
                                                <option value="Causal/emergency room">Causal /emergency room</option>
                                                <option value="Doctor reference">Doctor reference</option>
                                                <option value="Elective patient">Elective patient</option>
                                                </select>
                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
											   
                                   
                                           <div class="col-md-6" >
                                             <label class="col-md-3 control-label"  style="color:#FFF">MRD No:</label>  
                                            <div class="col-md-7"  >
                                                <input type="text" style="font-weight:bold;background:rgba(0, 0, 0, 0.2);border:0px;  background: rgba(0, 0,0, 0.2);  padding: 10px 15px;  color: #CCC;  line-height: 20px;  height: auto;  -webkit-transition: all 200ms ease;  -moz-transition: all 200ms ease;  -ms-transition: all 200ms ease;  -o-transition: all 200ms ease;  transition: all 200ms ease;"  class="form-control" name="mrd_no" id="mrd_no" value="<?php echo $_GET['mrd_no'];?>" readonly />
                                                  <span class="help-block"></span>  
												</div>                                        
												   </div>                   
                       
										</div>
                                        
                                       <h5 style="color:#FFF">Ward</h5>
                                       <div class="form-group">
										 <div class="col-md-4" align="left">
                                            <div class="col-md-9"  style="background:rgba(0, 0, 0, 0.2);border:0px;  background: rgba(0, 0, 0, 0.2); padding:10px 15px;  color: #CCC;  line-height: 20px;  height: auto;  -webkit-transition: all 200ms ease; -moz-transition: all 200ms ease;  -ms-transition: all 200ms ease;  -o-transition: all 200ms ease;  transition:all 200ms ease;">
                                          <select name="ward" id="ward" class="form-control select" onChange="get_ward_room_det()" >
                                                <option value="">Select</option>
                                                <?php
																include("config_db1.php");
												$cmd = "select * from ward_creation order by id asc";
							$res = mysql_query($cmd);
							while($rs = mysql_fetch_array($res))
							{
							$id = $rs['id'];
							$ward_name = $rs['ward_name'];
						?>
                                                <option value="<?php echo $id;?>"><?php echo $ward_name;?></option><?php } ?>
                                                </select>
                                                                                               <span class="help-block"></span> 
												</div>                                        
												   </div>
                       <div class="col-md-4" >
                                                                   <label class="col-md-3 control-label"  style="color:#FFF">Room:</label>  

                                            <div class="col-md-7"  style="font-weight:bold;background:rgba(0, 0, 0, 0.2);border:0px;  background: rgba(0, 0,0, 0.2);  padding: 10px 15px;  color: #CCC;  line-height: 20px;  height: auto;  -webkit-transition: all 200ms ease;  -moz-transition: all 200ms ease;  -ms-transition: all 200ms ease;  -o-transition: all 200ms ease; transition: all 200ms ease;" >
  <select id="room"   class="form-control select">
                                         <option value="">Select</option>
                                                <?php
																include("config_db1.php");
												$cmd = "select * from room_no where vacant='' OR vacant='yes' order by id asc";
							$res = mysql_query($cmd);
							while($rs = mysql_fetch_array($res))
							{
							$id = $rs['id'];
							$room = $rs['room'];
						?>
                                                <option value="<?php echo $id;?>"><?php echo $room;?></option><?php } ?>
                                                </select>
                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
												   						 <div class="col-md-4">
																		  <label class="col-md-4 control-label"  style="color:#FFF">Allocation Date/Time</label>  
												 
												 
                    
					 <input type="text" style="font-weight:bold;width:160px;"  class="form-control" name="room_alloc_date" id="room_alloc_date" value="<?php echo date("d-m-Y H:i:s");?>"/>
				
	  
					
				
                </div>  
										</div>
                                         
										
                                      <h5 style="color:#FFF">Depart</h5>
                                        <div class="form-group">
                                        <div class="col-md-4">
                                            <div class="col-md-9"  style="background:rgba(0, 0, 0, 0.2);border:0px;  background: rgba(0, 0, 0, 0.2); padding:10px 15px;  color: #CCC;  line-height: 20px;  height: auto;  -webkit-transition: all 200ms ease;  -moz-transition: all 200ms ease;  -ms-transition: all 200ms ease;  -o-transition: all 200ms ease;  transition: all 200ms ease;">
                                                <select name="depart" id="depart" class="form-control select" onChange="get_depart_det()">
                                                <option value="">Select</option>
                                                <?php
																include("config_db1.php");
												$cmd = "select * from department_creation order by id asc";
							$res = mysql_query($cmd);
							while($rs = mysql_fetch_array($res))
							{
							$id = $rs['id'];
							$department_names = $rs['department_names'];
						?>
                                                <option value="<?php echo $department_names;?>"><?php echo $department_names;?></option><?php } ?>
                                                </select>
                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
												   <div class="col-md-4" >
                                                                   <label class="col-md-3 control-label"  style="color:#FFF">Consultant:</label>  

                                            <div class="col-md-7"  style="font-weight:bold;background:rgba(0, 0, 0, 0.2);border:0px;  background: rgba(0, 0,0, 0.2);  padding: 10px 15px;  color: #CCC;  line-height: 20px;  height: auto;  -webkit-transition: all 200ms ease;  -moz-transition: all 200ms ease;  -ms-transition: all 200ms ease;  -o-transition: all 200ms ease; transition: all 200ms ease;" >
   <select name="consultant" id="consultant" class="form-control select" >
                                                <option value="">Select</option>
                                                <?php
																include("config_db1.php");
												$cmd = "select * from doctor_creation order by id asc";
							$res = mysql_query($cmd);
							while($rs = mysql_fetch_array($res))
							{
							$id = $rs['id'];
							$doctor_name = $rs['doctor_name'];
						?>
                                                <option value="<?php echo $id;?>"><?php echo $doctor_name;?></option><?php } ?>
                                                </select>
                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
												   <div class="col-md-4" >
                                                                   <label class="col-md-3 control-label"  style="color:#FFF">Type:</label>  

                                            <div class="col-md-7"   style="font-weight:bold;background:rgba(0, 0, 0, 0.2);border:0px;  background: rgba(0, 0,0, 0.2);  padding: 10px 15px;  color: #CCC;  line-height: 20px;  height: auto;  -webkit-transition: all 200ms ease;  -moz-transition: all 200ms ease;  -ms-transition: all 200ms ease;  -o-transition: all 200ms ease;  transition: all 200ms ease;">
                                                <select name="type_pat" id="type_pat" class="form-control select">
                                                <option value="">Select</option>
                                                <option value="Visiting consultant">Visiting consultant</option>
                                                <option value="Hospital consultant">Hospital consultant</option>
                                                <option value="Duty doctor">Duty doctor</option>
                                                </select> 
                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
										</div>
                                        <div class="form-group">
                                        										 <div class="col-md-3" align="center">
</div>
										 <div class="col-md-5" align="center">
                                         								<input type="button" class="btn btn-info btn-block" style="width:100px;" name="submit" id="submit"  onClick="update_patient(source.value,mrd_no.value,ward.value,room.value,room_alloc_date.value,depart.value,consultant.value,type_pat.value,'<?php echo $inv_pat_id?>')" value="Admit"/>

                                    </div>
                                    										 <div class="col-md-5" align="center">
</div>                                               
                                    </form>
                       
                            
                            <!-- END JQUERY VALIDATION PLUGIN -->
                          
				
							
							
						
							</div>
							</div>
                            <!-- END JQUERY VALIDATION PLUGIN -->
                            </div>
							</div>
							
							
							
                        </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                </div></div>
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
		<!-- Modal -->
<div id="myModal_infomsg" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Message</h4>
      </div>
      <div class="modal-body">
        <p class='infomsg'>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->
<div id="confirm_infomsg" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirm</h4>
      </div>
      <div class="modal-body">
        <p class='infomsg'>Do you want to continue?</p>
      </div>
      <div class="modal-footer">
         <button type="button" data-dismiss="modal" class="btn btn-primary" data-value="1">Ok</button>
    
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
        
	<script src="js/plugins/bootstrap/moment-with-locales.js"></script>
	<script src="js/plugins/bootstrap/bootstrap-datetimepicker.js"></script>
    <script type='text/javascript'>
	
$(function(){
    
	//$('.pickdate').datetimepicker({ format: 'dd-MM-yyyy hh:mm:ss' });	
	 $('#room_alloc_date').datetimepicker({
format: "DD-MM-YYYY HH:mm:ss",

});
   
});

		jQuery('#ward').on('change', function() {
			txt = $('#ward').val();
			if(txt==1)
			return false;
			jQuery.ajax({
				type: "post",
				url: "room_no.php",
				data: {
					ward: txt,
				},
				success: function(value) {
					jQuery("#room").val(value).selectmenu('refresh', true);

				}
			});
		});
		</script>

		
		
		
		
		
		
		






