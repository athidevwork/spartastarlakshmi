<?php
session_start();
$role=$_SESSION['role'];
//$pid=$_REQUEST['pid'];
function get_labfee($lab_id_arg,$lab_sub_id_arg){
			include("config_db1.php");
		//Retrieve lab test main title from investigation table
		$inves_query=mysql_query("select title from investigation where id = $lab_id_arg AND status=1 LIMIT 1");
		$inves_query_array=mysql_fetch_array($inves_query);
		$lab_title=strtolower($inves_query_array['title']);
		
		//Lab sub title query to get fee details using title as table from investiogation
		$rate=0;
		if(!empty($lab_sub_id_arg)){
		$lab_query=mysql_query("select rate from $lab_title where id = $lab_sub_id_arg AND status=1 LIMIT 1");
		$lab_query_array=mysql_fetch_array($lab_query);
		$rate=strtolower($lab_query_array['rate']);
		}
		
		return $rate;
	}
	function get_labtype($lab_id_arg){
			include("config_db1.php");
		//Retrieve lab test main title from investigation table
		$inves_query=mysql_query("select title from investigation where id = $lab_id_arg AND status=1 LIMIT 1");
		$inves_query_array=mysql_fetch_array($inves_query);
		$lab_title=strtolower($inves_query_array['title']);
		
		return $lab_title;
	}
	function get_labtest($lab_id_arg,$lab_sub_id_arg){
			include("config_db1.php");
		//Retrieve lab test main title from investigation table
		$inves_query=mysql_query("select title from investigation where id = $lab_id_arg AND status=1 LIMIT 1");
		$inves_query_array=mysql_fetch_array($inves_query);
		$lab_title=strtolower($inves_query_array['title']);
		
		//Lab sub title query to get fee details using title as table from investiogation
		$sym='';
		if(!empty($lab_sub_id_arg)){
		$lab_query=mysql_query("select sym from $lab_title where id = $lab_sub_id_arg AND status=1 LIMIT 1");
		$lab_query_array=mysql_fetch_array($lab_query);
		$sym=strtolower($lab_query_array['sym']);
		}
		return $sym;
	}
 include("config_db1.php");
 $cmd=mysql_query("select * from settings where role='$role'");
 $cat=$_SESSION['category'];
 $v=mysql_query("select display_name from complaint_tbl_name where id=$cat");
$v=mysql_fetch_array($v);
$display=$v['display_name'];
 mysql_close($db1);
$sql=mysql_fetch_array($cmd);
$billrights=$sql['print_bill'];
$chartot=$sql['chartot'];
$clinicalchart=$sql['clinicalchart'];
$activitycharticu=$sql['activitycharticu'];
$activitychart=$sql['activitychart'];
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
			$patient_id = $pid = $rs['patientid'];		
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
	
	function get_room_name($room)
  {
	  		include("config_db1.php");
    $sql2="select * from  room_no where id='$room'"; 
  $rs2=mysql_query($sql2);
	while($rsdata2=mysql_fetch_array($rs2))
	  {
	   $room=$rsdata2['room'];
  		}
  return $room;
  }
  
  
  function get_consul_name($consultant)
  {
	  	  		include("config_db1.php");
   $sql2="select * from  doctor_creation where id='$consultant'"; 
  $rs2=mysql_query($sql2);
	while($rsdata2=mysql_fetch_array($rs2))
	  {
	   $doctor_name=$rsdata2['doctor_name'];
  		}
  return $doctor_name;
  }
	if(isset($_REQUEST['pid'])){
		$pid = $_REQUEST['pid'];
		include("config_db2.php");
		 $sql1 = "SELECT * FROM inv_patient WHERE patientid='$pid' AND pat_ip_status = 0 LIMIT 1";
		$result = mysql_query($sql1);
		if(mysql_num_rows($result) != 0){
			$rs = mysql_fetch_array($result);
			$room = $rs['room'];
			$room_name=get_room_name($room);		
			$create_date = $rs['create_date'];
			$inv_pat_id = $rs['inv_pat_id'];
			$patientid = $rs['patientid'];
			$consultant = $rs['consultant'];
			$consultant_name=get_consul_name($consultant);	
			
		}else{
			$room = "";
			$create_date = "";
			$consultant = "";
			$pat_ip_status = 1;
			$inv_pat_id = "";
		}
		mysql_close($db2);
	}
	else{
		$room = "";
		$create_date = "";
		$consultant = "";	
	}
	 include("config_db1.php");
 
 
$time=date("h:i"); 
	
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
    <div class="col-md-1"> </div>
    <div class="col-md-10">
      <div  class="panel panel-default">
        <div  class="panel-body">
          <!--<h5>Patient Details.</h5>-->
          <form class="form-horizontal" role="form">
            <input type="hidden" value="<?php echo $billrights;?>" id="billrights">
            <input type="hidden" value="<?php echo $reqrights;?>" id="reqrights">
            <input type="hidden" value="<?php echo $prerights;?>" id="prerights">
            <input type="hidden" value="<?php echo $display;?>" id="display">
			<input type="hidden" value="<?php echo $pid;?>" id="pid">
            <!--  <input type="hidden" id="cpresid" name="cpresid" >-->
            <div class="form-group">
              <!--<div class="col-md-12">
                                            <div class="btn-group btn-group-justified">  
                                                <a href="#" class="btn btn-primary active">Patient ID</a>
                                                <a href="#" class="btn btn-primary">Patient Name</a>
                                                <a href="#" class="btn btn-primary">Age</a>
                                                <a href="#" class="btn btn-primary">Gender</a>
												<a href="#" class="btn btn-primary">Date</a>                                          
												  </div>                                         
                                        </div>-->
              <div class="col-md-12">
                <div class="btn-group btn-group-justified">
             <a data-toggle="tooltip" data-placement="top" title="Go to Summary" href="patient-info.php?pid=<?php echo $pid; ?>" class="btn btn-success"><?php echo $inv_pat_id; ?></a>   <a data-toggle="tooltip" data-placement="top" title="Go to Summary" href="patient-info.php?pid=<?php echo $pid; ?>" class="btn btn-success"><?php echo $room_name; ?></a>    <a data-toggle="tooltip" data-placement="top" title="Go to Summary" href="patient-info.php?pid=<?php echo $pid; ?>" class="btn btn-success"><?php echo $pid; ?></a> <a data-toggle="tooltip" data-placement="top" title="Go to Summary" href="patient-info.php?pid=<?php echo $pid; ?>" class="btn btn-success "><?php echo $patientname; ?></a> <a data-toggle="tooltip" data-placement="top" title="Go to Summary" href="patient-info.php?pid=<?php echo $pid; ?>" class="btn btn-success"><?php echo $age; ?></a> <a data-toggle="tooltip" data-placement="top" title="Go to Summary" href="patient-info.php?pid=<?php echo $pid; ?>" class="btn btn-success"><?php echo $gender; ?></a> <a data-toggle="tooltip" data-placement="top" title="Go to Summary" href="patient-info.php?pid=<?php echo $pid; ?>" class="btn btn-success"><?php if(!empty($create_date)) { echo date('d/m/Y',strtotime($create_date)); } else { echo '';} ?></a> <a data-toggle="tooltip" data-placement="top" title="Go to Summary" href="patient-info.php?pid=<?php echo $pid; ?>" class="btn btn-success"><?php echo $consultant_name; ?></a></div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-1"> </div>
    <div class="col-md-12">
      <form class="form-horizontal">
      <div class="panel panel-default tabs">
      <ul class="nav nav-tabs" role="tablist">
        <?php if($activitychart==1 && !empty($inv_pat_id)) {?><li id="1" class="active"><a href="#tab-first"  role="tab" data-toggle="tab">Activity Chart</a></li><?php } ?>
        <?php if($clinicalchart==1) {?> <li id="2" <?php if(empty($inv_pat_id)) { echo ' class="active"'; } ?>><a href="#tab-second" role="tab" data-toggle="tab">Clinical Chart</a></li><?php } ?>
        <li id="3"><a href="#tab-third" role="tab" data-toggle="tab">Investigation</a></li>
		<li id="5"><a href="#tab-five" role="tab" data-toggle="tab">Medication</a></li>
      
        <div style="padding-top:4px"> <a href="#" onClick="saveall()"  data-box="#message-box-success" class="btn btn-primary">Save All <span class="fa fa-floppy-o fa-right"></span></a>
          <!--<a href="#" role="tab" onClick="pause1()" ><img width="40" height="40"src="img/pause.png" /></a>-->
          <a href="#tab-six" role="tab" data-toggle="tab" class="btn btn-primary">Upload <span class="fa fa-upload fa-right"></span></a>
          <?php
										if($billrights==2)
										{ ?>
          <a href="#" onClick="get()" data-toggle="tab" class="btn btn-primary" >Billing <span class="fa fa-credit-card fa-right"></span></a>
          <?php }
											?>
        </div>
      </ul>
      <script>
									function pause1()
									{
									var s=$('.tab-pane.active').attr('id');
									var val="";
									if(s=='tab-first')
									{
									val=20;
									savecompliants();
									}
									if(s=='tab-second')
									{val=40;
									savemedhistory();
									}
									if(s=='tab-third')
									{val=55;
									saveinvestigation();
									}
									if(s=='tab-four')
									{val=70;
									saveinvestigation();
									}
									if(s=='tab-five')
									{val=90;
									savemedication();
									}
									var y=$("#pid").val();
									
									var per=s.split("-");
									//alert(s);
									$.ajax({
		type: "POST",
		url: "pausecom.php",
		data: { id:y,
		per:val,
		},
		success: function(msg) {
		//window.location.href="home.php";
		}
	});
							
									}
									</script>
      <div class="panel-body tab-content">
<div class="tab-pane <?php if(!empty($inv_pat_id)) { echo 'active'; } ?>" id="tab-first">
        <div class="row">
          <div class="col-md-12">
                                  <form action="#" class="form-horizontal" method="post" >
              <div class="form-group" style="display:none;">
										 <div class="col-md-2">
                                            <label class="col-md-6 control-label">Room:</label>  
                                            <div class="col-md-4">
                      <span style="width:100px;font-weight:bold; font-size:14px "class="form-control"><?php echo $room_name;?></span><input type="hidden" style="width:100px;font-weight:bold;" readonly name="room_no2"  id="room_no2" value="<?php echo $room_name;?>"/>
                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
											   
                                   
                                                     <div class="col-md-3">
                                            <label class="col-md-4 control-label">Name:</label>  
                                            <div class="col-md-5">
                    <span style="width:175px;font-weight:bold; font-size:14px "class="form-control"><?php echo $patientname;?></span><input type="hidden" style="font-weight:bold;width:175px;"   name="pat_name2"readonly id="pat_name2" value="<?php echo $patientname;?>"/>
                                                  <span class="help-block"></span>  
												</div>                                        
												   </div>       
                       
										 <div class="col-md-2">
                                            <label class="col-md-4 control-label">Age:</label>  
                                            <div class="col-md-5">
                    <span style="width:75px;font-weight:bold; font-size:14px "class="form-control"><?php echo $age;?></span><input type="hidden" style="font-weight:bold;width:75px;"  class="form-control" name="age2" id="age2"readonly value="<?php echo $age;?>"/>
                                               <span class="help-block"></span> 
												</div>                                        
												   </div>
                                                   <div class="col-md-2">
                                            <label class="col-md-4 control-label">DOA:</label>  
                                            <div class="col-md-6">
                   <span style="width:150px;font-weight:bold; font-size:14px " class="form-control" > <?php echo date('d-m-Y',strtotime($create_date));?><input type="hidden"   class="form-control" name="doa2" id="doa2"readonly value="<?php echo date('d-m-Y',strtotime($create_date));?>"/>
                                               <span class="help-block"></span> 
												</div>                                        
												   </div>
                                                   <div class="col-md-2">
                                            <label class="col-md-6 control-label">Cons:</label>  
                                            <div class="col-md-5">
                    <span style="width:175px;font-weight:bold; font-size:14px "class="form-control"><?php echo $consultant_name;?></span><input type="hidden" style="font-weight:bold;width:175px;"  class="form-control" name="cons2" id="cons2"readonly value="<?php echo $consultant_name;?>"/>
                                               <span class="help-block"></span> 
												</div>                                        
												   </div><div class="col-md-4">
            <?php
			include("config_db2.php");
					$cmd_ser1 = "select * from chart_ot order by id desc limit 1";
					$res_ser1 = mysql_query($cmd_ser1);
					while($rs_ser1 = mysql_fetch_array($res_ser1)){
								$ref_no=$rs_ser1['ref_id'];
					}
					if($ref_no=='')
					{
						$ref_no='1';
					}
					else
					{
						$ref_no=$ref_no+1;
					}
			?>
            <input type="hidden" style="font-weight:bold;width:110px;"  class="form-control" name="chart_ot_no2" id="chart_ot_no2" value="<?php echo $ref_no;?>"/>
            </div>
										</div>	
                                         <div class="form-group">
										 <div class="col-md-2">
                                            <label class="col-md-7 control-label">Physiotheraphy:</label>  
                                            <div class="col-md-4">
<input type="checkbox" id="physiotheraphy" name="physiotheraphy"  style="height:25px; width:20px;" onClick="display_checkbox();"/>                                                
<span class="help-block"></span> 
												</div>                                        
												   </div>
                                                  <div id="table1" style="display:none;">
                                                     <div class="col-md-4">
                                            <label class="col-md-4 control-label">Type:</label>  
                                            <div class="col-md-7">
<select id="type_name" name="type_name" class="form-control select" >
 <option value="">Select</option>
<?php 
					include("config_db1.php");
					$cmd_ser = "select * from type_creation";
					$res_ser = mysql_query($cmd_ser);
					while($rs_ser = mysql_fetch_array($res_ser)){
								$type_name=$rs_ser['type_name'];
								$amounts=$rs_ser['amounts'];
								$id=$rs_ser['id'];
					?>
                    	<option value="<?php echo $id."@#@#".$type_name."@#@#".$amounts?>"><?php echo $type_name;?></option>
                        <?php }?>
                        </select>  
     <span class="help-block"></span>  
												</div>                                        
												   </div>       
                       
										 <div class="col-md-3">
                                            <label class="col-md-4 control-label">Sitting:</label>  
                                            <div class="col-md-7">
                                            <select id="sitting" name="sitting" class="form-control select" style="width:150px;">
                                            <option value="">Select</option>
                                            <option value="1">1</option>
                                             <option value="2">2</option>
                                              <option value="3">3</option>
                                               <option value="4">4</option>
                                              <option value="5">5</option>
</select>  
                                               <span class="help-block"></span> 
												</div>                                        
												   </div>
                                                               <div class="col-md-1">
                <a href="#"  onClick="add_sitting(type_name.value,sitting.value,chart_ot_no2.value);return false;" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-plus"></span></a>         </div>   

										</div>
                                         <div class="form-group">
                
            <div class="col-md-6">
				<center>
					
                        <div id="sitting_list_div">
                        <table id="dataTables-example" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Type Name</th>
                        <th>Sitting</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         <?php 
					include("config_db2.php");
					$cmd = "select * from sitting_details where patient_id='$patient_id' AND paid_status !=1 AND bill_queue='0'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['type_name']; ?></td>
						<td><?php echo $rs['sitting']; ?></td>
						<td><a href="#" onClick="delete_sitting('<?php echo $rs['id'];?>','<?php echo $ref_no;?>');return false;" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php }
				?>
                        </tbody>
                        </table>

                        </div>
				</center>
			</div>
        </div></div>
										<div class="form-group">
										 <div class="col-md-4">
                                           <label class="col-md-6 control-label">Intime and Date:</label>  
                <div class="col-md-1">
               
                    <input type="datetime" style="font-weight:bold;width:160px;"  class="form-control datepicker" name="intimedate2" id="intimedate2" value="<?php echo date("d-m-Y h:i:sa");?>"/>
                </div>                                        
												   </div></div>
                                              <div class="form-group">
                                                              <label class="col-md-1 control-label"><h3>Service:</h3></label>  
                                           <label class="col-md-5 control-label"><h3>&nbsp;&nbsp;&nbsp;Procedure:</h3></label>  

                   
                     </div>                     
										  <div class="form-group">

          <div class="col-md-4"><div class="col-md-12">
            <div class="col-md-7" >
                        <select name="service2" id="service2" class="select" style="font-weight:bold;">
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
            <div class="col-md-3">
                 <input type="text" style="font-weight:bold"  class="form-control" name="service_no2" id="service_no2"/>             
            </div>   
          
												 <?php 
												   if($pat_ip_status !=1){
												   ?>
													<div class="col-md-2">
														<a href="#"  onClick="add_service2(service2.value,service_no2.value,chart_ot_no2.value);return false;" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-plus"></span></a>         </div> 
												<?php
												   }
												   ?>
                </div></div>
                
          <div class="col-md-8"><div class="col-md-12">
            <div class="col-md-4">
                        <select name="procedures2" id="procedures2" class="select" style="font-weight:bold;">
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
            <div class="col-md-2">
                 <input type="text" style="font-weight:bold"  class="form-control" name="procedure_no2" id="procedure_no2" value="<?php //echo $time;?>"/>             
            </div> 
          <div class="col-md-4">
                                  <select name="consultantname2" id="consultantname2" class="select" style="font-weight:bold;">
                                  <option>select</option>
                    <?php 
					include("config_db1.php");
					$cmd_ser = "select * from doctor_creation";
					$res_ser = mysql_query($cmd_ser);
					while($rs_ser = mysql_fetch_array($res_ser)){
								$doctor_name=$rs_ser['doctor_name'];
								$id=$rs_ser['id'];
					?>
                    	<option value="<?php echo $doctor_name;?>"><?php echo $doctor_name;?></option>
                        <?php }?>
                        </select> 
            </div>
            <div class="col-md-1"> <input type="text" style="font-weight:bold; width:60px;" class="form-control" name="fees_amount2" id="fees_amount2"/> </div>
			 <?php 
 if($pat_ip_status !=1){
  ?>
            <div class="col-md-1">
                <a href="#"  onClick="add_procedures2(procedures2.value,procedure_no2.value,chart_ot_no2.value,consultantname2.value,fees_amount2.value);return false;" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-plus"></span></a>       </div>   
				<?php } ?>
 </div>
 </div></div> 
