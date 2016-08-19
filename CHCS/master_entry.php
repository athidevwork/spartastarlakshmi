<?php
session_start();
$role=$_SESSION['role'];
//$pid=$_REQUEST['pid'];
 include("config_db1.php");
 $cmd=mysql_query("select * from settings where role='$role'");
 mysql_close($db1);
$sql=mysql_fetch_array($cmd);

$lab=$sql['masterentry'];
if($sql['masterentry'] !=1)
{
echo '<script>alert("You could not access this page");</script>';
exit();
}

 date_default_timezone_set('Asia/Kolkata'); 

?>
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from aqvatarius.com/themes/atlant/html/pages-edit-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2015 09:47:47 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>        
        <!-- META SECTION -->
        <title>DPP- Master Entry</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->
		<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
		<link rel="stylesheet" href="css/fontawesome/font-awesome.min.css">
		<link href="css/editor.css" type="text/css" rel="stylesheet"/>
        <link rel="stylesheet" type="text/css" href="css/cropper/cropper.min.css"/>
        <!--  EOF CSS INCLUDE -->        
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->   
		
		<style>
		.ui-autocomplete {
  z-index:2147483647;
}</style> 

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
                                        <li class="active">
                                        <a href="#tab-first" role="tab" data-toggle="tab">Modify Table</a></li>
                                        <li><a href="#tab-second" role="tab" data-toggle="tab">Manage Users</a></li>
										<li><a href="#tab-third" role="tab" data-toggle="tab">User Settings</a></li> 
										<li><a href="#tab-four" role="tab" data-toggle="tab">Branch</a></li>
                                        <li><a href="#tab-five" role="tab" data-toggle="tab">Ward</a></li>
                                        <li><a href="#tab-six" role="tab" data-toggle="tab">Room No</a></li>
                                        <li><a href="#tab-seven" role="tab" data-toggle="tab">Service</a></li>
                                        <li><a href="#tab-eight" role="tab" data-toggle="tab">Procedure</a></li>
                                        <li><a href="#tab-nine" role="tab" data-toggle="tab">Visit</a></li>
                                       <li><a href="#tab-fourteen" role="tab" data-toggle="tab">Type Creation</a></li>
										<li><a href="#tab-ten" role="tab" data-toggle="tab">Print</a></li>
										<li><a href="#tab-eleven" role="tab" data-toggle="tab">Lab</a></li> 
                                        <li><a href="#tab-twelve" role="tab" data-toggle="tab">Department</a></li>
                                        <li><a href="#tab-thirteen" role="tab" data-toggle="tab">Doctor</a></li>   
                                    </ul>
                                    <div class="panel-body tab-content">
                                        <div class="tab-pane active" id="tab-first">
										<div class="row">
																				
		
 
			 <div class="col-lg-12">
                  <div class="form-group">
				    <div class="col-lg-6">
					<select name="sel_table"  class="form-control select" id="sel_table">
											<option value="1">Select</option>
											 <optgroup label="Symptoms">
											<option value="2">Psychiatric Symptoms</option>
											<option value="3">Other Symptoms</option>
											</optgroup>
											<optgroup label="Medical History">
											<option value="4">Family / Others History</option>
											</optgroup>
										</select>
											<span class="help-block">Select Table to Modify</span>  
					
					</div>
					   <div class="col-lg-6">
					    <select name="sel_content" id="sel_content"  class="form-control select" style="width:250px">
													  <option></option>
													</select>
														<span class="help-block">Current Text</span>
					
					</div>
					</div>
					<br><br><br><br>
					</div>
					
					 <div class="col-lg-12">
                  <div class="form-group">
				    <div class="col-lg-6">
					 <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="newtxt" placeholder="Text to Update" id="newtxt" class="form-control"/>
                                                    </div>                                            
                                                    <span class="help-block">Text to Update</span> 
					
					</div>
					</div>
					<br><br><br><br>
					</div>
										
										
										
									 <div class="col-lg-12">
                  <div class="form-group">
				    <div class="col-lg-2">
								
								 <a href="#" onClick="update()" class="btn btn-primary pull-left"><span class="fa fa-floppy-o fa-right"></span>Save Changes</a>     </div>
								 	 <div class="col-lg-2">
									  			
                                    <a href="#" onClick="del()" class="btn btn-primary pull-left">Delete </a>
						    							
									</div>		
									</div>	</div>	



									   
                                        </div>
										 </div>
										                                                                       
                                       
                                    
										<div class="tab-pane" id="tab-second">
										<div class="row">
                                        
                                        <div class="col-md-6">
                                            
                                            
                                            
                                            <div class="form-group">
                                               
                                                <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="user_real_name" placeholder="Name" id="user_real_name" class="form-control"/>
                                                    </div>                                            
                                                    <span class="help-block">Enter Name</span>
                                            </div>
                                            <div class="form-group">
                                               
                                                <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="username" placeholder="User Name" id="username" class="form-control"/>
                                                    </div>                                            
                                                    <span class="help-block">Enter User Name</span>
                                            </div>
                                            
											<div class="form-group">
                                               
                                                <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="password" placeholder="Password" id="password" class="form-control"/>
														 <input type="hidden" name="id" placeholder="Password" id="id" class="form-control"/>
                                                    </div>                                            
                                                    <span class="help-block">Enter Password</span>
                                            </div>
											  <div class="form-group">
                                               
                                                                                                                                                                                        
                                              <select name="role" id="role" class="form-control select" style="width:200px;">
											<option selected="selected" value="2">Users</option>
											<option value="1">Admin</option>
<option value="4">Cashier</option>
<option value="5">Ward</option>
<option value="6">ICU</option>
<option value="7">OT</option>
<option value="8">ER</option>
											<?php if($lab==1) { ?>
											<option value="3">Lab</option>
											<?php } ?>
											</select>
												 <span class="help-block">Select Role</span>								
                                       
                                            </div>
											 <br>
                                            <div class="col-md-2" id="addus">
<a href="#" class="btn btn-primary pull-left" onClick="adduser();return false;">Add <span class="fa fa-plus fa-right"></span></a>                                 </div>
	    <div class="col-md-2" style="display:none" id="editus">                                                     
<a href="#" class="btn btn-primary pull-left" onClick="saveuser();return false;">Save Changes <span class="fa fa-floppy-o fa-right"></span></a>
</div> 
                                        </div>
										
										<!--<input type="button" onClick="f()">-->
										
                                        <div class="col-md-6">
                                             <div id="usertable">
                                            <table id="user" class="table table-striped table-bordered table-hover" >
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Username</th>
					  <th>Role</th>
						<th style="display:none">id</th>
						<th>Name</th>
						 <th>Action</th>
                    </tr>
					
                  </thead>
				  <tbody>
				  
				  <?php 
					include("config_db1.php");
					$cmd = "select username,role,id,name from user_login order by username asc";
					$i=1;
			$res = mysql_query($cmd);
			while($rs = mysql_fetch_array($res)){
			if($rs['role']==1)
			$role="Admin";
			
			if($rs['role']==2)
			$role="User";
			if($rs['role']==3)
			$role="Lab";

if($rs['role']==4)
			$role="Cashier";
if($rs['role']==5)
			$role="Ward";
if($rs['role']==6)
			$role="ICU";
if($rs['role']==7)
			$role="OT";
if($rs['role']==8)
			$role="ER";
						echo '<tr>
						<td> '.$i++.' </td>
						<td>'.$rs['username'].'</td>
						<td>'.$role.'</td>
						<td style="display:none;">'.$rs['id'].'</td>
						<td style="">'.$rs['name'].'</td>
						<td><a href="javascript:return false;" name="editimg" onClick="edit_user(this);return false;"  class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-pencil"></span></a>&nbsp;&nbsp;
						<a href="javascript:delete_id(\''.$rs['id'].'\')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
					</tr>';
					}
				?>
				  </tbody>
				  </table>
										 
							</div>			 
											
                                        </div>
                                        
                                    </div>
									   
                                            
                                           <br><br>
										    
                                        </div>
	
                                                  
                                        <div class="tab-pane" id="tab-third">
										<div class="row">
                                         <div class="col-lg-12">
                  <div class="form-group">
				    <div class="col-lg-6">
                                      <select name="role1" id="role1" onChange="getset()" class="form-control select" style="width:200px;">
											<option selected="selected" value="0">Select</option>
											<option  value="2">Users</option>
											<option value="1">Admin</option>
