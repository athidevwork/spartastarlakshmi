<?php
session_start();
$role=$_SESSION['role'];
//$pid=$_REQUEST['pid'];
 include("config_db1.php");
 $cmd=mysql_query("select * from settings where role='$role'");
 mysql_close($db1);
$sql=mysql_fetch_array($cmd);

if($sql['patientinfo'] !=1)
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
	function get_room_name($room)
  {
	  		include("config_db1.php");
    $sql2="select room from  room_no where id='$room'"; 
  $rs2=mysql_query($sql2);
	while($rsdata2=mysql_fetch_array($rs2))
	  {
	   $room=$rsdata2['room'];
  		}
  return $room;
  }
  function get_dept_names($id)
{include("config_db1.php");
					$cmd_ser1 = "select department_names from department_creation where id='$id'";
					$res_ser1 = mysql_query($cmd_ser1);
					while($rs_ser1 = mysql_fetch_array($res_ser1))
					{
								$name=$rs_ser1['department_names'];
                     }
                                return $name;

}
function get_consult_names($id)
{include("config_db1.php");
					$cmd_ser2 = "select doctor_name from doctor_creation where id='$id'";
					$res_ser2 = mysql_query($cmd_ser2);
					while($rs_ser2 = mysql_fetch_array($res_ser2)){
								$name=$rs_ser2['doctor_name'];
                                }
                                return $name;
}
function get_visit_names($id)
{include("config_db1.php");
					$cmd_ser3 = "select visit_name,vtypes from visit_creation where id='$id'";
					$res_ser3 = mysql_query($cmd_ser3);
					while($rs_ser3 = mysql_fetch_array($res_ser3)){
								$name=$rs_ser3['visit_name'];
                                $vtypes=$rs_ser3['vtypes'];
                                }
                                return $name."/".$vtypes;

}

?>

<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from aqvatarius.com/themes/atlant/html/pages-edit-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2015 09:47:47 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>        
        <!-- META SECTION -->
        <title>DPP- Admission Entry</title>            
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
                    
                    
					
				<?php