<!-- 3 ROW END  -->
 
        <div class="form-group">
                
            <div class="col-md-4">
				<center>
					
                        <div id="service2_list_div">
                        <table id="dataTables-example" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Services</th>
                        <th>Duration</th>
                        <th>Timing</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         <?php 
					include("config_db2.php");
					$cmd = "select * from services_details where patient_id='$patient_id' AND insert_from='CHART' AND paid_status !=1 AND bill_queue='0'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						$insert_from='CHART';
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['service_name']; ?></td>
						<td><?php echo $rs['duration']; ?></td>
						<td><?php echo $rs['given_details']; ?></td>
						<td><a href="#" onClick="delete_services2('<?php echo $rs['id'];?>','<?php echo $insert_from;?>','<?php echo $ref_no;?>');return false;" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php }
				?>
                        </tbody>
                        </table>

                        </div>
				</center>
			</div>
            <div class="col-md-8">
				<center>
                <div id="procedures2_list_div">
					<table id="dataTables-example" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Procedure</th>
                        <th>Duration</th>
                        <th>Timing</th>
                       <th>Consultant</th>
                        <th>Amount</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         <?php 
					include("config_db2.php");
					$cmd = "select * from procedure_details where insert_from='CHART' AND paid_status !=1 AND patient_id='$patient_id' AND bill_queue='0'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						$insert_from='CHART';
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['procedure_name']; ?></td>
						<td><?php echo $rs['duration']; ?></td>
						<td><?php echo $rs['given_details']; ?></td>
                        <td><?php echo $rs['consultant']; ?></td>
                        <td><?php echo $rs['fees_amount']; ?></td>	
						<td><a href="#" onClick="delete_procedures2('<?php echo $rs['id'];?>','<?php echo $insert_from;?>','<?php echo $ref_no;?>')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
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
            <div class="col-md-3">
                <label class="col-md-3 control-label">Depart:</label>  
                <div class="col-md-1">
                        <select name="depart2" id="depart2" class="select" style="font-weight:bold;width:160px;"  onChange="get_depart_det()">
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
                <label class="col-md-3 control-label">Consul:</label>  
                <div class="col-md-1">
                        <select name="consultant2" id="consultant2" class="select" style="font-weight:bold;width:160px;">
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
                        <select name="visit2" id="visit2" class="select" style="font-weight:bold;width:160px;">
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
			 <?php 
 if($pat_ip_status !=1){
  ?>  
            <div class="col-md-1">
                <a href="#"  onClick="add_consulting_details2(depart2.value,consultant2.value,visit2.value,chart_ot_no2.value);return false;" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-plus"></span></a>            </div>    
				 <?php } ?>                                
		</div>	
<!-- 5 ROW END  -->   <div class="form-group">
            <div class="col-md-10">
				<center>
                <div id="consultant2_list_div">
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
					
					$cmd = "select * from consultant_details where insert_from='CHART' AND paid_status !=1 AND patient_id='$patient_id' AND bill_queue='0'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
				
						$insert_from='CHART';
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo get_dept_names($rs['department']); ?></td>
						<td><?php echo get_consult_names($rs['consultant']); ?></td>
						<td><?php echo get_visit_names($rs['visit']); ?></td>
						<td><a href="#" onClick="delete_consultants2('<?php echo $rs['id'];?>','<?php echo $insert_from;?>','<?php echo $ref_no;?>')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php }
				?>

                        </tbody>
                    </table>
                    </div>
				</center>
			</div>
		</div>
		<h3>Room Details</h3>
										<div class="col-md-12">
										 <div id="room_sublist_div">
                        <table id="room_decription_ids" class="table table-striped table-bordered table-hover" width="75%">
										<thead>
										<tr>
										<th>#</th>
										<th>Room No</th>
										<th>IN Time</th>
										<th>Out Time</th>
										
										</tr>
										</thead>
										 <tbody>
                       
                        <?php 
					include("config_db2.php");
					
					$cmd = "select * from room_bill_details where ip_no='$inv_pat_id'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						$rm_id = $rs['room_id'];
						include("config_db1.php");
						$cmd_get_rm_no = mysql_query("select room from room_no where id ='$rm_id'");
						$cmd_get_rm_no_array = mysql_fetch_array($cmd_get_rm_no);
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $cmd_get_rm_no_array['room']; ?></td>
						<td><?php echo $rs['from_time']; ?></td>
						<td><?php echo $rs['to_time']; ?></td>
                       
                        </tr>
					<?php }
				?>

                        </tbody>
                    </table></div>

</div>	                                
         <div class="form-group">
            <div class="col-md-4">
                <label class="col-md-6 control-label">Notes:</label>  
                <div class="col-md-5">
					<textarea name="description2" id="description2" class="form-control" style="font-weight:bold;width:250px;"></textarea>                
                </div> 
            </div>                
            <div class="col-md-6">
                <label class="col-md-6 control-label">Shift Patient To:</label>  
                <div class="col-md-1">
				
                        <select name="shift_patient2" id="shift_patient2" class="select" style="font-weight:bold;width:160px;" onChange="check_vacant_room2(this.value)">
                        <option>select</option>
                        <option value="Discharge">Discharge</option>
                    <?php 
					include("config_db2.php");
					$cmd = "select DISTINCT(room) as room_id from inv_patient where pat_ip_status=0 AND room <>''";
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
					$rs_array[] = $rs['room_id'];
					}
					$res_db2=implode("," , $rs_array);
					include("config_db1.php");
					$cmd = "select * from room_no WHERE vacant ='' OR vacant ='$inv_pat_id'";
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
                <input type="checkbox" id="vacant_chk2" name="vacant_chk2" value="checked">
                </div> 
            </div>                
            <div class="col-md-4">
                <label class="col-md-6 control-label">Out Date and Time:</label>  
                <div class="col-md-1">
                    <input type="datetime" style="font-weight:bold;width:160px;"  class="form-control datepicker" name="outtime2" id="outtime2" value="<?php echo date("d-m-Y h:i:sa");?>"/>
                </div> 
            </div>                
        </div>
<!-- 9 ROW END  -->  
                                        <div class="form-group">
										 <div class="col-md-10" align="center">
												   </div>
												   <?php 
												   if($pat_ip_status !=1){
												   ?>
                                                   <div class="col-md-8" align="center">
                                        <input name="submit" id="submit" class="btn btn-primary" value="submit" type="button" onClick="add_chart_ot2(room_no2.value,pat_name2.value,age2.value,doa2.value,cons2.value,intimedate2.value,chart_ot_no2.value,description2.value,shift_patient2.value,outtime2.value,vacant_chk2.value)">
                                                   </div>
												   <?php
												   }
												   ?>
                                     <div class="col-md-2"  align="center">
												   </div> </div>
        </div></div>
        </div>
      <?php 
							
		//{//upcom($(this));
		//$sym='sd';
		$blood=$rs['bloodgroup'];
		$oth=str_replace("<br />","~",$rs['medicalhistory']);
		$oth=substr($oth,0,-1);
		$fam=str_replace("<br />","~",$rs['familyhistory']);
		$fam=substr($fam,0,-1);
		$per=str_replace("<br />","~",$rs['personalhistory']);
		$per=substr($per,0,-1);
		$psy=str_replace("<br />","~",$rs['Psychiatrichistory']);
		$psy=substr($psy,0,-1);
		
		if($rs['asthma']=='Yes')
		$asthma='checked="checked"';
		else
		$asthma='';
		
		if($rs['diabetes']=='Yes')
		$diabetes='checked="checked"';
		else
		$diabetes='';
		
		if($rs['coronary']=='Yes')
		$coronary='checked="checked"';
		else
		$coronary='';
		
		if($rs['hypertension']=='Yes')
		$hypertension='checked="checked"';
		else
		$hypertension='';
		
		if($rs['cad']=='Yes')
		$cad='checked="checked"';
		else
		$cad='';
		
		?>
      <div class="tab-pane <?php if(empty($inv_pat_id)) { echo ' active'; } ?>" id="tab-second">
        <div class="row">
                        
                        <div class="col-md-12"> 
						 <div class="panel panel-default">   
						  <div class="panel-body">                    
						
                            <!-- START JQUERY VALIDATION PLUGIN -->
                           <?php  date_default_timezone_set('Asia/Kolkata'); ?>
                                    <form id="jvalidate" role="form" class="form-horizontal">
                                    <div class="panel-body">                                    
                                        <div class="form-group">
                                        <div class="col-md-1" align="center">
                                                                        <label class="col-md-5 control-label">Complaints:</label>  

												   </div>
										 <div class="col-md-2" align="left">
                                            <div class="col-md-3">
                                          <?php  
										  																include("config_db2.php");

												$cmd = "select complaint_no from clinical_history order by id asc";
							$res = mysql_query($cmd);
							while($rs = mysql_fetch_array($res))
							{
							$complaint_no = $rs['complaint_no'];
							}
							if($complaint_no=='')
							{
								$complaint_num='com-'.'0001';
								}
								else{
									$complaint_numb=explode('-',$complaint_no);
									 $complaint_no=$complaint_numb[1]+1;
									$complaint_num='com-'.str_pad($complaint_no, 4, '0', STR_PAD_LEFT);
									}
						?>
                                            <input type="hidden" name="complaint_no" id="complaint_no" value="<?php echo $complaint_num;?>">
                                            <select name="complaints" id="complaints" class="select">    
                                            <option value='' selected="selected">select</option>
                                             <?php
																include("config_db1.php");
												$cmd = "select * from complaint_tbl_name order by id asc";
							$res = mysql_query($cmd);
							while($rs = mysql_fetch_array($res))
							{
							$id = $rs['id'];
							$tbl_name = $rs['tbl_name'];
						?>
                                                <option value="<?php echo $id;?>"><?php echo $tbl_name;?></option><?php } ?>                                           
                                            </select>
                                            <span class="help-block"></span> 
												</div>                                        
												   </div>
										</div>	   
										<div class="form-group">
                                        <div class="col-md-1">
                                             <div class="col-md-1" >
                                            </div>
                                                                                    
												   </div>
										 <div class="col-md-2">
                                           <label class="col-md-3 " >DM:</label> 
                                             <div class="col-md-1" >
                                            <input name="dm" id="dm" type="checkbox" value="1"></div>
                                                                                    
												   </div>
											   
                                   
                                                     <div class="col-md-2">
                                           <label class="col-md-3 " >CAD:</label> 
                                             <div class="col-md-1" >
                                            <input name="cad" id="cad" type="checkbox" value="1"></div>
                                                                                    
												   </div>
                                                    <div class="col-md-2">
                                           <label class="col-md-4" >Asthma:</label> 
                                             <div class="col-md-2" >
                                            <input name="asthma" id="asthma" type="checkbox" value="1"></div>
                                                                                    
												   </div>
                                                   <div class="col-md-2">
                                           <label class="col-md-4 " >Seizure:</label> 
                                             <div class="col-md-2" >
                                            <input name="seizure" id="seizure" type="checkbox" value="1"></div>
                                                                                    
												   </div>
										</div>
                                        <div class="form-group">
										 <div class="col-md-4">
                                           <label class="col-md-3  control-label" >Others:</label> 
                                             <div class="col-md-7" >
                                                             <input type="text" style="font-weight:bold"  class="form-control" name="others" id="others"/>             
</div>
                                                     <div class="col-md-2">
                <a href="#"  onClick="add_others('#others','#others_div','Others',others.value);return false;" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-plus"></span></a>            </div>                                
												   </div>
                                                   
                 <div class="col-md-4">
                                           <label class="col-md-5  control-label" >Personal History:</label> 
                                             <div class="col-md-5" >
                                                             <input type="text" style="font-weight:bold"  class="form-control" name="personal" id="personal"/>             
</div>
                                                     <div class="col-md-2">
                <a href="#"  onClick="add_others('#personal','#personal_div','Personal History',personal.value);return false;" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-plus"></span></a>            </div>                               
												   </div>
                                                    <div class="col-md-4">
                                           <label class="col-md-5  control-label" >Family History:</label> 
                                             <div class="col-md-5" >
                                                             <input type="text" style="font-weight:bold"  class="form-control" name="family" id="family"/>             
</div>
                                                     <div class="col-md-2">
                <a href="#"  onClick="add_others('#family','#family_div','Family History',family.value);return false;" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-plus"></span></a>            </div>                               
												   </div>
                                                   
										</div>
                                        <div class="form-group">
                
            <div class="col-md-4">
				<center>
                <div id="others_div">
					<table id="dataTables-examples1" class="table table-striped table-bordered table-hover" width="40%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>others</th>
                        <th style="display:none;">id</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="clinical_add" name="clinical_add">
                         
				  <?php 
					include("config_db2.php");
					$cmd = "select id,reason from clinical_others  where patient_id='$patient_id' AND clinical_history_id='' AND  type='Others' order by id asc";
					$i=1;
			$res = mysql_query($cmd);
			while($rs = mysql_fetch_array($res)){
			if($rs['role']==1)
			$role="Admin";
			
			if($rs['role']==2)
			$role="User";
			if($rs['role']==3)
			$role="Lab";
						echo '<tr>
						<td> '.$i++.' </td>
						<td>'.$rs['reason'].'</td>
						<td style="display:none;">'.$rs['id'].'</td>
						<td>
						<a href="javascript:delete_id(\''.$rs['id'].'\',\'#others_div\')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
					</tr>';
					}
				?> 
										  </tbody>
                    </table>
                    </div>
				</center>
			</div>
            <div class="col-md-4">
				<center>
                                <div id="personal_div">
					<table id="dataTables-examples2" class="table table-striped table-bordered table-hover" width="40%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Personal History</th>
                       <th>Action</th>
                        </tr>
                        </thead>
                        <tbody id="personal_add" name="personal_add">
                        <?php 
							include("config_db2.php");
					$cmd = "select id,reason from clinical_others  where patient_id='$patient_id' AND clinical_history_id='' AND type='Personal History' order by id asc";
					$i=1;
			$res = mysql_query($cmd);
			while($rs = mysql_fetch_array($res)){
			if($rs['role']==1)
			$role="Admin";
			
			if($rs['role']==2)
			$role="User";
			if($rs['role']==3)
			$role="Lab";
						echo '<tr>
						<td> '.$i++.' </td>
						<td>'.$rs['reason'].'</td>
						<td style="display:none;">'.$rs['id'].'</td>
						<td>
						<a href="javascript:delete_id(\''.$rs['id'].'\',\'#personal_div\')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
					</tr>';
					}
				?> 
										  </tbody>
                    </table>
				</center>
			</div>
<div class="col-md-4">
				<center>
                <div id="family_div">
					<table id="dataTables-examples3" class="table table-striped table-bordered table-hover" width="40%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Family History</th>
                       <th>Action</th>
                        </tr>
                        </thead>
                         <tbody id="family_add" name="family_add">
                          <?php 
				include("config_db2.php");
					$cmd = "select id,reason from  clinical_others  where patient_id='$patient_id' AND clinical_history_id='' AND type='Family History' order by id asc";
					$i=1;
			$res = mysql_query($cmd);
			while($rs = mysql_fetch_array($res)){
			if($rs['role']==1)
			$role="Admin";
			
			if($rs['role']==2)
			$role="User";
			if($rs['role']==3)
			$role="Lab";
						echo '<tr>
						<td> '.$i++.' </td>
						<td>'.$rs['reason'].'</td>
						<td style="display:none;">'.$rs['id'].'</td>
						<td>
						<a href="javascript:delete_id(\''.$rs['id'].'\',\'#family_div\')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
					</tr>';
					}
				?> 
										  </tbody>
                    </table>
                    </div>
				</center>
			</div>
        </div>
                                        <div class="form-group">
										 <div class="col-md-2">
                                           <label class="col-md-10  control-label" >Diagnosis:</label> 
                                             <div class="col-md-2" >
                                            <select name="diagnosis" id="diagnosis" class="select">
                                            <option value=''  selected="selected">select</option>
                                            <?php
																include("config_db1.php");
												$cmd = "select * from diagnosis order by id asc";
							$res = mysql_query($cmd);
							while($rs = mysql_fetch_array($res))
							{
							$id = $rs['id'];
							$diag_sym = $rs['diag_sym'];
						?>
                                                <option value="<?php echo $id;?>"><?php echo $diag_sym;?></option><?php } ?>                                           
                                            </select></div>
                                                                                    
												   </div>
										</div>
                                        <div class="form-group">
										 <div class="col-md-10" align="center">
												   </div>
                                                   <div class="col-md-8" align="center">

                                        <input name="submit" id="addclinicsubmit" class="btn btn-primary" value="submit" type="button" onClick="add_clinic()">
                                                   </div>
                                     <div class="col-md-2"  align="center">
												   </div>
                                                   </div>
										
										
										                                                                                                                          
                                    </div>                                               
                                    </form>
                       
                            
                            <!-- END JQUERY VALIDATION PLUGIN -->
                     
				<table  class="table" id="getclinicalhistorytable">
      <thead>
        <tr>
           <th width="5%">Sl. No</th>
		   <th width="10%">Date</th>
			<th width="5%">Complaints</th>
			<th width="10%">Diagnosis</th>	
			<th width="10%">View</th>			
          
          
        </tr>
      </thead>
      <tbody>
	  </tbody>
	  </table>
		<div id="get_clinichist_modal"  class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Patient Clinical Details</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="panel-body" id="get_clinichist_modal_report">                    
						
                            <!-- START JQUERY VALIDATION PLUGIN -->
                          
                                   
                            <!-- END JQUERY VALIDATION PLUGIN -->
          </div>
            
            
            
          
        </div>
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-primary" onClick="printbill()" data-dismiss="modal">Print</button>-->
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>					
							
						
							</div>
							</div>
                            <!-- END JQUERY VALIDATION PLUGIN -->
                            </div>
							</div>
        <br>
        <br>
        <br>
        <div class="col-md-12"> </div>
      </div>
      <div class="tab-pane" id="tab-third">
        <div class="row">
          <div class="col-md-5">
            <div class="form-group">
              <!-- <label class="col-md-4 col-xs-12 control-label"></label>-->
              <div class="col-md-5 col-xs-12">
                <select id="inves" onChange="investigation()" class="form-control select">
                  <option value="0">Select</option>
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
                <span class="help-block">Select Investigation </span> </div>
              <div class="col-md-7 col-xs-12">
                <select id="inves_sub" data-live-search="true" class="form-control select">
                  <option>select</option>
                </select>
                <span class="help-block">Select Types </span> </div>
            </div>
            <div class="form-group">
              <label class="col-md-2 col-xs-12 control-label"></label>
              <div class="col-md-12 col-xs-12">
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                  <input type="text" id="reports"  name="reports" class="form-control" placeholder="Reports"/>
                </div>
                <span class="help-block">Reports</span> </div>
            </div>
            <div class="form-group">
              <label class="col-md-2 col-xs-12 control-label"></label>
              <div class="col-md-12 col-xs-12">
                <div class="input-group">
                  <!--  <span class="input-group-addon"><span class="fa fa-pencil"></span></span>-->
                  <input type="hidden" id="obser" name="obser" class="form-control" placeholder="Observation"/>
                </div>
                <!-- <span class="help-block">Observation </span>  -->
              </div>
            </div>
            <div class="form-group">
              <label class="col-md-2 col-xs-12 control-label"></label>
              <div class="col-md-12 col-xs-12">
                <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                  <input type="text" id="note" name="note" class="form-control" placeholder="Notes"/>
                </div>
                <span class="help-block">Notes </span> </div>
            </div>
            <div align="center"> <a href="#" class="btn btn-success" onClick="addlabinves();return false;"> <span class="fa fa-plus"></span> ADD</a>
              <br>
            </div>
			
          </div>
          <!--<input type="button" onClick="saveinvestigation()">-->
          <div id="reportadd" class="col-md-7">
            <table id="investable" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                        <th>No</th>
                        <th>Type </th>
                        <th>Test</th>
                        <th>Reports</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         <?php 
						 
						
						include("config_db2.php");
	
					$cmd = "select * from lab_details_ip where patient_id='$patient_id' and paid_status!='1' AND bill_queue != '1' AND labsampleno =''";
					$i=1;
					$res = mysql_query($cmd);
					while($rs_array = mysql_fetch_array($res)){
						?>
                        <tr>
						<td style="display:none"><?php echo $rs_array['id'] ?> </td>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo get_labtype($rs_array['lab_id']); ?></td>
						<td><?php echo get_labtest($rs_array['lab_id'],$rs_array['lab_sub_id']); ?></td>
						<td><?php echo $rs_array['reports']; ?></td>
						<td><a href="#" onclick="delete_lab_inves_details('<?php echo $rs_array['id'];?>','<?php echo $rs_array['patient_id'];?>');return false;" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php }
				?>

                        </tbody>
                    </table>

          </div>
		  <div class="col-md-12" align="right">
                                        <input name="submit" id="submit" class="btn btn-primary" value="Submit" onclick="addlabinves_save('<?php echo $patient_id;?>','');return false;" type="button">
                                                   </div>
        </div>
        <br>
        <br>
		                              <table  class="table" id="getlabhistorytable">
      <thead>
        <tr>
           <th width="5%">Sl. No</th>
		   <th width="10%">LAB Sample No</th>
			<th width="5%">Patient Type</th>
			<th width="10%">Test Name</th>	
			<th width="10%">Category</th>			
           <th width="10%">Requested on</th>
           <th width="10%">Collected on</th>
		   <th width="10%">Reported on</th>
          
        </tr>
      </thead>
      <tbody>
	  </tbody>
	  </table>
