<?php
session_start();
$role=$_SESSION['role'];
date_default_timezone_set('Asia/Kolkata'); 
include("config_db1.php");
$cmd=mysql_query("select * from settings where role='$role'");
mysql_close($db1);
$sql=mysql_fetch_array($cmd);
$print_bill=$sql['billingip'];
$lab=$sql['labreports'];
if($sql['billingip'] !=1)
{
echo '<script>alert("You could not access this page");</script>';
//header('Location :home.php');
echo '<script>window.location.href="home.php"</script>';
exit();
}
$patientid = $_REQUEST['pid'];
include("config_db2.php");
			 $sql1 = "SELECT inv_pat_id FROM inv_patient WHERE patientid='$patientid' AND pat_ip_status = 0 LIMIT 1";
					$result = mysql_query($sql1);
					$inv_pat_id ='';
					if(mysql_num_rows($result) != 0){
						$rs = mysql_fetch_array($result);
						$inv_pat_id = $rs['inv_pat_id'];
					}
?>
<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>        
        <!-- META SECTION -->
        <title>DPP-Billing Ip</title>            
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
                            <input type="text" name="ser" id="ser"  onBlur="get()" placeholder="Search Patient for billing..." value ="<?php echo $_REQUEST['pid']; ?>"/>
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
		$sqlx = mysql_query("SELECT patientid,patientsalutation,patientname,contactno,address FROM patientdetails WHERE hold = 10");
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
                    <li><a href="#">Billing Ip</a></li>
                    
                </ul>
                <!-- END BREADCRUMB -->
                
                <!-- PAGE TITLE -->
                <div class="page-title">                    
                    <h2><span class="fa fa-arrow-circle-o-left"></span>Billing IP</h2>
					
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
                                                <input type="text"  style="font-weight:bold; color:#000;" readonly class="form-control" name="pat_id" id="pat_id"/>
                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
											    
                                   
                                                     <div class="col-md-4">
                                            <label class="col-md-3 control-label">Pat Name:</label>  
                                            <div class="col-md-9">
                                                <input type="text" style="font-weight:bold; color:#000;" readonly class="form-control" name="part_name" id="part_name"/>
                                                  <span class="help-block"></span>  
												</div>                                        
												   </div>       
                       
										 <div class="col-md-4">
                                            <label class="col-md-3 control-label">Date</label>  
                                            <div class="col-md-9">
                                                <input type="text" style="font-weight:bold; color:#000;" readonly class="form-control" value="<?php echo date("d/m/Y"); ?>" name="date"/>
                                               <span class="help-block"></span> 
												</div>                                        
												   </div>
										</div>	
                                        <div class="form-group">
										 <div class="col-md-4">
                                            <label class="col-md-3 control-label">Pat. IP ID:</label>  
                                            <div class="col-md-9">
                                                <input type="text"  style="font-weight:bold; color:#000;" readonly class="form-control" name="ip_id" id="ip_id"/>
                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
                                                    <div class="col-md-8">
                                            <label class="col-md-3 control-label"></label>  
                                            <div class="col-md-12">
                                                <span class="help-block"></span> 
												</div>                                        
												   </div> <div class="col-md-8">
                                            <label class="col-md-3 control-label"></label>  
                                            <div class="col-md-12">
                                                <span class="help-block"></span> 
												</div>                                        
												   </div> <div class="col-md-8">
                                            <label class="col-md-3 control-label"></label>  
                                            <div class="col-md-12">
                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
                                                    <div class="col-md-5">
                                            <label class="col-md-3 control-label"></label>  
                                            <div class="col-md-12">
                                                <span class="help-block"></span> 
												</div>                                        
												   </div> <div class="col-md-4">
                                            <label class="col-md-3 control-label"></label>  
                                            <div class="col-md-9" align="right">
                    <input name="advance" id="advance" value="Advance" class="btn btn-danger btn-block" autofocus onFocus="" onClick="javascript:adjst_window()" type="button">
                                               <span class="help-block"></span> 
												</div>                                        
												   </div> 
                                                   </div>
												   
                                        <hr>
										
                     <div class="form-group">
										 <div class="col-md-2">
                                            <label class="col-md-7 control-label">Procedures:</label>  
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
					$cmd_ser = "select id,type_name,amounts from type_creation";
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
                <a href="#"  onClick="add_sitting(type_name.value,sitting.value,'');return false;" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-plus"></span></a>         </div>   

										</div>
                                         <div class="form-group">
                
            <div class="col-md-6">
				<center>
					
                        <div id="sitting_list_div">
                        

                        </div>
				</center>
			</div>
        </div></div>
                                        <div class="form-group">
                                        <div class="col-md-12">
                                        <div class="col-md-9">
                                        <h3>Lab Details</h3>
										<div class="form-group">
                                        
										 <div class="col-md-8"><div class="col-md-12">
                                            <div class="col-md-5">
                                              <select name="lab_detail" id="lab_detail" onChange="get_display_lab_det()" class="select" style="font-weight:bold;width:160px;">
													 <option value="0">Select Lab</option>
                                                         <?php
					include("config_db1.php");
					$cmd_inves_list_query = mysql_query("select id,title from investigation");
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
                                           <a href="#" onClick="add_lab_sublist(lab_detail.value,lab_full_det.value,pat_id.value,fees1.value),get_total_amt(pat_id.value);return false;" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-plus"></span></a>                                   
												   </div>
                                                  
                                                    </div> </div>
                                                    
                                                    <div class="col-md-4">
                                                    <div class="col-md-12" align="right">
                                                    <h3>Advance</h3> 
                                                    </div></div>
                                                    
                                                    </div>
                                                     </div>
                                                <div class="col-md-2">
										<div class="form-group">   
                                           <label class="col-md-1 control-label"></label>  
                                           <label class="col-md-2 control-label"></label>  
                                           <label class="col-md-3 control-label"></label>  