<option value="4">Cashier</option>
<option value="5">Ward</option>
<option value="6">ICU</option>
<option value="7">OT</option>
<option value="8">ER</option>
											<?php if($lab==1) { ?>
											<option value="3">Lab</option>
											<?php } ?>
											</select>
												 <span class="help-block">Select Role</span>								
                                       
                                            </div>
											 
                                            
                                        </div>
										</div>
										<!--<input type="button" onClick="f()">-->
										
                                        <div class="col-md-12">
                                             
											
										<div class="form-group">
                                            <label class="col-md-5  control-label">Billing IP</label>
                                            <div class="col-md-4">
                                                <label class="switch">
                                                    <input type="checkbox" id="billip" value="0"/>
                                                    <span></span>
                                                </label>
                                                                             
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-5  control-label">Billing OP</label>
                                            <div class="col-md-4">
                                                <label class="switch">
                                                    <input type="checkbox" id="billop" value="0"/>
                                                    <span></span>
                                                </label>
                                                                             
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-5  control-label">Reports</label>
                                            <div class="col-md-4">
                                                <label class="switch">
                                                    <input type="checkbox" id="report" value="0"/>
                                                    <span></span>
                                                </label>
                                                                             
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-5  control-label">Lab Reports</label>
                                            <div class="col-md-4">
                                                <label class="switch">
                                                    <input type="checkbox" id="lab_reports_perm" value="0"/>
                                                    <span></span>
                                                </label>
                                                                             
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-5  control-label">Print Bill</label>
                                            <div class="col-md-4">
                                                <label class="switch">
                                                    <input type="checkbox" id="printbill" value="0"/>
                                                    <span></span>
                                                </label>
                                                                             
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label class="col-md-5  control-label">Master Entry</label>
                                            <div class="col-md-4">
                                                <label class="switch">
                                                    <input type="checkbox" id="master" value="0"/>
                                                    <span></span>
                                                </label>
                                                                             
                                            </div>
                                        </div>
										
										<div class="form-group">
                                            <label class="col-md-5  control-label">Registration</label>
                                            <div class="col-md-4">
                                                <label class="switch">
                                                    <input type="checkbox" id="reg" value="0"/>
                                                    <span></span>
                                                </label>
                                                                             
                                            </div>
                                        </div>
										
										
										
                                        
                                        
										<div class="form-group">
                                            <label class="col-md-5  control-label">Complaints</label>
                                            <div class="col-md-4">
                                                <label class="switch">
                                                    <input type="checkbox" id="complaints_perm" value="0"/>
                                                    <span></span>
                                                </label>
                                                                             
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-5  control-label">Active Chart</label>
                                            <div class="col-md-4">
                                                <label class="switch">
                                                    <input type="checkbox" id="activechart_perm" value="0"/>
                                                    <span></span>
                                                </label>
                                                                             
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-5  control-label">Clinical Chart</label>
                                            <div class="col-md-4">
                                                <label class="switch">
                                                    <input type="checkbox" id="clinicalchart_perm" value="0"/>
                                                    <span></span>
                                                </label>
                                                                             
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-5  control-label">Medication</label>
                                            <div class="col-md-4">
                                                <label class="switch">
                                                    <input type="checkbox" id="medication_perm" value="0"/>
                                                    <span></span>
                                                </label>
                                                                             
                                            </div>
										</div>
										<div class="form-group">
                                            <label class="col-md-5  control-label">Investigation</label>
                                            <div class="col-md-4">
                                                <label class="switch">
                                                    <input type="checkbox" id="investigation_perm" value="0"/>
                                                    <span></span>
                                                </label>
                                                                             
                                            </div>
                                        </div>
										<div class="form-group">
                                            <label class="col-md-5  control-label">Patient Info</label>
                                            <div class="col-md-4">
                                                <label class="switch">
                                                    <input type="checkbox" id="info" value="0"/>
                                                    <span></span>
                                                </label>
                                                                             
                                            </div>
                                        </div>
										
                                        <div class="form-group">
                                            <label class="col-md-5  control-label">Admission</label>
                                            <div class="col-md-4">
                                                <label class="switch">
                                                    <input type="checkbox" id="admission_perm" value="0"/>
                                                    <span></span>
                                                </label>
                                                                             
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                          <div class="col-lg-12">
                  <div class="form-group">
				    <div class="col-lg-2">                                              
<a href="#" class="btn btn-primary pull-left" onClick="saveset();return false;">Save<span class="fa fa-floppy-o fa-right"></span></a>
</div></div></div>
                                            
                                           <br><br>
										    
                                        </div>
										
										
										
                                    </div>
										
										
									
									
									
									<div class="tab-pane" id="tab-four">
										<div class="row">
                                        
                                        <div class="col-md-6">
                                            
                                            
                                            
                                            
                                            <div class="form-group">
                                              
                                                <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="branch" placeholder="Branch Name" id="branch" class="form-control"/>
														
                                                    </div>                                            
                                                    <span class="help-block">Enter Branch Name</span>
                                            </div>
                                            
											<div class="form-group">
                                                
                                                <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="branchid" placeholder="Branch ID" id="branchid" readonly class="form-control"/>
														
                                                    </div>                                            
                                                    <span class="help-block">Enter Branch ID</span>
                                            </div>
											  
											 
                                            
                                        </div>
										
										<!--<input type="button" onClick="f()">-->
										
                                        <div class="col-md-6">
                                             <div id="usertable">
                                            <table id="user" class="table table-striped table-bordered table-hover" >
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Branch</th>
						<th style="display:none">id</th>
						 <th>Action</th>
                    </tr>
					
                  </thead>
				  <tbody>
				  
				  <?php 
					//include("config_db1.php");
					$cmd = "select branch,id from hospitalbranches where status=1";
					$i=1;
			$res = mysql_query($cmd);
			while($rs = mysql_fetch_array($res)){
		
						echo '<tr>
						<td> '.$i++.' </td>
						<td>'.$rs['branch'].'</td>
						<td style="display:none;">'.$rs['id'].'</td>
						<td><a href="#" name="editbranch" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-pencil"></span></a>&nbsp;&nbsp;
						<a href="javascript:delete_branch('.$rs['id'].')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
					</tr>';
					}
				?>
				  </tbody>
				  </table>
										 
							</div>			 
											
                                        </div>
                                        
                                    </div>
										    <div class="col-md-2" id="addbra">
<a href="#" class="btn btn-primary pull-left" onClick="addbranch()">Add<span class="fa fa-plus fa-right"></span></a>                                           </div>
	    <div class="col-md-2" id="editbr" style="display:none">                                         
<a href="#" class="btn btn-primary pull-left" onClick="savebranch()">Save Changes <span class="fa fa-floppy-o fa-right"></span></a>

                                          </div>  
                                           <br><br>
										    
                                        </div>
										
                                  
								  
                                  
                                  
                                  <div class="tab-pane" id="tab-five">
										<div class="row">
                                        
                                        <div class="col-md-6">
                                            
                                            
                                            
                                            
                                            <div class="form-group">
                                              
                                                <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="ward_name" placeholder="Ward Name" id="ward_name" class="form-control"/>
                                                       
														
                                                    </div>                                            
                                                    <span class="help-block">Enter Ward Name</span>
                                            </div>
                                            
											<div class="form-group">
                                                
                                                <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                       <textarea name="description" placeholder="Description" id="description" class="form-control"></textarea>
                                                    </div>                                            
                                                    <span class="help-block">Enter Description</span>
                                            </div>
											  
											 
                                            
                                        </div>
										
										<!--<input type="button" onClick="f()">-->
										
                                        <div class="col-md-6">
                                             <div id="usertable">
                                            <table id="user" class="table table-striped table-bordered table-hover" >
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Ward</th>
						<th>Description</th>
                        <th style="display:none;">ID</th>
						 <th>Action</th>
                    </tr>
					
                  </thead>
				  <tbody>
				  
				  <?php 
					//include("config_db1.php");
					$cmd = "select id,ward_name,description from ward_creation";
					$i=1;
			$res = mysql_query($cmd);
			while($rs = mysql_fetch_array($res)){
		
						echo '<tr>
						<td> '.$i++.' </td>
						<td>'.$rs['ward_name'].'</td>
						<td>'.$rs['description'].'</td>
						<td style="display:none;">'.$rs['id'].'</td>
						<td><a href="#" name="editward" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-pencil"></span></a>&nbsp;&nbsp;
						<a href="javascript:delete_ward('.$rs['id'].')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
					</tr>';
					}
				?>
				  </tbody>
				  </table>
										 
							</div>			 
											
                                        </div>
                                        
                                    </div>
										    <div class="col-md-2" id="addwar">
<a href="#" class="btn btn-primary pull-left" onClick="addward()">Add<span class="fa fa-plus fa-right"></span></a>                                           </div>
	    <div class="col-md-2" id="editwar" style="display:none">                                         
<a href="#" class="btn btn-primary pull-left" onClick="saveward()">Save Changes <span class="fa fa-floppy-o fa-right"></span></a>

                                          </div>  
                                           <br><br>
										    
                                        </div>
                                        
                                        
                                        
                                        <div class="tab-pane" id="tab-six">
										<div class="row">
                                        <div class="col-md-6">
                                   <div class="form-group">
				    <div class="col-lg-12"> 
 <select name="ward_names" id="ward_names" class="form-control select" style="width:200px;">
 <option  value="">Select</option>
 <?php
    $sql="select * from ward_creation ";
    $rs=mysql_query($sql);
    while($rsdata=mysql_fetch_array($rs))
      {
	     $ward_names = $rsdata['ward_name'];
	     $id = $rsdata['id'];
          ?>
    <option value="<?php echo $id;?>"><?php echo $ward_names;?></option><?php }?></select></div>
                                           <span class="help-block">Select Ward Name</span>                                            
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="room" placeholder="Room No" id="room" class="form-control"/>
                                                    </div>                                            
                                                    <span class="help-block">Enter Room No</span>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="rate" placeholder="Rate" id="rate" onKeyPress="if ((event.keyCode &lt; 46) || (event.keyCode &gt; 57) || event.keyCode==47) event.returnValue = false;" class="form-control"/>
                                                    </div>                                            
                                                    <span class="help-block">Enter Rate (Per Day)</span>
                                            </div>
                                            
                                        </div>
                                        <div class="col-md-6">
                                             <div id="usertable">
                                            <table id="user" class="table table-striped table-bordered table-hover" >
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Ward Name</th>
                      <th>Room No</th>
                      <th>Rate (Per Day)</th>
					  <th style="display:none">id</th>
                      <th style="display:none">id</th>
					  <th>Action</th>
                    </tr>
                  </thead>
				  <tbody>
				  
				  <?php 
					//include("config_db1.php");
					  function get_ward_name($ward_names)
  {
   $sql2="select * from  ward_creation where  id='$ward_names'"; 
  $rs2=mysql_query($sql2);
	while($rsdata2=mysql_fetch_array($rs2))
	{
	   $ward_name=$rsdata2['ward_name'];
  	}
  return $ward_name;
  }
			$cmd = "select * from room_no";
			$i=1;
			$res = mysql_query($cmd);
			while($rs1 = mysql_fetch_array($res)){
			$ward_names=get_ward_name($rs1['ward_names']);
						echo '<tr>
						<td> '.$i++.' </td>
						<td>'.$ward_names.'</td>
						<td>'.$rs1['room'].'</td>
						<td>'.$rs1['rate'].'</td>
						<td style="display:none;">'.$rs1['id'].'</td>
						<td style="display:none;">'.$rs1['ward_names'].'</td>
						<td><a href="#" name="editroom" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-pencil"></span></a>&nbsp;&nbsp;
						<a href="javascript:delete_room('.$rs1['id'].')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
					</tr>';
					}
				?>
				  </tbody>
				  </table>
							</div>			 
                             </div>
                              </div>
					    <div class="col-md-2" id="addroo">