<div id="labsampletestedit_modal"  class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Investigation Details</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="panel-body" id="labsampletestedit_report">                    
						
                            <!-- START JQUERY VALIDATION PLUGIN -->
                           <?php  date_default_timezone_set('Asia/Kolkata');   ?>
                                   
                            <!-- END JQUERY VALIDATION PLUGIN -->
          </div>
            
            
            
          
        </div>
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-primary" onClick="printbill()" data-dismiss="modal">Print</button>-->
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
        <script>
		
function getlabhistorytable(){


				var t = $('#getlabhistorytable').DataTable();
				var pid = $("#pid").val();
				
				$.ajax({
							type: "post",
							url: "returngetsampledteaillist_history.php",
							data: {patient_id:pid},
							success: function(msg) {
								var msg=$.trim(msg);
								t.clear().draw(false);;	
								if(msg=="")
								{
								$("#getlabhistorytable > tbody").append("<b>No Result Found</b>");
								return false;
								}
									var v=msg.split('@');
									var len=v.length;
									var j=1;	
								for (i = 0; i <len; i++) 
								{
										var s=j++;
										var x1= v[i].split("~");
										t.row.add([
										s,
										x1[0],
										x1[1],
										x1[2],
										x1[3],
										x1[4],
										x1[5],
										x1[6],
										msg, 
									]).draw();
								}
							//$('#bill1').trigger("reset");
							}
						});
}
function get_iplab_list(sampleno){
	var labsampleno = $(sampleno).data('id');
	 //console.log(labsampleno);
	//return false;	
		$.ajax({
		type: "POST",
		url: "returngetlabdteaillist_history.php",
		data: {sampleno:labsampleno},
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
		
		$('#labsampletestedit_report').html(msg);
		
		
		
		
		
		}
			
		}
	});
	}


										 function saveinvestigation()
										{
										//alert('hi');
										table = $("#investable");
										var pid = $("#pid").val();
										
										 var inves = [];
										 
									table.find('tbody > tr').each(function (rowIndex, r) {
										var cols = [];
										$(this).find('td').each(function (colIndex, c) {
											cols.push(c.textContent);
										});
										inves.push(cols);
									});
									
											$.ajax({
			type: "post",
			url: "investigationentry.php",
			data: {
				inves:inves,pid:pid,
			},
			success: function(msg) {
			//alert(msg);
			if(msg=='success')
				{
				msg='<p><span class="fa fa-check">Investigation  Sucessfully Added</span></p>';
			$("#appendmsg").append(msg);
			}
				//alert(msg);
				$("#reportadd").html("");
				//$("#lstsym").val('');
				//$('#medhistory').modal('close');
			}
		});
											//alert(res);
											
										//var x = x.replace("diagnostics", "");
										//var y=x.split("+");
//										var len=y.length;
//										var x = x.replace("diagnostics", ""); 
//										$.each( y, function(key,value ) {
//  										alert($.trim(value));
//										});
										//alert(x);
										
										}</script>
        <div class="col-md-12">
          <?php 
							include("config_db2.php");
	$cmd = "select  cast(datetime as date) as datetime from investigationreport where patientid='$pid' group by  cast(datetime as date) desc";
	$res = mysql_query($cmd);
	if(mysql_num_rows($res) != 0){	
		while($rs = mysql_fetch_array($res))
		{
		$date=$rs['datetime'];
		include("config_db2.php");
		$cmd =mysql_query("select id, cast(datetime as date) as datetime,test,complaint,notes,category,created_by,sub from investigationreport where patientid='$pid' order by datetime desc");
		$i=1;
		mysql_close($db2);
		
		 		
		
		echo '<div class="panel panel-default">
                                
                                <div class="panel-body faq">
                                    

                                    <div class="faq-item">
                                        <div class="faq-title"><span class="fa fa-angle-down"></span>'.$rs['datetime'].'
										 </div>
										
                                        <div class="faq-text">
										
                                           <div class="panel panel-default tabs" style="margin-top: 0px;">
                               
                                <div class="tab-content">
                                    <div " id="tab1">                                          
									 
                                        <div class="list-group list-group-contacts border-bottom">';
										
										echo '<div class="list-group-controls" style="z-index:1">
                                            <a herf="#" onClick="updateinvesigationmodal(\''.$date.'\',\''.$pid.'\')" class="btn btn-primary btn-rounded"><span class="fa fa-pencil"></span></a>
                                           </div>';
								
										
										
                                          echo'  <a href="#" class="list-group-item">                                                         
                                                <span class="contacts-title"><strong>'.$x[0].'</strong></span>
											<table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    
													
													<th>Test</th>
                                                    <th>Report</th>
                                                    <th>Notes</th>
                                                  
													
                                                </tr>
                                            </thead>
                                            <tbody>';
											while($rs = mysql_fetch_array($cmd)) {
											include("config_db1.php");
											$tblcat=$rs['category'];
											$sym_id=$rs['test'];
											$sub=$rs['sub'];
											$id=$rs['id'];
		$cmd12 =mysql_query("select title from investigation where id='$tblcat'");
	$rs12=mysql_fetch_array($cmd12);
	$tbl=$rs12['title'];
	$sql1=mysql_query("select sym from $tbl where id='$sym_id'");
	$getsym=mysql_fetch_array($sql1);
	if($sub==1)
	$pen='<a href="#" name="editimg" onclick="addreport('.$id.')" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-plus"></span></a>';
	else
	$pen=$rs['complaint'];
	mysql_close($db1);
											echo '  
											
											<tr>
											<td>'.$i++.'</td>
											<td>'.$getsym['sym'].'</td>
											<td>'.$pen.'</td>
											<td>'.$rs['notes'].'</td>
											</tr>'; }
											echo '</tbody>
											</table>
											
                                    
                                                                                    
                                            </a> ';   
											
											
											echo'                           
                                        </div>
                                        
                                    </div>
									
									
                                                                    
                                                                                                         
                                    
                                </div>
                                
                            </div>
                                           
											
                                         
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>';
			
		}
		
	}
	//mysql_close($db2);
?>
          <script>
		  function addreport(x) {
	//$('#reportadd').modal('show');
	$('#reportadd').toggle();
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
function updateinvesigationmodal(x,y)
{

//pid=$("#pid").val();
$.ajax({
			type: "post",
			url: "getinvet.php",
			data: {
				x:x,y:y,
			},
			success: function(msg) {
			var msg=$.trim(msg);
			//alert(msg);
			$('.modal-body').find("div#invesoldtable").empty();
			$('.modal-body').find("div#invesoldtable").prepend(msg);
			$('#inves12').modal('toggle');
			//window.location.href='complaints.php?pid='+pid;
			}
		});
//alert(x);
}
</script>

        </div>
      </div>
     
<?php 
function get_dept_names($id)
{include("config_db1.php");
					$cmd_ser1 = "select * from department_creation where id='$id'";
					$res_ser1 = mysql_query($cmd_ser1);
					while($rs_ser1 = mysql_fetch_array($res_ser1))
					{
								$name=$rs_ser1['department_names'];
                     }
                                return $name;

}
function get_consult_names($id)
{include("config_db1.php");
					$cmd_ser2 = "select * from doctor_creation where id='$id'";
					$res_ser2 = mysql_query($cmd_ser2);
					while($rs_ser2 = mysql_fetch_array($res_ser2)){
								$name=$rs_ser2['doctor_name'];
                                }
                                return $name;
}
function get_visit_names($id)
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
</script>

      <div class="tab-pane " id="tab-four">
        <div class="row">
          <div class="col-md-12">
              <div class="form-group" style="display:none;">
										 <div class="col-md-2">
                                            <label class="col-md-6 control-label">Room:</label>  
                                            <div class="col-md-4">
                      <span style="width:100px;font-weight:bold; font-size:14px "class="form-control"><?php echo $room_name;?></span><input type="hidden" style="width:100px;font-weight:bold"  class="form-control" name="room_no1" readonly id="room_no1" value="<?php echo $room_name;?>"/>
                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
											   
                                   
                                                     <div class="col-md-3">
                                            <label class="col-md-4 control-label">Name:</label>  
                                            <div class="col-md-5">
                    <span style="width:175px;font-weight:bold; font-size:14px "class="form-control"><?php echo $patientname;?></span><input type="hidden" style="font-weight:bold;width:175px;"  class="form-control" name="pat_name1"readonly id="pat_name1" value="<?php echo $patientname;?>"/>
                                                  <span class="help-block"></span>  
												</div>                                        
												   </div>       
                       
										 <div class="col-md-2">
                                            <label class="col-md-4 control-label">Age:</label>  
                                            <div class="col-md-5">
                    <span style="width:75px;font-weight:bold; font-size:14px "class="form-control"><?php echo $age;?></span><input type="hidden" style="font-weight:bold;width:75px;"  class="form-control" name="age1" id="age1" readonly value="<?php echo $age;?>"/>
                                               <span class="help-block"></span> 
												</div>                                        
												   </div>
                                                   <div class="col-md-2">
                                            <label class="col-md-4 control-label">DOA:</label>  
                                            <div class="col-md-5">
                     <span style="width:150px;font-weight:bold; font-size:14px "class="form-control"><?php echo date('d-m-Y',strtotime($create_date));?></span><input type="hidden" style="font-weight:bold;width:150px;"  class="form-control" name="doa1" id="doa1" readonly value="<?php echo date('d-m-Y',strtotime($create_date));?>"/>
                                               <span class="help-block"></span> 
												</div>                                        
												   </div>
                                                   <div class="col-md-2">
                                            <label class="col-md-6 control-label">Cons:</label>  
                                            <div class="col-md-5">
                    <span style="width:175px;font-weight:bold; font-size:14px "class="form-control"><?php echo $consultant_name;?></span><input type="hidden" style="font-weight:bold;width:175px;"  class="form-control" name="cons1" id="cons1" readonly value="<?php echo $consultant_name;?>"/>
                                               <span class="help-block"></span> 
												</div>                                        
												   </div>
										</div>	
										<div class="form-group">
										 <div class="col-md-4">
                                           <label class="col-md-6 control-label">Intime and Date:</label>  
                <div class="col-md-1">
               
                    <input type="datetime" style="font-weight:bold;width:160px;"  class="form-control datepicker" name="intimedate1" id="intimedate1" value="<?php echo date("d-m-Y h:i:sa");?>"/>
                </div>                                        
												   </div><div class="col-md-4">
            <?php
			include("config_db2.php");
					$cmd_ser1 = "select * from chart_ot order by id desc limit 1";
					$res_ser1 = mysql_query($cmd_ser1);
					while($rs_ser1 = mysql_fetch_array($res_ser1)){
								$ref_no=$rs_ser1['ref_id'];
					}
					if($ref_no=='')
					{
						$ref_no='1';
					}
					else
					{
						$ref_no=$ref_no+1;
					}
			?>
            <input type="hidden" style="font-weight:bold;width:110px;"  class="form-control" name="chart_ot_no1" id="chart_ot_no1" value="<?php echo $ref_no;?>"/>
            </div></div>
										  <div class="form-group">
                                                              <label class="col-md-1 control-label"><h3>Service:</h3></label>  
                                           <label class="col-md-5 control-label"><h3>&nbsp;&nbsp;&nbsp;Procedure:</h3></label>  

                   
                     </div>                     
										  <div class="form-group">

          <div class="col-md-4"><div class="col-md-12">
            <div class="col-md-7" style="padding-right:20px;">
                        <select name="service1" id="service1" class="select" style="font-weight:bold;">
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
            <div class="col-md-3">
                 <input type="text" style="font-weight:bold"  class="form-control" name="service_no1" id="service_no1"/>             
            </div>   
          
            <div class="col-md-2">
                <a href="#"  onClick="add_service1(service1.value,service_no1.value,chart_ot_no1.value);" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-plus"></span></a>         </div> 
                </div></div>
                
                
                
                
                                            

 <div class="col-md-8"><div class="col-md-12">
            <div class="col-md-4">
                        <select name="procedures1" id="procedures1" class="select" style="font-weight:bold;">
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
            <div class="col-md-2">
                 <input type="text" style="font-weight:bold; width:60px;"  class="form-control" name="procedure_no1" id="procedure_no1"  value="<?php echo $time;?>"/>             
            </div> 
          <div class="col-md-4">
                                  <select name="consultantname1" id="consultantname1" class="select" style="font-weight:bold;">
                                  <option>select</option>
                    <?php 
					include("config_db1.php");
					$cmd_ser = "select * from doctor_creation";
					$res_ser = mysql_query($cmd_ser);
					while($rs_ser = mysql_fetch_array($res_ser)){
								$doctor_name=$rs_ser['doctor_name'];
								$id=$rs_ser['id'];
					?>
                    	<option value="<?php echo $doctor_name;?>"><?php echo $doctor_name;?></option>
                        <?php }?>
                        </select> 
            </div>
            <div class="col-md-1"> <input type="text" style="font-weight:bold: width:70px;"  class="form-control" name="fees_amount1" id="fees_amount1"/></div>. 
            <div class="col-md-1">
                <a href="#"  onClick="add_procedures1(procedures1.value,procedure_no1.value,chart_ot_no1.value,consultantname1.value,fees_amount1.value);" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-plus"></span></a>       </div>   
 </div>
 </div></div> 
<!-- 3 ROW END  -->
 
        <div class="form-group">
                
            <div class="col-md-4">
				<center>
					
                        <div id="services_list_div">
                        <table id="dataTables-example" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Services</th>
                        <th>Duration</th>
                        <th>Timing</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         <?php 
					include("config_db2.php");
					$cmd = "select * from services_details where ref_no='$ref_no' and insert_from='CHART ICU'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						$insert_from='CHART ICU';
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['service_name']; ?></td>
						<td><?php echo $rs['duration']; ?></td>
						<td><?php echo $rs['given_details']; ?></td>
						<td><a href="#" onClick="delete_services1('<?php echo $rs['id'];?>','<?php echo $insert_from;?>','<?php echo $ref_no;?>')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php }
				?>
                        </tbody>
                        </table>

                        </div>
				</center>
			</div>
            <div class="col-md-8">
				<center>
                <div id="procedures1_list_div">
					<table id="dataTables-example" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Procedure</th>
                        <th>Duration</th>
                        <th>Timing</th>
                        <th>Consultant</th>
                        <th>Amount</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         <?php 
					include("config_db2.php");
					$cmd = "select * from procedure_details where ref_no='$ref_no' and insert_from='CHART ICU'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						$insert_from='CHART ICU';
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['procedure_name']; ?></td>
						<td><?php echo $rs['duration']; ?></td>
						<td><?php echo $rs['given_details']; ?></td>
                        <td><?php echo $rs['consultant']; ?></td>
                        <td><?php echo $rs['fees_amount']; ?></td>
						<td><a href="#" onClick="delete_procedures1('<?php echo $rs['id'];?>','<?php echo $insert_from;?>','<?php echo $ref_no;?>')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
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
                        <select name="depart1" id="depart1" class="select" style="font-weight:bold;width:160px;">
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
                <label class="col-md-4 control-label">Consul:</label>  
                <div class="col-md-1">
                        <select name="consultant1" id="consultant1" class="select" style="font-weight:bold;width:160px;">
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
                        <select name="visit1" id="visit1" class="select" style="font-weight:bold;width:160px;">
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
                <a href="#"  onClick="add_consulting_detail1(depart1.value,consultant1.value,visit1.value,chart_ot_no1.value);" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-plus"></span></a>            </div>                                    
		</div>	
<!-- 5 ROW END  -->   <div class="form-group">
            <div class="col-md-10">
				<center>
                <div id="consultant1_list_div">
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
					$cmd = "select * from consultant_details where ref_no='$ref_no' and insert_from='CHART ICU'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
				
						$insert_from='CHART ICU';
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo get_dept_names($rs['department']); ?></td>
						<td><?php echo get_consult_names($rs['consultant']); ?></td>
						<td><?php echo get_visit_names($rs['visit']); ?></td>
						<td><a href="#" onClick="delete_consultant1('<?php echo $rs['id'];?>','<?php echo $insert_from;?>','<?php echo $ref_no;?>')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
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
                <div class="col-md-5">
					<textarea name="description1" id="description1" class="form-control" style="font-weight:bold;width:250px;"></textarea>                
                </div> 
            </div>                
            <div class="col-md-6">
                <label class="col-md-6 control-label">Shift Patient To:</label>  
                <div class="col-md-1">
                        <select name="shift_patient1" id="shift_patient1" class="select" style="font-weight:bold;width:160px;" onChange="check_vacant_room1(this.value)">
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
                <input type="checkbox" id="vacant_chk1" name="vacant_chk1" value="checked">
                </div> 
            </div>                
            <div class="col-md-4">
                <label class="col-md-6 control-label">Out Date and Time:</label>  
                <div class="col-md-1">
                    <input type="datetime" style="font-weight:bold;width:160px;"  class="form-control datepicker" name="outtime1" id="outtime1" value="<?php echo date("d-m-Y h:i:sa");?>"/>
                </div> 
            </div>                
        </div>
<!-- 9 ROW END  -->  
                                        <div class="form-group">
										 <div class="col-md-10" align="center">
												   </div>
                                                   <div class="col-md-8" align="center">
                                        <input name="submit" id="submit" class="btn btn-primary" value="submit" type="button" onClick="add_chart_ot1(room_no1.value,pat_name1.value,age1.value,doa1.value,cons1.value,intimedate1.value,chart_ot_no1.value,description1.value,shift_patient1.value,outtime1.value,vacant_chk1.value)">
                                                   </div>
                                     <div class="col-md-2"  align="center">
												   </div> </div>
        </div></div>
        <div class="col-md-12">
          <?php 
	include("config_db2.php");
	$cmd = "select complaintid,provisionaldiagnosis,diagnosis,cast(datetime as date) as datetime,prescribed_by from tbl_diagnosis where patientid='$pid' order by datetime desc";
	$res = mysql_query($cmd);
	if(mysql_num_rows($res) != 0){	
		while($rs = mysql_fetch_array($res))
		{//upcom($(this));
		$sym=str_replace("<br />","~",$rs['provisionaldiagnosis']);
		$sym=substr($sym,0,-1);
		$prp=str_replace("<br />","~",$rs['diagnosis']);
		$prp=substr($prp,0,-1);
									   echo '<div class="panel panel-default">
                                
                                <div class="panel-body faq">
                                    

                                    <div class="faq-item">
                                        <div class="faq-title"><span class="fa fa-angle-down"></span>'.$rs['datetime'].'
										 </div>
										
                                        <div class="faq-text">
										<a href="#" rel="'.$rs['complaintid'].'" onClick="updiog('.$rs['complaintid'].',\''.$sym.'\',\''.$prp.'\');" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-pencil"></span></a>
                                           <table >
  <tr>
    <td><strong>Provisional Diagnosis:</strong></td>
    <td> '.$sym.'</td>
    
  </tr>
  <tr>
    <td><strong>Diagnosis:</strong></td>
    <td>'.$prp.'</td>
    
  </tr>
</table>
                                           
											
                                            <p></p>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>';
									  
			echo '<tr class="cdr">
				<td><input type="hidden" value="'.$rs['complaintid'].'" id="hcomplaintid" name="hcomplaintid" /></td>
				
				</tr>';
		}
		echo '</tbody> </table>';
	}
	mysql_close($db2);
?>
          <script>
function updiog(x,y,z)
{ 
//alert();
//alert(z);
//var id=x.attr('rel');
$("#updiogid").val("");
//$("#us").val("");
$('#uplstdiagnosis').importTags('');
$('#uplstprovisional').importTags('');
$("#updiogid").val(x);
$('#uplstprovisional').importTags(y);
$("#uplstdiagnosis").importTags(z);
$('#updigonis').modal('show');
//alert('');

}
</script>
        </div>
      </div>
      <div class="tab-pane" id="tab-five">
        <div class="row">
          <div class="col-lg-12">
            <div class="form-group">
			<div class="col-lg-3">
                <select name="seltype" tabindex="2" id="seltype" class="validate[required] select form-control" onchange="gettabletlist();">
				<option value="">Select Type</option>
                  <?php 
					include("config_db3.php");
					$cmd_ser = "select id,producttype from tbl_producttype order by producttype ASC ";
					$res_ser = mysql_query($cmd_ser);
					while($rs_ser = mysql_fetch_array($res_ser)){
								$producttype=$rs_ser['producttype'];
								$id=$rs_ser['id'];
					?>
                    	<option value="<?php echo $id ?>"><?php echo $producttype ?></option>
                        <?php }?>
                </select>
                <span class="help-block" >Type</span> </div>
              <div class="col-lg-3">
                <input type="text" name="tablet" id="tablet" class="form-control" onBlur="gettabletAvail('tab');" onKeyUp="gettabletAvail('tab');" list="tabletlist"/>
                <span class="help-block">Serach Tablet list</span> </div>
				<datalist id="tabletlist">
				  
				</datalist>
              <div class="col-lg-3">
                <input type="text" tabindex="1" name="generic" id="generic" class="form-control"  list="tabletgenericlist" readonly />
                <span class="help-block">Serach Generic list</span> </div>
				<datalist id="tabletgenericlist">
				  
				</datalist>
				<div class="col-lg-3">
                
				<input type="text" tabindex="1" name="txtbrand" id="txtbrand" class="form-control" readonly />
                </select>
                <span class="help-block">Brand </span> </div>
				
              
            </div>
            <br>
          </div>
		  <div class="col-lg-12">
            <div class="form-group">
				<div class="col-lg-3">
                
				<input type="text" tabindex="1" name="tablet_availablequantity" id="tablet_availablequantity" class="form-control" readonly />
				<input type="hidden" tabindex="1" name="drugid" id="drugid" class="form-control" readonly />
                </select>
                <span class="help-block"> Quantity Available </span> </div>
				<div class="col-lg-3">
                
				<input type="text" tabindex="1" name="tablet_orderquantity" id="tablet_orderquantity" class="form-control" onBlur="calc_quantity();" />
                </select>
                <span class="help-block"> Quantity Order </span> </div>
				<div class="col-lg-3">
                <input name="dosage" tabindex="4" type="text" id="dosage" class="form-control"  placeholder="&micro;/mg/g">
                <span class="help-block" >Dosage</span> </div>
				<div class="col-lg-3">
                <select name="specification" tabindex="5" style="width:auto" id="specification" class="form-control select">
                  <option>After food</option>
                  <option>Before food</option>
                  <option>Bedtime</option>
                </select>
                <span class="help-block" >Specification</span> </div>
				</div>
				<br>
		</div>
          <div class="col-lg-12">
            <div class="form-group">
              
              
              
              
				<div class="col-lg-2">
                <input type="text" tabindex="6" name="frequency" id="frequency"  list="freq" class="form-control">
                <datalist id="freq" class="select">
                  <option>0-0-1</option>
                  <option>0-1-0</option>
                  <option>0-1-1</option>
                  <option>1-0-0</option>
                  <option>1-0-1</option>
                  <option>1-1-0</option>
                  <option>1-1-1</option>
                  <option>SOS</option>
                </datalist>
                <span class="help-block" >Frequency</span> </div>
				<div class="col-lg-2">
                <select name="route" tabindex="7" id="route" style="max-height:100px" data-live-search="true" class="form-control select">
                  <option>Oral</option>
                  <option>Rectal</option>
                  <option>Intravenous (IV)</option>
                  <option>Infusion</option>
                  <option>Intramuscular</option>
                  <option>Topical</option>
                  <option>Enteric</option>
                  <option>Nasal</option>
                  <option>Inhaled</option>
                  <option>Otic</option>
                  <option>Ophthalmic</option>
                  <option>Sublingual</option>
                  <option>Buccal</option>
                  <option>Transdermal</option>
                  <option>Subcutaneous</option>
                </select>
                <span class="help-block" >Route</span> </div>
				<div class="col-lg-2">
                <input tabindex="8" type="text" id="duration" name="duration"   class="form-control" >
                <span class="help-block">Duration </span> </div>
				<div class="col-lg-2">
              <center>
                <a href="#" class="btn btn-success" onClick="addmed();return false;"> <span class="fa fa-plus"></span> ADD</a> 
              </center>
			 
              <hr>
            </div>
            </div>
            <br>
          </div>
          <div class="col-lg-12">
            <div class="form-group">
              
              
              
            </div>
          </div>
        </div>
        <div class="col-lg-12">
          <div class="form-group">
            
          </div>
        </div>
        <div id="mdl-interaction"  class="modal interaction fade" role="dialog">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Drug Interaction</h4>
              </div>
              <div class="modal-body" style="max-height: 450px; overflow-x: auto;">
                <table class="table table-bordered" id="tbl-interaction">
                  <thead>
                    <tr>
                      <th style="text-align:center">Drug 1</th>
                      <th style="text-align:center">Drug 2</th>
                      <th style="text-align:center">Interaction</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
        <script>
		
		function calc_quantity(){
			var order_quantity = $("#tablet_orderquantity").val();
			var avail_quantity = $("#tablet_availablequantity").val();
			if(Number(order_quantity) > Number(avail_quantity)){
				alert('Please order Drug Quantity less than or equal to Availabale Quantity');
				$("#tablet_orderquantity").focus();
				return false;
			}
		}
		function addmed()
	{
	//alert('');
	if($("#newbrand").val()!= '' || $("#txtbrand").val()!= ''){
			if($("#generic").val()!= '' &&  $("#duration").val()!= '' && $("#frequency").val()!= ''){
				var brand="";
				if(calc_quantity() == false){
					return false;
				}
					brand = $("#seltype option:selected").text() + '--' + $("#tablet").val()+ '--' +  $("#txtbrand").val();
				
				var appendTxt = '<tr>'+
					'<td style="display:none;"><input name="chk" type="checkbox" id="chk" style=""/></td>'+
					'<td><span class="label label-success">'+brand+'</td>'+
					'<td style="display:none;">'+$("#seltype").val()+'</td>'+
					'<td style="display:none;">'+$("#tablet").val()+'</td>'+
					'<td style="display:none;">'+$("#generic").val()+'</td>'+
					'<td style="display:none;">'+$("#txtbrand").val()+'</td>'+
					'<td style="display:none;">'+$("#tablet_availablequantity").val()+'</td>'+
					'<td>'+$("#tablet_orderquantity").val()+'</td>'+
					'<td>'+$("#dosage").val()+'</td>'+
					'<td>'+$("#specification").val()+'</td>'+
					'<td>'+$("#frequency").val()+'</td>'+
					'<td>'+$("#route").val()+'</td>'+
					'<td>'+$("#duration").val()+'</td>'+
					'<td style="display:none;">'+$('#drugid').val()+'</td>'+
					'<td> <a href="#" class="btn btn-danger btn-rounded btn-condensed btn-sm" onClick="delete_row($(this));return false;"><span class="fa fa-times"></span></a></td>'+
					'</tr>';
					$("#pretable tbody").append(appendTxt);
				//clear
					//$("#seltype").val('Tab.');	
					$("#txtbrand").val('');
					$("#generic").val('');		$("#dosage").val('');
					//$("#route").val('Oral');	
					//$("#specification").val('After food');
					$("#duration").val('');		$("#newbrand").val('');
					$("#frequency").val('');    $("#tablet").val('');
					 $("#compnay").val(''); $("#tablet_orderquantity").val('');
					 $('#drugid').val('');
					 $("#submit_patient_drug_med").show();
			}else{
				alert('fields cannot be left blank!');
			}
		}else{
			alert('fields cannot be left blank2!');
		}
	
	}
		function gettabletAvail(list){
			if(list=='tab'){
				var tablet = $('#tablet').val();
				
				
				//alert(list);
				if(tablet ==''){
					return false;
				}
				$.ajax({
			type: 'post',
			url: 'complaints_tabletavail.php',
			data: {
				tablet: tablet,
				action:'tab',
			},
			success: function(msg) {
				
				if(msg.trim() == '@$@$@$'){
					return false;
				}
				var x=msg.split('@$');
				$('#generic').val(x[0]);
				$('#txtbrand').val(x[1]);
				$('#tablet_availablequantity').val(x[2]);
				
				$('#drugid').val(x[3]);
				
				
				//console.log(msg);
				
			}
			});
		}
		
				/* if(list=='gen'){
						var generic = $('#generic').val();
						
						
						//alert(tablet);
						if(generic ==''){
							return false;
						}
						$.ajax({
					type: 'post',
					url: 'complaints_tabletavail.php',
					data: {
						generic: generic,
						action:'gen',
					},
					success: function(msg) {
						//console.log(msg);
						if(msg.trim() == '@$@$@$'){
							return false;
						}
						var x=msg.split('@$');
						$('#tablet').val(x[0]);
						$('#txtbrand').val(x[1]);
						$('#tablet_availablequantity').val(x[2]);
						
						
						
						//console.log(msg);
						
					}
					});
				} */
			
		}

		function gettabletlist(){
			var seltype = $('#seltype').val();
			//alert(seltype);
			if(seltype ==''){
				return false;
			}
			$.ajax({
		type: 'post',
		url: 'complaints_tabletlist.php',
		data: {
			seltype: seltype,action:'name_list',
		},
		success: function(msg) {
			//console.log(msg);
			if(msg=='no'){
				$('#tabletlist').html('');
			}else{
				$('#tabletlist').html(msg);
			}
			
		}
	});
	/* $.ajax({
		type: 'post',
		url: 'complaints_tabletlist.php',
		data: {
			seltype: seltype, action:'gen_list',
		},
		success: function(msg) {
			console.log(msg);
			if(msg=='no'){
					$('#tabletgenericlist').html('');
			}else{
				$('#tabletgenericlist').html(msg);
			}
			
		}
	}); */
			
		}
function drugInteraction(){
	var druglist = [];
	$("#pretable").find('tbody > tr').each(function (rowIndex, r) {
		$(this).find('td').each(function (colIndex, c) {
			if(colIndex == 2)
				druglist.push(c.textContent);
		});
	});
	$('#tbl-interaction > tbody').empty();
	$('#mdl-interaction').modal('show');
	$.ajax({
		type: 'post',
		url: 'return-drug-interaction.php',
		data: {
			drugs: druglist,
		},
		success: function(msg) {
			$('#tbl-interaction > tbody').append(msg);
		}
	});
}
			  </script>
        <div class="panel-body panel-body-table">
          <div class="table-responsive">
            <table id="pretable" class="table table-bordered table-striped table-actions">
              <thead>
                <tr>
                  <th width="50" style="display:none;">id</th>
                  <th>Drug Name</th>
				  <th style="display:none;">Type</th>
				  <th style="display:none;">Tablet</th>
                  <th style="display:none;">Generic</th>
				  <th style="display:none;">Brand</th>
				  <th style="display:none;">Available Quantity</th>
				  <th>Order Quantity</th>
                  <th>Dosage</th>
                  <th>Specification</th>
                  <th>Frequecy</th>
                  <th>Route</th>
                  <th>Duration</th>
				  <th style="display:none;">Drug ID</th>
                  <th>actions</th>
                </tr>
              </thead>
              <tbody>
                <!--<tr>
                                                    <td class="text-center">1</td>
                                                    <td><strong>John Doe</strong></td>
                                                    <td><span class="label label-success">New</span></td>
                                                    <td><a href="">$430.20</a></td>
                                                    <td>24/09/2015</td>
													<td>24/09/2015</td>
													<td>24/09/2015</td>
                                                    <td>
                                                       
                                                        <a href="#" class="btn btn-danger btn-rounded btn-condensed btn-sm" onClick="delete_row($(this));"><span class="fa fa-times"></span></a>
                                                    </td>
                                                </tr>-->
              </tbody>
            </table>
				 
                
              <div class="col-lg-12" align="right">
                  
                   <a href="#" class="btn btn-success" id="submit_patient_drug_med" onClick="savemedication();return false;" style="display:none">  Submit</a> 
                  
                  <hr>
                </div>
          </div>
          <br>
          <br>
        </div>
        <script>
  
  function savemedication()
 {
 //alert('');
	var tbody = $("#pretable tbody");
		if (tbody.children().length == 0) {
		alert('Table should not blank');
		return false;}
		var table = $("#pretable");
    var asset = [];
    table.find('tbody > tr').each(function (rowIndex, r) {
        var cols = [];
        $(this).find('td').each(function (colIndex, c) {
            cols.push($.trim(c.textContent));
        });
        asset.push(cols);
    }); 
		
		var y=$("#pid").val();

		$.ajax({
		type: "POST",
		url: "medicationentry.php",
		data: { assets: asset,
		id:y,
		},
		success: function(msg) {
		//console.log(msg);
		//return false;
		$('#message-box-success').modal('toggle');
		if(msg=='Success')
		{
		msg='<p><span class="fa fa-check">Patient Prescriptiion-Drug details Added</span></p>';
			$("#appendmsg").append(msg);
			$("#pretable > tbody").empty();
			$("#submit_patient_drug_med").hide();
			}
			else
			{
			msg='<p><span class="fa fa-times">Drug details could not be added. Please try again.</span></p>';
			$("#appendmsg").append(msg);
			//$("#pretable > tbody").empty();
			}
		}
	});
		
 }
 </script>
 
        <?php
  include("config_db2.php");
  	$query4 = "select id,cast(datetime as date)as datetime,prescribed_by from prescriptiondetail where patientid='$pid' group by id order by id desc";
	$res4 = mysql_query($query4);
	if(mysql_num_rows($res4) != 0){
		
		while($rs4 = mysql_fetch_array($res4)){
			$query5 = "select * from prescriptiondetail where patientid='$pid' and id ='".$rs4['id']."'";
			$res5 = mysql_query($query5);
			if(mysql_num_rows($res5) != 0){
				echo '<div class="panel panel-default">
                                
                                <div class="panel-body faq">
                                    

                                    <div class="faq-item">
                                        <div class="faq-title"><span class="fa fa-angle-down"></span>'.$rs4['datetime'].'
										 </div>
										
                                        <div class="faq-text">
										
										<div class="table-responsive">
                                           <table class="table table-bordered table-striped table-actions">
					<thead>
					<tr>
						<th>Drug Name</th>
						<th>Dosage</th>
						<th>Specification</th>
						<th>Frequency</th>
						<th>Duration</th>
					</tr>
					</thead><tbody>	';
				while($rs5 = mysql_fetch_array($res5)){
					$maxid = $rs5['id'];
					echo "<tr>
						<td class='med'>".$rs5['drugname']."&nbsp;</td>					
						<td class='med'>".$rs5['dosage']."&nbsp;</td>
						<td class='med'>".$rs5['specification']."&nbsp;</td>
						<td class='med'>".$rs5['frequency']."&nbsp;</td>
						<td class='med'>".$rs5['duration']."&nbsp;</td>
						</tr>";
				}
				echo '<tr>
						<td colspan="2" style="color:#CC0000">Prescribed by : '.$rs4['prescribed_by'].'</td>
						<td><div style="text-align:center;cursor:pointer;"><!--<a href="#" onClick="medupdate('.$maxid.')" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-pencil"></span></a>-->
						 &nbsp; <a href="printing.php?pid='.$pid.'&maxid='.$maxid.'" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left" target="_blank"><span class="fa fa-print"></span></a></div></td>						
					</tr>';
				echo '</tbody></table></div></div>
                                    </div>
                                    
                                </div>
                            </div>';
			}
		}
	}
	mysql_close($db2);	
?>
        <script>
function medupdate(x)
{

$("#compid").val(x);
		$.ajax({
			type: "post",
			url: "return-prescription.php?maxid="+x,
			success: function(msg) {
				$("#divprescription").html(msg);
			}
		});
		$('#mmupdate').modal('toggle');
//alert(x);
		
}
</script>
      </div>
      <div class="tab-pane " id="tab-seven">
        <div class="row">
          <div class="col-md-12">
              <div class="form-group" style="display:none;">
										 <div class="col-md-2">
                                            <label class="col-md-6 control-label">Room:</label>  
                                            <div class="col-md-4">
                    <span style="width:100px;font-weight:bold; font-size:14px "class="form-control"><?php echo $room_name;?></span>  <input type="hidden" style="width:100px;font-weight:bold"  class="form-control" name="room_no" readonly id="room_no" value="<?php echo $room_name;?>"/>
                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
											   
                                   
                                                     <div class="col-md-3">
                                            <label class="col-md-4 control-label">Name:</label>  
                                            <div class="col-md-5">
                   <span style="width:175px;font-weight:bold; font-size:14px "class="form-control"><?php echo $patientname;?></span> <input type="hidden" style="font-weight:bold;width:175px;"  class="form-control" name="pat_name"readonly id="pat_name" value="<?php echo $patientname;?>"/>
                                                  <span class="help-block"></span>  
												</div>                                        
												   </div>       
                       
										 <div class="col-md-2">
                                            <label class="col-md-4 control-label">Age:</label>  
                                            <div class="col-md-5">
                    <span style="width:75px;font-weight:bold; font-size:14px "class="form-control"><?php echo $age;?></span><input type="hidden" style="font-weight:bold;width:75px;"  class="form-control" name="age"readonly value="<?php echo $age;?>"/>
                                               <span class="help-block"></span> 
												</div>                                        
												   </div>
                                                   <div class="col-md-2">
                                            <label class="col-md-4 control-label">DOA:</label>  
                                            <div class="col-md-5">
                    <span style="width:150px;font-weight:bold; font-size:14px "class="form-control"><?php echo date('d-m-Y',strtotime($create_date));?></span><input type="hidden" style="font-weight:bold;width:150px;"  class="form-control" name="doa"readonly value="<?php echo date('d-m-Y',strtotime($create_date));?>"/>
                                               <span class="help-block"></span> 
												</div>                                        
												   </div>
                                                   <div class="col-md-2">
                                            <label class="col-md-6 control-label">Cons:</label>  
                                            <div class="col-md-5">
                   <span style="width:175px;font-weight:bold; font-size:14px "class="form-control"><?php echo $consultant_name;?></span> <input type="hidden" style="font-weight:bold;width:175px;"  class="form-control" name="cons"readonly value="<?php echo $consultant_name;?>"/>
                                               <span class="help-block"></span> 
												</div>                                        
												   </div>
										</div>	
										<div class="form-group">
										 <div class="col-md-4">
                                           <label class="col-md-6 control-label">Intime and Date:</label>  
                <div class="col-md-1">
               
                    <input type="datetime" style="font-weight:bold;width:160px;"  class="form-control datepicker" name="intimedate" id="intimedate" value="<?php echo date("d-m-Y h:i:sa");?>"/>
                </div>                                        
												   </div><div class="col-md-4">
            <?php
			include("config_db2.php");
					$cmd_ser1 = "select * from chart_ot order by id desc limit 1";
					$res_ser1 = mysql_query($cmd_ser1);
					while($rs_ser1 = mysql_fetch_array($res_ser1)){
								$ref_no=$rs_ser1['ref_id'];
					}
					if($ref_no=='')
					{
						$ref_no='1';
					}
					else
					{
						$ref_no=$ref_no+1;
					}
			?>
            <input type="hidden" style="font-weight:bold;width:110px;"  class="form-control" name="chart_ot_no" id="chart_ot_no" value="<?php echo $ref_no;?>"/>
            </div></div>
										 <div class="form-group">
                                                              <label class="col-md-1 control-label"><h3>Service:</h3></label>  
                                           <label class="col-md-5 control-label"><h3>&nbsp;&nbsp;&nbsp;Procedure:</h3></label>  

                   
                     </div>                     
										  <div class="form-group">

          <div class="col-md-4"><div class="col-md-12">
            <div class="col-md-7" style="padding-right:20px;">
                        <select name="service" id="service" class="select" style="font-weight:bold;">
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
            <div class="col-md-3">
                 <input type="text" style="font-weight:bold"  class="form-control" name="service_no" id="service_no"/>             
            </div>   
          
            <div class="col-md-2">
                <a href="#"  onClick="add_service(service.value,service_no.value,chart_ot_no.value);" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-plus"></span></a>         </div> 
                </div></div>
                
          <div class="col-md-8"><div class="col-md-12">
            <div class="col-md-4">
                        <select name="procedures" id="procedures" class="select" style="font-weight:bold;">
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
            <div class="col-md-3">
                 <input type="datetime" style="font-weight:bold; width:160px;"  class="form-control" name="procedure_no" id="procedure_no"  value="<?php echo date("d-m-Y h:i:sa");?>"/>             
            </div> 
      <div class="col-md-3">  
      
                                  <select name="consultantname" id="consultantname" class="select" style="font-weight:bold;">
                                  <option>select</option>
                    <?php 
					include("config_db1.php");
					$cmd_ser = "select * from doctor_creation";
					$res_ser = mysql_query($cmd_ser);
					while($rs_ser = mysql_fetch_array($res_ser)){
								$doctor_name=$rs_ser['doctor_name'];
								$id=$rs_ser['id'];
					?>
                    	<option value="<?php echo $doctor_name;?>"><?php echo $doctor_name;?></option>
                        <?php }?>
                        </select> 
            </div>
            <div class="col-md-1"> <input type="text" style="font-weight:bold; width:45px;"  class="form-control" name="fees_amount" id="fees_amount"/> </div>
            <div class="col-md-1">
                <a href="#"  onClick="add_procedures(procedures.value,procedure_no.value,chart_ot_no.value,consultantname.value,fees_amount.value);" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-plus"></span></a>       </div>   
 </div>
 </div></div> 
<!-- 3 ROW END  -->
 
        <div class="form-group">
                
            <div class="col-md-4">
				<center>
					
                        <div id="service_list_div">
                        <table id="dataTables-example" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Services</th>
                        <th>Duration</th>
                        <th>Timing</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         <?php 
					include("config_db2.php");
					$cmd = "select * from services_details where ref_no='$ref_no' and insert_from='CHART OT'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						$insert_from='CHART OT';
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['service_name']; ?></td>
						<td><?php echo $rs['duration']; ?></td>
						<td><?php echo $rs['given_details']; ?></td>
						<td><a href="#" onClick="delete_services('<?php echo $rs['id'];?>','<?php echo $insert_from;?>','<?php echo $ref_no;?>')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php }
				?>
                        </tbody>
                        </table>

                        </div>
				</center>
			</div>
            <div class="col-md-8">
				<center>
                <div id="procedures_list_div">
					<table id="dataTables-example" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Procedure</th>
                        <th>Duration</th>
                        <th>Timing</th>
                         <th>Consultant</th>
                        <th>Amount</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         <?php 
					include("config_db2.php");
					$cmd = "select * from procedure_details where ref_no='$ref_no' and insert_from='CHART OT'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						$insert_from='CHART OT';
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['procedure_name']; ?></td>
						<td><?php echo $rs['duration']; ?></td>
						<td><?php echo $rs['given_details']; ?></td>
                        <td><?php echo $rs['consultant']; ?></td>
                        <td><?php echo $rs['fees_amount']; ?></td>
						<td><a href="#" onClick="delete_procedures('<?php echo $rs['id'];?>','<?php echo $insert_from;?>','<?php echo $ref_no;?>')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
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
                <label class="col-md-4 control-label">Consul:</label>  
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
<!-- 5 ROW END  -->   <div class="form-group">
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
						<td><?php echo get_dept_names($rs['department']); ?></td>
						<td><?php echo get_consult_names($rs['consultant']); ?></td>
						<td><?php echo get_visit_names($rs['visit']); ?></td>
						<td><a href="#" onClick="delete_consultants('<?php echo $rs['id'];?>','<?php echo $insert_from;?>','<?php echo $ref_no;?>')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
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
            <div class="col-md-12">
                <label class="col-md-2 control-label">Procedure:</label>  
                <div class="col-md-6">
					<textarea name="description" id="description" class="form-control ckeditor" style="font-weight:bold;width:500px;"></textarea>                
                </div> 
            </div>  
            </div>
             <div class="form-group">             
            <div class="col-md-6">
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
            <div class="col-md-4">
                <label class="col-md-6 control-label">Out Date and Time:</label>  
                <div class="col-md-1">
                    <input type="datetime" style="font-weight:bold;width:160px;"  class="form-control datepicker" name="outtime" id="outtime" value="<?php echo date("d-m-Y h:i:sa");?>"/>
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
												   </div> </div>
        </div></div>
        </div>
      </div>
 
<div id="addlabinves_save_modal"  class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Investigation Details</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="panel-body">                    
						
                            <!-- START JQUERY VALIDATION PLUGIN -->
                           <?php  date_default_timezone_set('Asia/Kolkata');   ?>
                                    <form id="jvalidate" role="form" class="form-horizontal">
                            
                                    <h5 >&nbsp;&nbsp;&nbsp;</h5>
                                        <div class="form-group">
										 <div class="col-md-6" align="left">
                                     <label class="col-md-6 control-label"  >Test Title:</label>  
                                            <div class="col-md-6" >
											<div class="input-group">
												<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
												 <input type="text"  class="form-control" name="test_title" id="test_title" />
											</div>
                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
											   
                                   
                                                     <div class="col-md-6">
                                            <label class="col-md-4 control-label"  >Category:</label>  
                                            <div class="col-md-8"  >
											<div class="input-group">
												<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
												 <input type="text"  class="form-control" name="test_category" id="test_category" />
											</div>
                               
                                                  <span class="help-block"></span>  
												</div>                                        
												   </div>       
                       
										</div>

                                        <div class="form-group">
                                        										 <div class="col-md-3" align="center">
</div>
										 <div class="col-md-5" align="center">
                                         								<input type="submit" class="btn btn-info btn-block" style="width:100px;" name="submit" id="submit"  onClick="addlabinves_save('<?php echo $patient_id;?>','add');return false;" value="Save"/>

                                    </div>
                                    										 <div class="col-md-5" align="center">
</div>                                               
                                    
                       
                            
                            <!-- END JQUERY VALIDATION PLUGIN -->
                          
				
							
							
						
							</div>
							
							</form>
                            <!-- END JQUERY VALIDATION PLUGIN -->
                            </div>
            <div id="addreporttable" class="col-md-12">
              
            </div>
            
            
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-primary" onClick="printbill()" data-dismiss="modal">Print</button>-->
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
 
<div class="message-box message-box-success animated fadeIn" id="message-box-success">
  <div class="mb-container">
    <div class="mb-middle">
      <div class="mb-title"><span class="fa fa-info"></span> MESSAGE</div>
      <div class="mb-content">
        <div id="appendmsg"> </div>
      </div>
      <div class="mb-footer"> <a href="complaints.php?pid=<?php echo $pid; ?>" class="btn btn-default btn-lg pull-right" >Close</a> </div>
    </div>
  </div>
</div>
<div class="message-box message-box-info animated fadeIn" id="message-box-info">
  <div class="mb-container">
    <div class="mb-middle">
      <div class="mb-title"><span class="fa fa-info"></span> Insert</div>
      <div class="mb-content">
        <p>New Data Added</p>
      </div>
      <div class="mb-footer">
        <button class="btn btn-default btn-lg" onClick="removebtn()">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="message-box message-box-success animated fadeIn" id="message-box-update">
  <div class="mb-container">
    <div class="mb-middle">
      <div class="mb-title"><span class="fa fa-check"></span> Success</div>
      <div class="mb-content">
        <div id="appendmsg1"> </div>
      </div>
      <div class="mb-footer"> <a href="complaints.php?pid=<?php echo $pid; ?>" class="btn btn-default btn-lg pull-right" >Close</a> </div>
    </div>
  </div>
</div>
<div class="message-box message-box-danger animated fadeIn" id="message-box-error">
  <div class="mb-container">
    <div class="mb-middle">
      <div class="mb-title"><span class="fa fa-times"></span> Error</div>
      <div class="mb-content">
        <div id="appenderror"> </div>
      </div>
      <div class="mb-footer">
        <button class="btn btn-default btn-lg pull-right mb-control-close">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div id="myModal_errmsg" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Message</h4>
      </div>
      <div class="modal-body">
        <p class='errmsg'>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
        <div class="pull-right"> <a href="logout.php" class="btn btn-success btn-lg">Yes</a>
          <button class="btn btn-default btn-lg mb-control-close">No</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- END MESSAGE BOX-->
<div class="message-box animated fadeIn" data-sound="alert" id="mb-remove-row">
  <div class="mb-container">
    <div class="mb-middle">
      <div class="mb-title"><span class="fa fa-times"></span> Remove <strong>Data</strong> ?</div>
      <div class="mb-content">
        <p>Are you sure you want to remove this row?</p>
        <p>Press Yes if you sure.</p>
      </div>
      <div class="mb-footer">
        <div class="pull-right"> <a href="#" id="yes" class="btn btn-success btn-lg mb-control-yes">Yes</a> <a href="#" id="no" class="btn btn-default btn-lg mb-control-no">No</a> </div>
      </div>
    </div>
  </div>
</div>
<div id="inves12" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Investigation</h4>
      </div>
      <div class="modal-body">
        <div id="invesoldtable"> </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onClick="updateinvestigation()">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div id="medhistory" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Medical History</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-4">
          <input type="hidden" name="upmedhistory" id="upmedhistory" class="form-control"/>
          <div class="form-group">
            <label class="col-md-2 col-xs-12 control-label"></label>
            <div class="col-md-12 col-xs-12">
              <label class="check">
              <input type="checkbox" id="updiabetes" name="updiabetes" class="icheckbox"/>
              Diabetes Mellitus </label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 col-xs-12 control-label"></label>
            <div class="col-md-12 col-xs-12">
              <label class="check">
              <input type="checkbox" id="upcoronary" name="upcoronary" class="icheckbox" />
              Seizures / Head Injury </label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 col-xs-12 control-label"></label>
            <div class="col-md-12 col-xs-12">
              <label class="check">
              <input type="checkbox" id="uphypertension" name="uphypertension" class="icheckbox"/>
              Hypertension </label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 col-xs-12 control-label"></label>
            <div class="col-md-12 col-xs-12">
              <label class="check">
              <input type="checkbox" id="upasthma" name="upasthma" class="icheckbox"/>
              Asthma </label>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 col-xs-12 control-label"></label>
            <div class="col-md-12 col-xs-12">
              <label class="check">
              <input type="checkbox" id="ucad" name="ucad" class="icheckbox"/>
              CAD </label>
            </div>
          </div>
        </div>
        <!--<input type="button" onClick="f()">-->
        <div class="col-md-6">
          <div class="form-group">
            <!--  <label class="col-md-4 control-label">Other Medical History:</label>-->
            <div class="col-md-12">
              <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                <input name="uptxtmedhis" class="tagsinput form-control" type="text" id="uptxtmedhis"  placeholder="Other Medical History">
                <!--list="symp" -->
              </div>
            </div>
          </div>
          <br>
          <br>
          <div class="form-group">
            <!--  <label class="col-md-4 control-label">Other Medical History:</label>-->
            <div class="col-md-12">
              <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                <input name="uptxtfamhis" class="tagsinput form-control" type="text" id="uptxtfamhis"  placeholder="Family History">
                <!--list="symp" -->
              </div>
            </div>
          </div>
          <br>
          <br>
          <div class="form-group">
            <!--  <label class="col-md-4 control-label">Other Medical History:</label>-->
            <div class="col-md-12">
              <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                <input name="uptxtperhis" class="tagsinput form-control" type="text" id="uptxtperhis"  placeholder="Personal History">
                <!--list="symp" -->
              </div>
            </div>
          </div>
          <br>
          <br>
          <div class="form-group">
            <!--  <label class="col-md-4 control-label">Other Medical History:</label>-->
            <div class="col-md-12">
              <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                <input name="uptxtpsyhis" class="tagsinput form-control" type="text" id="txtpsyhis"  placeholder="Psychiatric History">
                <!--list="symp" -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onClick="updatemedhistory()">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div id="upcomplaints" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Complaints</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <div class="col-lg-10">
                    <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                      <input name="uplstpsysym" type="text" id="uplstpsysym" class="form-control" placeholder="Paediatric Symptoms">
                    </div>
                  </div>
                  <div class="col-lg-2"> <a href="#" id="up_psysym1" class="btn btn-success" onClick="upPsy1()" name="up_psysym1"> <span class="fa fa-plus"></span></a> </div>
                </div>
                <br>
                <br>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <div class="col-lg-10">
                    <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                      <input name="uplstsym" class="form-control" type="text" id="uplstsym"  placeholder="Symptoms">
                    </div>
                  </div>
                  <div class="col-lg-2"> <a href="#" id="up_psysym2" class="btn btn-success" onClick="upPsy2()" name="up_psysym2" > <span class="fa fa-plus"></span></a> </div>
                </div>
                <br>
                <br>
              </div>
              <div class="col-lg-12"> <br>
                <br>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <div class="col-lg-10">
                    <div class="input-group">
                      <input type="hidden" name="upcompliantid" id="upcompliantid" class="form-control"/>
                    </div>
                  </div>
                </div>
                <div class="col-lg-12">
                  <div class="form-group">
                    <div class="col-lg-10">
                      <div class="pull-left">
                        <input type="text" name="us" id="us" class="tagsinput form-control"/>
                      </div>
                    </div>
                    <br>
                    <br>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" onClick="updatecompliants()" data-dismiss="modal">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="updigonis" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Diogonsis</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-7">
          <div class="form-group">
            <!-- <label class="col-md-4 control-label">Psychiatric Symptoms:</label>-->
            <div class="col-md-10">
              <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                <input name="updiogid" type="hidden" id="updiogid" class="form-control" style="width:180px">
                <input name="uplstprodiag" type="text" id="uplstprodiag" class="form-control" style="width:180px" placeholder="Provisional Diagnosis">
                <!--list="symp" -->
              </div>
            </div>
            <div class="col-md-2"> <a href="#"  class="btn btn-success" onClick="upaddprodiag()" > <span class="fa fa-plus"></span></a> </div>
          </div>
          <br>
          <br>
          <div class="form-group">
            <!-- <label class="col-md-4 control-label">Symptoms:</label>-->
            <div class="col-md-10">
              <div class="input-group"> <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                <input name="uptxtdiag" class="form-control" type="text" id="uptxtdiag" style="width:180px" placeholder="Diagnosis">
                <!--list="symp" -->
              </div>
            </div>
            <div class="col-md-2"> <a href="#"  class="btn btn-success" onClick="upadddiag()"  > <span class="fa fa-plus"></span></a>
              <!--<input class="add" type="button" name="add_psysym2" id="add_psysym2"/>-->
            </div>
          </div>
        </div>
        <div class="col-md-5">
          <div class="form-group">
            <div class="col-md-12 ">
              <div class="pull-left">
                <div id="uplstprovisional" class="tagsinput"> </div>
                <!--<input type="text" id="s" class="tagsinput form-control" placeholder="Symptoms"  />-->
              </div>
            </div>
            <hr>
            <div class="col-md-12 ">
              <div class="pull-left">
                <div id="uplstdiagnosis" class="tagsinput"> </div>
                <!--<input type="text" id="s" class="tagsinput form-control" placeholder="Symptoms"  />-->
              </div>
            </div>
            <!-- <a href="#" class="btn btn-danger" onClick="del()" ><span class="fa fa-times"></span> Remove</a>-->
            <!-- <button  name="del_psysym" id="del_psysym" class="btn btn-danger"><span class="fa fa-times"></span> Remove</button>-->
            <!-- <input class="del" name="del_psysym" id="del_psysym" type="button"/>-->
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" onClick="updateddiog()" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div id="mmupdate"  class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Prescription Details</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="form-group">
                  <div class="col-lg-6">
                    <input type="text" name="xtablet" id="xtablet" class="form-control" onChange="xtabletlist();" onKeyUp="getAvail()"/>
                    <span class="help-block">Serach Tablet list</span> </div>
                  <div class="col-lg-6">
                    <input type="hidden" id="compid" />
                    <input type="hidden" id="field" />
                    <input type="text" name="xgeneric" id="xgeneric" class="form-control" onChange="xdrugList();"/>
                    <span class="help-block">Serach Drug list</span> </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <div class="col-lg-4">
                    <select name="xseltype"  id="xseltype" class=" select form-control">
                      <option>Tab.</option>
                      <option>Cap.</option>
                      <option>Syr.</option>
                      <option>Inj.</option>
                    </select>
                    <span class="help-block" >Type</span> </div>
                  <div class="col-lg-4">
                    <select  name="txtxbrand" data-live-search="true" id="txtxbrand" class="form-control select" >
                    </select>
                    <span class="help-block">Brand </span> </div>
                  <div class="col-lg-4">
                    <input type="text" id="xduration" name="xduration"   class="form-control" >
                    <span class="help-block">Duration </span> </div>
                </div>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <div class="col-lg-2">
                    <input name="xdosage" type="text" id="xdosage" class="form-control"  placeholder="&micro;/mg/g">
                    <span class="help-block" >Dosage</span> </div>
                  <div class="col-lg-2">
                    <select name="specification" id="specification" class="form-control select">
                      <option>After food</option>
                      <option>Before food</option>
                      <option>Bedtime</option>
                    </select>
                    <span class="help-block" >Specification</span> </div>
                  <div class="col-lg-4">
                    <select name="xroute" id="xroute" data-live-search="true" class="form-control select">
                      <option>Oral</option>
                      <option>Rectal</option>
                      <option>Intravenous (IV)</option>
                      <option>Infusion</option>
                      <option>Intramuscular</option>
                      <option>Topical</option>
                      <option>Enteric</option>
                      <option>Nasal</option>
                      <option>Inhaled</option>
                      <option>Otic</option>
                      <option>Ophthalmic</option>
                      <option>Sublingual</option>
                      <option>Buccal</option>
                      <option>Transdermal</option>
                      <option>Subcutaneous</option>
                    </select>
                    <span class="help-block" >Route</span> </div>
                  <div class="col-lg-4">
                    <input type="text" name="xfrequency" id="xfrequency"  list="freq" class="form-control">
                    <datalist id="freq" class="select">
                      <option>0-0-1</option>
                      <option>0-1-0</option>
                      <option>0-1-1</option>
                      <option>1-0-0</option>
                      <option>1-0-1</option>
                      <option>1-1-0</option>
                      <option>1-1-1</option>
                      <option>SOS</option>
                    </datalist>
                    <span class="help-block" >Frequency</span> </div>
                </div>
              </div>
            </div>
            <div class="col-lg-12">
              <div class="form-group">
                <div class="col-lg-12">
                  <center>
                    <a href="#" class="btn btn-success" onClick="xaddmed()"> <span class="fa fa-plus"></span> ADD</a>
                  </center>
                  <hr>
                </div>
              </div>
            </div>
            <div class="col-md-12" id="divprescription"> </div>
            <div class="btn-group pull-right"> </div>
          </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" onClick="updatemed()" data-dismiss="modal">Save</button>
          <button type="button" class="btn btn-primary" onClick="printmed()" data-dismiss="modal">Print</button>
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

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
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div id="bbill"  class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Billing Details</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <form id="jvalidate" role="form" class="form-horizontal">
            <div class="panel-body">
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="col-lg-4 control-label">Description:</label>
                  <div class="col-lg-5">
                    <input type="text" class="form-control" name="des" id="des"/>
                  </div>
                </div>
                <br>
              </div>
              <div class="col-lg-12">
                <div class="form-group">
                  <label class="col-lg-4 control-label">Fees:</label>
                  <div class="col-lg-5">
                    <input type="text" class="form-control"  name="fees" id="fees"/>
                  </div>
                  <div class="col-md-1"> <a href="#"  onClick="add();" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-plus"></span></a> </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <center>
                <table id="dataTables-example" class="table table-striped table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Description&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                      <th>Fees&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="billing" name="billing">
                  </tbody>
                </table>
              </center>
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
            <div class="col-md-4 btn-group pull-right">
              <label class="col-md-3 control-label">Total:</label>
              <div class="col-md-9">
                <input type="text" class="form-control" value='0' readonly  name="total" id="total"/>
                <span class="help-block">&nbsp;&nbsp;</span> </div>
            </div>
            <div class="col-md-4 btn-group pull-right">
              <label class="col-md-3 control-label">Pay:</label>
              <div class="col-md-9">
                <input type="text" class="form-control"  onBlur="cal()" name="pay" id="pay"/>
                <span class="help-block">&nbsp;&nbsp;</span> </div>
            </div>
            <div class="col-md-4 btn-group pull-right">
              <label class="col-md-3 control-label">Balance:</label>
              <div class="col-md-9">
                <input type="text" class="form-control" value="0" name="bal" id="bal"/>
                <span class="help-block">&nbsp;&nbsp;</span> </div>
            </div>
            <div class="col-md-4 pull-right">
              <label class="col-md-6 control-label ">Old Balance:</label>
              <div class="col-md-6">
                <input type="text" class="form-control" value="0" name="old" id="old"/>
                <span class="help-block">&nbsp;&nbsp;</span> </div>
            </div>
            <div class="btn-group pull-right"> </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onClick="save()">Save</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
<audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
<script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
<script type="text/javascript" src="js/plugins/jquery/jquery-migrate.min.js"></script>
<script type="text/javascript" src="js/demo_tables.js"></script>
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>  
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

<script src="ckeditor/ckeditor.js"></script>
	<script src="ckeditor/samples/js/sample.js"></script>
	<!-- hide by sivaguru due to modal box issue<link rel="stylesheet" href="ckeditor/samples/css/samples.css">-->
	

<script>

		function removebtn() {
	$('#message-box-info').toggle();
	}
	function delinves(x) {
		if(confirm('Sure to delete?')){
			var txt = x.attr('alt');
			$.ajax({
				type: 'post',
				url: 'delete-inves.php?maxid='+txt,
				success: function(msg) {
					if(msg == 'ok')
						x.closest('td').html('Deleted');
					else	
						alert(msg);
				}
			});			
		}
	}
	</script>
<script type="text/javascript">
function add_others(id_value,tbl_value,type_value,reason)
	{
		if (reason == "") {
			alert(type_value+' cannot be left blank!');
			return false;
		}
		
		var id="";
		//console.log(location.href +" "+ tbl_value);
		//console.log(location.href + " #others_div");
		
		$.ajax({
			type: "post",
			url: "others.php", //this is my servlet
			data: {
				others: reason,
				complaint_no: $('#complaint_no').val(),
				room_no:'<?php echo $room_name;?>',
				consultant:'<?php echo $consultant_name;?>',
				id:id,
				pid:$('#pid').val(),
				type:type_value,
			},
			success: function(msg) {
				$(id_value).val('');
				
				$(tbl_value).load(location.href +" "+ tbl_value);
				//$("#others_div").load(location.href + " #others_div");

			}
		});
		}
		function delete_id(x,tbl_value){
		if(confirm("Sure to delete?")){
		//console.log(location.href +" "+ tbl_value);
		//console.log(location.href + " #others_div");
		$.ajax({
			type: "post",
			url: "others.php", //this is my servlet
			data: {
				user: x,
			},
			success: function(msg) {
								//$("#others_div").load(location.href + " #others_div");
								$(tbl_value).load(location.href +" "+ tbl_value);
			}
		});
		}
	}	

	function add_personal()
	{
		if ($('#personal').val() == "") {
			alert('personal cannot be left blank!');
			return false;
		}
		
		var id="";
		$.ajax({
			type: "post",
			url: "personal_clinic.php", //this is my servlet
			data: {
				personal: $('#personal').val(),
				complaint_no: $('#complaint_no').val(),
				room_no:'<?php echo $room_name;?>',
				consultant:'<?php echo $consultant_name;?>',
				id:id,
				pid:$('#pid').val(),
			},
			success: function(msg) {
				$('#personal').val('');
				$("#personal_div").load(location.href + " #personal_div");

			}
		});
		}
			function delete_per(x){
		if(confirm("Sure to delete?")){
			
		$.ajax({
			type: "post",
			url: "personal_clinic.php", //this is my servlet
			data: {
				user: x,
			},
			success: function(msg) {
								$("#personal_div").load(location.href + " #personal_div");
			}
		});
		}
	}		
		function add_family()
	{
		if ($('#family').val() == "") {
			alert('family cannot be left blank!');
			return false;
		}
		
		var id="";
		$.ajax({
			type: "post",
			url: "family_clinic.php", //this is my servlet
			data: {
				family: $('#family').val(),
				complaint_no: $('#complaint_no').val(),
				room_no:'<?php echo $room_name;?>',
				consultant:'<?php echo $consultant_name;?>',
				id:id,
			},
			success: function(msg) {
				$('#family').val('');
				$("#family_div").load(location.href + " #family_div");

			}
		});
		}	
		
			function delete_fam(x){
		if(confirm("Sure to delete?")){
			
		$.ajax({
			type: "post",
			url: "family_clinic.php", //this is my servlet
			data: {
				user: x,
			},
			success: function(msg) {
								$("#family_div").load(location.href + " #family_div");
			}
		});
		}
	}
	function add_clinic()
	{
		var complaints = $('#complaints').val();
		var dm = $('#dm').val();
		var cad = $('#cad').val();
		var asthma= $('#asthma').val();
		var seizure = $('#seizure').val();
		var diagnosis = $('#diagnosis').val();
		if($("#checkSurfaceEnvironment-1").prop('checked') == true){
			//do something
		}
		
		if($("#dm").prop('checked') == true){
			var dm=1;
			}else{
				var dm=0;
				}
			if($("#cad").prop('checked') == true){
			var cad=1;
			}else{
				var cad=0;
				}
			if($("#asthma").prop('checked') == true){
			var asthma=1;
			}else{
				var asthma=0;
				}
			if($("#seizure").prop('checked') == true){
			var seizure=1;
			}else{
				var seizure=0;
				}
		if ($('#pid').val() == "") {
			alert('You can not submit without Patient ID. Please Select Patient!');
			return false;
		}
		if ($('#complaints').val() == "") {
			alert('complaints cannot be left blank!');
			return false;
		}
		else if ($('#diagnosis').val() == "") {
			alert('diagnosis cannot be left blank!');
			return false;
		}
		
		$('#addclinicsubmit').hide();
		var id="";
		$.ajax({
			type: "post",
			url: "clinical_history.php", //this is my servlet
			data: {
				complaint_no : $('#complaint_no').val(),
				complaints: $('#complaints').val(),
				dm: dm,
				cad: cad,
				asthma: asthma,
				seizure: seizure,
				diagnosis: $('#diagnosis').val(),
				room_no:'<?php echo $room_name;?>',
				consultant:'<?php echo $consultant_name;?>',
				id:id,
				pid:$('#pid').val(),
				action:'add',
			},
			success: function(msg) {
				
				if(msg=='success')
					alert('Clinical data added.');
				else
					alert('Clinincal data can not be added. Please try again.');
				window.location.href=window.location.href;
			}
		});
		}	

function getclinicalhistorytable(){


				var t = $('#getclinicalhistorytable').DataTable();
				var pid = $("#pid").val();
				
				$.ajax({
							type: "post",
							url: "clinical_history.php",
							data: {
							pid:pid,
							action:'list',
							},
							success: function(msg) {
								var msg=$.trim(msg);
								t.clear().draw(false);;	
								if(msg=="")
								{
								$("#getclinicalhistorytable > tbody").append("<b>No Result Found</b>");
								return false;
								}
									var v=msg.split('@');
									var len=v.length;
									var j=1;	
								for (i = 0; i <len; i++) 
								{
										var s=j++;
										var x1= v[i].split("~");
										t.row.add([
										s,
										x1[0],
										x1[1],
										x1[2],
										x1[3],
										msg, 
									]).draw();
								}
							//$('#bill1').trigger("reset");
							}
						});
}


function get_clinichist_list(cno){
	var pcno = $(cno).data('id');
	 //console.log(labsampleno);
	//return false;	
		$.ajax({
		type: "POST",
		url: "clinical_history.php",
		data: {pcno:pcno,action:'pc_modal_view',},
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
		
		$('#get_clinichist_modal_report').html(msg);
		
		
		
		
		
		}
			
		}
	});
	}



