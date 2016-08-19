<?php
session_start();
$role=$_SESSION['role'];
date_default_timezone_set('Asia/Kolkata'); 
include("config_db1.php");
 $cmd=mysql_query("select * from settings where role='$role'");
 mysql_close($db1);
 
$sql=mysql_fetch_array($cmd);
$print_bill=$sql['print_bill'];
$lab=$sql['lab'];
?>
<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from aqvatarius.com/themes/atlant/html/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2015 09:48:25 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>        
        <!-- META SECTION -->
        <title>DPP-clinical form</title>            
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
                    <h2><span class="fa fa-arrow-circle-o-left"></span>  Billing</h2>
					
					<div class="pull-right">                            
                           <!--<a href="#" onClick="addreq()" class="btn btn-danger"><span class="fa fa-book"></span> Add Requisition </a>-->
						   </div>
						 
                </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                <div class="page-content-wrap">                
                
                    <div class="tab-pane " id="tab-four">
        <div class="row">
          <div class="col-md-12">
              <div class="form-group">
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
            <div class="col-md-4">
                <label class="col-md-4 control-label">Service:</label>  
                <div class="col-md-1">
                        <select name="service1" id="service1" class="select" style="font-weight:bold;width:160px;">
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
                 <input type="text" style="width:60px;font-weight:bold"  class="form-control" name="service_no1" id="service_no1"/>             
            </div>   
          
            <div class="col-md-1">
                <a href="#"  onClick="add_service1(service1.value,service_no1.value,chart_ot_no1.value);" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-plus"></span></a>            </div>   
                
            <div class="col-md-4">
                <label class="col-md-4 control-label">Procedures:</label>  
                <div class="col-md-3">
                        <select name="procedures1" id="procedures1" class="select" style="font-weight:bold;width:160px;" onFocus="get_amount111()"onChange="get_amount111();">
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
                 <input type="text" style="width:60px;font-weight:bold"  class="form-control" name="procedure_no1" id="procedure_no1"/>             
            </div> 
            
             <div class="col-md-4">
                        <select name="consultant" id="consultant" class="select" style="font-weight:bold;width:160px;">
                        <option>select</option>
                    <?php 
					include("config_db1.php");
					$cmd_ser = "select * from doctor_creation";
					$res_ser = mysql_query($cmd_ser);
					while($rs_ser = mysql_fetch_array($res_ser)){
								$doctor_name=$rs_ser['doctor_name'];
								$id=$rs_ser['id'];
					?>
                    	<option value="<?php echo $id."@#@#".$doctor_name;?>"><?php echo $doctor_name;?></option>
                        <?php }?>
                        </select>   
             
            </div>  <div class="col-md-1">
                 <input type="text" style="width:60px;font-weight:bold"  class="form-control" name="fees_icu" id="fees_icu"/>             
            </div>     
          
            <div class="col-md-1">
                <a href="#"  onClick="add_procedures1(procedures1.value,procedure_no1.value,chart_ot_no1.value,consultant.value,fees_icu.value);" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-plus"></span></a>            </div>   

        </div>