if($pid !="" && $sql['patientinfo']==1)
{
								include("config_db2.php");
	$cmd = "select id,branch, patientid, patientsalutation, patientname, guardiansalutation, guardianname, age, gender, contactno, occupation, address, cast(time as date) as time from patientdetails where patientid='$pid'";
	$res = mysql_query($cmd);
	$rs = mysql_fetch_array($res);
	?>
                <div class="page-content-wrap">
                    
                    <div class="row">
                        <div class="col-md-3">
                            
                            <div class="panel panel-default">
                                <div class="panel-body profile" style="background: url('assets/images/gallery/music-4.jpg') center center no-repeat;">
                                    <div class="profile-image">
                                       <!-- <img src="assets/images/users/user3.jpg" returnpatimg.php?id="+x[13]  alt="Nadia Ali"/>-->
									    <img src="returnpatimg.php?id=<?php echo $rs[id]; ?>"  alt="Nadia Ali"/>
                                    </div>
                                    <div class="profile-data">
                                        <div class="profile-data-name"><?php echo $rs['patientsalutation'].'&nbsp;&nbsp;'. $rs['patientname'];?></div>
                                        <div class="profile-data-title" style="color: #FFF;"><?php echo $rs['patientid'];?></div>
										
                                    </div>
                                    <div class="profile-controls">
									<?php if($pid!=0) { echo '<a href="#"  onClick="edit(\''.$rs['patientid'].'\')"  class="profile-control-left twitter"><span style="color:#3B2879" class="fa fa-pencil"></span></a>'; ?>
                                        <!--<a href="#" class="profile-control-left twitter"><span class="fa fa-twitter"></span></a>-->
										<a href="complaints.php?pid=<?php echo $pid; ?>" class="profile-control-right twitter"><span style="color:#3B2879" class="fa fa-eye"></span></a><?php }?>
                                    </div>                                    
                                </div>   
							                             
                                <div class="panel-body">                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="btn btn-info btn-rounded btn-block"><?php echo $rs['branch'];?></div>
                                        </div>
										<div class="col-md-6">
                                            <div class="btn btn-info btn-rounded btn-block"><?php echo $rs['contactno'];?></div>
                                        </div>
										<div class="col-md-12">
										<div class="col-md-6">
										<div><b>Branch</b></div>
										</div>
										<div class="col-md-6">
										<?php echo '<div>'.$rs['branch'].'&nbsp;</div>'; ?>
										</div>
										<div class="col-md-6">
										<div><b>Guardian</b></div>
										</div>
										<div class="col-md-6">
										<?php echo '<div>'.$rs['guardiansalutation'].' '.$rs['guardianname'].'&nbsp;</div>'; ?>
										</div>
										<div class="col-md-6">
											<div><b>Gender</b></div>
											</div>
											<div class="col-md-6">
											<?php echo '<div>'.$rs['gender'].'&nbsp;</div>'; ?>
											</div>
											<div class="col-md-6">
												<div><b>Occupation</b></div>
												</div>
												<div class="col-md-6">
												<?php echo '<div>'.$rs['occupation'].'&nbsp;</div>'; ?>
												</div>
												<div class="col-md-6">
												<div><b>Address</b></div>
												</div>
												<div class="col-md-6">
												<?php echo '<div>'.$rs['address'].'&nbsp;</div>';?>
												</div>
												<div class="col-md-6">
												<div><b>Date</b></div>
												</div>
												<div class="col-md-6">
												<?php echo '<div>'.$rs['time'].'&nbsp;</div>';?>
												</div>
												<?php
													$query2 = "SELECT id,source FROM inv_patient WHERE patientid='$pid' AND pat_ip_status=0 ORDER BY id DESC LIMIT 1";
													$res2 = mysql_query($query2);
													//echo $query2;
													
													if(mysql_num_rows($res2) != 0){
													$rs = mysql_fetch_array($res2);
												?>
												<div class="col-md-6">
												<div><b>Room type</b></div>
												</div>
												<div class="col-md-6">
												<?php echo '<div>'.$rs['source'].'&nbsp;</div>';?>
												</div>
												<?php
													}
													?>
												</div>	  
                                    </div>
                                </div>
								 <div class="panel-body list-group border-bottom">
								<?php
								$query2 = "SELECT cast(datetime as date) as datetime,prescribed_by, diabetes, hypertension, coronary, asthma, medicalhistory, familyhistory, personalhistory, psychiatrichistory,allergies,bloodgroup FROM medicalhistory WHERE patientid='$pid' ORDER BY id DESC LIMIT 1";
	$res2 = mysql_query($query2);
	//echo $query2;
	$rs = mysql_fetch_array($res);
	if(mysql_num_rows($res2) != 0){
	
	while($rs2 = mysql_fetch_array($res2)){
	if($rs2['diabetes']=='Yes') {
	echo '<div class="list-group-item"><img src="img/med/diabet.png"  width="20px" height="20px" alt="Diabetes"/> Diabetes <span class="badge badge-danger">'.$rs2['diabetes'].'</span></div>'; }
	if($rs2['hypertension']=='Yes') {
	echo '<div class="list-group-item"><img src="img/med/diabet.png" width="20px" height="20px" alt="Hypertension"/> Hypertension <span class="badge badge-danger">'.$rs2['hypertension'].'</span></div>'; }
	if($rs2['coronary']=='Yes') {
	echo '<div class="list-group-item"><img src="img/med/diabet.png" width="20px" height="20px" alt="Seizures"/> Seizures <span class="badge badge-danger">'.$rs2['coronary'].'</span></div>'; }
	if($rs2['cad']=='Yes') {
	echo '<div class="list-group-item"><img src="img/med/diabet.png" width="20px" height="20px" alt="Seizures"/> Seizures <span class="badge badge-danger">'.$rs2['cad'].'</span></div>'; }
	
	if($rs2['asthma']=='Yes') {
	echo '<div class="list-group-item"><img src="img/med/diabet.png" width="20px" height="20px" alt="Asthma"/> Asthma <span class="badge badge-danger">'.$rs2['asthma'].'</span></div>'; }
	if($rs2['bloodgroup']!='') {
	echo '<div class="list-group-item"  data-container="body" data-toggle="popover" data-placement="top" data-html="true" data-content="'.$rs2['familyhistory'].'"><strong>Blood Group </strong> <span class="badge badge-danger">'.$rs2['bloodgroup'].'</span></div>
	'; }
	
	if($rs2['allergies']!='') {
	echo '<div class="list-group-item"  data-container="body" data-toggle="popover" data-placement="top" data-html="true" data-content="'.$rs2['familyhistory'].'"><strong>Allergies </strong></div>
	<div class="list-group-item" data-html="true"  data-container="body" data-toggle="popover" data-placement="top" data-content="'.$rs2['allergies'].'">'.$rs2['allergies'].'</div>'; }
					
					if($rs2['familyhistory']!='') {
	echo '<div class="list-group-item"  data-container="body" data-toggle="popover" data-placement="top" data-html="true" data-content="'.$rs2['familyhistory'].'"><strong>Family History </strong></div>
	<div class="list-group-item" data-html="true"  data-container="body" data-toggle="popover" data-placement="top" data-content="'.$rs2['familyhistory'].'">'.$rs2['familyhistory'].'</div>'; }
	
	if($rs2['medicalhistory']!='') {
	echo '<div class="list-group-item" data-html="true"  data-container="body" data-toggle="popover" data-placement="top" data-content="'.$rs2['medicalhistory'].'"><b>Medical History</b></div>
	<div class="list-group-item" data-html="true"  data-container="body" data-toggle="popover" data-placement="top" data-content="'.$rs2['medicalhistory'].'">'.$rs2['medicalhistory'].'</div>'; }
	
	if($rs2['personalhistory']!='') {
	echo '<div class="list-group-item" data-html="true"  data-container="body" data-toggle="popover" data-placement="top" data-content="'.$rs2['personalhistory'].'"><strong>Personal History</strong></div>
	<div class="list-group-item" data-html="true"  data-container="body" data-toggle="popover" data-placement="top" data-content="'.$rs2['personalhistory'].'">'.$rs2['personalhistory'].'</div>'; }
	
	if($rs2['psychiatrichistory']!='') {
	echo '<div class="list-group-item" data-html="true"  data-container="body" data-toggle="popover" data-placement="top" data-content="'.$rs2['psychiatrichistory'].'"><strong>Paediatric History:</strong>
	<div class="list-group-item" data-html="true"  data-container="body" data-toggle="popover" data-placement="top" data-content="'.$rs2['psychiatrichistory'].'">'.$rs2['psychiatrichistory'].'</div> </div>'; }}
	
	}
?>
     
	                            </div>
								<?php 
									//include("config_db2.php");
									//echo "SELECT sum(bal_amt)  FROM billing where patientid ='$pid' and balance='1' order by id asc LIMIT 1";
									$fee1 = mysql_query("SELECT sum(bal_amt) as bal_amt  FROM billing where patientid ='$pid' and balance='1' order by id asc LIMIT 1");
									//mysql_close($db1);
									$fee=mysql_fetch_array($fee1);
									if($fee['bal_amt']=="" || $fee['bal_amt']=="NULL" || $fee['bal_amt']==0)
									$due= 'No due';
									else
									$due= 'Rs '.$fee['bal_amt'];
									?>
                                <div class="panel-body">
                                    <h4 class="text-title">Due Payments <span class="badge badge-danger pull-right"><?php echo $due; ?></span></h4>
                                    <div class="row">
									
									
									
                                        <!--<div class="col-md-4 col-xs-4">
                                            <a href="#" class="friend">
                                                <img src="assets/images/users/user.jpg"/>
                                                <span>Dmitry Ivaniuk</span>
                                            </a>                                            
                                        </div>
                                        <div class="col-md-4 col-xs-4">                                            
                                            <a href="#" class="friend">
                                                <img src="assets/images/users/user2.jpg"/>
                                                <span>John Doe</span>
                                            </a>                                            
                                        </div>
                                        <div class="col-md-4 col-xs-4">                                            
                                            <a href="#" class="friend">
                                                <img src="assets/images/users/user4.jpg"/>
                                                <span>Brad Pit</span>
                                            </a>                                            
                                        </div> -->
                                    </div>
                                    <div class="row">
                                       <!-- <div class="col-md-4 col-xs-4">                                            
                                            <a href="#" class="friend">
                                                <img src="assets/images/users/user5.jpg"/>
                                                <span>John Travolta</span>
                                            </a>                                            
                                        </div>
                                        <div class="col-md-4 col-xs-4">                                            
                                            <a href="#" class="friend">
                                                <img src="assets/images/users/user6.jpg"/>
                                                <span>Darth Vader</span>
                                            </a>                                            
                                        </div>
                                        <div class="col-md-4 col-xs-4">                                            
                                            <a href="#" class="friend">
                                                <img src="assets/images/users/user7.jpg"/>
                                                <span>Samuel Leroy Jackson</span>
                                            </a>                                            
                                        </div> -->
                                    </div>
                                
                                    <h4 class="text-title">Scan Documents</h4>
                                    <div class="gallery" id="links">
									 
									<?php
									$query2 = "SELECT * FROM  record WHERE pid='$pid'"; 
								$res2 = mysql_query($query2);
								//echo $query2;
								//$rs = mysql_fetch_array($res);
								if(mysql_num_rows($res2) != 0){
								
								while($rs2 = mysql_fetch_array($res2)){
									
									echo ' <a href="return_scan.php?id='.$rs2['id'].'" title="Scan Image" class="gallery-item" data-gallery>
                                            <div class="image">
                                                <img src="return_scan.php?id='.$rs2['id'].'" alt="Scan Image"/>
                                            </div>                                            
                                        </a>';
									}}
									?>                                               
                                       
                                                        
                                    </div>
                                </div>
                            </div>                            
                            
                        </div>
                        
                        <div class="col-md-9">
						<!-- START TIMELINE -->
                            <div class="timeline timeline-right">
						    <div class="timeline-item timeline-main">
                                    <div class="timeline-date"><a href="complaints.php?pid=<?php echo $pid; ?>">Add New</a></div>
                                </div>
								</div>
							<?php
							$cdquery = "SELECT id,type,typeid,patientid,message,date FROM timeline WHERE patientid='$pid' ORDER BY id DESC";
							//echo $query1;
							$index = 1;
							$timeline_array = array();
							$cd = mysql_query($cdquery);
									while ($cd1 = mysql_fetch_array($cd)) {	//if(mysql_num_rows($res1) != 0){
									//$rs1 = mysql_fetch_array($res1);
									
									$date=date("Y-m-d",strtotime($cd1['date']));
									$existing_date=date("Y-m-d",strtotime($cd1['date']));
									$time=date("h:i-A",strtotime($cd1['date']));
									$timeline_id=$cd1['id'];
									$timeline_type=$cd1['type'];
									$timeline_typeid=$cd1['typeid'];
									$timeline_message=$cd1['message'];
									$dbresult_array = array('time'=>$time,'','timeline_id'=>$timeline_id,'timeline_type'=>$timeline_type,'timeline_typeid'=>$timeline_typeid,'timeline_message'=>$timeline_message);
									$timeline_array[$date][]=$dbresult_array;
									}
									$index = 1;
									foreach($timeline_array as $key => $value_array){
										
										$date = $key
										
									
							
							?>
                            
                            <div class="timeline timeline-right">
                                <!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-main" style="cursor:pointer" onClick="javascript:$('#divindex<?php echo $index; ?>').toggle(1000);">
                                    <div class="timeline-date"><?php echo $date; ?></div>
                                </div>
                                <!-- END TIMELINE ITEM -->       
								<?php if($index > 1) $css = 'style="display:none;"'; else $css = ''; ?>
                                <div id="divindex<?php echo $index; ?>" <?php echo $css ?> >
								
								<?php 
								foreach($value_array as $key => $values){
											$time=$values['time'];
											$timeline_id=$values['timeline_id'];
											$timeline_type=$values['timeline_type'];
											$timeline_message=$values['timeline_message'];
											$timeline_typeid=$values['timeline_typeid'];
										
								?>
															<?php if($timeline_type =='dischargepatient'){ ?>
								<!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-item-right">
                                    <div class="timeline-item-info"><?php echo $time; ?></div>
                                    <div class="timeline-item-icon"><span style="color:#3A267D" class="fa fa-edit"></span>
									</div>                                   
                                    <div class="timeline-item-content">
                                        <div class="timeline-heading" style="padding-bottom: 10px;">
                                            <img src="img/med/complaint.png"/>
                                            <a style="font-size:16px">Discharge</a>&nbsp;&nbsp;&nbsp; 
                                        </div>                                        
                                        <div class="timeline-body comments">
												<div class="col-md-12">Patient Discharged.</div>
                                           
                                        </div>
                                    </div>                                    
                                </div>       
                                <!-- END TIMELINE ITEM -->
								<?php } ?>
								<?php if($timeline_type =='addconsultantservice'){ ?>
								<!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-item-right">
                                    <div class="timeline-item-info"><?php echo $time; ?></div>
                                    <div class="timeline-item-icon"><span style="color:#3A267D" class="fa fa-edit"></span>
									</div>                                   
                                    <div class="timeline-item-content">
                                        <div class="timeline-heading" style="padding-bottom: 10px;">
                                            <img src="img/med/complaint.png"/>
                                            <a style="font-size:16px">Consultant Details</a>&nbsp;&nbsp;&nbsp; 
                                        </div>                                        
                                        <div class="timeline-body comments">
													<?php
										include("config_db2.php");
										
										$cmd_sitting_query = mysql_query("select department,consultant,visit from consultant_details WHERE id ='$timeline_typeid' LIMIT 1");
						$i=1;
						$cmd_sitting_num = mysql_num_rows($cmd_sitting_query);
						if($cmd_sitting_num >0){
						?>
										
								
										<div class="col-md-12">
								
						<?php
						
						while($cmd_sitting_array = mysql_fetch_array($cmd_sitting_query)){
						
						$department =get_dept_names($cmd_sitting_array['department']);
						$visit = get_visit_names($cmd_sitting_array['visit']);
						$consultant = get_consult_names($cmd_sitting_array['consultant']);
						echo '<table class="table table-striped table-bordered table-hover" width="30%">
														<thead>
														<tr>
														
														<th>Department</th>
														<th>Consultant</th>
														<th>Visit</th>
														
														</tr>
														</thead>
														<tbody>';
														echo '<tr><td>'.$department.'</td><td>'.$consultant.'</td><td>'.$visit.'</td></tr>';
														echo '</tbody></table>';
						
						}
						?>
						
										</div>
										<?php
						}
						?>                                        
                                           
                                        </div>
                                    </div>                                    
                                </div>       
                                <!-- END TIMELINE ITEM -->
								<?php } ?>
								<?php if($timeline_type =='addprocedures'){ ?>
								<!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-item-right">
                                    <div class="timeline-item-info"><?php echo $time; ?></div>
                                    <div class="timeline-item-icon"><span style="color:#3A267D" class="fa fa-edit"></span>
									</div>                                   
                                    <div class="timeline-item-content">
                                        <div class="timeline-heading" style="padding-bottom: 10px;">
                                            <img src="img/med/complaint.png"/>
                                            <a style="font-size:16px">Procedures Details</a>&nbsp;&nbsp;&nbsp; 
                                        </div>                                        
                                        <div class="timeline-body comments">
													<?php
										include("config_db2.php");
										
										$cmd_sitting_query = mysql_query("select procedure_name,duration,given_details,consultant from procedure_details WHERE id ='$timeline_typeid' LIMIT 1");
						$i=1;
						$cmd_sitting_num = mysql_num_rows($cmd_sitting_query);
						if($cmd_sitting_num >0){
						?>
										
								
										<div class="col-md-12">
								
						<?php
						
						while($cmd_sitting_array = mysql_fetch_array($cmd_sitting_query)){
						
						$procedure_name =$cmd_sitting_array['procedure_name'];
						$duration = $cmd_sitting_array['duration'];
						$given_details = $cmd_sitting_array['given_details'];
						$consultant = $cmd_sitting_array['consultant'];
						echo '<table class="table table-striped table-bordered table-hover" width="30%">
														<thead>
														<tr>
														
														<th>Procedure</th>
														<th>Duration</th>
														<th>Timings</th>
														<th>Consultant</th>
														</tr>
														</thead>
														<tbody>';
														echo '<tr><td>'.$procedure_name.'</td><td>'.$duration.'</td><td>'.$given_details.'</td><td>'.$consultant.'</td></tr>';
														echo '</tbody></table>';
						
						}
						?>
						
										</div>
										<?php
						}
						?>                                        
                                           
                                        </div>
                                    </div>                                    
                                </div>       
                                <!-- END TIMELINE ITEM -->
								<?php } ?>
								<?php if($timeline_type =='addservices'){ ?>
								<!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-item-right">
                                    <div class="timeline-item-info"><?php echo $time; ?></div>
                                    <div class="timeline-item-icon"><span style="color:#3A267D" class="fa fa-edit"></span>
									</div>                                   
                                    <div class="timeline-item-content">
                                        <div class="timeline-heading" style="padding-bottom: 10px;">
                                            <img src="img/med/complaint.png"/>
                                            <a style="font-size:16px">Services Details</a>&nbsp;&nbsp;&nbsp; 
                                        </div>                                        
                                        <div class="timeline-body comments">
													<?php
										include("config_db2.php");
										
										$cmd_sitting_query = mysql_query("select service_name,duration,given_details from services_details WHERE id ='$timeline_typeid' LIMIT 1");
						$i=1;
						$cmd_sitting_num = mysql_num_rows($cmd_sitting_query);
						if($cmd_sitting_num >0){
						?>
										
								
										<div class="col-md-12">
								
						<?php
						
						while($cmd_sitting_array = mysql_fetch_array($cmd_sitting_query)){
						
						$service_name =$cmd_sitting_array['service_name'];
						$duration = $cmd_sitting_array['duration'];
						$given_details = $cmd_sitting_array['given_details'];
						echo '<table class="table table-striped table-bordered table-hover" width="30%">
														<thead>
														<tr>
														
														<th>Services</th>
														<th>Duration</th>
														<th>Timings</th>
														</tr>
														</thead>
														<tbody>';
														echo '<tr><td>'.$service_name.'</td><td>'.$duration.'</td><td>'.$given_details.'</td></tr>';
														echo '</tbody></table>';
						
						}
						?>
						
										</div>
										<?php
						}
						?>                                        
                                           
                                        </div>
                                    </div>                                    
                                </div>       
                                <!-- END TIMELINE ITEM -->
								<?php } ?>
								<?php if($timeline_type =='addsittings'){ ?>
								<!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-item-right">
                                    <div class="timeline-item-info"><?php echo $time; ?></div>
                                    <div class="timeline-item-icon"><span style="color:#3A267D" class="fa fa-edit"></span>
									</div>                                   
                                    <div class="timeline-item-content">
                                        <div class="timeline-heading" style="padding-bottom: 10px;">
                                            <img src="img/med/complaint.png"/>
                                            <a style="font-size:16px">Physiotheropy Details</a>&nbsp;&nbsp;&nbsp; 
                                        </div>                                        
                                        <div class="timeline-body comments">
													<?php
										include("config_db2.php");
										
										$cmd_sitting_query = mysql_query("select type_name,sitting from sitting_details WHERE id ='$timeline_typeid' LIMIT 1");
						$i=1;
						$cmd_sitting_num = mysql_num_rows($cmd_sitting_query);
						if($cmd_sitting_num >0){
						?>
										
								
										<div class="col-md-12">
								
						<?php
						
						while($cmd_sitting_array = mysql_fetch_array($cmd_sitting_query)){
						
						$type_name =$cmd_sitting_array['type_name'];
						$sitting = $cmd_sitting_array['sitting'];
						echo '<table class="table table-striped table-bordered table-hover" width="30%">
														<thead>
														<tr>
														
														<th>Type Name</th>
														<th>Sitting</th>
														
														</tr>
														</thead>
														<tbody>';
														echo '<tr><td>'.$type_name.'</td><td>'.$sitting.'</td></tr>';
														echo '</tbody></table>';
						
						}
						?>
						
										</div>
										<?php
						}
						?>                                        
                                           
                                        </div>
                                    </div>                                    
                                </div>       
                                <!-- END TIMELINE ITEM -->
								<?php } ?>
								<?php if($timeline_type =='addroom'){ ?>
								<!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-item-right">
                                    <div class="timeline-item-info"><?php echo $time; ?></div>
                                    <div class="timeline-item-icon"><span style="color:#3A267D" class="fa fa-edit"></span>
									</div>                                   
                                    <div class="timeline-item-content">
                                        <div class="timeline-heading" style="padding-bottom: 10px;">
                                            <img src="img/med/complaint.png"/>
                                            <a style="font-size:16px">Allocated/Shifted Room</a>&nbsp;&nbsp;&nbsp; 
                                        </div>                                        
                                        <div class="timeline-body comments">
													<?php
										include("config_db2.php");
										
										$cmd_room_query = mysql_query("select room_id from room_bill_details WHERE id ='$timeline_typeid' LIMIT 1");
						$i=1;
						$cmd_room_num = mysql_num_rows($cmd_room_query);
						if($cmd_room_num >0){
						?>
										
								
										<div class="col-md-12">
								
						<?php
						
						while($cmd_room_array = mysql_fetch_array($cmd_room_query)){
						
						echo 'Patient Shifted to Room '.get_room_name($cmd_room_array['room_id']);
						
						}
						?>
						
										</div>
										<?php
						}
						?>                                        
                                           
                                        </div>
                                    </div>                                    
                                </div>       
                                <!-- END TIMELINE ITEM -->
								<?php } ?>
															<?php if($timeline_type =='vacateroom'){ ?>
								<!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-item-right">
                                    <div class="timeline-item-info"><?php echo $time; ?></div>
                                    <div class="timeline-item-icon"><span style="color:#3A267D" class="fa fa-edit"></span>
									</div>                                   
                                    <div class="timeline-item-content">
                                        <div class="timeline-heading" style="padding-bottom: 10px;">
                                            <img src="img/med/complaint.png"/>
                                            <a style="font-size:16px">Vacate Room</a>&nbsp;&nbsp;&nbsp; 
                                        </div>                                        
                                        <div class="timeline-body comments">
													<?php
										include("config_db2.php");
										//echo "select room_id from room_bill_details WHERE id ='$timeline_typeid' LIMIT 1";
										$cmd_room_query = mysql_query("select room_id from room_bill_details WHERE id ='$timeline_typeid' LIMIT 1");
						$i=1;
						$cmd_room_num = mysql_num_rows($cmd_room_query);
						if($cmd_room_num >0){
						?>
										
								
										<div class="col-md-12">
								
						<?php
						
						while($cmd_room_array = mysql_fetch_array($cmd_room_query)){
						
						echo 'Patient Vacated Room '.get_room_name($cmd_room_array['room_id']);
						
						}
						?>
						
										</div>
										<?php
						}
						?>                                        
                                           
                                        </div>
                                    </div>                                    
                                </div>       
                                <!-- END TIMELINE ITEM -->
								<?php } ?>
								<?php if($timeline_type =='addprescription'){ ?>
								<!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-item-right">
                                    <div class="timeline-item-info"><?php echo $time; ?></div>
                                    <div class="timeline-item-icon"><span style="color:#3A267D" class="fa fa-edit"></span>
									</div>                                   
                                    <div class="timeline-item-content">
                                        <div class="timeline-heading" style="padding-bottom: 10px;">
                                            <img src="img/med/complaint.png"/>
                                            <a style="font-size:16px">Medication Details</a>&nbsp;&nbsp;&nbsp; 
                                        </div>                                        
                                        <div class="timeline-body comments">
										
										
			<?php
			
  include("config_db2.php");
  	$query4 = "select id,cast(datetime as date)as datetime,prescribed_by from prescriptiondetail where patientid='$pid' AND id='$timeline_typeid' LIMIT 1";
	$res4 = mysql_query($query4);
	if(mysql_num_rows($res4) != 0){
		
		while($rs4 = mysql_fetch_array($res4)){
			$query5 = "select id,drugname,dosage,specification,frequency,duration from prescriptiondetail where patientid='$pid' AND id ='$timeline_typeid'";
			$res5 = mysql_query($query5);
			if(mysql_num_rows($res5) != 0){
				echo '<div class="table-responsive">
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
				echo '</tbody></table></div>';
			}
		}
	}
	mysql_close($db2);	
?>
                                        </div>
                                    </div>                                    
                                </div>       
                                <!-- END TIMELINE ITEM -->
								<?php } ?>
								
								<?php if($timeline_type =='addcomplaints'){ ?>
								<!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-item-right">
                                    <div class="timeline-item-info"><?php echo $time; ?></div>
                                    <div class="timeline-item-icon"><span style="color:#3A267D" class="fa fa-edit"></span>
									</div>                                   
                                    <div class="timeline-item-content">
                                        <div class="timeline-heading" style="padding-bottom: 10px;">
                                            <img src="img/med/complaint.png"/>
                                            <a style="font-size:16px">Complaints Details</a>&nbsp;&nbsp;&nbsp; 
                                        </div>                                        
                                        <div class="timeline-body comments">
										
												<?php											
                                           		$cno = $timeline_typeid;
												
		include("config_db2.php");
			$cmd_clinic_hist_query = mysql_query("select id,patient_id,complaints, dm, cad, asthma, seizure, diagnosis, room_no, consultant,  create_date from clinical_history WHERE id ='$cno' order by id desc LIMIT 1");
			$cmd_clinic_hist_array = mysql_fetch_array($cmd_clinic_hist_query);
	?>
	
									      
										  
									   <?php
										include("config_db2.php");
										
										$cmd_clinic_query = mysql_query("select id,type,reason,consultant,room_no from clinical_others WHERE clinical_history_id ='$cno' order by id desc");
						$i=1;$reason = array();
						$cmd_clinic_num = mysql_num_rows($cmd_clinic_query);
						if($cmd_clinic_num >0){
							while($cmd_clinic_array = mysql_fetch_array($cmd_clinic_query)){
								$type = $cmd_clinic_array['type'];
								$reason[$type][] =$cmd_clinic_array['reason'];
								$room_no = ($cmd_clinic_array['room_no']==0) ? '' : $cmd_clinic_array['room_no']; 
								$consultant =$cmd_clinic_array['consultant'];
								
							}
						}
							
						?>
						<div class="form-group">
									 <div class="col-md-6" align="center">
                                     <label class="col-md-12 control-label"  ><strong>Complaints</strong>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo (count($reason['complaints'])==0) ? 'Nil' : implode(',',$reason['complaints']);  ?></label>  
                                                                                    
												   </div>
									<div class="col-md-6" align="center">
                                     <label class="col-md-12 control-label"  ><strong>Diagnosis</strong>:&nbsp;&nbsp;&nbsp;&nbsp; <?php echo  (count($reason['diagnosis'])==0) ? 'Nil' : implode(',',$reason['diagnosis']);  ?></label>  
                                                                                    
												   </div>
						</div>      
                       
										
										  
										 <div class="col-md-3" align="left">
                                     <label class="col-md-8 control-label"  ><strong>DM</strong>:&nbsp;&nbsp;&nbsp;&nbsp;    <?php echo ($cmd_clinic_hist_array['dm']==0) ?  'NO' : 'YES' ?></label>  
                                                                                    
												   </div>
											   
                                   
                                                     <div class="col-md-3">
                                            <label class="col-md-4 control-label"  ><strong>CAD</strong>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($cmd_clinic_hist_array['cad']==0) ?  'NO' : 'YES' ?></label>  
                                                                                   
												   </div>  
										<div class="col-md-3" align="left">
                                     <label class="control-label"  ><strong>Asthma</strong>:&nbsp;&nbsp;&nbsp;&nbsp;    <?php echo ($cmd_clinic_hist_array['asthma']==0) ?  'NO' : 'YES' ?></label>  
                                                                                    
												   </div>
											   
                                   
                                                     <div class="col-md-3">
                                            <label class="col-md-4 control-label"  ><strong>Seizure</strong>:&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($cmd_clinic_hist_array['seizure']==0) ?  'NO' : 'YES' ?></label>  
                                                                                   
												   </div>		   
                       
										
										
										
								
																				<?php
						if(count($reason['Personal History']) > 0 || count($reason['Family History']) > 0 || count($reason['Others']) > 0){
						?>
								
								
										<div class="col-md-12">
										<h3>Details</h3>		
										<center>
	<table id="clinichist-dataTables" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                        <th>#</th>
					    <th>Type</th>
                        <th>Reason</th>
						<th>Room</th>
						<th>Consultant</th>
                        </tr>
                        </thead>
                        <tbody>
						
						
						<?php
						if(count($reason['Personal History']) > 0){
						?>
							<tr>
							<td><?php echo $i++; ?></td>
							<td>Personal History</td>
							<td><?php echo (count($reason['Personal History'])==0) ? 'Nil' : implode(',',$reason['Personal History']);  ?></td>
							<td><?php echo $room_no;  ?></td>
							<td><?php echo $consultant;  ?></td>
							</tr>
						<?php
						}
						?>
						<?php
						if(count($reason['Family History']) > 0){
						?>
							<tr>
							<td><?php echo $i++; ?></td>
							<td>Family History</td>
							<td><?php echo (count($reason['Family History'])==0) ? 'Nil' : implode(',',$reason['Family History']);  ?></td>
							<td><?php echo $room_no;  ?></td>
							<td><?php echo $consultant;  ?></td>
							</tr>
						<?php
						}
						?>
						<?php
						if(count($reason['Others']) > 0){
						?>
						
							<tr>
							<td><?php echo $i++; ?></td>
							<td>Others</td>
							<td><?php echo (count($reason['Others'])==0) ? 'Nil' : implode(',',$reason['Others']);  ?></td>
							<td><?php echo $room_no;  ?></td>
							<td><?php echo $consultant;  ?></td>
							</tr>
						<?php
						}
						?>
						
 </tbody>
                                </table></center>
										</div>
						
                                <?php
						}
						?>
										
          
                                        </div>
                                    </div>                                    
                                </div>       
                                <!-- END TIMELINE ITEM -->
								<?php } ?>
								<?php if($timeline_type =='addpatient'){ ?>
								<!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-item-right">
                                    <div class="timeline-item-info"><?php echo $time; ?></div>
                                    <div class="timeline-item-icon"><span style="color:#3A267D" class="fa fa-edit"></span>
									</div>                                   
                                    <div class="timeline-item-content">
                                        <div class="timeline-heading" style="padding-bottom: 10px;">
                                            <img src="img/med/complaint.png"/>
                                            <a style="font-size:16px">Registration</a>&nbsp;&nbsp;&nbsp; 
                                        </div>                                        
                                        <div class="timeline-body comments">
										<?php
										echo'
                                            <div class="comment-item">
                                                
                                                <p class="comment-head">
                                                    
                                                </p>
                                                <p>Patient Registration Complete.</p>
                                                
                                            </div>                                            
                                             '; 
											
											//echo $date;
											//$date='2015-07-28';
											?>                                          
                                           
                                        </div>
                                    </div>                                    
                                </div>       
                                <!-- END TIMELINE ITEM -->
								<?php } ?>
								<?php if($timeline_type =='admitpatient'){ ?>
								<!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-item-right">
                                    <div class="timeline-item-info"><?php echo $time; ?></div>
                                    <div class="timeline-item-icon"><span style="color:#3A267D" class="fa fa-edit"></span>
									</div>                                   
                                    <div class="timeline-item-content">
                                        <div class="timeline-heading" style="padding-bottom: 10px;">
                                            <img src="img/med/complaint.png"/>
                                            <a style="font-size:16px">Admission</a>&nbsp;&nbsp;&nbsp; 
                                        </div>                                        
                                        <div class="timeline-body comments">
										<?php
										echo'
                                            <div class="comment-item">
                                                
                                                <p class="comment-head">
                                                    
                                                </p>
                                                <p>'.$timeline_message.'</p>
                                                
                                            </div>                                            
                                             '; 
											
											//echo $date;
											//$date='2015-07-28';
											?>                                          
                                           
                                        </div>
                                    </div>                                    
                                </div>       
                                <!-- END TIMELINE ITEM -->
								<?php } ?>
								
								<!-- START TIMELINE ITEM -->
								<?php if($timeline_type =='complaints'){ ?>
                                <div class="timeline-item timeline-item-right">
                                    <div class="timeline-item-info"><?php echo $time; ?></div>
                                    <div class="timeline-item-icon"><span style="color:#3A267D" class="fa fa-edit"></span>
									</div>                                   
                                    <div class="timeline-item-content">
                                        <div class="timeline-heading" style="padding-bottom: 10px;">
                                            <img src="img/med/complaint.png"/>
                                            <a style="font-size:16px">COMPLAINTS</a>&nbsp;&nbsp;&nbsp; 
                                        </div>                                        
                                        <div class="timeline-body comments">
										<?php
										echo'
                                            <div class="comment-item">
                                                
                                                <p class="comment-head">
                                                    <a>Symptoms</h6></a>
                                                </p>
                                                <p>'.$cd1['symptoms'].'</p>
                                                
                                            </div>                                            
                                             '; 
											
											//echo $date;
											//$date='2015-07-28';
											?>                                          
                                           
                                        </div>
                                    </div>                                    
                                </div>     
								<?php } ?>
                                <!-- END TIMELINE ITEM -->
								
                                <!-- START TIMELINE ITEM -->
								<?php if($timeline_type =='reports'){ ?>
                                <div class="timeline-item timeline-item-right">
                                    <div class="timeline-item-info"><?php echo $time; ?></div>
                                    <div class="timeline-item-icon"><span style="color:#3A267D" class="fa fa-folder"></span>
									</div>                                   
                                    <div class="timeline-item-content">
                                        <div class="timeline-heading" style="padding-bottom: 10px;">
                                            <img src="img/med/complaint.png"/>
                                            <a style="font-size:16px">REPORTS</a>&nbsp;&nbsp;&nbsp; 
                                        </div>                                        
                                        <div class="timeline-body comments">
										<?php
										
										$query1 = "SELECT  cast(datetime as date) as datetime, test,complaint,notes,category,created_by FROM investigationreport WHERE patientid='$pid' and 
cast(datetime as date)='$date' order by id";
										//echo $query1;
										$res1 = mysql_query($query1);
										if(mysql_num_rows($res1) != 0){
										echo'                                                         
                                                
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
											$i=1;
										while($rs1 = mysql_fetch_array($res1)){
										echo '  
											
											<tr>
											<td>'.$i++.'</td>
											<td>'.$rs1['test'].'</td>
											<td>'.$rs1['complaint'].'</td>
											<td>'.$rs1['notes'].'</td>
											</tr>'; 
											} 
											echo '</tbody>
											</table>';
										 }
										?>                                             
                                           
                                        </div>
                                    </div>                                    
                                </div>    
								<?php } ?>
                                <!-- END TIMELINE ITEM -->
								
								  <!-- START TIMELINE ITEM -->
								  <?php if($timeline_type =='diagnosis'){ ?>
									<div class="timeline-item timeline-item-right">
                                    <div class="timeline-item-info"><?php echo $time; ?></div>
                                    <div class="timeline-item-icon"><span style="color:#3A267D" class="glyphicon glyphicon-book"></span>
									</div>                                   
                                    <div class="timeline-item-content">
                                        <div class="timeline-heading" style="padding-bottom: 10px;">
                                            <img src="img/med/complaint.png"/>
                                            <a style="font-size:16px">DIAGNOSIS DETAILS</a>&nbsp;&nbsp;&nbsp; 
                                        </div>                                        
                                        <div class="timeline-body comments">
										<?php
									$query1 = "SELECT cast(datetime as date) as datetime, prescribed_by, provisionaldiagnosis, diagnosis FROM tbl_diagnosis WHERE patientid='$pid' and cast(datetime as date)='$date' order by complaintid DESC LIMIT 1";
									//echo $query1;
									$res1 = mysql_query($query1);
									if(mysql_num_rows($res1) != 0){
									
										while($rs1 = mysql_fetch_array($res1)){
										echo'
                                            <div class="comment-item">
                                                
                                                <p class="comment-head">
                                                    <a>Provisional Diagnosis</h6></a>
                                                </p>
                                                <p>'.$rs1['provisionaldiagnosis'].'</p>
                                                
                                            </div>                                            
                                            <div class="comment-item">
                                                
                                                <p class="comment-head">
                                                    <a>Diagnosis</a>
                                                </p>
                                                <p>'.$rs1['diagnosis'].'</p>
                                                <span class="text-muted pull-right">'.$rs1['prescribed_by'].'</span> 
                                            </div>  '; 
											$date=$rs1['datetime'];
											}}?>                                          
                                           
                                        </div>
                                    </div>                                    
                                </div>
								  <?php } ?>
								    <!-- END TIMELINE ITEM -->
									
									
									
									 <!-- START TIMELINE ITEM -->
									 <?php if($timeline_type =='medication'){ ?>
									<div class="timeline-item timeline-item-right">
                                    <div class="timeline-item-info"><?php echo $time; ?></div>
                                    <div class="timeline-item-icon"><span style="color:#3A267D" class="glyphicon glyphicon-list-alt"></span>
									</div>                                   
                                    <div class="timeline-item-content">
                                        <div class="timeline-heading" style="padding-bottom: 10px;">
                                            <img src="img/med/complaint.png"/>
                                            <a style="font-size:16px">MEDICATION DETAILS</a>&nbsp;&nbsp;&nbsp; 
                                        </div>                                        
                                        <div class="timeline-body comments">
										<?php
										$query4 = "select id,cast(datetime as date)as datetime,prescribed_by from prescriptiondetail where patientid='$pid' and cast(datetime as date)='$date' group by id order by id desc limit 1";
										//echo $query4;
	$res4 = mysql_query($query4);
	if(mysql_num_rows($res4) != 0){
	while($rs4 = mysql_fetch_array($res4)){
			$query5 = "select * from prescriptiondetail where patientid='$pid' and id ='".$rs4['id']."'";
			$res5 = mysql_query($query5);
			if(mysql_num_rows($res5) != 0){
				echo '
				<div class="comment-item">
				<table border="0" style="width:100%">
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
					echo "<tr>
						<td>".$rs5['drugname']."&nbsp;</td>					
						<td >".$rs5['dosage']."&nbsp;</td>
						<td >".$rs5['specification']."&nbsp;</td>
						<td>".$rs5['frequency']."&nbsp;</td>
						<td>".$rs5['duration']."&nbsp;</td>
						</tr>";
				}
			
						
						
				echo '</tbody></table><br />
				<div class="pull-right" style="color:#CC0000">Prescribed by : '.$rs4['prescribed_by'].'&nbsp;</div>
				</div>';
			}
		}
	}
									?>                       
                                           
                                        </div>
                                    </div>                                    
                                </div>
									 <?php } ?>
								 
								
								    <!-- END TIMELINE ITEM -->
									
									
									
                                <!-- START TIMELINE ITEM -->
         
                                <!-- END TIMELINE ITEM -->                                                                
                                
                                <!-- START TIMELINE ITEM -->
                      
                                <!-- END TIMELINE ITEM -->                                
                                
                                <!-- START TIMELINE ITEM -->
       
                                <!-- START TIMELINE ITEM -->
  
                                <!-- END TIMELINE ITEM -->
                                
                                <!-- START TIMELINE ITEM -->
                                   
                                <!-- END TIMELINE ITEM -->
								
							
                            <!-- END TIMELINE -->  
							<?php							
								}
							?>
                            </div>
                        
						</div>
					<?php 
					
					$index++;	
					} ?>
                      </div>  
                    </div>

                </div>
				
				<?php } else { ?>
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
						 
											 
                           
                                                      <?php  if($sql['admission']==1) { ?>	      
                                <div class="panel panel-default tabs"> 
															
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Admission IP List</a></li>
										<li><a href="#tab-second" role="tab" data-toggle="tab">Admission OP List</a></li>
                                     
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
												<a href="#" class="btn btn-primary pull-left" onClick="getpatientlist()">Search <span class="fa fa-floppy-o fa-right"></span></a>
												</div>
                                            </div>
											</form>
                                        </div>
                                        <div class="col-md-6">
                                        </div>
										  <br/><br/>                                           
                                           <br><br>
                                            <table  class="table" id="getpatienttable">
      <thead>
        <tr>
           <th width="5%">Sl. No</th>
           <th width="8%">Date</th>
           <th width="10%">Patient IP Id</th>
           <th width="10%">Branch</th>		
           <th width="10%">Patient ID</th>
           <th width="15%">Patient Name</th>
		   <th width="5%">Age</th>
          <th width="15%">Address</th>
          <th width="2%">View</th>
        </tr>
      </thead>
      <tbody>
	  </tbody>
	  </table>
</div></div>
<div class="tab-pane" id="tab-second">
										<div class="row">
                                        
                                        <div class="col-md-12">
                                            <form id="bill2">
											
											
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Range</label>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input id="reg_from" name="reg_from" type="text" class="form-control datepicker" value="<?php $date = strtotime("-7 day");
echo date('Y-m-d', $date); ?> "/>
                                                    <span class="input-group-addon add-on"> - </span>
                                                    <input id="reg_to" name="reg_to" type="text" class="form-control datepicker" value="<?php echo date("Y-m-d"); ?>"/>
													</div>
                                                </div>
												<div class="col-md-3">
												<a href="#" class="btn btn-primary pull-left" onClick="getregpatientlist()">Search <span class="fa fa-floppy-o fa-right"></span></a>
												</div>
                                            </div>
											</form>
                                        </div>
                                        <div class="col-md-6">
                                        </div>
										  <br/><br/>                                           
                                           <br><br>
                                            <table  class="table" id="getregpatienttable">
      <thead>
        <tr>
           <th width="5%">Sl. No</th>
           <th width="8%">Date</th>
           <th width="10%">Branch</th>		
           <th width="10%">Patient ID</th>
           <th width="15%">Patient Name</th>
		   <th width="5%">Age</th>
          <th width="15%">Address</th>
          <th width="2%">View</th>
        </tr>
      </thead>
      <tbody>
	  </tbody>
	  </table>
</div></div>
					<?php } ?>
                <!-- END PAGE CONTENT WRAPPER -->                                                 
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
		<?php } ?>

        <!-- MESSAGE BOX-->
		<div id="serachdis" class="modal fade" role="dialog">
  <div class="modal-dialog" style="width: 80%;">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Search result</h4>
      </div>
      <div class="modal-body">
        	
	
										
      <div class="col-md-13">  
                        <table class="table" border="1" cellpadding="5" cellspacing="5">
<thead>
	<tr>
		<th>Branch</th>
		<th>Patient ID</th>
		<th>Patient Name</th>
		<th>Parents / Spouse Name</th>
		<th>Age</th>
		<th>Gender</th>
		<th>Contact No.</th>
		<th>Occupation</th>
		<th>Address</th>
		<th>Date</th>
		<th>View</th>
        <th>Action</th>			
	</tr>
</thead>
	<tbody id="divserachdis">	
	<tbody></table>                   
									
											 
											
                                        </div>
										
                                        	
	
      </div>
      <div class="modal-footer">
	  <!--<button type="button" class="btn btn-default" onClick="updateddiog()" data-dismiss="modal">Save</button>-->
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
		
		
		<div id="editprofile" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
	
	

    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Edit Patient Details</h4>
      </div>
      <div class="modal-body">
        	
	<form action="#" class="form-horizontal" id="update" method="post" onSubmit="return valid()">
                        <div class="col-md-6">
                            
                            
                            <!--<div class="registration-subtitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. In odio mauris, maximus ac sapien sit amet.</div>-->
                            
							<?php date_default_timezone_set('Asia/Kolkata'); ?>
								<input type="hidden" id="datepicker" name="datepicker" value="<?php echo date("m/d/Y");?>" />
                                <h4>Official info</h4>
                                <div class="form-group">
                                    <div class="col-md-12">
										<select  class="form-control select" id="branch" name="branch">
										<option value="1">Select Branch Hospital</option>
										<?php
										include("config_db1.php");
										$cmd = "select branch from hospitalbranches WHERE status = 1";
										$res = mysql_query($cmd);
										while($rs = mysql_fetch_array($res)){
										echo '<option>'.$rs['branch'].'</option>';
										}
										mysql_close($db1);
										?>
										</select>
										
                                    </div>
                                </div>
								
                                    <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" id="patid" name="patid"  class="form-control" required readonly placeholder="Patient ID"/>
										
                                    </div>
                                </div>
								<h4>Personal Info</h4>
                                <div class="form-group">
                                    <div class="col-md-4">
											<select style="width:auto" class="form-control" id="patsat" name="patsat" required>
											<option value="1">Surname</option>
											<option>Baby</option>
											<option>Miss.</option>		
											<option>Mr.</option>
											<option>Mrs.</option>
											<option>Master</option>		
											</select>
											</div>
											<div class="col-md-8"> <input type="text" placeholder="Patient Name" class="form-control"  id="patname" name="patname" required/>
											

                                    </div>
									<div class="col-md-10">
									<span class="help-block">Patient Name</span>
									</div>
                                </div>

                                                    
                                <div class="form-group">
                                    <div class="col-md-4">
									<select  style="width:auto" class="form-control" id="gsat" name="gsat" required>
									<option value="1">Surname</option>
									<option>Mr.</option>
									<option>Mrs.</option>
									</select> </div>
									<div class="col-md-8">
									<input type="text"  placeholder="Parents/Spouse Name" class="form-control" id="gname" name="gname" required/>
									

                                    </div>
									<div class="col-md-10">
									<span class="help-block">Parents/Spouse Name</span>
									</div>
                                </div>                        
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <input type="text" class="form-control" id="age" name="age" required placeholder="Age"/>
										<span class="help-block">Age</span>

                                    </div>
                                </div>                    
                                <div class="form-group">
                                    <div class="col-md-4">
									  <label class="check">
									<input name="gender" type="radio" class="form-control iradio" id="gender" value="Male" required /> 
									Male</label>
									</div>
									 <div class="col-md-4">
									 <label class="check">
									<input name="gender" type="radio" class="form-control iradio" id="gender" value="Female" required /> 
									Female</label>
                                    </div>
									 <div class="col-md-4"></div>
                                </div>             
								
                                <!--<div class="form-group push-up-30">
                                    <div class="col-md-6">
                                        <a href="#" class="btn btn-link btn-block">Already have an account?</a>                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-danger btn-block">Sign Up</button>
                                    </div>
                                </div>-->
                                <h4>Address </h4>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="contactno" name="contactno"  placeholder="Contact Number"/>
									<span class="help-block">Contact Number</span>

                                </div>
                            </div>                       
                        </div>
						
						
						<div class="col-md-6">
                            
                           <div class="registration-title"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&nbsp;&nbsp;</div>
                           
                            <div class="form-group">
                                <div class="col-md-12">
                                 <input type="text" list="dloccupation" id="occupation" name="occupation" required class="form-control" placeholder="Occupation"/>
									<datalist id="dloccupation">
									<option>Employee</option>
									<option>Engineer</option>
									<option>House Wife</option>
									<option>Self-Employed</option>
									<option>Student</option>
									<option>Others</option>
									</datalist>
									<span class="help-block">Occupation</span>
								</div>
                            </div>
							<div class="form-group">
                                <div class="col-md-12">
                                <textarea class="form-control" name="address" id="address" placeholder="Address" required ></textarea>
								<span class="help-block">Enter Address</span>	
								</div>
								
                            </div>
							<div class="form-group">
                                <div class="col-md-12">
                                    <input type="text" class="form-control" id="reference" name="reference"  placeholder="Reference"/>
									<span class="help-block">Reference</span>

                                </div>
                            </div>
							<div class="form-group">
                                <div class="col-md-12">
                                    <img style="float:right; cursor:pointer; margin-right:30px" src="img/default.png" height="200" width="200" id="img_prev" name="img_prev" />
    <input type="file" class="fileinput form-control btn-info" id="photo" name="photo" onChange="readURL(this);"/>
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
						</form>                              	
	
      </div>
      <div class="modal-footer">
	  <button type="button" class="btn btn-default" onClick="save()" data-dismiss="modal">Save</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
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
                        <button class="btn btn-default btn-lg pull-right mb-control-close">Close</button>
                    </div>
                </div>
            </div>
        </div>
		
		<div class="message-box message-box-success animated fadeIn" id="message-box-update">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-check"></span> Success</div>
                    <div class="mb-content">
                        <div id="appendmsg1">
						</div>
                    </div>
                    <div class="mb-footer">
                        <a href="complaints.php?pid=<?php echo $pid; ?>" class="btn btn-default btn-lg pull-right" >Close</a>
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
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-remove-row">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-times"></span> Remove <strong>Data</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to remove this row?</p>                    
                        <p>Press Yes if you sure.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="#" id="yes" class="btn btn-success btn-lg mb-control-yes">Yes</a>
                            <a href="#" id="no" class="btn btn-default btn-lg mb-control-no">No</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		<div id="inves12" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    
			
	
                                      
   
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
        <!-- END THIS PAGE PLUGINS-->        

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="js/settings.js"></script>        
        
        <script type="text/javascript" src="js/plugins.js"></script>        
        <script type="text/javascript" src="js/actions.js"></script>
		
        
       <!-- <script type="text/javascript" src="js/demo_edit_profile.js"></script>-->
        <!-- END TEMPLATE -->


    
    </body>
	 <script >
       $(document).ready(function() {
	   //alert('');
	  
 	$.ajax({
		type: "GET",
		url: "return_name.php",
		success: function(msg) {
		//alert(msg);
			var availableTags = msg.split("~");
			$( "#search" ).autocomplete({
			  source: availableTags
			});
		}
	});
});	

        </script>

<script>
	
		function add_new_variety(url)
	{
	new_popup= window.open(url,'new_popup','height=550,width=1000,scrollbars=no,resizable=no,left=50,top=50,toolbar=no,location=no,directories=no,status=no');
	}	function add_new_varietys(url)
	{
alert("Patient Is Already Admitted");
	}	

							function edit(x)
							{ 
							//alert(x);
							//var id=x.attr('rel');
							//$("#upcompliantid").val("");
							//$("#editpid").val("");
							//$("#editpid").val(x);
							var pid = x;
		  $.ajax({
			type: "post",
			url: "returnpatientinfo.php",
			data:{
				pid: pid,
			},
			success: function(msg) {
				var x = msg.split("~");
				//alert(msg);
				$('#datepicker').val(x[0]);	$('#branch').val(x[1]);			$('#patid').val(x[2]);
				$('#patsat').val(x[3]);		$('#patname').val(x[4]);		$('#gsat').val(x[5]);
				$('#gname').val(x[6]);		$('#age').val(x[7]);
				
				gen = x[8];
				if(gen == "Female")
					$('input:radio[name=gender]')[1].checked = true;
				else if(gen == "Male")
					$('input:radio[name=gender]')[0].checked = true;
					
				$('#contactno').val(x[9]);	$('#occupation').val(x[10]);		$('#address').val(x[11]);	$('#reference').val(x[12]);
				$('#img_prev').attr("src","returnpatimg.php?id="+x[13]);
			}
		});
							$('#editprofile').modal('toggle');
							
							}
							</script>
							
			
			
			<script>
			function dispid()
  {
  
  var ser=$("#search").val();
 	if(ser=="")
  return false;
  $.ajax({
			type: "post",
			url: "search.php?ser="+ser,
			success: function(msg) {
			//alert(msg);
				$("#divserachdis").html(msg);
			}
		});
		$('#serachdis').modal('toggle');
  
  }
  
  
		function save()
		{
		branch = $('#branch').val();
		datepicker = $('#datepicker').val();
		patid = $('#patid').val();
		patsat = $('#patsat').val();
		patname = $('#patname').val();
		gsat = $('#gsat').val();
		gname = $('#gname').val();
		age = $('#age').val()
		gender = $('#gender').val();
		contactno = $('#contactno').val()
		occupation = $('#occupation').val();
		address = $('#address').val();
		reference = $('#reference').val()
		
		var photo = $('#photo').prop('files')[0];
	var fd = new FormData();
	fd.append('photo',photo);
	fd.append('branch',branch);
	fd.append('datepicker',datepicker);
	fd.append('patid',patid);
	fd.append('patsat',patsat);
	fd.append('patname',patname);
	fd.append('gsat',gsat);
		fd.append('gname',gname);
	fd.append('age',age);
	fd.append('gender',gender);
	fd.append('contactno',contactno);
	fd.append('occupation',occupation);
	fd.append('address',address);
	fd.append('reference',reference);
			$.ajax({
				type: "post",
				url: 'patient_update.php?'+fd,
		contentType: false,
		processData: false,
		data: fd,
				success: function(msg) {
				   alert(msg);
				}
			});
			}
		
		
		 $(document).ready(function(){
		getregpatientlist();
		getpatientlist();
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
	//alert('');
   
    }, 5000);
});





		function save_patient(patientid,patientname,branch,patientsalutation,guardiansalutation,age,contactno,gender,occupation,address)
		{
		$.ajax({
		type: "post",
type: "POST",
		url: "invisit_patient_db.php",
		data: "patientid="+patientid+"&patientname="+patientname+"&branch="+branch+"&patientsalutation="+patientsalutation+"&guardiansalutation="+guardiansalutation+"&age="+age+"&contactno="+contactno+"&gender="+gender+"&occupation="+occupation+"&address="+address+"&action=Save",
		success: function(msg){jQuery("#get_patient_entry_div").html(msg);
		window.location.reload();
		}
			});
		}
	</script>
<!-- Mirrored from aqvatarius.com/themes/atlant/html/pages-edit-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2015 09:47:54 GMT -->
</html>

<script>
//window.load(getpatientlist());
function getpatientlist()
{
from=$("#from").val();
to=$("#to").val();

if($("#from").val()=="" && $("#to").val()=="")
{
alert("Please Fill any one field");
return false;
}

var t = $('#getpatienttable').DataTable();

$.ajax({
			type: "post",
			url: "get_patient_list.php",
			data: $("#bill1").serialize(),
			success: function(msg) {
			var msg=$.trim(msg);
			t.clear().draw(false);;	
			if(msg=="")
			{
			$("#getpatienttable > tbody").append("<b>No Result Found</b>");
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
		x1[7],
		msg, 
    ]).draw();
		}
		$('#bill1').trigger("reset");
			}
		});
}
function getregpatientlist()
{
var from=$("#reg_from").val();
var to=$("#reg_to").val();

if($("#reg_to").val()=="" && $("#reg_from").val()=="")
{
alert("Please Fill any one field");
return false;
}

var t = $('#getregpatienttable').DataTable();

$.ajax({
			type: "post",
			url: "get_patient_oplist.php",
			data: $("#bill2").serialize(),
			success: function(msg) {
				//console.log(msg);
			var msg=$.trim(msg);
			t.clear().draw(false);;	
			if(msg=="")
			{
			$("#getregpatienttable > tbody").append("<b>No Result Found</b>");
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
		x1[7],
		msg, 
    ]).draw();
		}
		$('#bill2').trigger("reset");
			}
		});
}
</script>