<div id="addadvance"  class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Add Advance</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="panel-body">                    
						
                            <!-- START JQUERY VALIDATION PLUGIN -->
                           <?php  date_default_timezone_set('Asia/Kolkata');   ?>
                                    <form id="jvalidate" role="form" class="form-horizontal">
                            
                                    <h5 >&nbsp;&nbsp;&nbsp;</h5>
                                        <div class="form-group">
										<div class="col-md-8">
                                            <label class="col-md-4 control-label"  >Description:</label>  
                                            <div class="col-md-8"  >
											<div class="input-group">
												<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
												 <input type="text"  class="form-control" name="description" id="description" />
											</div>
                                
                                                  <span class="help-block"></span>  
												</div>                                        
												   </div> 
										 <div class="col-md-4" align="left">
                                     <label class="col-md-6 control-label"  >Advance Amount:</label>  
                                            <div class="col-md-6" >
											<div class="input-group">
												<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
												 <input type="text"  class="form-control" name="adv_amt" id="adv_amt" />
											</div>
                                             

                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
											   
                                   
                                                           
                       
										</div>

                                        <div class="form-group">
                                        										 <div class="col-md-3" align="center">
</div>
										 <div class="col-md-5" align="center">
                                         								<input type="submit" class="btn btn-info btn-block" style="width:100px;" name="submit" id="submit"  onClick="add_advance();return false;" value="Add &amp; Pay"/>

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
                                         </div></div></div>
</div>
                                        