<!-- 3 ROW END  -->
 
        <div class="form-group">
                
            <div class="col-md-6">
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
						<td><a href="#" onclick="delete_services1('<?php echo $rs['id'];?>','<?php echo $insert_from;?>','<?php echo $ref_no;?>')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
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
                <div id="procedures1_list_div">
					<table id="dataTables-example" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Procedure</th>
                        <th>Duration</th>
                        <th>Timing</th>
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
						<td><a href="#" onclick="delete_procedures1('<?php echo $rs['id'];?>','<?php echo $insert_from;?>','<?php echo $ref_no;?>')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
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
						<td><a href="#" onclick="delete_consultant1('<?php echo $rs['id'];?>','<?php echo $insert_from;?>','<?php echo $ref_no;?>')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
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
		
	function add_others()
	{
		if ($('#others').val() == "") {
			alert('others cannot be left blank!');
			return false;
		}
		var id="";
		$.ajax({
			type: "post",
			url: "others.php", //this is my servlet
			data: {
				others: $('#others').val(),
				complaint_no: $('#complaint_no').val(),
				
				id:id,
			},
			success: function(msg) {
				$('#others').val('');
				$("#others_div").load(location.href + " #others_div");

			}
		});
		}
		function delete_id(x){
		if(confirm("Sure to delete?")){
			
		$.ajax({
			type: "post",
			url: "others.php", //this is my servlet
			data: {
				user: x,
			},
			success: function(msg) {
								$("#others_div").load(location.href + " #others_div");
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
				id:id,
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
		
		if ($('#complaints').val() == "") {
			alert('complaints cannot be left blank!');
			return false;
		}
		else if ($('#diagnosis').val() == "") {
			alert('diagnosis cannot be left blank!');
			return false;
		}
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
				id:id,
			},
			success: function(msg) {
				$('#complaints').val('');
				$('#dm').val('');
				$('#cad').val('');
				$('#asthma').val('');
				$('#seizure').val('');
				$('#diagnosis').val('');
				window.location.reload(true);
			}
		});
		}	
		function save()
		{
		//alert('');
		var pay = $('#pay').val();
		var total = $('#total').val();
		var name = $('#name').val();
		var id= $('#id').val();
		var bal = $('#bal').val();
	
		//alert(bill);
		//return false;

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
		},
		success: function(msg) {
		var msg=$.trim(msg);
		var x=msg.split("~");
			var bill= $('#print_bill').val();
		//alert(msg);
		
		//alert(bill);
		if(x[0]=='Success')
		{
		if(bill==1) {
		var win=window.open("printbill.php?billnumber="+x[1]);
		}	
		//alert(bill);
		//return false;
		$('#message-box-success').modal('toggle');
		$("#appendmsg").empty();
	msg='<p><span class="fa fa-check">Billing  Sucessfully Added</span></p>';
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
		var tbody = $("#dataTables-example tbody");

		if (tbody.children().length == 0) {
    	//alert('Table Sholud not blank');
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

function get_amount111()
		{
			alert();
		var procedures1 = $('#procedures1').val();
		procedures1=procedures1.split('@#@#');
		procedures=procedures1[3];
		alert(procedures);
		$('#fees_icu').val(procedures);
		}
		function add()
		{
		$("#total").val("");
		var fees = $('#fees').val();
		var des = $('#des').val();
		//alert('');
		if(des =="")
		{
		$('#message-box-info').toggle();

		$("#appendinfo").empty();
	msg='<p><span class="fa fa-check">Description Should Not Blank !</span></p>';
	$("#appendinfo").append(msg);
			return false;
			}
		if(fees =="")
		{
		$('#message-box-info').toggle();
		$("#appendinfo").empty();
	msg='<p><span class="fa fa-check">Fees should not be blank !</span></p>';
	$("#appendinfo").append(msg);
	return false;
			}
			var txt = "<tr><td></td><td>"+des+"</td><td>"+fees+"</td><td><a href='#' onClick='delItem($(this))' class='btn btn-danger btn-condensed'><span class='fa fa-times'></span></a></td><td style='display:none'>0</td></tr>";
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
		url: "returnget.php",
		data: {ser:ser},
		success: function(msg) {
		var msg=$.trim(msg);
		//alert(msg);
		if(msg=='~~0+#0') {
		$('#message-box-info').toggle();
		$("#appendinfo").empty();
	msg='<p><span class="fa fa-check">Request Not Found !</span></p>';
	$("#appendinfo").append(msg);
		//alert('');
		$('#name').val('');
		$('#id').val('');
		
		return false;
		}
		else {
		var y=msg.split('+');
		var x=y[0].split('~');
		$('#name').val(x[1]);
		$('#id').val(x[0]);
		$('#old').val(x[2]);
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
		
		
		
		function add_procedures1(procedures1,procedure_no1,ref_no,consultant,fees_icu)
{
	if ($('#procedure_no1').val() == "") {
			alert('Enter the Procedure Days/Hours!');
			return false;
		}
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
				ref_no : ref_no,
				patient_id :'<?php echo $patientid; ?>',
				mrd_no : '<?php echo $inv_pat_id; ?>',
				},
			success: function(msg) {
				jQuery("#procedures1_list_div").html(msg);	
				$('#procedure_no1').val('');
			}
		});
}



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