<a href="#" class="btn btn-primary pull-left" onClick="addroom();return false;">Add<span class="fa fa-plus fa-right"></span></a>                                           </div>
	    <div class="col-md-2" id="editroo" style="display:none">                                         
<a href="#" class="btn btn-primary pull-left" onClick="saveroom();return false;">Save Changes <span class="fa fa-floppy-o fa-right"></span></a>
                                          </div>  
                                           <br>
                                           <br>
                                        </div>
                                        
                                        
                                         <div class="tab-pane" id="tab-seven">
										<div class="row">
                                        
                                        <div class="col-md-6">
                                            
                                            
                                            
                                            
                                            <div class="form-group">
                                              
                                                <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="service_name" placeholder="Service Name" id="service_name" class="form-control"/>
                                                       
														
                                                    </div>                                            
                                                    <span class="help-block">Enter Service Name</span>
                                            </div>
                                            
											 <div class="form-group">
				    <div class="col-lg-12"> 
                                                       <select id="types" name="types" class="form-control select" style="width:200px;" > 
                                                       <option value="">Select</option>
                                                       <option value="Hours">Hours</option>
                                                        <option value="Days">Days</option>
                                                       </select>
                                                    </div>                                            
                                                    <span class="help-block">Select Type</span>
                                            </div>
                                            
                                            <div class="form-group">
                                              
                                                <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="amount" placeholder="Amount" id="amount" class="form-control" onKeyPress="if ((event.keyCode &lt; 48) || (event.keyCode &gt; 57)) event.returnValue = false"/>
                                                       
														
                                                    </div>                                            
                                                    <span class="help-block">Enter Amount</span>
                                            </div>
											  
											 
                                            
                                        </div>
										
										<!--<input type="button" onClick="f()">-->
										
                                        <div class="col-md-6">
                                             <div id="usertable">
                                            <table id="user" class="table table-striped table-bordered table-hover" >
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Service Name</th>
						<th>Type</th>
                        <th>Amount</th>
                        <th style="display:none;">ID</th>
						 <th>Action</th>
                    </tr>
					
                  </thead>
				  <tbody>
				  
				  <?php 
					//include("config_db1.php");
					$cmd = "select * from service_creation";
					$i=1;
			$res = mysql_query($cmd);
			while($rs = mysql_fetch_array($res)){
		
						echo '<tr>
						<td> '.$i++.' </td>
						<td>'.$rs['service_name'].'</td>
						<td>'.$rs['types'].'</td>
						<td>'.$rs['amount'].'</td>
						<td style="display:none;">'.$rs['id'].'</td>
						<td><a href="#" name="editservice" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-pencil"></span></a>&nbsp;&nbsp;
						<a href="javascript:delete_service('.$rs['id'].')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
					</tr>';
					}
				?>
				  </tbody>
				  </table>
										 
							</div>			 
											
                                        </div>
                                        
                                    </div>
										    <div class="col-md-2" id="addser">
<a href="#" class="btn btn-primary pull-left" onClick="addservice()">Add<span class="fa fa-plus fa-right"></span></a>                                           </div>
	    <div class="col-md-2" id="editser" style="display:none">                                         
<a href="#" class="btn btn-primary pull-left" onClick="saveservice()">Save Changes <span class="fa fa-floppy-o fa-right"></span></a>

                                          </div>  
                                           <br><br>
										    
                                        </div>
                                        
                                         <div class="tab-pane" id="tab-eight">
										<div class="row">
                                        
                                        <div class="col-md-6">
                                            
                                            
                                            
                                            
                                            <div class="form-group">
                                              
                                                <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="procedure_name" placeholder="Procedure Name" id="procedure_name" class="form-control"/>
                                                       
														
                                                    </div>                                            
                                                    <span class="help-block">Enter Procedure Name</span>
                                            </div>
                                            
											 <div class="form-group">
				    <div class="col-lg-12"> 
                                                       <select id="ptypes" name="ptypes" class="form-control select" style="width:200px;" > 
                                                       <option value="">Select</option>
                                                     <option value="Hours">Hours</option>
                                                        <option value="Days">Days</option>
                                                       </select>
                                                    </div>                                            
                                                    <span class="help-block">Select Type</span>
                                            </div>
                                            
                                            <div class="form-group">
                                              
                                                <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="pamount" placeholder="Amount" id="pamount" class="form-control" onKeyPress="if ((event.keyCode &lt; 48) || (event.keyCode &gt; 57)) event.returnValue = false"/>
                                                       
														
                                                    </div>                                            
                                                    <span class="help-block">Enter Amount</span>
                                            </div>
											  
											 
                                            
                                        </div>
										
										<!--<input type="button" onClick="f()">-->
										
                                        <div class="col-md-6">
                                             <div id="usertable">
                                            <table id="user" class="table table-striped table-bordered table-hover" >
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Procedure Name</th>
						<th>Type</th>
                        <th>Amount</th>
                        <th style="display:none;">ID</th>
						 <th>Action</th>
                    </tr>
					
                  </thead>
				  <tbody>
				  
				  <?php 
					//include("config_db1.php");
					$cmd = "select * from procedure_creation";
					$i=1;
			$res = mysql_query($cmd);
			while($rs = mysql_fetch_array($res)){
		
						echo '<tr>
						<td> '.$i++.' </td>
						<td>'.$rs['procedure_name'].'</td>
						<td>'.$rs['ptypes'].'</td>
						<td>'.$rs['pamount'].'</td>
						<td style="display:none;">'.$rs['id'].'</td>
						<td><a href="#" name="editprocedure" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-pencil"></span></a>&nbsp;&nbsp;
						<a href="javascript:delete_procedure('.$rs['id'].')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
					</tr>';
					}
				?>
				  </tbody>
				  </table>
										 
							</div>			 
											
                                        </div>
                                        
                                    </div>
										    <div class="col-md-2" id="addproc">
<a href="#" class="btn btn-primary pull-left" onClick="addprocedure()">Add<span class="fa fa-plus fa-right"></span></a>                                           </div>
	    <div class="col-md-2" id="editproc" style="display:none">                                         
<a href="#" class="btn btn-primary pull-left" onClick="saveprocedure()">Save Changes <span class="fa fa-floppy-o fa-right"></span></a>


                                          </div>  
                                           <br><br>
										    
                                        </div>
                                        
                                         <div class="tab-pane" id="tab-nine">
										<div class="row">
                                        
                                        <div class="col-md-6">
                                            
                                            
                                            
                                            
                                          <div class="form-group">
                                              
                                                <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="visit_name" placeholder="Visit Name" id="visit_name" class="form-control"/>
                                                       
														
                                                    </div>                                            
                                                    <span class="help-block">Enter Visit Name</span>
                                            </div>
                                            
											 <div class="form-group">
				    <div class="col-lg-12"> 
                                                       <select id="vtypes" name="vtypes" class="form-control select" style="width:200px;" > 
                                                       <option value="">Select</option>
                                                       <option value="Hours">Hours</option>
                                                        <option value="Days">Days</option>
                                                       </select>
                                                    </div>                                            
                                                    <span class="help-block">Select Type</span>
                                            </div>
                                            
                                            <div class="form-group">
                                              
                                                <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="vamount" placeholder="Amount" id="vamount" class="form-control" onKeyPress="if ((event.keyCode &lt; 48) || (event.keyCode &gt; 57)) event.returnValue = false"/>
                                                       
														
                                                    </div>                                            
                                                    <span class="help-block">Enter Amount</span>
                                            </div>
											  
											 
                                            
                                        </div>
										
										<!--<input type="button" onClick="f()">-->
										
                                        <div class="col-md-6">
                                             <div id="usertable">
                                            <table id="user" class="table table-striped table-bordered table-hover" >
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Visit Name</th>
						<th>Type</th>
                        <th>Amount</th>
                        <th style="display:none;">ID</th>
						 <th>Action</th>
                    </tr>
					
                  </thead>
				  <tbody>
				  
				  <?php 
					//include("config_db1.php");
					$cmd = "select * from visit_creation";
					$i=1;
			$res = mysql_query($cmd);
			while($rs = mysql_fetch_array($res)){
		
						echo '<tr>
						<td> '.$i++.' </td>
						<td>'.$rs['visit_name'].'</td>
						<td>'.$rs['vtypes'].'</td>
						<td>'.$rs['vamount'].'</td>
						<td style="display:none;">'.$rs['id'].'</td>
						<td><a href="#" name="editvisit" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-pencil"></span></a>&nbsp;&nbsp;
						<a href="javascript:delete_visit('.$rs['id'].')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
					</tr>';
					}
				?>
				  </tbody>
				  </table>
										 
							</div>			 
											
                                        </div>
                                        
                                    </div>
										    <div class="col-md-2" id="addvis">