function updatemed()
{
$("#appendmsg1").empty();
msg='<p><span class="fa fa-check">Medication  Sucessfully Updated</span></p>';
$("#appendmsg1").append(msg);
$('#message-box-update').toggle();
}


function printmed()
{
var x= $('#pid').val();
var y=$('#compid').val();
//alert(y);
var win2=window.open('printing.php?pid='+x+'&maxid='+y);
}

function allprint()
{
//saveall('1');

var x= $('#pid').val();
//var billrights= $('#billrights').val();
var reqrights= $('#reqrights').val();
var prerights= $('#prerights').val();
//alert(prerights);
var tbody = $("#pretable tbody");
if(tbody.children().length != 0)
{
if(prerights==1)
var win=window.open('printing.php?pid='+x, '_blank');
}
 
 //alert(reqrights);
 
if(reqrights==1)
var win1=window.open('reqprint.php?pid='+x, '_blank');


//$('#message-box-success').toggle();
}
function addnewbrand()
	{
		if ($('#company').val() == "") {
			alert('Compnay cannot be left blank');
			return false;
		}
		if ($('#tablet').val() == "") {
			alert('Brand/Tablet name cannot be left blank');
			return false;
		}
		if ($('#generic').val() == "") {
			alert('Gneric Name cannot be left blank');
			return false;
		}
		$.ajax({
			type: "post",
			url: "add_brand.php",
			data: {
				generic: $('#generic').val(),
				brand: $('#tablet').val(),
				company: $('#company').val(),
			},
			success: function(msg) {
				//alert(msg);
				msg=$.trim(msg);
			if(msg=='inserted')
			{
			 $('#generic').val('');
				 $('#tablet').val('');
				 $('#company').val('');
			$('#message-box-info').toggle();
			}
			else
			{
			$("#appenderror").empty();
		msg='<p><span class="fa fa-check">Error Occured</span></p>';
		$("#appenderror").append(msg);
		$('#message-box-error').toggle();
			}	
			
				
			}
		});	
	
	}