<div class="form-group">
            <div class="col-md-8">
				<center>
                <div id="lab_sublist_list_div" align="center">
					<table id="fees_id" class="table table-striped table-bordered table-hover">
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
            <div class="col-md-4">
				<center>
                <div id="advance_sub_list_div" align="center">
					<table id="advance_id" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th>Advance Amount</th>
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
                      <div class="form-group">
                                                              <label class="col-md-1 control-label"><h3>Service:</h3></label>  
                                           <label class="col-md-5 control-label"><h3>&nbsp;&nbsp;&nbsp;Procedure:</h3></label>  

                   
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
                <a href="#"  onClick="add_servicess(service2.value,service_no2.value,pat_id.value,ip_id.value);return false;" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-plus"></span></a>         </div> 
                </div></div>
                
          <div class="col-md-8"><div class="col-md-12">
            <div class="col-md-4">
                        <select name="procedures2" id="procedures2" class="select" style="font-weight:bold;" >
                        <option>select</option>
                    <?php 
					include("config_db1.php");
					$cmd_ser = "select id,procedure_name,ptypes,pamount from procedure_creation";
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
                 <input type="text" style="font-weight:bold"  class="form-control" name="procedure_no2" id="procedure_no2" value="<?php echo $time;?>"/>             
            </div> 
          <div class="col-md-4">
                                  <select name="consultantname2" id="consultantname2" class="select" style="font-weight:bold;">
                                  <option>select</option>
                    <?php 
					include("config_db1.php");
					$cmd_ser = "select id,doctor_name from doctor_creation";
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
            <div class="col-md-1">
                <a href="#"  onClick="add_proceduress(procedures2.value,procedure_no2.value,consultantname2.value,fees_amount2.value,pat_id.value,ip_id.value);return false;" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-plus"></span></a>       </div>   
 </div>
 </div></div>                         
                                        
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
            <div class="col-md-7">
				<center>
                <div id="procedure_billing_list_div">
					<table id="procedures_ids_div" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Procedure</th>
                        <th>Timing</th>
                       <th>Consultant</th>
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
		<div class="form-group">
            <div class="col-md-4">
                <label class="col-md-6 control-label">Depart:</label>  
                <div class="col-md-1">
                        <select name="depart2" id="depart2" class="select" style="font-weight:bold;width:160px;"  onChange="get_depart_det()">
                        <option>select</option>
                  <?php 
				  include("config_db1.php");
					$cmd_ser = "select id,department_names from department_creation order by department_names asc";
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
                        <select name="consultant2" id="consultant2" class="select" style="font-weight:bold;width:160px;">
                        <option>select</option>
                     <?php 
					 include("config_db1.php");
					$cmd_ser = "select id,doctor_name from doctor_creation order by doctor_name asc";
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
					$cmd_ser = "select id,visit_name,vtypes,vamount from visit_creation";
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
                <a href="#"  onClick="add_consulting_details2(depart2.value,consultant2.value,visit2.value,'');return false;" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-plus"></span></a>            </div>    
				 <?php } ?>                                
		</div>	
<!-- 5 ROW END  -->   <div class="form-group">
            <div class="col-md-10">
				<center>
                <div id="consultant2_list_div">
					
                    </div>
				</center>
			</div>
		</div>
                                      <hr>
									   	
										<div class="col-md-12">
										 <div id="room_sublist_div">
                        </div>

</div>	                                  
                                        
                                         
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
                        <table id="decription_ids" class="table table-striped table-bordered table-hover" width="75%">
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
										                                       
                                        <div id="total_div">
										<div class="col-md-4">
                                            <label class="col-md-5 control-label">Amount in Advance:</label>  
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" value="0" name="adv_amt" id="adv_amt" readonly />
                                                
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
										</div> 
										<div class="col-md-4">
                                            <label class="col-md-5 control-label">Old Balance:</label>  
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" value="0" name="old" id="old" readonly />
                                                
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
										</div> 
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
                                                <input type="text" class="form-control"  onBlur="cal()" name="pay" id="pay" />
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
												   </div>  
												   
												   
												   <div class="col-md-4">
                                            <label class="col-md-5 control-label">Remaining Balance:</label>  
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" value="0" name="bal" id="bal" readonly />
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
												   </div> 
												    <div class="col-md-4">
                                            <label class="col-md-5 control-label">Remaining Advance:</label>  
                                            <div class="col-md-4">
                                                <input type="text" class="form-control" value="0" name="adv_remain" id="adv_remain" readonly />
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
												   </div>

												   </div> 
                                                    
	<?php 		 $billnumber= abs(date-time(yyyyMMddHHmmss));
	

?>      											   
												     
	 					<input type="hidden" class="form-control" value="<?php echo $billnumber;?>" name="bill_number" id="bill_number"/>
						    
<script>
function contactform(url)
{
		//window.open ('/dpp_2/printbillip.php?patient_id='+pat_id.value+'&bill_number='+bill_number.value);
}
</script>											     
												     
                
                                                                                                                            
                                        <div class="btn-group pull-right">
                                         <!--   <button class="btn btn-primary" type="button" onClick="print_bill()">Print</button>-->
                                           <div class="col-md-4"> <a class="btn btn-primary btn-default  btn-condensed btn-sm pull-left" onClick="save();return false;" target="_blank" >Pay</a></div>
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
        <!-- Modal -->