<a href="#" class="btn btn-primary pull-left" onClick="addvisit()">Add<span class="fa fa-plus fa-right"></span></a>                                           </div>
	    <div class="col-md-2" id="editvis" style="display:none">                                         
<a href="#" class="btn btn-primary pull-left" onClick="savevisit()">Save Changes <span class="fa fa-floppy-o fa-right"></span></a>

                                          </div>  
                                           <br><br>
										    
                                        </div>
                                        
                                        
								  <div class="tab-pane" id="tab-ten">
								   <form enctype="multipart/form-data" method="post" name="uploadheader" action="uploadhed.php">
										<div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                <div class="col-md-12">
								 <input type="file" class="fileinput form-control btn-info" id="header" name="header" onChange="readURL(this);"/>
								 <span class="help-block">Browse Header file</span><br>
								 <br />
                                    <img style="float:right; cursor:pointer; margin-right:30px" src="return_print_image.php?type=header" height="200" width="200" id="img_prev" name="img_prev" />
   
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
                                            
                                            
            <div class="form-group">
											
                                <div class="col-md-12">
								<br>
								    <input type="file" class="fileinput form-control btn-info" id="footer" name="footer" onChange="readURL1(this);"/>
								<span class="help-block">Browse Footer file</span><br><br>
                                    <img style="float:right; cursor:pointer; margin-right:30px" src="return_print_image.php?type=footer" height="200" width="200" id="img_prev1" name="img_prev1" />

                                </div>
                            </div>
							<script>
		function readURL1(input) {
			if (input.files && input.files[0]) {
				var reader = new FileReader();
				reader.onload = function(e) {
					$('#img_prev1')
					.attr('src', e.target.result)
					.width(200)
				.height(200);
				};
				reader.readAsDataURL(input.files[0]);
			}
		}
	</script>                              
                                            
											
											  
											 
                                            
                                        </div>
										
										<!--<input type="button" onClick="f()">-->
										
                                        
                                        
                                    </div>
								<br>		   
	    			<div class="col-md-2">                                         
				<button type="submit" class="btn btn-primary pull-left">Save Changes <span class="fa fa-floppy-o fa-right"></span>
				</button>

                                          </div>  
                                           <br><br>
										    
                                 
										
										
										
                                                                
                            </form>
                   
                            
                        </div>
						
						
						<div class="tab-pane" id="tab-eleven">
										<div class="row">
                                        
										<!--<input type="button" onClick="f()">-->
										
                                        <div class="col-md-12">
                                             
											<div class="form-group">
                                            <label class="col-md-5  control-label">Lab</label>
                                            <div class="col-md-4">
                                                <label class="switch">
												<?php if($lab==1)
												$lac_check='checked="checked"'; ?>
                                                    <input type="checkbox" <?php echo $lac_check;?> id="lab" value="0"/>
                                                    <span></span>
                                                </label>
                                                                             
                                            </div>
                                        </div>
										
                                        </div>
                                        
									
										 
										 <div class="form-group">
                                               <!-- <label class="col-md-4 col-xs-12 control-label"></label>-->
                                                <div class="col-md-5 col-xs-12">
										<select id="inves" onChange="investigation()" class="form-control select">
													 <option value="0">Select</option>
                                                        <option value="1">Diagnostics</option>
                                                        <option value="2">Blood</option>
                                                        <option value="3">Radiology</option>
                                                        <option value="4">Psychological</option>
                                                        <option value="5">Psychometric</option>
														<option value="6">Others</option>
                                                    </select>
													<span class="help-block">Select Investigation </span>
													
													</div>
													</div> 
					<script>
					function investigation()
		{
		
		$("#rate").empty();	
		
		var inves=$('#inves option:selected').text();
		
		if(inves=='Select')
		{
		$("#reports").empty();
		$("#reports").append("<option title='Select' value='1'>Select</option>").selectpicker('refresh');
		return false;
		}
		
			//alert(inves);
			//$("#reports").append(new option("sample"));
			//var xx='sample';
			//$('#reports').append($('<option>', { title: xx, text: xx }));
			//$("#reports").append("<option value='31'>31</option>");
		//alert(inves);	
			$.ajax({
		type: "POST",
		url: "getinvestrate.php",
		data: {inves:inves,},
		success: function(msg) {
		
			//alert(msg);
	  			$("#rate_new").html(msg);			 
			  $('table').filterTable({filterExpression: 'filterTableFindAll'});
			 }
		});
		}
					</script>
					<script>
	function delinves(x) {
		if(confirm('Sure to delete?')){
			var txt = x.attr('alt');
			var inves=$('#inves option:selected').text();
			
			$.ajax({
				type: 'post',
				url: 'delete-inves_table.php',
				data: {txt:txt,inves:inves, },
				success: function(msg) {
					if(msg == 'ok')
						x.closest('td').html('Deleted');
					else {	
						$("#appenderror").empty();
	msg='<p><span class="fa fa-check">Error Occured During Updation Try again !</span></p>';
	$("#appenderror").append(msg);
	$('#message-box-error').toggle(); }
				}
			});			
		}
	}
	function edit_lab_normal(report){
	var labreport = $(report).data('id');
	//alert(labreport);
	
	//alert($('#'+labreport).html());
	$(".txtEditor").Editor("setText", $('#'+labreport).html());
	$("#txtEditor_id").val(labreport);
	
}
function add_update_lab_report_save(){
	var labreportid = $("#txtEditor_id").val();
	//alert(labreportid);
	var htmltext = $(".txtEditor").Editor("getText");
	$('#'+labreportid).html(htmltext);
}
	function savelab()
	{
	if ($('#lab').is(':checked')) 
lab=1; 
else
lab=0;

	var table = $("#tbllab");
	var inves=$('#inves option:selected').text();
	//if(inves='Select')
//$("#tbl1 > tbody").html("");
//alert(id);
    var asset = [];
    table.find('tbody > tr').each(function (rowIndex, r) {
        var cols = [];
        $(this).find('td').each(function (colIndex, c) {
			
				if(colIndex == 3){
					cols.push($(this).find('div').html());
				}else{
					cols.push(c.textContent);
				}
        });
        asset.push(cols);
    });
	
	$.ajax({
		type: "POST",
		url: "savelab.php",
		data: { assets: asset,
		inves:inves,
		lab:lab,
		},
		success: function(msg) {
			
		
		
		$("#confirm_infomsg .infomsg").empty();
			$("#confirm_infomsg .infomsg").append(msg);
				$('#confirm_infomsg')
				.modal({ backdrop: 'static', keyboard: false })
				.one('click', '[data-value]', function (e) {
				
		});
		
		}
	}); 
	}
	
	function addnewtest()
	{
	var test = $("#addtest").val();
	var rate = $("#addrate").val();
	var normal = $("#addnormal").Editor("getText");
	
	var inves=$('#inves option:selected').text();
	$.ajax({
		type: "POST",
		url: "saveaddinves.php",
		data: { test: test,
		inves:inves,
		rate:rate,
		normal:normal,
		},
		success: function(msg) {
		alert(msg);
		investigation();
		}
		});
		
		
	}
	</script>					 <div class="col-lg-12">
							<div id="rate_new">			
							</div>
								
								</div>
										
                                          <div class="col-lg-12">
                  <div class="form-group">
				    <div class="col-lg-2">                                              
<a href="#" class="btn btn-primary pull-left" onClick="savelab()">Save Changes <span class="fa fa-floppy-o fa-right"></span></a>
</div></div></div>
                                            
                                           <br><br>
										    
                                        </div>
										
										
										
                                    </div>
                                    
                                    
                                     <div class="tab-pane" id="tab-twelve">
										<div class="row">
                                        
                                        <div class="col-md-6">
                                            
                                            
                                            
                                            
                                            <div class="form-group">
                                              
                                                <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="department_names" placeholder="Department Name" id="department_names" class="form-control"/>
                                                       
														
                                                    </div>                                            
                                                    <span class="help-block">Enter Department Name</span>
                                            </div>
                                            
											<div class="form-group">
                                                
                                                <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                       <textarea name="description" placeholder="Descriptions" id="descriptions" class="form-control"></textarea>
                                                    </div>                                            
                                                    <span class="help-block">Enter Description</span>
                                            </div>
											  
											 
                                            
                                        </div>
										
										<!--<input type="button" onClick="f()">-->
										
                                        <div class="col-md-6">
                                             <div id="usertable">
                                            <table id="user" class="table table-striped table-bordered table-hover" >
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Department Name</th>
						<th>Description</th>
                        <th style="display:none;">ID</th>
						 <th>Action</th>
                    </tr>
					
                  </thead>
				  <tbody>
				  
				  <?php 
					//include("config_db1.php");
					$cmd = "select * from department_creation";
					$i=1;
			$res = mysql_query($cmd);
			while($rs = mysql_fetch_array($res)){
		
						echo '<tr>
						<td> '.$i++.' </td>
						<td>'.$rs['department_names'].'</td>
						<td>'.$rs['descriptions'].'</td>
						<td style="display:none;">'.$rs['id'].'</td>
						<td><a href="#" name="editdept" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-pencil"></span></a>&nbsp;&nbsp;
						<a href="javascript:delete_dept('.$rs['id'].')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
					</tr>';
					}
				?>
				  </tbody>
				  </table>
										 
							</div>			 
											
                                        </div>
                                        
                                    </div>
										    <div class="col-md-2" id="adddepart">
<a href="#" class="btn btn-primary pull-left" onClick="adddept()">Add<span class="fa fa-plus fa-right"></span></a>                                           </div>
	    <div class="col-md-2" id="editdepart" style="display:none">                                         