//var globalvariable;
$(document).ready(function() {
	//Allow numeric only  
  $("#tablet_orderquantity").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
           return false;
    }
   });

$('.btnNext').click(function(){
  $('.nav-tabs > .active').next('li').find('a').trigger('click');
});

  $('.btnPrevious').click(function(){
  $('.nav-tabs > .active').prev('li').find('a').trigger('click');
});

});


function saveall(x){
//alert('');
//$('#message-box-success'.data("box")).fadeToggle();


	var tbody = $("#pretable tbody");
	if (tbody.children().length == 0) {
		if(confirm("Do you want to continue without medication?")){
		}
		else{
			return false;
		}
	}
	//var x=$.trim(x);
	//if(x =="")
		//$('#message-box-success').toggle();
//$('#message-box-success').modal('toggle');
//var s=$("#s").val();
//var x=$("#txtallergies").val();

	
		savecompliants();
	
	
$('#message-box-success').modal('toggle');
	if (tbody.children().length != 0) {
		savemedication();
	}

	var s=$("#lstprovisional").val();
	var x=$("#lstdiagnosis").val();
	if(x !="" || s!="")
		savediognis();


	if (jQuery("#diabetes").is(":checked")){
        var p='Yes';}else { p='No'; 
	}
	if (jQuery("#coronary").is(":checked")){
        var q='Yes';} else { q='No'; 
	}
	if (jQuery("#hypertension").is(":checked")){
       var r='Yes';} else { r='No'; 
	}
	if (jQuery("#asthma").is(":checked")){
        var s='Yes';} else { s='No'; 
	}
	if (jQuery("#cad").is(":checked")){
        var t='Yes';} else { t='No'; 
	}
	var x=$("#txtmedhis").val();
	var y=$("#txtfamhis").val();
	
	var z=$("#txtperhis").val();
	var w=$("#txtpsyhis").val();
	var aller=$("#txtallergies").val();
	var blood=$("#blood").val();
	//if(p =='Yes' ||t =='Yes'|| q =='Yes' || r =='Yes' || s =='Yes' || x!="" || y !="" || z !="" || w !="" || aller !="" || blood !="")  		
	//alert();
	savemedhistory();
//alert(globalvariable);

	

	//var x=$("#reportadd").text();
	//x=$.trim(x);
	var investbody = $("#investable tbody");
	if (investbody.children().length != 0)  {
	
		saveinvestigation();
	}
allprint();
//alert('hi');
} 



