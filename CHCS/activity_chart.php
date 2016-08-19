<?php
session_start();
$role=$_SESSION['role'];
//$pid=$_REQUEST['pid'];
 include("config_db1.php");
 $cmd=mysql_query("select * from settings where role='$role'");
 $cat=$_SESSION['category'];
 $v=mysql_query("select display_name from complaint_tbl_name where id=$cat");
$v=mysql_fetch_array($v);
$display=$v['display_name'];
 mysql_close($db1);
$sql=mysql_fetch_array($cmd);
$billrights=$sql['print_bill'];

$reqrights=$sql['print_request'];
$prerights=$sql['prescription'];
if($sql['clinicalhistory'] !=1)
{
echo '<script>alert("You could not access this page");</script>';
echo '<script>window.location.href="home.php"</script>';
exit();
}

 date_default_timezone_set('Asia/Kolkata'); 
if(isset($_REQUEST['pid'])){
		$pid = $_REQUEST['pid'];
		include("config_db2.php");
		$sql1 = "SELECT patientid,patientname,age,gender FROM patientdetails WHERE patientid='$pid'";
		$result = mysql_query($sql1);
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
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<!-- /Added by HTTrack -->
<head>
<!-- META SECTION -->
<title>DPP- Clinical History</title>
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
		.ui-autocomplete {
  z-index:2147483647;
}
</style>
<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery/jquery-migrate.min.js"></script>
<script type="text/javascript" src="js/demo_tables.js"></script>
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="js/plugins/form/jquery.form.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap-select.js"></script>
<script type="text/javascript" src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
<script type='text/javascript' src='js/plugins/maskedinput/jquery.maskedinput.min.js'></script>
<script type="text/javascript" src="js/plugins/cropper/cropper.min.js"></script>
<script type="text/javascript" src="js/faq.js"></script>
<script type='text/javascript' src='js/plugins/noty/themes/default.js'></script>
<script type="text/javascript" src="js/plugins.js"></script>
<script type="text/javascript" src="js/actions.js"></script>
<script>
function check_vacant_room(status)
{
	if(status=='Discharge'){
		document.getElementById('vacant_chk').checked=true; 
	}
	else{
		document.getElementById('vacant_chk').checked=false; 
	}
}
function add_service(service,service_no,ref_no)
{
	if ($('#service_no').val() == "") {
			alert('Enter the Service Days/Hours!');
			return false;
		}
		$.ajax({
			type: "post",
			url: "addservices.php", 
			data: {
				service_no : service_no,
				service : service,
				ref_no : ref_no,
				},
			success: function(msg) {		
				$('#service_no').val('');
				jQuery("#service_list_div").html(msg);	
				//jQuery("#service_list_div").html(msg).trigger("create");
				//$('#service').val('');
			}
		});
}
function delete_services(serviceid,chart_ot,ref_no)
{
		$.ajax({
			type: "post",
			url: "deleteservices.php", 
			data: {
				serviceid : serviceid,chart_ot : chart_ot,ref_no : ref_no,},
			success: function(msg) {
				jQuery("#service_list_div").html(msg);
			}
		});
}

function add_procedures(procedures,procedure_no,ref_no)
{
	//alert(procedures);
	//alert(procedure_no);
	//alert(ref_no);
	if ($('#procedure_no').val() == "") {
			alert('Enter the Procedure Days/Hours!');
			return false;
		}
		$.ajax({
			type: "post",
			url: "addprocedures.php", 
			data: {
				procedure_no : procedure_no,
				procedures : procedures,
				ref_no : ref_no,
				},
			success: function(msg) {
				jQuery("#procedures_list_div").html(msg);	
				//jQuery("#service_list_div").html(msg).trigger("create");
				$('#procedure_no').val('');
				//$('#procedures').val('');
			}
		});
}
function delete_procedures(procedureid,chart_ot,ref_no)
{
		$.ajax({
			type: "post",
			url: "deleteprocedures.php", 
			data: {
				procedureid : procedureid,chart_ot : chart_ot,ref_no : ref_no,},
			success: function(msg) {
				jQuery("#procedures_list_div").html(msg);
			}
		});
}

function delete_consultants(delete_id,chart_ot,ref_no)
{
	
		$.ajax({
			type: "post",
			url: "deleteconsultantdetails.php", 
			data: {
				delete_id : delete_id,chart_ot : chart_ot,ref_no : ref_no,},
			success: function(msg) {
				jQuery("#consultant_list_div").html(msg);
			}
		});
}
function add_consulting_details(depart,consultant,visit,ref_no)
{
		if ($('#depart').val() == "") {
			alert('Select Department !');
			return false;
		}
		if ($('#consultant').val() == "") {
			alert('Select Consultant!');
			return false;
		}
		if ($('#visit').val() == "") {
			alert('Select Visit!');
			return false;
		}

		$.ajax({
			type: "post",
			url: "addconsultantdetails.php", 
			data: {
				depart : depart,
				consultant : consultant,
				visit : visit,
				ref_no : ref_no,
				},
			success: function(msg) {
				jQuery("#consultant_list_div").html(msg);	
				//jQuery("#service_list_div").html(msg).trigger("create");
				$('#procedure_no').val('');
				//$('#procedures').val('');
			}
		});

}
function add_chart_ot(room_no,name,age,doa,cons,intimedate,chart_ot_no,description,shift_patient,outtime,vacant_chk)
{
			$.ajax({
			type: "post",
			url: "addchartot.php", 
			data: {
				room_no : room_no,name : name,age : age,doa : doa,cons : cons,intimedate : intimedate,chart_ot_no : chart_ot_no,description : description,shift_patient : shift_patient,outtime : outtime,vacant_chk : vacant_chk,
				},
			success: function(msg) {
				alert(msg);
				//jQuery("#consultant_list_div").html(msg);	
				//jQuery("#service_list_div").html(msg).trigger("create");
				//$('#procedure_no').val('');
				//$('#procedures').val('');
			}
		});

}
</script>
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
      <input type="text" name="search" placeholder="Search..."/>
    </form>
  </li>
  <!-- END SEARCH -->
  <!-- POWER OFF -->
  <li class="xn-icon-button pull-right last"> <a href="#"><span class="fa fa-power-off"></span></a>
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
      <div id="appmsg" class="panel-body list-group list-group-contacts scroll" style="height: 200px;"> </div>
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
  <!-- END MESSAGES -->
  <!-- TASKS -->
  <!-- END TASKS -->
  <!-- LANG BAR -->
  <!-- END LANG BAR -->
</ul> 
<?php 
function get_dept_name($id)
{include("config_db1.php");
					$cmd_ser1 = "select * from department_creation where id='$id'";
					$res_ser1 = mysql_query($cmd_ser1);
					while($rs_ser1 = mysql_fetch_array($res_ser1))
					{
								$name=$rs_ser1['department_names'];
                     }
                                return $name;

}
function get_consult_name($id)
{include("config_db1.php");
					$cmd_ser2 = "select * from doctor_creation where id='$id'";
					$res_ser2 = mysql_query($cmd_ser2);
					while($rs_ser2 = mysql_fetch_array($res_ser2)){
								$name=$rs_ser2['doctor_name'];
                                }
                                return $name;
}
function get_visit_name($id)
{include("config_db1.php");
					$cmd_ser3 = "select * from visit_creation where id='$id'";
					$res_ser3 = mysql_query($cmd_ser3);
					while($rs_ser3 = mysql_fetch_array($res_ser3)){
								$name=$rs_ser3['visit_name'];
                                $vtypes=$rs_ser3['vtypes'];
                                }
                                return $name."/".$vtypes;

}


?>
<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">                
	<div class="row">

		<div class="col-md-12"> 
			<div class="panel panel-default">   
				<div class="panel-body">                    

                <form id="jvalidate" role="form" class="form-horizontal">
                <div class="panel-body">
  <!-- STARTS BASIC DIV -->                		
  <div class="form-group">
			<div class="col-md-3">
            	<label class="col-md-6 control-label">Room No:</label>  
                <div class="col-md-4">
                      <input type="text" style="width:90px;font-weight:bold"  class="form-control" name="room_no" id="room_no"/>
                      <span class="help-block"></span> 
				</div>                                        
			</div>
											   
                                  
            <div class="col-md-2">
               <label class="col-md-4 control-label">Name:</label>  
               <div class="col-md-5">
                    <input type="text" style="font-weight:bold;width:110px;"  class="form-control" name="pat_name" id="pat_name"/>
                    <span class="help-block"></span>  
			   </div>                                        
			</div>       
                       
            <div class="col-md-3">
                <label class="col-md-4 control-label">Age/Gender</label>  
                <div class="col-md-5">
                    <input type="text" style="font-weight:bold;width:110px;"  class="form-control" name="age"/>
                    <span class="help-block"></span> 
                </div>                                        
            </div>
            
            <div class="col-md-2">
                <label class="col-md-3 control-label">DOA</label>  
                <div class="col-md-5">
                    <input type="text" style="font-weight:bold;width:110px;"  class="form-control" name="doa"/>
                    <span class="help-block"></span> 
                </div>                                        
            </div>
            
            <div class="col-md-2">
                <label class="col-md-3 control-label">Cons:</label>  
                <div class="col-md-5">
                    <input type="text" style="font-weight:bold;width:110px;"  class="form-control" name="cons"/>
                    <span class="help-block"></span> 
                </div>                                        
            </div>
		</div>	
<!-- 1 ROW END  -->   
      
        <div class="form-group">
            <div class="col-md-4">
                <label class="col-md-6 control-label">Physiotheraphu</label>  
                <div class="col-md-1">
                    <input type="datetime" style="font-weight:bold;width:160px;"  class="form-control" name="intimedate" id="intimedate" value="<?php echo date("Y-m-d h:i:s", $d);?>"/>
                </div>                                        
            </div>
            <div class="col-md-4">
            <?php
			include("config_db2.php");
					$cmd_ser1 = "select * from chart_ot order by id desc limit 1";
					$res_ser1 = mysql_query($cmd_ser1);
					while($rs_ser1 = mysql_fetch_array($res_ser1)){
								$ref_no=$rs_ser1['ref_no'];
					}
					if($ref_no!='')
					{
						$ref_no='1';
					}
					else
					{
						$ref_no=$ref_no+1;
					}
			?>
            <input type="hidden" style="font-weight:bold;width:110px;"  class="form-control" name="chart_ot_no" id="chart_ot_no" value="<?php echo $ref_no;?>"/>
            </div>
        </div>
<!-- 2 ROW END  --> 
        
        <div class="form-group">
            <div class="col-md-4">
                <label class="col-md-6 control-label">Service:</label>  
                <div class="col-md-1">
                        <select name="service" id="service" class="select" style="font-weight:bold;width:160px;">
                        <option value="">select</option>
                    <?php 
					include("config_db1.php");
					$cmd_ser = "select * from service_creation";
					$res_ser = mysql_query($cmd_ser);
					while($rs_ser = mysql_fetch_array($res_ser)){
								$service_name=$rs_ser['service_name'];
								$types=$rs_ser['types'];
								$amount=$rs_ser['amount'];
								$id=$rs_ser['id'];
					?>
                    	<option value="<?php echo $id."@#@#".$service_name."@#@#".$types."@#@#".$amount?>"><?php echo $service_name."/".$types?></option>
                        <?php }?>
                        </select>   
                </div> 
            </div>                  
            <div class="col-md-1">
                 <input type="text" style="width:60px;font-weight:bold"  class="form-control" name="service_no" id="service_no"/>             
            </div>   
          
            <div class="col-md-1">
                <a href="#"  onClick="add_service(service.value,service_no.value,chart_ot_no.value);" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-plus"></span></a>            </div>   
                
            <div class="col-md-4">
                <label class="col-md-6 control-label">Procedures:</label>  
                <div class="col-md-1">
                        <select name="procedures" id="procedures" class="select" style="font-weight:bold;width:160px;">
                        <option>select</option>
                    <?php 
					include("config_db1.php");
					$cmd_ser = "select * from procedure_creation";
					$res_ser = mysql_query($cmd_ser);
					while($rs_ser = mysql_fetch_array($res_ser)){
								$procedure_name=$rs_ser['procedure_name'];
								$ptypes=$rs_ser['ptypes'];
								$pamount=$rs_ser['pamount'];
								$id=$rs_ser['id'];
					?>
                    	<option value="<?php echo $id."@#@#".$procedure_name."@#@#".$ptypes."@#@#".$pamount?>"><?php echo $procedure_name."/".$ptypes?></option>
                        <?php }?>
                        </select>   
                </div> 
            </div>                  
            <div class="col-md-1">
                 <input type="text" style="width:60px;font-weight:bold"  class="form-control" name="procedure_no" id="procedure_no"/>             
            </div>   
          
            <div class="col-md-1">
                <a href="#"  onClick="add_procedures(procedures.value,procedure_no.value,chart_ot_no.value);" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-plus"></span></a>            </div>   

        </div>
<!-- 3 ROW END  -->
 
        <div class="form-group">
                
            <div class="col-md-6">
				<center>
					
                        <div id="service_list_div">
                        <table id="dataTables-example" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Services</th>
                        <th>Duration</th>
                        <th>Total</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         <?php 
					include("config_db2.php");
					$cmd = "select * from services_details where ref_no='$ref_no'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						$insert_from='CHART OT';
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['service_name']; ?></td>
						<td><?php echo $rs['duration']; ?></td>
						<td><?php echo $rs['total_count']; ?></td>
						<td><a href="#" onclick="delete_services('<?php echo $rs['id'];?>','<?php echo $insert_from;?>','<?php echo $ref_no;?>')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php }
				?>
                        </tbody>
                        </table>

                        </div>
				</center>
			</div>
            <div class="col-md-6">
				<center>
                <div id="procedures_list_div">
					<table id="dataTables-example" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Services</th>
                        <th>Fees</th>
                        <th>Fees</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         <?php 
					include("config_db2.php");
					$cmd = "select * from procedure_details where ref_no='$ref_no'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						$insert_from='CHART OT';
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['procedure_name']; ?></td>
						<td><?php echo $rs['duration']; ?></td>
						<td><?php echo $rs['total_count']; ?></td>
						<td><a href="#" onclick="delete_procedures('<?php echo $rs['id'];?>','<?php echo $insert_from;?>','<?php echo $ref_no;?>')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php }
				?>

                        </tbody>
                    </table>
                    </div>
				</center>
			</div>

        </div>
<!-- 4 ROW END  -->    
    
        <div class="form-group">
            <div class="col-md-4">
                <label class="col-md-6 control-label">Depart:</label>  
                <div class="col-md-1">
                        <select name="depart" id="depart" class="select" style="font-weight:bold;width:160px;">
                        <option>select</option>
                  <?php 
				  include("config_db1.php");
					$cmd_ser = "select * from department_creation order by department_names asc";
					$res_ser = mysql_query($cmd_ser);
					while($rs_ser = mysql_fetch_array($res_ser)){
								$department_names=$rs_ser['department_names'];
								$id=$rs_ser['id'];
					?>
                    	<option value="<?php echo $id?>"><?php echo $department_names?></option>
                        <?php }?>
                        </select>                
                </div> 
            </div>                
            
            <div class="col-md-4">
                <label class="col-md-4 control-label">Consultant:</label>  
                <div class="col-md-1">
                        <select name="consultant" id="consultant" class="select" style="font-weight:bold;width:160px;">
                        <option>select</option>
                     <?php 
					 include("config_db1.php");
					$cmd_ser = "select * from doctor_creation order by doctor_name asc";
					$res_ser = mysql_query($cmd_ser);
					while($rs_ser = mysql_fetch_array($res_ser)){
								$doctor_name=$rs_ser['doctor_name'];
								$id=$rs_ser['id'];
					?>
                    	<option value="<?php echo $id?>"><?php echo $doctor_name?></option>
                        <?php }?>

                        </select>                
                </div> 
            </div>                

            <div class="col-md-3">
                <label class="col-md-2 control-label">Visit:</label>  
                <div class="col-md-1">
                        <select name="visit" id="visit" class="select" style="font-weight:bold;width:160px;">
                        <option>select</option>
                    <?php 
					include("config_db1.php");
					$cmd_ser = "select * from visit_creation";
					$res_ser = mysql_query($cmd_ser);
					while($rs_ser = mysql_fetch_array($res_ser)){
								$visit_name=$rs_ser['visit_name'];
								$vtypes=$rs_ser['vtypes'];
								$vamount=$rs_ser['vamount'];
								$id=$rs_ser['id'];
					?>
                    	<option value="<?php echo $id?>"><?php echo $visit_name."/".$vtypes?></option>
                        <?php }?>

                        </select>                
                </div> 
            </div>                
            <div class="col-md-1">
                <a href="#"  onClick="add_consulting_details(depart.value,consultant.value,visit.value,chart_ot_no.value);" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-plus"></span></a>            </div>                                    
		</div>	
<!-- 5 ROW END  -->  



        <div class="form-group">
			<div class="col-md-1">
            </div>
            <div class="col-md-10">
				<center>
                <div id="consultant_list_div">
					<table id="dataTables-example" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Department</th>
                        <th>Consultant</th>
                        <th>Visit</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                   <?php 
					include("config_db2.php");
					$cmd = "select * from consultant_details where ref_no='$ref_no' and insert_from='CHART OT'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
				
						$insert_from='CHART OT';
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo get_dept_name($rs['department']); ?></td>
						<td><?php echo get_consult_name($rs['consultant']); ?></td>
						<td><?php echo get_visit_name($rs['visit']); ?></td>
						<td><a href="#" onclick="delete_consultants('<?php echo $rs['id'];?>','<?php echo $insert_from;?>','<?php echo $ref_no;?>')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php }
				?>

                        </tbody>
                    </table>
                    </div>
				</center>
			</div>
		</div>




        <div class="form-group">
            <div class="col-md-4">
                <label class="col-md-6 control-label">Procedure:</label>  
                <div class="col-md-1">
					<textarea name="description" id="description" class="form-control" style="width:400px;"></textarea>                
                </div> 
            </div>                
        </div>
<!-- 6 ROW END  -->  

        <div class="form-group">
            <div class="col-md-4">
                <label class="col-md-6 control-label">Shift Patient To:</label>  
                <div class="col-md-1">
                        <select name="shift_patient" id="shift_patient" class="select" style="font-weight:bold;width:160px;" onChange="check_vacant_room(this.value)">
                        <option>select</option>
                        <option value="Discharge">Discharge</option>
                     <?php 
					include("config_db1.php");
					$cmd = "select * from room_no";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						?>
<option value="<?php echo $rs['id'];?>"><?php echo $rs['room'];?></option>
<?php }?>
                        </select>                
                </div> 
            </div>                
        </div>