<a href="#" class="btn btn-primary pull-left" onClick="savedept()">Save Changes <span class="fa fa-floppy-o fa-right"></span></a>

                                          </div>  
                                           <br><br>
										    
                                        </div>
<div class="tab-pane" id="tab-fourteen">
										<div class="row">
                                        
                                        <div class="col-md-6">
                                            
                                            
                                            
                                            
                                            <div class="form-group">
                                              
                                                <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="type_name" placeholder="Type Name" id="type_name" class="form-control"/>
                                                       
														
                                                    </div>                                            
                                                    <span class="help-block">Enter Type Name</span>
                                            </div>
                                            
                                            <div class="form-group">
                                              
                                                <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="amounts" placeholder="Amount" id="amounts" class="form-control" onKeyPress="if ((event.keyCode &lt; 48) || (event.keyCode &gt; 57)) event.returnValue = false"/>
                                                       
														
                                                    </div>                                            
                                                    <span class="help-block">Enter Amount</span>
                                            </div>
											  
											 
                                            
                                        </div>
										
										<!--<input type="button" onClick="f()">-->
										
                                        <div class="col-md-6">
                                             <div id="usertable">
                                            <table id="user" class="table table-striped table-bordered table-hover" >
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Type Name</th>
                        <th>Amount</th>
                        <th style="display:none;">ID</th>
						 <th>Action</th>
                    </tr>
					
                  </thead>
				  <tbody>
				  
				  <?php 
					//include("config_db1.php");
					$cmd = "select * from type_creation";
					$i=1;
			$res = mysql_query($cmd);
			while($rs = mysql_fetch_array($res)){
		
						echo '<tr>
						<td> '.$i++.' </td>
						<td>'.$rs['type_name'].'</td>
						<td>'.$rs['amounts'].'</td>
						<td style="display:none;">'.$rs['id'].'</td>
						<td><a href="#" name="edittypesss" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-pencil"></span></a>&nbsp;&nbsp;
						<a href="javascript:delete_type('.$rs['id'].')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
					</tr>';
					}
				?>
				  </tbody>
				  </table>
										 
							</div>			 
											
                                        </div>
                                        
                                    </div>
										    <div class="col-md-2" id="addtypess">
<a href="#" class="btn btn-primary pull-left" onClick="addtype()">Add<span class="fa fa-plus fa-right"></span></a>                                           </div>
	    <div class="col-md-2" id="edittypess" style="display:none">                                         
<a href="#" class="btn btn-primary pull-left" onClick="savetype()">Save Changes <span class="fa fa-floppy-o fa-right"></span></a>

                                          </div>  
                                           <br><br>
										    
                                        </div>
                                    
 <!--////////////////////////////////////////////// Doctor Creation START/////////////////////////////////////-->                                   
  <div class="tab-pane" id="tab-thirteen">
  	<div class="row">
  		<div class="col-md-6">
			 <div class="form-group">
				    <div class="col-lg-12"> 
<select name="department_name" id="department_name" class="form-control select" style="width:200px;">
 <option  value="">Select</option>
 <?php
    $sql="select * from department_creation ";
    $rs=mysql_query($sql);
    while($rsdata=mysql_fetch_array($rs))
      {
	     $department_names = $rsdata['department_names'];
	     $id = $rsdata['id'];
          ?>
    <option value="<?php echo $department_names;?>"><?php echo $department_names;?></option><?php }?></select>                                                       
                                                    </div>                                            
                                                    <span class="help-block">Enter Doctor Name</span>
                                            </div>
                                            
                                            <div class="form-group">
                                              
                                                <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="doctor_name" placeholder="Doctor Name" id="doctor_name" class="form-control"/>
                                                       
														
                                                    </div>                                            
                                                    <span class="help-block">Enter Doctor Name</span>
                                            </div>
                                            
											<div class="form-group">
                                                
                                                <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="mobile_no" placeholder="Mobile No" id="mobile_no" onKeyPress="if ((event.keyCode &lt; 48) || (event.keyCode &gt; 57)) event.returnValue = false" class="form-control"/>
                                                    </div>                                            
                                                    <span class="help-block">Enter Mobile No</span>
                                            </div>
											  
											 
                                            
                                        </div>
										
                                        <div class="col-md-6">
                                             <div id="usertable">
                                            <table id="user" class="table table-striped table-bordered table-hover" >
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Department Name</th>
                      <th>Doctor Name</th>
						<th>Mobile No</th>
                        <th style="display:none;">ID</th>
						 <th>Action</th>
                    </tr>
					
                  </thead>
				  <tbody>
				  
				  <?php 
					//include("config_db1.php");
					$cmd = "select * from doctor_creation";
					$i=1;
			$res = mysql_query($cmd);
			while($rs = mysql_fetch_array($res)){
		
						echo '<tr>
						<td> '.$i++.' </td>
						<td>'.$rs['department_name'].'</td>
						<td>'.$rs['doctor_name'].'</td>
						<td>'.$rs['mobile_no'].'</td>
						<td style="display:none;">'.$rs['id'].'</td>
						<td><a href="#" name="editdoctor" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-pencil"></span></a>&nbsp;&nbsp;
						<a href="javascript:delete_doctor('.$rs['id'].')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
					</tr>';
					}
				?>
				  </tbody>
				  </table>
							</div>			 
                                        </div>
                                    </div>
										    <div class="col-md-2" id="adddoc">
<a href="#" class="btn btn-primary pull-left" onClick="adddoctor()">Add<span class="fa fa-plus fa-right"></span></a>                                           </div>
	    <div class="col-md-2" id="editdoc" style="display:none">                                         
<a href="#" class="btn btn-primary pull-left" onClick="savedoctor()">Save Changes <span class="fa fa-floppy-o fa-right"></span></a>
                                          </div>  
                                           <br><br>
                                        </div>
        </div>
    </div>
  </div>                                    
          
 <!--////////////////////////////////////////////// Doctor Creation END/////////////////////////////////////-->                                            
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
<div id="labsampletestreportedit_modal"  class="modal fade" role="dialog" style="z-index:9999;">
  <div class="modal-dialog modal-lg ">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Add/Update Report</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
          <div class="panel-body" id="labsampletest_report"> 
<input type="hidden" id="txtEditor_id">  
<div class="txtEditor"></div>		  
						
                            <!-- START JQUERY VALIDATION PLUGIN -->
                           <?php  date_default_timezone_set('Asia/Kolkata');   ?>
                                   
                            <!-- END JQUERY VALIDATION PLUGIN -->
          </div>
            
            
            
          
        </div>
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-primary" onClick="printbill()" data-dismiss="modal">Print</button>-->
		<button type="button" id='add_update_lab_report_save' data-id='' class="btn btn-primary" onclick="add_update_lab_report_save();return false;" data-dismiss="modal">Add/Update</button>
        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
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
                        <a href="master_entry.php" class="btn btn-default btn-lg pull-right" >Close</a>
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
                        <button class="btn btn-default btn-lg pull-right mb-control-close">Close</button>
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
		<div id="addnew" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Test</h4>
      </div>
      <div class="modal-body">
        <div class="col-md-12"> 
			  <div class="panel-body">  
	<div class="row">	
	
		 <div class="col-lg-12">
                  <div class="form-group">
                    <div class="col-lg-10">
					<div class="input-group"> 
                   <span class="input-group-addon"><span class="fa fa-pencil"></span></span>                                   
										<input name="addtest" type="text" id="addtest" class="form-control" placeholder="Enter Test Name ">  </div>
                    </div>
                    <div class="col-lg-2">
                                            
                    </div>
                  </div>
				  <br><br>
				  </div>   
				  
				  <div class="col-lg-12">
                  <div class="form-group">
                    <div class="col-lg-10">
					<div class="input-group"> 
                   <span class="input-group-addon"><span class="fa fa-pencil"></span></span>                                           
										<input name="addrate" class="form-control" type="text" id="addrate"  placeholder="Rate"> </div>
                    </div>
                    <div class="col-lg-2">
                               
                    </div>
                  </div>
				   <br><br>
				  </div>    
				  
				  <div class="col-lg-12">
                  <div class="form-group">
                    <div class="col-lg-10">
					<div class="input-group"> 
                                     <span class="help-block">Normal Value</span>                          
										<input name="addnormal" class="form-control txtEditor_add" type="text" id="addnormal"  placeholder="Normal Value"> </div>
                    </div>
                    <div class="col-lg-2">
                               
                    </div>
                  </div>
				   <br><br>
				  </div>
				  
				     
				   </div>
      </div>
      <div class="modal-footer">
	  <button type="button" class="btn btn-default" onClick="addnewtest()" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
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
        <script type="text/javascript" src="js/jquery.filtertable.min.js"></script> 
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
		<script src="js/editor.js"></script>
        
       <!-- <script type="text/javascript" src="js/demo_edit_profile.js"></script>-->
        <!-- END TEMPLATE -->

    <!-- END SCRIPTS -->
	
    <!-- COUNTERS // NOT INCLUDED IN TEMPLATE -->
        <!-- GOOGLE -->