<div id="confirm_infomsg" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Message</h4>
      </div>
      <div class="modal-body">
        <p class='infomsg'>Do you want to continue?</p>
      </div>
      <div class="modal-footer">
         <button type="button" data-dismiss="modal" class="btn btn-primary" data-value="1">Close</button>
    
      </div>
    </div>

  </div>
</div>

        <!-- MESSAGE BOX-->
		<div class="message-box message-box-success animated modal" id="message-box-success" role="dialog">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-check"></span> Success</div>
                    <div class="mb-content">
                        <div id="appendmsg">
						</div>
                    </div>
                    <div class="mb-footer">
                        <a href="billing_ip.php" class="btn btn-default btn-lg pull-right" >Close</a>
                    </div>
                </div>
            </div>
        </div>
		
		<div class="message-box message-box-danger animated fadeIn modal fade" id="message-box-error" role="dialog">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-times"></span> Error</div>
                    <div class="mb-content">
                        <div id="appenderror">
						</div>
                    </div>
                    <div class="mb-footer">
                        <button class="btn btn-default btn-lg pull-right mb-control-close" data-dismiss="modal">Close</button>
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
		function add_sitting(type_name,sitting,ref_no)
{
	var pat_id = $('#pat_id').val();
		if (pat_id == "") {
			alert('Select Patient');
			return false;
		}
	
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
				patient_id :$('#pat_id').val(),
				mrd_no : $('#ip_id').val(),
				insert_from: 'Billing',
				req_from:'Billing',
				},
			success: function(msg) {
				
				jQuery("#sitting_list_div").html(msg);	
				get_total_amt(pat_id);
				
			}
		});
}
function delete_sitting(id,ref_no)
{
	var pat_id = $('#pat_id').val();
		$.ajax({
			type: "post",
			url: "deletesitting.php", 
			data: {
				id : id,ref_no : ref_no,patient_id :$('#pat_id').val(),
				mrd_no : $('#ip_id').val(),req_from:'Billing',},
			success: function(msg) {
				get_total_amt(pat_id);
				jQuery("#sitting_list_div").html(msg);
			}
		});
}
function get_sitting_list()
{
	var pat_id = $('#pat_id').val();
		$.ajax({
			type: "post",
			url: "listsittingbill.php", 
			data: {
				patient_id :$('#pat_id').val(),
				mrd_no : $('#ip_id').val(),req_from:'Billing',action:'list',},
			success: function(msg) {
				//get_total_amt(pat_id);
				jQuery("#sitting_list_div").html(msg);
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
		
		function removebtn() {
	$('#message-box-info').toggle();
	}
	
	function reload_div()
	{
		$.ajax({
			type: "post",
			url: "billing_advance_list.php", 
			data: {
				pat_id : $("#pat_id").val(),
				ip_no  : $("#ip_id").val(),
				},
			success: function(msg) {
				//$("#total_div").load(location.href + " #total_div");
					jQuery("#advance_sub_list_div").html(msg);
			}
		});
		//$("#advance_sub_list_div").load(location.href + " #advance_sub_list_div");
		}
	function delete_services2(serviceid,chart_ot,ref_no,consultant2,fees_amount2)
{
		$.ajax({
			type: "post",
			url: "delservice_billing.php", 
			data: {
				serviceid : serviceid,chart_ot : chart_ot,ref_no : ref_no,
				patient_id :$('#pat_id').val(),
				ip_no : $('#ip_id').val(),
				},
			success: function(msg) {
				jQuery("#service2_list_div").html(msg);
				get_total_amt($('#pat_id').val());
			}
		});
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
		$("#decription_ids > tbody").append(msg);
		
			var i=1;
			var sum=0;
			$( "#decription_ids tbody tr" ).each( function(){
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
		
		function print_bill_preview(){
			var pat_id = $('#pat_id').val();
			var bill= $('#print_bill').val();
			if(pat_id == ''){
				alert('Select Patient');
				return false;
			}else{
				if(bill==1) {
					var win=window.open('printbillintip.php?patient_id='+pat_id);
				}
			}
		}
		
	function save()
		{
			
			
		var pat_id = $('#pat_id').val();
		if (pat_id == "") {
			alert('Select IP Patient');
			return false;
		}
		var total_adv_amt = $('#total_adv_amt').val();
		var old = $('#old').val();
		var total = $('#total').val();
		var pay = $('#pay').val();
		var name = $('#part_name').val();
		var id= $('#pat_id').val();
		var bal = $('#bal').val();
		var adv_remain = $('#adv_remain').val();
		var bill_number = $('#bill_number').val();
		var return_adv ='';
		var tbody = $("#sitting_list_div #dataTables-example tbody,#fees_id tbody,#services_ids tbody,#procedures_ids_div tbody,#consultant2_list_div #dataTables-example tbody,#room_decription_ids tbody,#decription_ids tbody");
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
		if($('#return_adv').is( ":checked" ))
			var return_adv = 'return';
		
	
	//var table = $("#decription_ids");
    var asset = [];
    //table.find('tbody > tr').each(function (rowIndex, r) {
      //  var cols = [];
        //$(this).find('td').each(function (colIndex, c) {
          //  cols.push(c.textContent);
        //});
        //asset.push(cols);
    //}); 

	
		$.ajax({
		type: "POST",
		url: "save_ipbill.php",
		data: { assets: asset,
		pay:pay,
		total:total,
		id:id,
		bal:bal,
		adv_remain:adv_remain,
		total_adv_amt:total_adv_amt,
		old:old,
		return_adv:return_adv,
		bill_number:bill_number,
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
		var win=window.open("printbillip.php?bill_number="+x[1]+"&patient_id="+id);
		}	
		//alert(bill);
		//return false;
		//$('#message-box-success').modal('toggle');
		//$("#appendmsg").empty();
		if(bill==1) {
			msg='<p><span class="fa fa-check">Bill No:<a href="printbillip.php?bill_number='+x[1]+'&patient_id='+id+'" target="_blank">'+x[1]+'</a> Generated</span></p>';
		}else{
			msg='<p><span class="fa fa-check">Bill Generated.</span></p>';
		}
		
		//$("#appendmsg").append(msg);
	
	//$('#message-box-update').toggle();
	}
	
	else
		{
	//$("#appenderror").empty();
	msg='<p><span class="fa fa-check">Error Occured During Billing Try again !</span></p>';
	//$("#appenderror").append(msg);
	//$('#message-box-error').toggle();
	//alert('Error Occured During Billing Try again !');
	
	}
			$("#confirm_infomsg .infomsg").empty();
			$("#confirm_infomsg .infomsg").append(msg);
				$('#confirm_infomsg')
				.modal({ backdrop: 'static', keyboard: false })
				.one('click', '[data-value]', function (e) {
				if($(this).data('value')) {
					window.location.href=window.location.href;
					}
		});
		//window.location.reload();
		
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
		 $( "#decription_ids tbody tr" ).each( function(){
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
		//var tbody = $("#decription_ids tbody");

		//if (tbody.children().length == 0) {
		//$('#pay').val("");
		//return false;
		//}
		var adv_amt = $('#total_adv_amt').val();
		var old = $('#old').val();
		var total = $('#total').val();
		var pay = $('#pay').val();
		var bal = $('#bal').val();
		var adv_remain = $('#adv_remain').val();
		//alert(adv_amt);
		if(Number(roundToTwo(total)) <= Number(roundToTwo(adv_amt))){
			$('#pay').val(0);
			$('#bal').val(0);
		}
		if(Number(adv_amt) < Number(total)){
			var actual_pay = Number(total)-Number(adv_amt);
			//alert(total);
			
			if(Number(roundToTwo(pay)) > Number(roundToTwo(actual_pay))){
				alert('Payment should not exceed Actual Payable-Amount(Total-Advance)');
				$('#pay').val(roundToTwo(actual_pay));
				return false;
			}
			if(Number(roundToTwo(pay)) < Number(roundToTwo(actual_pay))){
				var remain_bal = Number(actual_pay)-Number(pay);
				$('#bal').val(roundToTwo(remain_bal));
				
			}
			
		}
		return true;
		
			
		}
function add_servicess(service2,service_no2,pat_id,ip_no)
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
			data: {
				service_no : service_no2,
				service : service2,
				pat_id : pat_id,
				mrd_no : ip_no,
				},
			success: function(msg) {
				jQuery("#service2_list_div").html(msg);	
				get_total_amt(pat_id);
				//$('#service_no2').val('');
				//$('#service2').val('');
			}

		});
}	


function delete_procedures2(procedureid,chart_ot,ref_no)
{
		$.ajax({
			type: "post",
			url: "deleteprocedurebilling.php", 
			data: {
				procedureid : procedureid,
				chart_ot : chart_ot,
				ref_no : ref_no,
				patient_id :$('#pat_id').val(),
				ip_no :$('#ip_id').val(),
				},
			success: function(msg) {
				jQuery("#procedure_billing_list_div").html(msg);
				get_total_amt($('#pat_id').val());
			}
		});
}

	
function add_proceduress(procedures2,procedure_no2,consultant2,fees_amount2,pat_id,ip_no)
{
	var pat_id = $('#pat_id').val();
		if (pat_id == "") {
			alert('Select Patient');
			return false;
		}
	if ($('#procedure_no2').val() == "") {
			alert('Enter the Procedure Days/Hours!');
			return false;
		}
		$.ajax({
			type: "post",
			url: "addprocedurebilling.php", 
			data: {
				procedure_no : procedure_no2,
				procedures : procedures2,
				consultant : consultant2,
				fees_amount : fees_amount2,
				patient_id :pat_id,
				mrd_no : ip_no,
				},
			success: function(msg) {
				console.log(msg);
			jQuery("#procedure_billing_list_div").html(msg);	
			get_total_amt(pat_id);
			//$('#procedures2').val('');
			//$('#consultant2').val('');
			//$('#fees_amount2').val('');
			}
		});
}		
function get_total_amt(id)
{
		$.ajax({
			type: "post",
			url: "billing_iptotal.php", 
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
			url: "billing_iptotal.php", 
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
			url: "billing_iplist.php", 
			data: {
				pat_id : ser,
				},
			success: function(msg) {
				jQuery("#fees_sublist_div").html(msg);	
			}
		});
	
	}
	function get_adv_list()
	{
		var ser = $('#ser').val();
				ser=$.trim(ser);
				ser=ser.split('-');
				ser=ser[0];
				ip_no=ser[3];
				$.ajax({
			type: "post",
			url: "billing_advance_list.php", 
			data: {
				pat_id : ser,
				ip_no  : ip_no,
				},
			success: function(msg) {
				jQuery("#advance_sub_list_div").html(msg);	
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
	function get_procedure_details()
	{
		var ser = $('#ser').val();
				ser=$.trim(ser);
				ser=ser.split('-');
				ser=ser[0];
				ip_no=ser[3];
				$.ajax({
			type: "post",
			url: "billing_procedure_list.php", 
			data: {
				pat_id : ser,
				ip_no  : ip_no,
				},
			success: function(msg) {
				jQuery("#procedure_billing_list_div").html(msg);	
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
			url: "billing_iplist.php", 
			data: {
				pat_id : ser,
				
				},
			success: function(msg) {
				jQuery("#fees_sublist_div").html(msg);	
			}
		});
	
	
		}
		
		function get_lab_details_billing()
	{
	$.ajax({
			type: "post",
			url: "add_lab_detailsip.php", 
			data: {
				
				patient_id : $('#pat_id').val(),
				action:'list',
				},
			success: function(msg) {
				//alert($('#pat_id').val());
				jQuery("#lab_sublist_list_div").html(msg);	
				//get_total_amt(patient_id);
			}
		});
	
	
		}
		
		

function add_fees_sublist(id,name,ip_id,des,fees)
{
	//alert(id);alert(name);alert(ip_id);alert(des);alert(fees);
	var pat_id = $('#pat_id').val();
		if (pat_id == "") {
			alert('Select Patient');
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
			url: "add_fees_ip.php", 
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
			url: "del_feesip.php", 
			data: {
				id : id,patient_id : patient_id,},
			success: function(msg) {
				//console.log(msg);
					jQuery("#fees_sublist_div").html(msg);	
				get_total_amt(patient_id);
				$('#des').val('');
				$('#fees').val('');
			}
		});
}
	function delete_advance(id,patient_id,ip_no)
	{
				$.ajax({
			type: "post",
			url: "delete_advance.php", 
			data: {
				id : id,
				patient_id : patient_id,
				ip_no : ip_no,
				
				},
			success: function(msg) {
				jQuery("#advance_sub_list_div").html(msg);
				get_total_amt(patient_id);


			}		});
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
				
				$("#oldtable > tbody").html("");
				$("#decription_ids > tbody").html("");
				var ser = $('#ser').val();
				ser=$.trim(ser);
				ser=ser.split('-');
				ser=ser[0];
				if(ser =="")
				return false;
			//alert(ser);
			$.ajax({
		type: "POST",
		url: "return_ipget.php",
		data: {ser:ser},
		success: function(msg) {
		var msg=$.trim(msg);
		//alert(msg);
		if(msg=='~~0+#0' || msg=='~~~0+#0' || msg=='~~~0~+#0') {
		$('#message-box-info').toggle();
		$("#appendinfo").empty();
	msg='<p><span class="fa fa-check">Request Not Found !</span></p>';
	$("#appendinfo").append(msg);
		//alert('');
		$('#part_name').val('');
		$('#pat_id').val('');
		
		return false;
		}
		else {
		var y=msg.split('+');
		var x=y[0].split('~');
		$('#part_name').val(x[1]);
		$('#pat_id').val(x[0]);
		$('#ip_id').val(x[2]);
		if(x[4]=='Discharge'){
				$('#advance').hide();
		}else{
			$('#advance').show();
		}
		//$('#old').val(x[3]);
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
		
		get_details();get_sum_total();get_service_details();get_procedure_details();get_lab_details_billing();get_advance_list();get_consulting_details_list();get_room_details_list();get_sitting_list();get_total_amt($('#pat_id').val());
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
		url: "return_billing.php",
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
function adjst_window(url)
     {
		 var pat_id = $('#pat_id').val();
		if (pat_id == "") {
			alert('Select Patient');
			return false;
		}
		 $('#addadvance').modal('show');
	//new_popup= window.open(url,'new_popup','height=250,width=1000,scrollbars=no,resizable=no,left=50,top=50,toolbar=no,location=no,directories=no,status=no');
     }  
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
		
		
		function get_service_amount()
{
	var service2=$('#service2').val();
			$.ajax({
		type: "POST",
		url: "get_service_amount.php",
		data: {
			service2:service2,
		},
		success: function(msg) {
			$("#service_no2").val(msg);
			
			 }
		});
		}
		
		
		
function add_lab_sublist(lab_det,lab_full_det,patient_id,fees)
{
		var pat_id = $('#pat_id').val();
		if (pat_id == "") {
			alert('Select Patient');
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
		

		$.ajax({
			type: "post",
			url: "add_lab_detailsip.php", 
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
function delete_iplabpatient_details(id,sample_no,patient_id)
{
	//alert(id);
	//alert(patient_id);
		$.ajax({
			type: "post",
			url: "add_lab_detailsip.php", 
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
			url: "del_lab_detailsip.php", 
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


function delete_advance_ip(id){
	$.ajax({
        type: "POST",
		url: "advance_db.php",
		data: {
				id:id,
				patient_id :$('#pat_id').val(),
				action:'del_advance',
				},
				success: function(msg){
			//console.log(msg);
			jQuery("#advance_sub_list_div").html(msg);
			get_total_amt($('#pat_id').val());
			
		
		}
			});
}

function add_advance(){
		if ($('#adv_amt').val() == "") {
			alert('Enter amount');
			return false;
		}
		if ($('#description').val() == "") {
			alert('Enter Description!!!');
			return false;
		}
		$.ajax({
        type: "POST",
		url: "advance_db.php",
		data: {
				adv_amt : $('#adv_amt').val(),
				description : $('#description').val(),
				patient_name : $('#part_name').val(),
				patient_id :$('#pat_id').val(),
				ip_no : $('#ip_id').val(),
				insert_from: 'Billing',
				req_from:'Billing',
				action:'add_advance',
				},
				success: function(msg){
			console.log(msg);
			var msg=$.trim(msg);
			var x=msg.split("~");
			var bill= $('#print_bill').val();
			if(x[0]=='Success'){
				if(bill==1) {
				var win=window.open('printadvancebill.php?patient_id='+$('#pat_id').val()+'&bill_number='+x[1]);
				}	
				//alert(bill);
				//return false;
				
			alert('Advance  Added');
			//$('#message-box-update').toggle();
			get_total_amt($('#pat_id').val());
			$('#addadvance').modal('hide');
			get_advance_list();
			}
			
			else
				{
			
			alert('Error Occured During Billing Try again !');
			}
			//jQuery("#advance_sub_list_div").html(msg);
			
		
		}
			});
       }
	   function get_advance_list(){
		
		$.ajax({
        type: "POST",
		url: "advance_db.php",
		data: {
				patient_id :$('#pat_id').val(),
				ip_no : $('#ip_id').val(),
				insert_from: 'Billing',
				req_from:'Billing',
				action:'list',
				},
				success: function(msg){
						
			jQuery("#advance_sub_list_div").html(msg);
			//get_total_amt($('#pat_id').val());
			//$('#addadvance').modal('hide');
		
		}
			});
       }
	    function get_room_details_list()
		{
			//alert($('#pat_id').val());
		$.ajax({
			type: "post",
			url: "billingroomdetail.php", 
			data: {
				pid : $('#pat_id').val(),
				action:'list',
				
				},
			success: function(msg) {
				//console.log(msg);
				jQuery("#room_sublist_div").html(msg);	
				//$('#depart2').val('');
				//$('#consultant2').val('');
				//$('#visit2').val('');
				//get_total_amt($('#pat_id').val());
			}
		});

}
	   function get_consulting_details_list()
		{
			//alert($('#pat_id').val());
		$.ajax({
			type: "post",
			url: "billingconsultantdetail.php", 
			data: {
				pid : $('#pat_id').val(),
				action:'list',
				
				},
			success: function(msg) {
				//console.log(msg);
				jQuery("#consultant2_list_div").html(msg);	
				//$('#depart2').val('');
				//$('#consultant2').val('');
				//$('#visit2').val('');
				//get_total_amt($('#pat_id').val());
			}
		});

}
	   function add_consulting_details2(depart2,consultant2,visit2,ref_no)
		{
			var pat_id = $('#pat_id').val();
		if (pat_id == "") {
			alert('Select Patient');
			return false;
		}
			
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
			url: "billingconsultantdetail.php", 
			data: {
				depart : depart2,
				consultant :consultant2,
				visit : visit2,
				ref_no : ref_no,
				pid : $('#pat_id').val(),
				action:'add',
				
				},
			success: function(msg) {
				//console.log(msg);
				jQuery("#consultant2_list_div").html(msg);	
				//$('#depart2').val('');
				//$('#consultant2').val('');
				//$('#visit2').val('');
				get_total_amt($('#pat_id').val());
			}
		});

}

function delete_consultants2(delete_id,chart_ot,ref_no)
{
	
		$.ajax({
			type: "post",
			url: "billingconsultantdetail.php", 
			data: {
				delete_id : delete_id,chart_ot : chart_ot,ref_no : ref_no,
				pid : $('#pat_id').val(),
				action : 'delete',
				},
			success: function(msg) {
				jQuery("#consultant2_list_div").html(msg);
				get_total_amt($('#pat_id').val());
			}
		});
}

//Call all function on first load using PID and search have value
if($('#ser').val()){
get();
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
function roundToTwo(num) {    
    return +(Math.round(num + "e+2")  + "e-2");
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
		 $('#pay,#fees,#fees1,#fees_amount2').keypress(function(event) {

			 if(event.which == 8 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46) 
				  return true;

			 else if((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57))
				  event.preventDefault();

		});
})
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