function updateinvestigation()
{
pid=$("#pid").val();
table = $("#invesupdate");
var id=$("#hcomplaintid1").val();
//$("#tbl1 > tbody").html("");
//alert(id);
    var asset = [];
    table.find('tbody > tr').each(function (rowIndex, r) {
        var cols = [];
        $(this).find('td').each(function (colIndex, c) {
            cols.push(c.textContent);
        });
        asset.push(cols);
    });
	$.ajax({
		type: "POST",
		url: "updateinvestigationhistory.php",
		data: { assets: asset,
		
		},
		success: function(msg) {
		//alert(msg);
		var msg=$.trim(msg);
		if(msg=='updated')
		{
		$("#appendmsg1").empty();
	msg='<p><span class="fa fa-check">Investigation  Sucessfully Updated</span></p>';
	$("#appendmsg1").append(msg);
	$('#message-box-update').toggle();
	}else
	{
	$("#appenderror").empty();
	msg='<p><span class="fa fa-check">Error Occured During Updation Try again !</span></p>';
	$("#appenderror").append(msg);
	$('#message-box-error').toggle();
	}
		}
	}); 
}
		function save()
		{
		//alert('');
		
		var pay = $('#pay').val();
		var total = $('#total').val();
		//var name = $('#name').val();
		var id= $('#pid').val();
		var bal = $('#bal').val();

		if(pay=="")
		return false;
		
		if(id=="")
		return false;
		//var tbody = $("#pretable tbody");
	
		var tbody = $("#dataTables-example tbody");
		table = $("#dataTables-example");
		if (tbody.children().length == 0) {
		alert('Table should not blank');
		return false;}
    var asset = [];
    table.find('tbody > tr').each(function (rowIndex, r) {
        var cols = [];
        $(this).find('td').each(function (colIndex, c) {
            cols.push(c.textContent);
        });
        asset.push(cols);
    }); 
	//saveall();
	//alert('');
		$.ajax({
		type: "POST",
		url: "save_bill.php",
		data: { assets: asset,
		pay:pay,
		total:total,
		id:id,
		bal:bal,
		},
		success: function(msg) {
		//alert(msg);
			msg=$.trim(msg);
			msg=msg.split('~');
			var num=msg[1];
			//alert(msg[1]);
				if(msg[0]=='Success')
		{
		$("#appendmsg").empty();
	msg='<p><span class="fa fa-check">Billing  Sucessfully Added</span></p>';
	$("#appendmsg").append(msg);
	var bill=$('#billrights').val();
	if(bill=='1') {
	window.open('printbill.php?billnumber='+num, '_blank');
	}
	saveall();
	//$('#message-box-success').toggle();
	}else
	{
	$("#appenderror").empty();
	msg='<p><span class="fa fa-check">Error Occured During Updation Try again !</span></p>';
	$("#appenderror").append(msg);
	$('#message-box-error').toggle();
	}
		if(msg=='Success')
		{
		
			$("#dataTables-example > tbody").empty();
			}
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
			//alert(sum);
			$("#total").val(sum);
			var bal = $('#old').val();
		var pay = $('#pay').val();
		var total = $('#total').val();
		var amt=Number(total)-Number(pay);
		var due=Number(amt)+Number(bal);
		//alert(due);
		$('#bal').val(due);
}

		function cal()
		{
		//alert($('#billing').text());
		var tbody = $("#dataTables-example tbody");

		if (tbody.children().length == 0) {
    	alert('Table Sholud not blank');
		$('#pay').val("");
		return false;
	}
		var bal = $('#old').val();
		var pay = $('#pay').val();
		var total = $('#total').val();
		var amt=Number(total)-Number(pay);
		var due=Number(amt)+Number(bal);
		$('#bal').val(due);
		//alert(due);
		}

		function add()
		{
		$("#total").val("");
		var fees = $('#fees').val();
		var des = $('#des').val();
		//alert('');
		if(des =="")
		{
		alert('description should not be blank');
			return false;
			}
		if(fees =="")
		{
	alert('Fees should not be blank');
	return false;
			}
			var txt = "<tr><td></td><td>"+des+"</td><td>"+fees+"</td><td><a href='#' onClick='delItem($(this))' class='btn btn-danger btn-condensed'><span class='fa fa-times'></span></a></td></tr>";
	$("#dataTables-example > tbody").append(txt);
			 $('#fees').val('');
		 $('#des').val('');
		 var sum=0;
		 var i=1;
		 $( "#dataTables-example tbody tr" ).each( function(){
		 $(this).find("td").eq(0).text(i++);
  			var s=$(this).find("td").eq(2).text();
			
			sum += Number(s);
		});
			//alert(sum);
			$("#total").val(sum);
			cal();
		}
		

		
		
	        /*var jvalidate = $("#jvalidate").validate({
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
				*/
				
				function get()
				{
				//alert('');
				$("#oldtable > tbody").html("");
				$("#dataTables-example > tbody").html("");
				$('#old').val('0');
				$('#total').val('0');
				$('#pay').val('0');
				var ser = $("#pid").val();
				//alert(ser);
				ser=$.trim(ser);
				if(ser =="")
				return false;
				$('#bbill').modal('toggle');
			//alert(ser);
			$.ajax({
		type: "POST",
		url: "returnget.php",
		data: {ser:ser},
		success: function(msg) {
		var msg=$.trim(msg);
		//alert(msg);
		if(msg=='') {
		alert('Request Not Found');
		//$('#name').val('');
		//$('#id').val('');
		return false;
		}
		else {
		var y=msg.split('+');
		var x=y[0].split('~');
		//$('#name').val(x[1]);
		//$('#id').val(x[0]);
		$('#old').val(x[2]);
		var z=y[1].split('#');
		var last=z[1];
		
		var v=z[0].split('@');
		var j=1;
		for (i = 0; i <last; i++) 
		{
		var s=j++;
		var x1= v[i].split("~");
		$("#tbl").show();
		var txt = "<tr><td>"+s+"</td><td>"+x1[0]+"</td><td>"+x1[1]+"</td><td>"+x1[2]+"</td></tr>";
	$("#oldtable > tbody").append(txt);
		
		}
		
		
		}
			
		}
	});
	}
				
				$(document).ready(function() {
 	$.ajax({
		type: "GET",
		url: "return_name.php",
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
	getlabhistorytable();
	getclinicalhistorytable();
		});                                   

        
	function savediognis()
	{
	var s=$("#lstprovisional").val();

	var x=$("#lstdiagnosis").val();

	var y=$("#pid").val();


$.ajax({
			type: "post",
			url: "diagnosisentry.php",
			data: {
				s:s,y:y,x:x,
			},
			success: function(msg) {
				if(msg=='Sucess')
				{
				msg='<p><span class="fa fa-check">Diagnosis Sucessfully Added</span></p>';
			$("#appendmsg").append(msg);
			}
				$("#lstdiagnosis").val('');
				$("#lstprovisional").val('');
				//$("#lstsym").val('');
				//$('#upcomplaints').modal('close');
			}
		});
	
	 
	}
	
	
	function updateddiog()
	{
	pid=$("#pid").val();
	var u=$("#updiogid").val();
var x=$("#uplstprovisional").val();
var y=$("#uplstdiagnosis").val();

//var u=$("#upmedhistory").val();
$.ajax({
			type: "post",
			url: "updatediagnosishistory.php",
			data: {
				y:y,x:x,u:u,
			},
			success: function(msg) {
				//alert(msg);
				msg=$.trim(msg);
				if(msg=='updated')
		{
		$("#appendmsg1").empty();
	msg='<p><span class="fa fa-check">Diagnosis  Sucessfully Updated</span></p>';
	$("#appendmsg1").append(msg);
	$('#message-box-update').toggle();
	}else
	{
	$("#appenderror").empty();
	msg='<p><span class="fa fa-check">Error Occured During Updation Try again !</span></p>';
	$("#appenderror").append(msg);
	$('#message-box-error').toggle();
	}
				//$('#medhistory').modal('toggle');
			}
		});
	
	 
	}
	
	
	/*function updatemedhistory()
	{
	
	var u=$("#upmedhistory").val();
	if (jQuery("#updiabetes").is(":checked")){
        var p='Yes';}else { p='No'; }
	if (jQuery("#upcoronary").is(":checked")){
        var q='Yes';} else { q='No'; }
		if (jQuery("#uphypertension").is(":checked")){
        var r='Yes';} else { r='No'; }
		if (jQuery("#upasthma").is(":checked")){
        var s='Yes';} else { s='No'; }
		
		if (jQuery("#ucad").is(":checked")){
        var a='Yes';} else { a='No'; }

var x=$("#uptxtmedhis").val();
var y=$("#uptxtfamhis").val();

var z=$("#uptxtperhis").val();
var w=$("#uptxtpsyhis").val();
//var u=$("#upmedhistory").val();
$.ajax({
			type: "post",
			url: "updatemedicalhistory.php",
			data: {
				p:p,q:q,r:r,s:s,w:w,z:z,y:y,x:x,u:u,a:a,
			},
			success: function(msg) {
				alert(msg);
				//$("#lstsym").val('');
				$('#medhistory').modal('toggle');
			}
		});
	
	 
	}*/
	
	function savemedhistory()
	{
	//alert('');
	var u=$("#pid").val();
	//alert(u);
	if (jQuery("#diabetes").is(":checked")){
        var p='Yes';}else { p='No'; }
	if (jQuery("#coronary").is(":checked")){
        var q='Yes';} else { q='No'; }
		if (jQuery("#hypertension").is(":checked")){
        var r='Yes';} else { r='No'; }
		if (jQuery("#asthma").is(":checked")){
        var s='Yes';} else { s='No'; }
		if (jQuery("#cad").is(":checked")){
        var a='Yes';} else { a='No'; }
var x=$("#txtmedhis").val();
var y=$("#txtfamhis").val();
var t=$("#txtallergies").val();
var z=$("#txtperhis").val();
var w=$("#txtpsyhis").val();
var blood=$("#blood").val();
//alert(w);
//var u=$("#upmedhistory").val();
$.ajax({
			type: "post",
			url: "medicalhistoryentry.php",
			data: {
				p:p,q:q,r:r,s:s,w:w,z:z,y:y,x:x,u:u,a:a,t:t,blood:blood,
			},
			success: function(msg) {
			//alert(msg);
			if(msg=='Success')
				{
				msg='<p><span class="fa fa-check">Medical History Sucessfully Added</span></p>';
			$("#appendmsg").append(msg);
			}
				//alert(msg);
			 //window.globalvariable = msg;
				//$("#lstsym").val('');
				//$('#medhistory').modal('close');
			}
		});
	
	 
	}
	
	
	function savecompliants()
	{
	//alert('');
	var s=$("#s").val();
	var y=$("#pid").val();
	if(s=="")
	$('#s').addTag('nill');

var count;
$.ajax({
			type: "post",
			url: "complaintsentry.php",
			data: {
				s:s,y:y,
			},
			success: function(msg) {
				//alert(msg);
				var msg=msg;
				//var x=msg.split("~");
				//var x[0]=msg;
				if(msg=='Success')
				{
				//$("#cpresid").val(x[1]);
				msg='<p><span class="fa fa-check">Complaints Sucessfully Added</span></p>';
			$("#appendmsg").append(msg);	
			$("#s").importTags('');
			$("#txtallergies").val('');
			}
			//count=msg;
			//if(typeof callback === "function") callback(count);
			//$('#upcomplaints').modal('close');
			}
		});
	//alert(msg);
	 
	}
	
	function updatecompliants()
	{
	var s=$("#us").val();

var x=$("#upcompliantid").val();

//var y=$("#upaller").val();
pid=$("#pid").val();

$.ajax({
			type: "post",
			url: "updatecompliaint.php",
			data: {
				s:s,x:x,
			},
			success: function(msg) {
				//alert(msg);
				msg=$.trim(msg);
				if(msg=='updated')
		{
		$("#appendmsg1").empty();
	msg='<p><span class="fa fa-check">Diagnosis  Sucessfully Updated</span></p>';
	$("#appendmsg1").append(msg);
	$('#message-box-update').toggle();
	}else
	{
	$("#appenderror").empty();
	msg='<p><span class="fa fa-check">Error Occured During Updation Try again !</span></p>';
	$("#appenderror").append(msg);
	$('#message-box-error').toggle();
	}
				//$('#upcomplaints').modal('toggle');
			}
		});
	
	 
	}
	
	
	$('.select').selectpicker();
	
	function tabletlist(){
	//alert($('#generic').val());
	$('#txtbrand').empty();
		
		tab=$('#tablet').val();
		brand=$.trim(tab);
		
		
		$.ajax({
			type: "post",
			url: "gettablet.php", //this is my servlet
			data: {
				brand: brand,
				
			},
			success: function(msg) {
			//alert(msg);
			var arr = msg.split('@');
			var x=arr[1].split('#');
			$.each( x, function( key,value ) {	
				$('#txtbrand').append(new Option(value));
				});
				$('#txtbrand').selectpicker('refresh')
				$('#generic').val(arr[0]);
				}

			});
			}
			
	function xtabletlist(){
	//alert($('#xgeneric').val());
	$('#txtxbrand').empty();
		
		tab=$('#xtablet').val();
		brand=$.trim(tab);
		$.ajax({
			type: "post",
			url: "gettablet.php", //this is my servlet
			data: {
				brand: brand,
				
			},
			success: function(msg) {
			var arr = msg.split('@');
			var x=arr[1].split('#');
			$.each( x, function( key,value ) {	
				$('#txtxbrand').append(new Option(value)).selectpicker('refresh');
				});
				$('#xgeneric').val(arr[0]);
			//alert(msg);
				//var arr = msg.split(';');
				
				//$('#txtxbrand').append(new Option(tab)).selectpicker('refresh');
				//$('#xgeneric').val(msg);
				}

			});
			}
			

			
			
	function drugList(){
	//alert($('#generic').val());
	$('#txtbrand').empty();
		if ($('#generic').val() == "") {
			//$('#txtbrand').append(new Option('Select Drug Name'));
			return false;
		}
		$.ajax({
			type: "post",
			url: "getbrand.php", //this is my servlet
			data: {
				generic: $('#generic').val(),
			},
			success: function(msg) {
			//alert(msg);
				var arr = msg.split(';');
			//	alert(msg);
				$.each(arr, function(index,value){
				
					$('#txtbrand').append(new Option(value));
				});
				$('#txtbrand').selectpicker('refresh');
				}

			});
			}
			
			function xdrugList(){
	//alert($('#generic').val());
	$('#txtxbrand').empty();
		if ($('#xgeneric').val() == "") {
			$('#txtxbrand').append(new Option('Select Drug Name'));
			return false;
		}
		$.ajax({
			type: "post",
			url: "getbrand.php", //this is my servlet
			data: {
				generic: $('#xgeneric').val(),
			},
			success: function(msg) {
			//alert(msg);
				var arr = msg.split(';');
				$.each(arr, function(index,value){
					$('#txtxbrand').append(new Option(value)).selectpicker('refresh');
				});
				}

			});
			}
			
	
	
	function xaddmed()
	{
	//alert('');
	if($("#txtxbrand").val()!= 'Select Drug Name'  && $("#xduration").val()!= '' && $("#xfrequency").val()!= '' && $("#xspecification").val()!='' && $("#xdosage").val() !=''){
			var x = $("#txtxbrand").val().split("--");
			var drugname = $("#xseltype").val() + ' ' + x[0], dosage = $("#xdosage").val(), route = $("#xroute").val(), 
				specification = $("#xspecification").val(), duration = $("#xduration").val(), frequency = $("#xfrequency").val();
			$.ajax({
				type: "post",
				url: "add-new-prescription.php", //this is my servlet
				data: {
					id: $("#compid").val(),
					drugname: drugname,
					dosage: dosage,
					route: route,
					specification: specification,
					duration: duration,
					frequency: frequency,
				},
				success: function(msg) {
					$('#tblXPrescription > tbody').append(msg);
				}
			});
			$("#xseltype").val('Tab.');	$("#txtxbrand").val('Select Drug Name');
			$("#xgeneric").val('');		$("#xdosage").val('');
			$("#xroute").val('Oral');	$("#xspecification").val('After food');
			$("#xduration").val('');	$("#xfrequency").val('');
			$("#xtablet").val('');
		}
		else
		{
		alert('Feild canot br blank');
		}
	}
</script>
<!-- COUNTERS // NOT INCLUDED IN TEMPLATE -->
<!-- GOOGLE -->
<script>
 /*$(document).ready(function() {
 	$.ajax({
		type: "GET",
		url: "returnproduct.php",
		success: function(msg) {
			var availableTags = msg.split("~");
			$( "#generic" ).autocomplete({
			
			minLength:3,
			  source: availableTags
			});
			$( "#xgeneric" ).autocomplete({
			minLength:3,
			  source: availableTags
			});
		}
	});
 });*/



 /*$(document).ready(function() {

 	$.ajax({
		type: "GET",
		url: "returntablet.php",
		success: function(msg) {
			var availableTags = msg.split("~");
			$( "#tablet" ).autocomplete({
			minLength:3,
			  source: availableTags
			});
			$( "#xtablet" ).autocomplete({
			minLength:3,
			  source: availableTags
			});
			
		}
	});
 });*/
 function getAvailgeneric(x){
 var val = $(x).val().length;
  var gen = $(x).val();
 //alert(val);
	if(val < 3) 
	return false;
	//alert(gen);
	//return false;
	$.ajax({
		type: "GET",
		url: "returnproduct.php?generic="+gen,
		success: function(msg) {
		//alert(msg);
		var availableTags = msg.split("~");
			//var availableTags = JSON.parse(msg);
			$(x).autocomplete({
				source: availableTags,
				
			});
			
		}
	});
 
 }
function getAvail(){
	var val = $('#tablet').val().length;
	if(val < 2) return false;
	$.ajax({
		type: "GET",
		url: "returntablet.php?brand="+$('#tablet').val(),
		success: function(msg) {
			var availableTags = JSON.parse(msg);
			$( "#tablet" ).autocomplete({
				source: availableTags,
				open: function (event, ui) {
					$('.ui-autocomplete > li').css("background-color", function() {
						return $(this).text().indexOf('-1') > -1 ? '#AAD899' : '#FFFFFF';
					});
					$('.ui-autocomplete > li').text(function(){
						var text = $(this).text().slice(0,-2);
						return text;
					});
				}
			});
			$( "#xtablet" ).autocomplete({
				source: availableTags
			});
		}
	});
}	
			
	
		
		
	
	
		$(document).ready(function() {
 	$.ajax({
		type: "GET",
		url: "returndiagnosis.php",
		success: function(msg) {
			var availableTags = msg.split("~");
			$( "#txtdiag" ).autocomplete({
			  source: availableTags
			});
		}
	});
 });
 
 $(document).ready(function() {
 	$.ajax({
		type: "GET",
		url: "returndiagnosis.php",
		success: function(msg) {
			var availableTags = msg.split("~");
			$( "#uptxtdiag" ).autocomplete({
			  source: availableTags
			});
		}
	});
 });
 
 function addlabinves(){
	var inves=$('#inves').val();
	var inves_sub=$('#inves_sub').val();
	var note=$('#note').val();
	var reports=$('#reports').val();
	if(inves=='' || inves==0)
	return false;
	//console.log(inves);
	$.ajax({
		type: "POST",
		url: "lab_investigation_add.php",
		data: {
			pat_id:'<?php echo $pid;?>',
			patientname:'<?php echo $patientname;?>',
			lab_id:inves,
			lab_sub_id:inves_sub,
			reports:reports,
			note:note,
			action:'add',
		   
		},
		success: function(msg) {
			//console.log(msg);
			//return false;
			$('#reportadd').html(msg);
			
		}
	});
	}
 function delete_lab_inves_details(row_id,pid){
	 $.ajax({
		type: "POST",
		url: "lab_investigation_del.php",
		data: {
			pat_id:pid,
			row_id:row_id
			
		   
		},
		success: function(msg) {
			//console.log(msg);
			//return false;
			$('#reportadd').html(msg);
			
		}
	});
 }
 
 function addlabinves_save(pid,add){
	 var tbody = $("#reportadd #investable tbody");
		var err='';
		if (tbody.children().length == 0) {
			var err='Lab Test record should not blank';
		}
		if(err!=''){
			$(".errmsg").empty();
			
			$(".errmsg").append(err);
			$('#myModal_errmsg').modal('show');
			return false;
		}
		if(add ==''){
			$('#addlabinves_save_modal').modal('show');
			return false;
		}
		$('#addlabinves_save_modal').modal('hide');
		var test_title = $("#test_title").val();
		var test_category = $("#test_category").val();
		var table = $("#investable");
		var asset = [];
		table.find('tbody > tr').each(function (rowIndex, r) {
			var cols = [];
			$(this).find('td').each(function (colIndex, c) {
				cols.push(c.textContent);
			});
			asset.push(cols);
		}); 
	//console.log(asset.toString());
	//return false;
	  $.ajax({
		type: "POST",
		url: "lab_investigation_add.php",
		data: {
			pat_id:'<?php echo $patient_id;?>',
			ip_id:'<?php echo $inv_pat_id;?>',
			test_title:test_title,
			test_category:test_category,
			asset:asset,
			action:'save',
		},
		success: function(msg) {
			//console.log(msg);
			//return false;
			$('#reportadd').html(msg);
			alert('Reports Submitted.');
			getlabhistorytable();
			
		}
	});
	 
 }
	function addinves()
	{
	var inves=$('#inves').val();
	var inves1=$('#inves option:selected').text();
	var note=$('#note').val();
	var reports=$('#reports').val();
	var reports1=$('#reports option:selected').text();
	//var obser=$('#obser').val();
	var chief=$('#chief').val();
	if(chief=="" && note=="")
	chief='Pending'; 
		$.ajax({
		type: "POST",
		url: "investigation_add.php",
		data: {
			pat_id:'<?php echo $pid;?>',
			patientname:'<?php echo $patientname;?>',
			inves:$('#inves option:selected').text(),
			note:$('#note').val(),
			reports:$('#reports option:selected').text(),
		    chief:$('#chief').val(),
		},
		success: function(msg) {
		}
	});
	var txt='<tr><td></td><td>'+inves1+'</td><td style="display:none">'+inves+'</td><td>'+reports1+'</td><td>'+chief+'</td><td>'+note+'</td><td><a href="#" class="remove" onClick="javascript:delDiv(this)"><span class="fa fa-times"></span></a></td><td style="display:none">'+reports+'</td>';
	$('#investable > tbody').append(txt);
	
	var i=1;
		 $( "#investable tbody tr" ).each( function(){
		 $(this).find("td").eq(0).text(i++);
  			});
	$('#chief').val("");
	$('#note').val("");
	}
	
	
	function delDiv(x){
	var row = x.closest("tr");
	 //row.find("td").eq(4).text("0");
		row.remove();
			var i=1;
		 $( "#investable tbody tr" ).each( function(){
		 $(this).find("td").eq(0).text(i++);
  			});
			
			
	}
	
	//	$('#s').tagsinput({
//   'defaultText':'add a tag',
//   });style="border:none"
	
		
$(document).ready(function() {
$("#s_tagsinput").css({ 'border': "none" });
$("#lstdiagnosis_tagsinput").css({ 'border': "none" });
$("#lstprovisional_tagsinput").css({ 'border': "none" });
$("#uplstdiagnosis_tagsinput").css({ 'border': "none" });
$("#uplstprovisional_tagsinput").css({ 'border': "none" });
$( "#txtmedhis_tag" ).attr( "placeholder", "Other Medical History" );
$( "#txtfamhis_tag" ).attr( "placeholder", "Family History" );
$( "#txtperhis_tag" ).attr( "placeholder", "Personal History");
var d=$("#display").val();
$( "#txtpsyhis_tag" ).attr( "placeholder", ""+d+" History" );
$( "#txtallergies_tag" ).attr( "placeholder", "Allergies Only" );
//$("txtpsyhis_tag").css("width", "100px"); 
//$("#txtpsyhis_tag").css("position", "relative");
//$( "#txtperhis_tag" ).css( 'width': "100px" );
//$("#lstsym_tag").fieldcontain('refresh');
});
		
		
		
		
 $(".remove").on("click",function(){
 //event.preventDefault();
  $(this).closest('div').remove();
  /*<!--var parentId = $(this).closest('div').prop('id');
			$("#'+parentId+'").remove();
    alert(parentId);-->*/
			
		});
		
		
							
		
		
function investigation(){
	var inves=$('#inves').val();
		//console.log(inves);
		//return false;
	$.ajax({
		type: "POST",
		url: "getinvesreport.php",
		data: {inves:inves,},
		success: function(msg) {
			//console.log(msg);
			//return false;
			$("#inves_sub").empty().selectpicker('refresh');
			if(msg !=''){
				var opt = msg.split("~");
				//$("#reports").append(new option("sample"));
				//waitingDialog.show();
				
				$.each( opt, function( i, val ) {
				var id = val.split("+");
					$("#inves_sub").append("<option title='"+id[0]+"' value='"+id[1]+"'>"+id[0]+"</option>").selectpicker('refresh');			 
				  });
			}
			else{
				$("#inves_sub").append("<option title='' value=''>Select</option>").selectpicker('refresh');			 
			}
		}
	});
}
	
 $(document).ready(function() {
 	$.ajax({
		type: "GET",
		url: "returnsymptom.php",
		success: function(msg) {
			var availableTags = msg.split("~");
			$( "#lstsym" ).autocomplete({
			  source: availableTags
			});
		}
	});
	$.ajax({
		type: "GET",
		url: "returnsymptom.php",
		success: function(msg) {
			var availableTags = msg.split("~");
			$( "#uplstsym" ).autocomplete({
			  source: availableTags
			});
		}
	});
	
	$.ajax({
		type: "GET",
		url: "returnpsysymptom.php",
		success: function(msg) {
			var availableTags = msg.split("~");
			$( "#lstpsysym" ).autocomplete({
			  source: availableTags
			});
			
		}
	});
 
 $.ajax({
		type: "GET",
		url: "returnpsysymptom.php",
		success: function(msg) {
			var availableTags = msg.split("~");
			$( "#uplstpsysym" ).autocomplete({
			  source: availableTags
			});
		}
	});
 });
 
$(document).ready(function() {

	/*dialog = $("#dialog").dialog({
			autoOpen: false,
			height: 250,
			width: 400,
			modal: true
		});
	$('table').find('td').click(function () {
    	var txt = $(this).text();
		var th = $('#tbl1 th').eq($(this).index()).text();
		var id = $(this).closest("tr").find('input[name="hcomplaintid"]').val();
//		var id = $(this).parent().parent().find('input[name="hcomplaintid"]').val();
		if(th == "Date" || th == "Physician")
			return false;
		$("#compid").val(id);
		$("#field").val(th);
	    $("#updatecontent").val(txt);
		dialog.dialog("open");
		
	});*/
	$("#btnupdate").click(function(){
	pid=$("#pid").val();
		$.ajax({
			type: "post",
			url: "updatecomplainthistory.php",
			data: {
				content: $('#updatecontent').val(),
				field: $('#field').val(),
				id: $('#compid').val(),
			},
			success: function(msg) {
				if(msg == 'updated'){
					window.location.href='complaints.php?pid='+pid;
				}else{
					alert(msg);
				}
			}
		});
	});
});

function upaddprodiag(){

	if($("#uplstprodiag").val() != ''){
			var x = $("#uplstprodiag");
			$('#uplstprovisional').addTag(x.val());
			x.val('');
			
		}
	
	}
	
	function upadddiag(){

	if($("#uptxtdiag").val() != ''){
			var x = $("#uptxtdiag");
			$('#uplstdiagnosis').addTag(x.val());
			x.val('');
			
		}
	
	}
	
	
function addprodiag(){

	if($("#lstprodiag").val() != ''){
			var x = $("#lstprodiag");
			$('#lstprovisional').addTag(x.val());
			x.val('');
			
		}
	
	}
	
	function adddiag(){

	if($("#txtdiag").val() != ''){
			var x = $("#txtdiag");
			$('#lstdiagnosis').addTag(x.val());
			x.val('');
			
		}
	
	}
	
function addPsy1(){

	if($("#lstpsysym").val() != ''){
			var x = $("#lstpsysym");
			$('#s').addTag(x.val());
			x.val('');
			
		}
	
	}
	
	
	function upPsy1(){

	if($("#uplstpsysym").val() != ''){
			var x = $("#uplstpsysym");
			$('#us').addTag(x.val());
			x.val('');
			
		}
	
	}
	
	
	function addPsy2()
	{
		if($("#lstsym").val() != ''){
			var x = $("#lstsym");
			$('#s').addTag(x.val());
			
			x.val('');
		}
	}

function upPsy2()
	{
		if($("#uplstsym").val() != ''){
			var x = $("#uplstsym");
			$('#us').addTag(x.val());
			
			x.val('');
		}
	}



$(document).ready(function() {
	$('#lstdiag').on('change', function() {
//	  $('#lstdiagnosis').append(new Option(this.value));
	  $('#lstdiagnosis').append($('<option>', { title: this.value, text: this.value }));
	  $("#lstdiag").val('Select');
	});
});
  
function del()
{
		$('#lstsymptom :selected').remove(); 
}




$(document).ready(function() {
	$("#reset").click(function () {	
		$('#lstsymptom').empty();
		$("#lstpsysym").val('');
		$("#lstsym").val('');
		$("#txtduration").val('');		
		$("#txtallergies").val('');
	});
});

	function db_psysymadd() {
	//alert('');
		if ($('#lstpsysym').val() == "") {
		var d=$("#display").val();
			alert(''+d+' symptoms cannot be left blank');
			return false;
		}
		$.ajax({
			type: "post",
			url: "add_psysym.php",
			data: {
				symptoms: $('#lstpsysym').val(),
			},
			success: function(msg) {
			msg=$.trim(msg);
			if(msg=='inserted')
			{
			$('#lstpsysym').val('');
			$('#message-box-info').toggle();
			}
			else
			{
			$("#appenderror").empty();
		msg='<p><span class="fa fa-check">Error Occured</span></p>';
		$("#appenderror").append(msg);
		$('#message-box-error').toggle();
			}	
				
			}
		});
	}
	

 function db_symadd () {
// alert('');
		if ($('#lstsym').val() == "") {
			alert('Symptoms cannot be left blank');
			return false;
		}
		$.ajax({
			type: "post",
			url: "add_symp.php",
			data: {
				symptoms: $('#lstsym').val(),
			},
			success: function(msg) {
			msg=$.trim(msg);
			if(msg=='inserted')
			{
			$('#lstsym').val('');
			$('#message-box-info').toggle();
			}
			else
			{
			$("#appenderror").empty();
		msg='<p><span class="fa fa-check">Error Occured</span></p>';
		$("#appenderror").append(msg);
		$('#message-box-error').toggle();
			}	
				//alert(msg);
				//$("#lstsym").val('');
			}
		});
	}
function selectall(){
	 $('#lstsymptom option').prop('selected', true);
}


</script>
 <script>
function check_vacant_room1(status)
{
	if(status=='Discharge'){
		document.getElementById('vacant_chk1').checked=true; 
	}
	else{
		document.getElementById('vacant_chk1').checked=false; 
	}
}
function add_service1(service1,service_no1,ref_no)
{
	if ($('#service_no1').val() == "") {
			alert('Enter the Service Days/Hours!');
			return false;
		}
		$.ajax({
			type: "post",
			url: "serviceicu.php", 
			data: {
				service_no : service_no1,
				service : service1,
				ref_no : ref_no,
				patient_id :'<?php echo $patientid; ?>',
				mrd_no : '<?php echo $inv_pat_id; ?>',

				},
			success: function(msg) {		
				$('#service_no1').val('');
				jQuery("#services_list_div").html(msg);	
			}
		});
}
function delete_services1(serviceid,chart_ot,ref_no)
{
		$.ajax({
			type: "post",
			url: "delserviceicu.php", 
			data: {
				serviceid : serviceid,chart_ot : chart_ot,ref_no : ref_no,},
			success: function(msg) {
				jQuery("#services_list_div").html(msg);
			}
		});
}

function add_procedures1(procedures1,procedure_no1,ref_no,consultant1,fees_amount1)
{
	if ($('#procedure_no1').val() == "") {
			alert('Enter the Procedure Days/Hours!');
			return false;
		}
		$.ajax({
			type: "post",
			url: "procedureicu.php", 
			data: {
				procedure_no : procedure_no1,
				procedures : procedures1,
				consultant : consultant1,
				fees_amount : fees_amount1,
				ref_no : ref_no,
				patient_id :'<?php echo $patientid; ?>',
				mrd_no : '<?php echo $inv_pat_id; ?>',
				},
			success: function(msg) {
				jQuery("#procedures1_list_div").html(msg);	
				$('#consultant1').val('');
				$('#procedures1').val('');
				$('#fees_amount1').val('');
			}
		});
}
function delete_procedures1(procedureid,chart_ot,ref_no)
{
		$.ajax({
			type: "post",
			url: "delprocedureicu.php", 
			data: {
				procedureid : procedureid,chart_ot : chart_ot,ref_no : ref_no,},
			success: function(msg) {
				jQuery("#procedures1_list_div").html(msg);
			}
		});
}

function delete_consultant1(delete_id,chart_ot,ref_no)
{
	
		$.ajax({
			type: "post",
			url: "delsublisticu.php", 
			data: {
				delete_id : delete_id,chart_ot : chart_ot,ref_no : ref_no,},
			success: function(msg) {
				jQuery("#consultant1_list_div").html(msg);
			}
		});
}
function add_consulting_detail1(depart1,consultant1,visit1,ref_no)
{
		if ($('#depar1t').val() == "") {
			alert('Select Department !');
			return false;
		}
		if ($('#consultan1t').val() == "") {
			alert('Select Consultant!');
			return false;
		}
		if ($('#visit1').val() == "") {
			alert('Select Visit!');
			return false;
		}

		$.ajax({
			type: "post",
			url: "sublisticu.php", 
			data: {
				depart : depart1,
				consultant : consultant1,
				visit : visit1,
				ref_no : ref_no,
				},
			success: function(msg) {
				jQuery("#consultant1_list_div").html(msg);	
				$('#depart1').val('');
				$('#consultant1').val('');
				$('#visit1').val('');
			}
		});

}
function add_chart_ot1(room_no1,name1,age1,doa1,cons1,intimedate1,chart_ot_no1,description1,shift_patient1,outtime1,vacant_chk1)
{
	 var com_remarks1 = CKEDITOR.instances.description1.getData();
     var description1= com_remarks1.replace(/&/g, "\\$1");
			$.ajax({
			type: "post",
			url: "addcharticu.php", 
			data: {
				room_no : room_no1,name : name1,age : age1,doa : doa1,cons : cons1,intimedate : intimedate1,chart_ot_no : chart_ot_no1,description : description1,shift_patient : shift_patient1,outtime : outtime1,vacant_chk : vacant_chk1,
				},
			success: function(msg) {
				alert(msg);
window.location.reload(true);			}
		});

}


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
				patient_id :'<?php echo $patientid; ?>',
				mrd_no : '<?php echo $inv_pat_id; ?>',
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

function add_procedures(procedures,procedure_no,ref_no,consultant,fees_amount)
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
				consultant : consultant,
				fees_amount : fees_amount,
				patient_id :'<?php echo $patientid; ?>',
				mrd_no : '<?php echo $inv_pat_id; ?>',
				},
			success: function(msg) {
				jQuery("#procedures_list_div").html(msg);	
				$('#procedures').val('');
				$('#consultant').val('');
				$('#fees_amount').val('');
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
window.location.reload(true);
			}
		});

}


		function display_checkbox()
		{
			if($('#physiotheraphy').is( ":checked" )){
				document.getElementById('table1').style.display="block";	
			}else{
				document.getElementById('table1').style.display="none";	
			}
		}



function check_vacant_room2(status)
{
	if(status=='Discharge'){
		document.getElementById('vacant_chk2').checked=true; 
	}
	else{
		document.getElementById('vacant_chk2').checked=false; 
	}
}
function add_service2(service2,service_no2,ref_no)
{
	if ($('#service_no2').val() == "") {
			alert('Enter the Service Days/Hours!');
			return false;
		}
		$.ajax({
			type: "post",
			url: "addservicechart.php", 
			data: {
				service_no : service_no2,
				service : service2,
				ref_no : ref_no,
				
				patient_id :'<?php echo $patientid; ?>',
				mrd_no : '<?php echo $inv_pat_id; ?>',
				},
			success: function(msg) {		
				
				jQuery("#service2_list_div").html(msg);	
				//$('#service_no2').val('');
				//$('#service2').val('');
				//$('#consultant2').val('');
				//$('#fees_amount2').val('');
				//jQuery("#service_list_div").html(msg).trigger("create");
				//$('#service').val('');
			}
		});
}
function delete_services2(serviceid,chart_ot,ref_no,consultant2,fees_amount2)
{
		$.ajax({
			type: "post",
			url: "deleteservice.php", 
			data: {
				serviceid : serviceid,chart_ot : chart_ot,ref_no : ref_no,patient_id :'<?php echo $patientid; ?>',
				mrd_no : '<?php echo $inv_pat_id; ?>',},
			success: function(msg) {
				jQuery("#service2_list_div").html(msg);
			}
		});
}

function add_procedures2(procedures2,procedure_no2,ref_no,consultant2,fees_amount2)
{
	//alert(procedures);
	//alert(procedure_no);
	//alert(ref_no);
	if ($('#procedure_no2').val() == "") {
			alert('Enter the Procedure Days/Hours!');
			return false;
		}
		$.ajax({
			type: "post",
			url: "addprocedurechart.php", 
			data: {
				procedure_no : procedure_no2,
				procedures : procedures2,
				ref_no : ref_no,
				consultant : consultant2,
				fees_amount : fees_amount2,
				patient_id :'<?php echo $patientid; ?>',
				mrd_no : '<?php echo $inv_pat_id; ?>',
				},
			success: function(msg) {
				jQuery("#procedures2_list_div").html(msg);	
			
			}
		});
}
function delete_procedures2(procedureid,chart_ot,ref_no)
{
		$.ajax({
			type: "post",
			url: "deleteprocedure.php", 
			data: {
				procedureid : procedureid,chart_ot : chart_ot,ref_no : ref_no,patient_id :'<?php echo $patientid; ?>',
				mrd_no : '<?php echo $inv_pat_id; ?>',},
			success: function(msg) {
				jQuery("#procedures2_list_div").html(msg);
			}
		});
}

function delete_consultants2(delete_id,chart_ot,ref_no)
{
	
		$.ajax({
			type: "post",
			url: "deleteconsultantdetail.php", 
			data: {
				delete_id : delete_id,chart_ot : chart_ot,ref_no : ref_no,
				pid : '<?php echo $pid; ?>',
				pat_ip_id : '<?php echo $inv_pat_id; ?>',
				},
			success: function(msg) {
				jQuery("#consultant2_list_div").html(msg);
			}
		});
}
function add_consulting_details2(depart2,consultant2,visit2,ref_no)
{
		if ($('#depart2').val() == "" || $('#depart2').val() == 'select') {
			alert('Select Department !');
			return false;
		}
		if ($('#consultant2').val() == "" || $('#consultant2').val() == 'select') {
			alert('Select Consultant!');
			return false;
		}
		if ($('#visit2').val() == "" || $('#visit2').val() == 'select') {
			alert('Select Visit!');
			return false;
		}
		//alert($('#depart2').val());
		$.ajax({
			type: "post",
			url: "addconsultantdetail.php", 
			data: {
				depart : depart2,
				consultant :consultant2,
				visit : visit2,
				ref_no : ref_no,
				pid : '<?php echo $pid; ?>',
				pat_ip_id : '<?php echo $inv_pat_id; ?>',
				
				},
			success: function(msg) {
				jQuery("#consultant2_list_div").html(msg);	
				//$('#depart2').val('');
				//$('#consultant2').val('');
				//$('#visit2').val('');
			}
		});

}
function add_chart_ot2(room_no2,name2,age2,doa2,cons2,intimedate2,chart_ot_no2,description2,shift_patient2,outtime2,vacant_chk2)
{

var pat_ip_id = '<?php echo $inv_pat_id; ?>';
var pid = '<?php echo $pid; ?>';
var vacant_chk2_value = jQuery('#vacant_chk2:checked').val();


			$.ajax({
			type: "post",
			url: "addchart.php", 
			data: {
				room_no : room_no2,name : name2,age : age2,doa : doa2,cons : cons2,intimedate : intimedate2,chart_ot_no : chart_ot_no2,description : description2,shift_patient : shift_patient2,outtime : outtime2,vacant_chk : vacant_chk2_value,patient_ip_id : pat_ip_id,pid:pid
				},
			success: function(msg) {
				alert(msg);
				if(shift_patient2=='Discharge'){
					window.location = "billing_ip.php?pid="+pid;
				}else{
					window.location.href=window.location.href;
				}
		//If success redirect to Billing page with Patient universal id
		//window.location = "billing_ip.php?pid="+pid;
			}
		});
		
		
}



function add_sitting(type_name,sitting,ref_no)
{
	if ($('#type_name').val() == "") {
			alert('Select Type Name');
			return false;
		}
		
		if ($('#sitting').val() == "") {
			alert('Select Sitting');
			return false;
		}
		
		$.ajax({
			type: "post",
			url: "addsitting.php", 
			data: {
				type_name : type_name,
				sitting : sitting,
				ref_no : ref_no,
				patient_id :'<?php echo $patientid; ?>',
				mrd_no : '<?php echo $inv_pat_id; ?>',
				insert_from: 'CHART',
				req_from:'CHART',
				},
			success: function(msg) {
			
				jQuery("#sitting_list_div").html(msg);	
				
			}
		});
}
function delete_sitting(id,ref_no)
{
		$.ajax({
			type: "post",
			url: "deletesitting.php", 
			data: {
				id : id,ref_no : ref_no,patient_id :'<?php echo $patientid; ?>',
				mrd_no : '<?php echo $inv_pat_id; ?>',req_from:'CHART',},
			success: function(msg) {
				jQuery("#sitting_list_div").html(msg);
			}
		});
}
function get_depart_det()
{
	var depart=$('#depart2 option:selected').text(); 
	$.ajax({
		type: "POST",
		url: "getdoctor.php",
		data: {depart:depart,},
		success: function(msg) {
			var opt = msg.split("~");
			$("#consultant2").empty().selectpicker('refresh');
			$.each( opt, function( i, val ) {
			var id = val.split("+");
	  			$("#consultant2").append("<option title='"+id[0]+"' value='"+id[1]+"'>"+id[0]+"</option>").selectpicker('refresh');			 
			  });
			 }
		});
		} 
$(function() {
  
//Allow numeric only  
  $("#procedure_no2,#service_no2").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
           return false;
    }
   });
  
 //Allow Numeric and single dot only
		 $('#fees_amount2').keypress(function(event) {

			 if(event.which == 8 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46) 
				  return true;

			 else if((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57))
				  event.preventDefault();

		});
})		
</script>
</body>
<!-- Mirrored from aqvatarius.com/themes/atlant/html/pages-edit-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2015 09:47:54 GMT -->
</html>