<script>
			$(document).ready(function() {
				$(".txtEditor").Editor({'texteffects':false,'textformats':false,'fonteffects':false,'actions' : false,'insertoptions' : false,'extraeffects' : false,'advancedoptions' : false,'screeneffects':false,'bold': true,'italics': true,'underline':true,'ol':false,'ul':false,'undo':false,'redo':false,'aligneffects':true,'l_align':true,'r_align':true,'c_align':true,'justify':true,'insert_link':false,'unlink':false,'insert_img':false,'hr_line':false,'block_quote':false,'source':false,'strikeout':false,'indent':false,'outdent':false,'fonts':false,'styles':false,'print':false,'rm_format':false,'status_bar':false,'font_size':false,'color':false,'splchars':false,'insert_table':false,'select_all':false,'togglescreen':false});
				$(".txtEditor_add").Editor({'texteffects':false,'textformats':false,'fonteffects':false,'actions' : false,'insertoptions' : false,'extraeffects' : false,'advancedoptions' : false,'screeneffects':false,'bold': true,'italics': true,'underline':true,'ol':false,'ul':false,'undo':false,'redo':false,'aligneffects':true,'l_align':true,'r_align':true,'c_align':true,'justify':true,'insert_link':false,'unlink':false,'insert_img':false,'hr_line':false,'block_quote':false,'source':false,'strikeout':false,'indent':false,'outdent':false,'fonts':false,'styles':false,'print':false,'rm_format':false,'status_bar':false,'font_size':false,'color':false,'splchars':false,'insert_table':false,'select_all':false,'togglescreen':false});
				
				
				
			});
		</script>			
		
<script>
function saveset()
{
	
var sel=$('#role1').val();
if(sel==0) {
alert("Select Role");
return false;
}

$.ajax({
			type: "post",
			url: "savesettings.php", //this is my servlet
			data: {
				role: sel,
				billip: +$('#billip').is( ':checked' ),
				billop: +$('#billop').is( ':checked' ),
				report: +$('#report').is( ':checked' ),
				lab_reports_perm: +$('#lab_reports_perm').is( ':checked' ),
				printbill: +$('#printbill').is( ':checked' ),
				master: +$('#master').is( ':checked' ),
				reg: +$('#reg').is( ':checked' ),
				complaints_perm: +$('#complaints_perm').is( ':checked' ),
				activechart_perm: +$('#activechart_perm').is( ':checked' ),
				clinicalchart_perm: +$('#clinicalchart_perm').is( ':checked' ),
				medication_perm: +$('#medication_perm').is( ':checked' ),
				investigation_perm: +$('#investigation_perm').is( ':checked' ),
				info: +$('#info').is( ':checked' ),
				admission_perm: +$('#admission_perm').is( ':checked' ),
			},
			success: function(msg) {
			alert(msg);
			//msg=$.trim(msg);
			
			}
			});


}
function getset()
{
var sel=$('#role1').val();
/*if(sel==3)
return false;*/

$.ajax({
			type: "post",
			url: "getsettings.php", //this is my servlet
			data: {
				role: sel,
			},
			success: function(msg) {
			//alert(msg);
			msg=$.trim(msg);
			var x=msg.split("~");
			
			
			
			if(x[0]==1)
			$('#billip').iCheck('check');
			else
			$('#billip').iCheck('uncheck');
			
			
			if(x[1]==1)
			$('#billop').iCheck('check');
			else
			$('#billop').iCheck('uncheck');
			
			if(x[2]==1)
			$('#report').iCheck('check');
			else
			$('#report').iCheck('uncheck');	//alert(msg);
				
				
			if(x[3]==1)
			$('#clinicalchart_perm').iCheck('check');
			else
			$('#clinicalchart_perm').iCheck('uncheck');
			
				
				if(x[4]==1)
			$('#lab_reports_perm').iCheck('check');
			else
			$('#lab_reports_perm').iCheck('uncheck');
			
			
			if(x[5]==1)
			$('#printbill').iCheck('check');
			else
			$('#printbill').iCheck('uncheck');
			
			
			if(x[6]==1)
			$('#master').iCheck('check');
			else
			$('#master').iCheck('uncheck');
			
			if(x[7]==1)
			$('#reg').iCheck('check');
			else
			$('#reg').iCheck('uncheck');
			
			
			if(x[8]==1)
			$('#medication_perm').iCheck('check');
			else
			$('#medication_perm').iCheck('uncheck');
			
			if(x[9]==1)
			$('#complaints_perm').iCheck('check');
			else
			$('#complaints_perm').iCheck('uncheck');
			
			if(x[10]==1)
			$('#activechart_perm').iCheck('check');
			else
			$('#activechart_perm').iCheck('uncheck');
			
			if(x[11]==1)
			$('#investigation_perm').iCheck('check');
			else
			$('#investigation_perm').iCheck('uncheck');
			
			if(x[12]==1)
			$('#info').iCheck('check');
			else
			$('#info').iCheck('uncheck');
			
			if(x[13]==1)
			$('#admission_perm').iCheck('check');
			else
			$('#admission_perm').iCheck('uncheck');
			}
		});

		
}

$('.select').selectpicker();
// Get table content and display in current text listbox
function delete_id(x){
		if(confirm("Sure to delete?")){
			
		$.ajax({
			type: "post",
			url: "deluser.php", //this is my servlet
			data: {
				user: x,
			},
			success: function(msg) {
				alert(msg);
				$('#username').val('');
				$('#password').val('');
			}
		});
		}
	}
	
	
	
	function delete_branch(x){
	alert(x);
		if(confirm("Sure to delete?")){
		$.ajax({
			type: "post",
			url: "delbranch.php", //this is my servlet
			data: {
				id:x,
			},
			success: function(msg) {
				alert(msg);
				$('#branch').val('');
			
			}
		});
		} 
	}
	
	
	
	
	function delete_ward(x){
		if(confirm("Sure to delete?")){
		$.ajax({
			type: "post",
			url: "delward.php", //this is my servlet
			data: {
				id:x,
			},
			success: function(msg) {
				alert(msg);
				$('#ward').val('');
				window.location.reload(true);
			
			}
		});
		} 
	}
	
	
	
	function delete_service(x){
		if(confirm("Sure to delete?")){
		$.ajax({
			type: "post",
			url: "delservice.php", //this is my servlet
			data: {
				id:x,
			},
			success: function(msg) {
				alert(msg);
				window.location.reload(true);
			
			}
		});
		} 
	}
	
	
	
	
	function delete_type(x){
		if(confirm("Sure to delete?")){
		$.ajax({
			type: "post",
			url: "deltype.php", //this is my servlet
			data: {
				id:x,
			},
			success: function(msg) {
				alert(msg);
				window.location.reload(true);
			
			}
		});
		} 
	}
	
	
	function delete_procedure(x){
		if(confirm("Sure to delete?")){
		$.ajax({
			type: "post",
			url: "delprocedure.php", //this is my servlet
			data: {
				id:x,
			},
			success: function(msg) {
				alert(msg);
				window.location.reload(true);
			}
		});
		} 
	}
	
	
	
	function delete_visit(x){
		if(confirm("Sure to delete?")){
		$.ajax({
			type: "post",
			url: "delvisit.php", //this is my servlet
			data: {
				id:x,
			},
			success: function(msg) {
				alert(msg);
				window.location.reload(true);
			}
		});
		} 
	}
	
	
	
	function delete_dept(x){
		if(confirm("Sure to delete?")){
		$.ajax({
			type: "post",
			url: "deldept.php", //this is my servlet
			data: {
				id:x,
			},
			success: function(msg) {
				alert(msg);
				$('#department_names').val('');
				$('#descriptions').val('');
				window.location.reload(true);
			
			}
		});
		} 
	}
	
	function delete_doctor(x){
		if(confirm("Sure to delete?")){
		$.ajax({
			type: "post",
			url: "deldoctor.php", //this is my servlet
			data: {
				id:x,
			},
			success: function(msg) {
				alert(msg);
				$('#doctor_name').val('');
				window.location.reload(true);
			
			}
		});
		} 
	}
	
	
	function delete_room(x){
		if(confirm("Sure to delete?")){
		$.ajax({
			type: "post",
			url: "delroom.php", //this is my servlet
			data: {
				id:x,
			},
			success: function(msg) {
				alert(msg);
				window.location.reload(true);
			
			}
		});
		} 
	}
	