<!-- 7 ROW END  -->  
        
        <div class="form-group">
            <div class="col-md-4">
                <label class="col-md-6 control-label">Vacant Room:</label>  
                <div class="col-md-1">
                <input type="checkbox" id="vacant_chk" name="vacant_chk" value="checked">
                </div> 
            </div>                
        </div>
<!-- 8 ROW END  -->          
        <div class="form-group">
            <div class="col-md-4">
                <label class="col-md-6 control-label">Out Date and Time:</label>  
                <div class="col-md-1">
                <?php
				$d=mktime(11, 14, 54, 8, 12, 2014);
				?>
                    <input type="datetime" style="font-weight:bold;width:160px;"  class="form-control" name="outtime" id="outtime" value="<?php echo date("Y-m-d h:i:s", $d);?>"/>
                </div> 
            </div>                
        </div>
<!-- 9 ROW END  -->  
                                        <div class="form-group">
										 <div class="col-md-10" align="center">
												   </div>
                                                   <div class="col-md-8" align="center">
                                        <input name="submit" id="submit" class="btn btn-primary" value="submit" type="button" onClick="add_chart_ot(room_no.value,pat_name.value,age.value,doa.value,cons.value,intimedate.value,chart_ot_no.value,description.value,shift_patient.value,outtime.value,vacant_chk.value)">
                                                   </div>
                                     <div class="col-md-2"  align="center">
												   </div>

<!-- ENDS BASIC DIV -->                		
                </div>
                </form>
                </div>
            </div>                                   
        </div>
    </div>
</div>    
