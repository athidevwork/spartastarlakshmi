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
</ul> <div class="row">
          <div class="col-lg-12">


            <div class="form-group">
										 <div class="col-md-2">
                                            <label class="col-md-6 control-label">Room No:</label>  
                                            <div class="col-md-4">
                                                <input type="text" style="width:90px;" style="font-weight:bold"  class="form-control" name="id" id="id"/>
                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
											   
                                   
                                                     <div class="col-md-2">
                                            <label class="col-md-4 control-label">Name:</label>  
                                            <div class="col-md-5">
                                                <input type="text" style="font-weight:bold;width:110px;"  class="form-control" name="name" id="name"/>
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
                                            <label class="col-md-4 control-label">DOA</label>  
                                            <div class="col-md-5">
                                                <input type="text" style="font-weight:bold;width:110px;"  class="form-control" name="doa"/>
                                               <span class="help-block"></span> 
												</div>                                        
												   </div>
                                                   <div class="col-md-2">
                                            <label class="col-md-6 control-label">Cons:</label>  
                                            <div class="col-md-5">
                                                <input type="text" style="font-weight:bold;width:110px;"  class="form-control" name="cons"/>
                                               <span class="help-block"></span> 
												</div>                                        
												   </div>
										</div>	   
										<div class="form-group">
										 <div class="col-md-3">
                                            <label class="col-md-1 control-label">Physiotherapy:</label>                                 
                                            <div class="col-md-5">
                               <span class="help-block"></span></div>
                              <input name="physiotherapy" id="physiotherapy" type="checkbox">                       
										   </div>
                                            <div class="col-md-3">
                                            <label class="col-md-3 control-label">Type:</label>  
                                            <div class="col-md-9">
                                            <select name="type" id="type" class="form-control select"> 
                                              <option>select</option> 
                                              <option>Type1</option>
                                                <option>Type2</option>                                            
                                                </select><span class="help-block"></span> 
												</div>                                        
												   </div>
                                                    <div class="col-md-2">
                                            <div class="col-md-5">
                               <span class="help-block"></span></div>
                                    <select name="type" id="type" class="form-control select"> 
                                              <option>select</option> 
                                              <option>Type1</option>
                                                <option>Type2</option>                                            
                                                </select></div>
                                                     
												   <div class="col-md-1">
                                           <a href="#"  onClick="add();" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-plus"></span></a>                                   
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
										<th style="display:none">Send</th>
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
										 <div class="col-md-4">
                                            <label class="col-md-3 control-label">Total:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value='0' readonly  name="total" id="total"/>
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
												   </div>  
												    
												    <div class="col-md-4">
                                            <label class="col-md-3 control-label">Pay:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"  onBlur="cal()" name="pay" id="pay"/>
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
												   </div>  
												   
												   
												   <div class="col-md-4">
                                            <label class="col-md-3 control-label">Balance:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="0" name="bal" id="bal"/>
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
												   </div> 
												   
												     <div class="col-md-4">
                                            <label class="col-md-3 control-label">Old Balance:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="0" name="old" id="old"/>
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
												   </div> 
												    
												     
												     
                       
                                                                                                                            
                                        <div class="btn-group pull-right">
                                         <!--   <button class="btn btn-primary" type="button" onClick="print_bill()">Print</button>-->
                                            <a href="#" class="btn btn-primary" onClick="save()" >Pay</a>
                                        </div>    </div>                                     
        </div>