$('table').on('click', 'a[name="editbranch"]', function (e) {
		if(confirm("Sure to edit record?")){
		
			var row = $(this).closest("tr");
			var branch = row.find("td").eq(1).text();
			//var role = row.find("td").eq(2).text();
			var id = row.find("td").eq(2).text();
			$("#addbra").hide();
			$("#editbr").show();
			$("#branch").val(branch);
			$("#branchid").val(id);	
		}
	});
	
	$('table').on('click', 'a[name="editward"]', function (e) {
		if(confirm("Sure to edit record?")){
			var row = $(this).closest("tr");
            var ward_name = row.find("td").eq(1).text();
			var description = row.find("td").eq(2).text();
			var id = row.find("td").eq(3).text();
			$("#addwar").hide();
			$("#editwar").show();
			$("#ward_name").val(ward_name);
			$("#description").val(description);
			$("#id").val(id);		
		}
	});
	
	
	
	
	$('table').on('click', 'a[name="editservice"]', function (e) {
		if(confirm("Sure to edit record?")){
			var row = $(this).closest("tr");
            var service_name  = row.find("td").eq(1).text();
			var types = row.find("td").eq(2).text();
			var amount = row.find("td").eq(3).text();
			var id = row.find("td").eq(4).text();
			$("#addser").hide();
			$("#editser").show();
			$("#service_name").val(service_name);
			$("#types").val(types);
			$("#amount").val(amount);
			$("#id").val(id);		
		}
	});
	
	
	
	
	$('table').on('click', 'a[name="edittypesss"]', function (e) {
		if(confirm("Sure to edit record?")){
			var row = $(this).closest("tr");
            var type_name  = row.find("td").eq(1).text();
			var amounts = row.find("td").eq(2).text();
			var id = row.find("td").eq(3).text();
			$("#addtypess").hide();
			$("#edittypess").show();
			$("#type_name").val(type_name);
			$("#amounts").val(amounts);
			$("#id").val(id);		
		}
	});
	
	
	$('table').on('click', 'a[name="editprocedure"]', function (e) {
		if(confirm("Sure to edit record?")){
			var row = $(this).closest("tr");
            var procedure_name  = row.find("td").eq(1).text();
			var ptypes = row.find("td").eq(2).text();
			var pamount = row.find("td").eq(3).text();
			var id = row.find("td").eq(4).text();
			$("#addproc").hide();
			$("#editproc").show();
			$("#procedure_name").val(service_name);
			$("#ptypes").val(types);
			$("#pamount").val(amount);
			$("#id").val(id);		
		}
	});
	
	$('table').on('click', 'a[name="editvisit"]', function (e) {
		if(confirm("Sure to edit record?")){
			var row = $(this).closest("tr");
            var visit_name  = row.find("td").eq(1).text();
			var vtypes = row.find("td").eq(2).text();
			var vamount = row.find("td").eq(3).text();
			var id = row.find("td").eq(4).text();
			$("#addvis").hide();
			$("#editvis").show();
			$("#visit_name").val(service_name);
			$("#vtypes").val(types);
			$("#vamount").val(amount);
			$("#id").val(id);		
		}
	});
	
	
	
	$('table').on('click', 'a[name="editdoctor"]', function (e) {
		if(confirm("Sure to edit record?")){
			var row = $(this).closest("tr");
			var department_name = row.find("td").eq(1).text();
            var doctor_name = row.find("td").eq(2).text();
			var mobile_no = row.find("td").eq(3).text();
			var id = row.find("td").eq(4).text();
			$("#adddoc").hide();
			$("#editdoc").show();
			$("#department_name").val(department_name);
			$("#doctor_name").val(doctor_name);
			$("#mobile_no").val(mobile_no);
			$("#id").val(id);		
		}
	});
	
	
	
	$('table').on('click', 'a[name="editdept"]', function (e) {
		if(confirm("Sure to edit record?")){
			var row = $(this).closest("tr");
			var department_names = row.find("td").eq(1).text();
            var descriptions = row.find("td").eq(2).text();
			var id = row.find("td").eq(3).text();
			$("#adddepart").hide();
			$("#editdepart").show();
			$("#department_names").val(department_names);
			$("#descriptions").val(descriptions);
			$("#id").val(id);		
		}
	});
	
	
	
	$('table').on('click', 'a[name="editroom"]', function (e) {
		if(confirm("Sure to edit record?")){
			var row = $(this).closest("tr");
			var ward_select_name = row.find("td").eq(1).text();
			$(this).parents('.btn-group').find('.dropdown-toggle').html(ward_select_name+'<span class="caret"></span>');
			var room = row.find("td").eq(2).text();
			var rate = row.find("td").eq(3).text();
			var id = row.find("td").eq(4).text();
			$("#addroo").hide();
			$("#editroo").show();
			$("#ward_names").val(ward_names);
			$("#room").val(room);
			$("#rate").val(rate);
			$("#id").val(id);		
		}
	});
	
//$('#user').on('click', 'a[name="editimg"]', function (e) {
	function edit_user(this_row){
	//alert('user');
		if(confirm("Sure to edit record?")){
			var row = $(this_row).closest("tr");
			var name = row.find("td").eq(1).text();
			var role = row.find("td").eq(2).text();
			var id = row.find("td").eq(3).text();
			var real_name = row.find("td").eq(4).text();
			//alert(id);alert(name);alert(role);
			$("#addus").hide();
			$("#editus").show();
			$("#user_real_name").val(real_name);
			$("#username").val(name);
			$('#username').attr('readonly', true);
			role= $.trim(role);
		
			if(role=="Admin")
			role=1;
			else if(role=="User")
			role=2;	
			else if(role=="Lab")
			role=3;	
			else if(role=="Cashier")
			role=4;	
			else if(role=="Ward")
			role=5;	
			else if(role=="ICU")
			role=6;	
			else if(role=="OT")
			role=7;	
			else if(role=="ER")
			role=8;	
				//alert(role);		
			$("#role").val(role).selectpicker('refresh');
			$("#id").val(id);		
			
		}
	}
	//});

		
	function savebranch()
	{
		if ($('#branch').val() == "") {
			alert('Branch cannot be left blank!');
			return false;
		}
		
		$.ajax({
			type: "post",
			url: "addbranch.php", //this is my servlet
			data: {
				branch: $('#branch').val(),
				id: $('#branchid').val(),
				},
			success: function(msg) {
				alert(msg);
				$('#branch').val('');
				$('#branchid').val('');
				//$('#password').val('');
			}
		});
		}
		
		
		function addbranch()
	{
		if ($('#branch').val() == "") {
			alert('Branch cannot be left blank!');
			return false;
		}
		var id="";
		$.ajax({
			type: "post",
			url: "addbranch.php", //this is my servlet
			data: {
				branch: $('#branch').val(),
				id: id,
				},
			success: function(msg) {
				alert(msg);
				$('#branch').val('');
				$('#branchid').val('');
				//$('#password').val('');
			}
		});
		}
		
		/****************/
		function saveward()
	{
		if ($('#ward_name').val() == "") {
			alert('Ward Name cannot be left blank!');
			return false;
		}
		$.ajax({
			type: "post",
			url: "addward.php", //this is my servlet
			data: {
				ward_name: $('#ward_name').val(),
				description: $('#description').val(),
				id: $('#id').val(),
				},
			success: function(msg) {
				alert(msg);
				$('#ward_name').val('');
				$('#description').val('');
				$('#id').val('');
				window.location.reload(true);
			}
		});
		}
		
		
		function addward()
	{
		if ($('#ward_name').val() == "") {
			alert('Ward cannot be left blank!');
			return false;
		}
		$.ajax({
			type: "post",
			url: "addward.php", 
			data: {
				ward_name : $('#ward_name').val(),
				description : $('#description').val(),
				},
			success: function(msg) {
				$('#ward_name').val('');
				window.location.reload(true);
			}
		});
		}
		
				
		function saveservice()
	{
		if ($('#service_name').val() == "") {
			alert('Service Name cannot be left blank!');
			return false;
		}
		if ($('#types').val() == "") {
			alert('Type cannot be left blank!');
			return false;
		}
		if ($('#amount').val() == "") {
			alert('Amount cannot be left blank!');
			return false;
		}
		$.ajax({
			type: "post",
			url: "addservice.php", //this is my servlet
			data: {
				service_name: $('#service_name').val(),
				types: $('#types').val(),
				amount: $('#amount').val(),
				id: $('#id').val(),
				},
			success: function(msg) {
				alert(msg);
				window.location.reload(true);
			}
		});
		}
		
		
		function addservice()
	{
		if ($('#service_name').val() == "") {
			alert('Service Name cannot be left blank!');
			return false;
		}
		if ($('#types').val() == "") {
			alert('Type cannot be left blank!');
			return false;
		}
		if ($('#amount').val() == "") {
			alert('Amount cannot be left blank!');
			return false;
		}
		$.ajax({
			type: "post",
			url: "addservice.php", 
			data: {
				service_name : $('#service_name').val(),
				types : $('#types').val(),
				amount : $('#amount').val(),
				},
			success: function(msg) {
				window.location.reload(true);
			}
		});
		}
		
		
		
		
		
		
		
		
		function savetype()
	{
		if ($('#type_name').val() == "") {
			alert('Type Name cannot be left blank!');
			return false;
		}
		
		if ($('#amounts').val() == "") {
			alert('Amount cannot be left blank!');
			return false;
		}
		$.ajax({
			type: "post",
			url: "addtype.php", 
			data: {
				type_name: $('#type_name').val(),
				amount: $('#amounts').val(),
				id: $('#id').val(),
				},
			success: function(msg) {
				alert(msg);
				window.location.reload(true);
			}
		});
		}
		
		
		function addtype()
	{
		if ($('#type_name').val() == "") {
			alert('Type Name cannot be left blank!');
			return false;
		}
		
		if ($('#amounts').val() == "") {
			alert('Amount cannot be left blank!');
			return false;
		}
		$.ajax({
			type: "post",
			url: "addtype.php", 
			data: {
				type_name : $('#type_name').val(),
				amount : $('#amounts').val(),
				},
			success: function(msg) {
				window.location.reload(true);
			}
		});
		}
		
		
		
		
		function saveprocedure()
	{
		if ($('#procedure_name').val() == "") {
			alert('Procedure Name cannot be left blank!');
			return false;
		}
		if ($('#ptypes').val() == "") {
			alert('Type cannot be left blank!');
			return false;
		}
		if ($('#pamount').val() == "") {
			alert('Amount cannot be left blank!');
			return false;
		}
		$.ajax({
			type: "post",
			url: "addprocedure.php", //this is my servlet
			data: {
				procedure_name: $('#procedure_name').val(),
				ptypes: $('#ptypes').val(),
				pamount: $('#pamount').val(),
				id: $('#id').val(),
				},
			success: function(msg) {
				alert(msg);
				window.location.reload(true);
			}
		});
		}
		
		
		function addprocedure()
	{
		if ($('#procedure_name').val() == "") {
			alert('Procedure Name cannot be left blank!');
			return false;
		}
		if ($('#ptypes').val() == "") {
			alert('Type cannot be left blank!');
			return false;
		}
		if ($('#pamount').val() == "") {
			alert('Amount cannot be left blank!');
			return false;
		}
		$.ajax({
			type: "post",
			url: "addprocedure.php", 
			data: {
				procedure_name : $('#procedure_name').val(),
				ptypes : $('#ptypes').val(),
				pamount : $('#pamount').val(),
				},
			success: function(msg) {
				window.location.reload(true);
			}
		});
		}
		
		
		
		
		
		
		
		function savevisit()
	{
		if ($('#visit_name').val() == "") {
			alert('Visit Name cannot be left blank!');
			return false;
		}
		if ($('#vtypes').val() == "") {
			alert('Type cannot be left blank!');
			return false;
		}
		if ($('#vamount').val() == "") {
			alert('Amount cannot be left blank!');
			return false;
		}
		$.ajax({
			type: "post",
			url: "addvisit.php", //this is my servlet
			data: {
				visit_name: $('#visit_name').val(),
				vtypes: $('#vtypes').val(),
				vamount: $('#vamount').val(),
				id: $('#id').val(),
				},
			success: function(msg) {
				alert(msg);
				window.location.reload(true);
			}
		});
		}
		
		
		function addvisit()
	{
		if ($('#visit_name').val() == "") {
			alert('Visit Name cannot be left blank!');
			return false;
		}
		if ($('#vtypes').val() == "") {
			alert('Type cannot be left blank!');
			return false;
		}
		if ($('#vamount').val() == "") {
			alert('Amount cannot be left blank!');
			return false;
		}
		$.ajax({
			type: "post",
			url: "addvisit.php", 
			data: {
				visit_name : $('#visit_name').val(),
				vtypes : $('#vtypes').val(),
				vamount : $('#vamount').val(),
				},
			success: function(msg) {
				window.location.reload(true);
			}
		});
		}
		
		
		
		function savedept()
	{
		if ($('#department_names').val() == "") {
			alert('Department cannot be left blank!');
			return false;
		}
		$.ajax({
			type: "post",
			url: "adddept.php", //this is my servlet
			data: {
				department_names: $('#department_names').val(),
				descriptions: $('#descriptions').val(),
				id: $('#id').val(),
				},
			success: function(msg) {
				alert(msg);
				$('#department_names').val('');
				$('#descriptions').val('');
				$('#id').val('');
				window.location.reload(true);
			}
		});
		}
		
		
		function adddept()
	{
		if ($('#department_names').val() == "") {
			alert('Department cannot be left blank!');
			return false;
		}
		$.ajax({
			type: "post",
			url: "adddept.php", 
			data: {
				department_names : $('#department_names').val(),
				descriptions : $('#descriptions').val(),
				},
			success: function(msg) {
				$('#department_names').val('');
				$('#descriptions').val('');
				window.location.reload(true);
			}
		});
		}
		
		function savedoctor()
	{
		if ($('#department_name').val() == "") {
			alert('Department Name cannot be left blank!');
			return false;
		}
		if ($('#doctor_name').val() == "") {
			alert('Doctor Name cannot be left blank!');
			return false;
		}
		if ($('#mobile_no').val() == "") {
			alert('Mobile No cannot be left blank!');
			return false;
		}
		$.ajax({
			type: "post",
			url: "adddoctor.php", //this is my servlet
			data: {
				department_name: $('#department_name').val(),
				doctor_name: $('#doctor_name').val(),
				mobile_no: $('#mobile_no').val(),
				id: $('#id').val(),
				},
			success: function(msg) {
				alert(msg);
				$('#department_name').val('');
				$('#doctor_name').val('');
				$('#mobile_no').val('');
				$('#id').val('');
				window.location.reload(true);
			}
		});
		}
		
		
		function adddoctor()
	{
		if ($('#department_name').val() == "") {
			alert('Department Name cannot be left blank!');
			return false;
		}
		if ($('#doctor_name').val() == "") {
			alert('Doctor Name cannot be left blank!');
			return false;
		}
		if ($('#mobile_no').val() == "") {
			alert('Mobile No cannot be left blank!');
			return false;
		}
		$.ajax({
			type: "post",
			url: "adddoctor.php", 
			data: {
				department_name : $('#department_name').val(),
				doctor_name : $('#doctor_name').val(),
				mobile_no : $('#mobile_no').val(),
				},
			success: function(msg) {
				$('#department_name').val('');
				$('#doctor_name').val('');
				$('#mobile_no').val('');
				window.location.reload(true);
			}
		});
		}
		
		
		
		function saveroom()
	{
		if ($('#ward_names').val() == "") {
			alert('Ward Name cannot be left blank!');
			return false;
		}
		if ($('#room').val() == "") {
			alert('Room No cannot be left blank!');
			return false;
		}
		if ($('#rate').val() == "") {
			alert('Rate cannot be left blank!');
			return false;
		}
		$.ajax({
			type: "post",
			url: "addroom.php", 
			data: {
				ward_names: $('#ward_names').val(),
				room: $('#room').val(),
				rate: $('#rate').val(),
				id: $('#id').val(),
				},
			success: function(msg) {
				alert(msg);
				$('#ward_names').val('');
				$('#room').val('');
				$('#rate').val('');
				$('#id').val('');
				window.location.reload(true);
			}
		});
		}
		
		

		function get_user_list(){
		
		$.ajax({
			type: "post",
			url: "user_list.php", //this is my servlet
			success: function(msg) {
				$('#usertable').html(msg);
				
			}
		});
		}
	function saveuser()
	{
		if ($('#user_real_name').val() == "") {
			alert('Name cannot be left blank!');
			return false;
		}
		if ($('#username').val() == "") {
			alert('UserName cannot be left blank!');
			return false;
		}
		else if ($('#password').val() == "") {
			alert('Password cannot be left blank!');
			return false;
		}
		$.ajax({
			type: "post",
			url: "adduser.php", //this is my servlet
			data: {
				name: $('#user_real_name').val(),
				user: $('#username').val(),
				pass: $('#password').val(),
				role: $('#role').val(),
				id: $('#id').val(),
			},
			success: function(msg) {
				alert(msg);
				$('#user_real_name').val('');
				$('#username').val('');
				$('#password').val('');
				$('#id').val('');
				$("#addus").show();
				$("#editus").hide();
				$('#username').attr('readonly', false);
				get_user_list();
			}
		});
		}
		
		function adduser()
	{
		if ($('#user_real_name').val() == "") {
			alert('Name cannot be left blank!');
			return false;
		}
		if ($('#username').val() == "") {
			alert('UserName cannot be left blank!');
			return false;
		}
		else if ($('#password').val() == "") {
			alert('Password cannot be left blank!');
			return false;
		}
		var id="";
		$.ajax({
			type: "post",
			url: "adduser.php", //this is my servlet
			data: {
				name: $('#user_real_name').val(),
				user: $('#username').val(),
				pass: $('#password').val(),
				role: $('#role').val(),
				id:id,
			},
			success: function(msg) {
				alert(msg);
				$('#username').val('');
				$('#password').val('');
				get_user_list();
			}
		});
		}
		
		
$(document).ready(function() {
	$('.select').selectpicker();
	$('#sel_table').on('change', function() {

		$('#sel_content').empty();
		if ($('#sel_table').val() == "1") {
			$('#sel_content').append(new Option('Select Table'));
			return false;
		}
		if ($('#sel_table').val() == "2")
		var sel="Psychiatric Symptoms";
			if ($('#sel_table').val() == "3")
		var sel="Other Symptoms";
		
		if ($('#sel_table').val() == "4")
		var sel="Family / Others History";
		
		
		$.ajax({
			type: "post",
			url: "getcontent.php", //this is my servlet
			data: {
				content: sel,
			},
			success: function(msg) {
				var arr = msg.split(';');
				$.each(arr, function(index,value){
					$('#sel_content').append(new Option(value)).selectpicker('refresh');
				});
			}
		});
	});
});


function update()
	{
	//alert('');
		if ($('#newtxt').val() == "") {
			alert('Textbox cannot be left blank');
			return false;
		}
		if ($('#sel_table').val() == "2")
		var sel="Psychiatric Symptoms";
			if ($('#sel_table').val() == "3")
		var sel="Other Symptoms";
		
		if ($('#sel_table').val() == "4")
		var sel="Family / Others History";
		$.ajax({
			type: "post",
			url: "updatesym.php", //this is my servlet
			data: {
				table: sel,
				old: $('#sel_content').val(),
				new : $('#newtxt').val()
			},
			success: function(msg) {
				alert(msg);
				$('#sel_table').val('1');$('#sel_content').empty();$('#newtxt').val('');
			}
		});
	}
	
	function del()
	{
		if ($('#sel_content').val() == "") {
			alert('Select symptoms to delete!');
			return false;
		}
			if ($('#sel_table').val() == "2")
		var sel="Psychiatric Symptoms";
			if ($('#sel_table').val() == "3")
		var sel="Other Symptoms";
		
		if ($('#sel_table').val() == "4")
		var sel="Family / Others History";
		
		$.ajax({
			type: "post",
			url: "deletesym.php", //this is my servlet
			data: {
				table: $('#sel_table').val(),
				old: $('#sel_content').val(),
			},
			success: function(msg) {
				alert(msg);
				$('#sel_table').val('');$('#sel_content').val('Select Table');$('#newtxt').val('');
			}
		});
		}
	function addroom()
	{
		if ($('#ward_names').val() == "") {
			alert('Ward Name cannot be left blank!');
			return false;
		}
		if ($('#room').val() == "") {
			alert('Room No cannot be left blank!');
			return false;
		}
		if ($('#rate').val() == "") {
			alert('Rate cannot be left blank!');
			return false;
		}
		$.ajax({
			type: "post",
			url: "addroom.php", 
			data: {
				ward_names : $('#ward_names').val(),
				room : $('#room').val(),
				rate : $('#rate').val(),
				},
			success: function(msg) {
				$('#ward_names').val('');
				$('#room').val('');
				$('#rate').val('');
				window.location.reload(true);
				$( "#tab-nine" ).tabs({ active: 9 });
			}
		});
		}
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




	
    </body>

<!-- Mirrored from aqvatarius.com/themes/atlant/html/pages-edit-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2015 09:47:54 GMT -->
</html>



