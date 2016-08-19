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
if($sql['reports'] !=1)
{
echo '<script>alert("You could not access this page");</script>';
echo '<script>window.location.href="home.php"</script>';
exit();
}
 date_default_timezone_set('Asia/Kolkata'); 
if(isset($_REQUEST['pid'])){
		$pid = $_REQUEST['pid'];
		include("config_db2.php");
		$sql = "SELECT patientid,patientname,age,gender FROM patientdetails WHERE patientid='$pid'";
		$result = mysql_query($sql);
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
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>        
        <!-- META SECTION -->
        <title>DPP- Reports</title>            
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
		table.dataTable tbody tr.sel {
    background-color: #B0BED9;
}
		.ui-autocomplete {
  z-index:2147483647;
}</style>

<link type="text/css" rel="stylesheet" media="all" href="chat/css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="chat/css/screen.css" />
      

		

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
										
                                        <!--<li><a href="#tab-first" role="tab" data-toggle="tab">General Repots</a></li>-->
										<li class="active"><a href="#tab-third" role="tab" data-toggle="tab">Billing Reports</a></li>
										<li><a href="#tab-second" role="tab" data-toggle="tab">Investigation Reports</a></li>
										
										<li><a href="#tab-fourth" role="tab" data-toggle="tab">Medication Reports</a></li>
										<li><a href="#tab-fifth" role="tab" data-toggle="tab">Service Reports</a></li>
										<li><a href="#tab-sixth" role="tab" data-toggle="tab">Procedure Reports</a></li>
										<li><a href="#tab-seventh" role="tab" data-toggle="tab">Admission Reports</a></li>
                                    </ul>
									
                                    <div class="panel-body tab-content">
												<div class="tab-pane" id="tab-seventh">
										<div class="row">
                                        
                                        <div class="col-md-12">
                                            <form id="admission_report_table_form">
											
											
                                        <div class="form-group col-md-12">
                                           
											         <div class="col-md-2" style="text-align:right">                                                
												                                           
										<label><strong>Date of Discharge</strong></label>
								 </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input id="admission_report_discharge_date_from" name="admission_report_discharge_date_from" type="text" class="form-control datepicker" value="<?php $date = strtotime("-7 day");
echo date('Y-m-d', $date); ?> "/>
                                                    <span class="input-group-addon add-on"> - </span>
                                                    <input id="admission_report_discharge_date_to" name="admission_report_discharge_date_to" type="text" class="form-control datepicker" value="<?php echo date("Y-m-d"); ?>"/>
													</div>
                                                </div>
												
												
                                            </div>
											
											<div class="form-group col-md-12">
                                           
											         <div class="col-md-2" style="text-align:right">                                                
												                                           
										<label><strong>Age</strong></label>
								 </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input id="admission_report_age_from" name="admission_report_age_from" type="text" class="form-control" value=""/>
                                                    <span class="input-group-addon add-on"> To </span>
                                                    <input id="admission_report_age_to" name="admission_report_age_to" type="text" class="form-control" value=""/>
													</div>
                                                </div>
												
												
                                            </div>
											<div class="form-group col-md-12">
                                           
											         <div class="col-md-2" style="text-align:right">                                                
												                                           
										<label><strong>Gender</strong></label>
								 </div>
                                            <div class="col-md-4">
									  <label class="check">
									<input name="admission_report_gender" type="radio" value="Male" required /> 
									Male</label>
									<label class="check">
									<input name="admission_report_gender" type="radio" value="Female" required /> 
									Female</label>
									</div>
									 
												
												
                                            </div>
											<div class="form-group col-md-12">
                                           
											         <div class="col-md-2" style="text-align:right">                                                
												                                           
										<label><strong>Address</strong></label>
								 </div>
                                            <div class="col-md-4">
									  
									<input name="admission_report_address" type="text" id="admission_report_address" value=""  />
									
									</div>
									 
											<div class="col-md-3">
												 <input id="request" name="request" type="hidden" class="form-control datepicker" value="admission_report_table"/>
												<a href="#" class="btn btn-primary pull-left" onClick="get_admission_report_table();return false;">Search <span class="fa fa-floppy-o fa-right"></span></a>
												</div>	
												
                                            </div>
											</form>
                                           
                                            
                                        </div>
										
										<!--<input type="button" onClick="f()">-->
										
                                        <div class="col-md-6">
                                             
											 
                                        </div>
										  <br/><br/>                                           

                                            
                                           <br><br>
                                        
										
													
											   <div class="col-md-12">
									
						
									
								 <div class="table-responsive">
								 <div class="btn-group pull-right">
									<br>
                                        <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
                                        <ul class="dropdown-menu">
                                           <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#admission_report_table').tableExport({type:'excel',escape:'false',ignoreColumn:'[7]'});"><img src='img/icons/xls.png' width="24"/> XLS</a></li>
                                            <li><a href="#" onClick ="$('#admission_report_table').tableExport({type:'doc',ignoreColumn:'[7]',escape:'false'});"><img src='img/icons/word.png' width="24"/> Word</a></li>
                                            
                                            
                                            <li><a href="#" onClick ="$('#admission_report_table').tableExport({type:'png',ignoreColumn:'[7]',escape:'false'});"><img src='img/icons/png.png' width="24"/> PNG</a></li>
                                            
                                        </ul>
                                    </div>	
									 <table id="admission_report_table" class="table" >
      <thead>
        <tr>
          <th>Sl. No</th>		
		  <th>Date of Admission</th>
          <th>Patient ID</th>
          <th>IP No</th>
		  <th>Patient Name</th>
		  <th>Source</th>
		  <th>Ward / Room</th>
		  <th>Dr / Dept</th>
		  <th>Type</th>
          <th>Date of Discharge</th>
		  
        </tr>
      </thead>
      <tbody>
	  </tbody>
	   
	  </table>
	  </div>
 </div> 
</div></div>
			<script>
function get_admission_report_table()
{
//alert('sdfd');
var from=$("#admission_report_discharge_date_from").val();
var to=$("#admission_report_discharge_date_from").val();

if($("#admission_report_discharge_date_from").val()=="" || $("#admission_report_discharge_date_from").val()=="")
{
alert("Please Fill Date of Discharge range");
return false;
}
		var start = $("#admission_report_discharge_date_from").datepicker("getDate");
        var end = $("#admission_report_discharge_date_from").datepicker("getDate");
        var days = (end - start) / (1000 * 60 * 60 * 24);
		if(days < 0){
			alert("From Date should be less than To date");
			return false;
		}
		if(days > 90){
			alert("Selected Date Range should not be greater than 90 days");
			return false;
		}
var t = $('#admission_report_table').DataTable();
$.ajax({
			type: "post",
			url: "getreports.php",
			data: $("#admission_report_table_form").serialize(),
			
			
			success: function(msg) {
			//alert(msg);
			var msg=$.trim(msg);
			//alert(msg);
			//$("#billreporttable > tbody").empty();	
			t.clear().draw(false);;	
			if(msg=="")
			{
			$("#admission_report_table > tbody").append("<b>No Result Found</b>");
			return false;
			}
			
				var v=msg.split('@');
				var len=v.length;
			var j=1;	
		
		for (i = 0; i <len; i++) 
		{
		var s=j++;
		var x1= v[i].split("~");
		//$("#tbl").show();<a href="printing.php?pid='.$pid.'&maxid='.$maxid.'" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left" target="_blank"><span class="fa fa-print"></span></a>
		//msg='<a href="#" onClick="edit('+x1[6]+');" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-pencil"></span></a> <a href="#" onClick="deletebill($(this));" alt="'+x1[6]+'" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-times"></span></a><a href="printbilling.php?billnumber='+x1[6]+'&patientid='+x1[1]+'" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left" target="_blank"><span class="fa fa-print"></span></a>';
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
		x1[8], 
    ]).draw();
		 <!--<div class="table-responsive"><table class="table datatable"><thead><tr><th>Study Center</th><th>Patient ID</th><th>Patient Name</th><th>Parents / Spouse Name</th><th>Age</th><th>Gender</th><th>Contact No.</th><th>Occupation</th><th>Address</th><th>Date</th><th>View</th></tr></thead><tbody>-->
		/*var txt = "<tr><td>"+s+"</td><td>"+x1[0]+"</td><td>"+x1[1]+"</td><td>"+x1[2]+"</td><td>"+x1[3]+"</td><td>"+x1[4]+"</td><td>"+x1[5]+"</td></tr>";
	t.append(txt).draw();*/
		}
		//$('#bill1').trigger("reset");
				//alert(len);
				
			}
		});

//alert('');
}
</script>
											<div class="tab-pane active" id="tab-third">
										<div class="row">
                                        
                                        <div class="col-md-12">
                                            <form id="bill1">
											
											
                                        <div class="form-group">
                                           
											         <div class="col-md-2">                                                
												                                           
										<select name="ptye" class="form-control select" id="ptye">
                                <option value="">Select</option>
                                <option value="OP">OP</option>
                                <option value="IP">IP</option>
								<option value="ADVANCE">ADVANCE</option>
                                
								 </select>
								 <span class="help-block">Select Patient Type</span>
								 </div>
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input id="from" name="from" type="text" class="form-control datepicker" value="<?php $date = strtotime("-7 day");
echo date('Y-m-d', $date); ?> "/>
                                                    <span class="input-group-addon add-on"> - </span>
                                                    <input id="to" name="to" type="text" class="form-control datepicker" value="<?php echo date("Y-m-d"); ?>"/>
													</div>
                                                </div>
												<div class="col-md-3">
												 <input id="request" name="request" type="hidden" class="form-control datepicker" value="bill"/>
												<a href="#" class="btn btn-primary pull-left" onClick="getbill();return false;">Search <span class="fa fa-floppy-o fa-right"></span></a>
												</div>
												
                                            </div>
											</form>
                                           
                                            
                                        </div>
										
										<!--<input type="button" onClick="f()">-->
										
                                        <div class="col-md-6">
                                             
											 
                                        </div>
										  <br/><br/>                                           

                                            
                                           <br><br>
                                        
										
													
											   <div class="col-md-12">
									
						
									
								 <div class="table-responsive">
								 <div class="btn-group pull-right">
									<br>
                                        <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
                                        <ul class="dropdown-menu">
                                           <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#billreporttable_fee').tableExport({type:'excel',escape:'false',ignoreColumn:'[7]'});"><img src='img/icons/xls.png' width="24"/> XLS</a></li>
                                            <li><a href="#" onClick ="$('#billreporttable_fee').tableExport({type:'doc',ignoreColumn:'[7]',escape:'false'});"><img src='img/icons/word.png' width="24"/> Word</a></li>
                                            
                                            
                                            <li><a href="#" onClick ="$('#billreporttable_fee').tableExport({type:'png',ignoreColumn:'[7]',escape:'false'});"><img src='img/icons/png.png' width="24"/> PNG</a></li>
                                            
                                        </ul>
                                    </div>	
									 <table id="billreporttable_fee" class="table" >
      <thead>
        <tr>
          <th>Sl. No</th>		
          <th>Patient Name</th>
          <th>Patient ID</th>
          <th>Bill Type</th>
		  <th>Fees</th>
          <th>Fees Recieved</th>
          <th>Date of Reciept</th>
		  <th>Action</th>
        </tr>
      </thead>
      <tbody>
	  </tbody>
	   <tfoot>
            <tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			
                <td>Total:</td>
                <td></td>
            </tr>
			
        </tfoot>
	  </table>
	  </div>

			
					  			
							
 </div> 
										
                                   
									

					</div></div>
					<!--End of third tab -->
					<script>
function getbill()
{
//alert('sdfd');
var from=$("#from").val();
var to=$("#to").val();

if($("#from").val()=="" && $("#to").val()=="")
{
alert("Please Fill any one field");
return false;
}
		var start = $("#from").datepicker("getDate");
        var end = $("#to").datepicker("getDate");
        var days = (end - start) / (1000 * 60 * 60 * 24);
		if(days < 0){
			alert("From Date should be less than To date");
			return false;
		}
		if(days > 90){
			alert("Selected Date Range should not be greater than 90 days");
			return false;
		}
var t = $('#billreporttable_fee').DataTable();
$.ajax({
			type: "post",
			url: "getreports.php",
			data: $("#bill1").serialize(),
			
			
			success: function(msg) {
			//alert(msg);
			var msg=$.trim(msg);
			//alert(msg);
			//$("#billreporttable > tbody").empty();	
			t.clear().draw(false);;	
			if(msg=="")
			{
			$("#billreporttable_fee > tbody").append("<b>No Result Found</b>");
			return false;
			}
			
				var v=msg.split('@');
				var len=v.length;
			var j=1;	
		
		for (i = 0; i <len; i++) 
		{
		var s=j++;
		var x1= v[i].split("~");
		//$("#tbl").show();<a href="printing.php?pid='.$pid.'&maxid='.$maxid.'" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left" target="_blank"><span class="fa fa-print"></span></a>
		//msg='<a href="#" onClick="edit('+x1[6]+');" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-pencil"></span></a> <a href="#" onClick="deletebill($(this));" alt="'+x1[6]+'" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-times"></span></a><a href="printbilling.php?billnumber='+x1[6]+'&patientid='+x1[1]+'" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left" target="_blank"><span class="fa fa-print"></span></a>';
		t.row.add([
        s,
        x1[0],
        x1[1],
		x1[2],
		x1[3],
		x1[4],
		x1[5],
		x1[6], 
    ]).draw();
		 <!--<div class="table-responsive"><table class="table datatable"><thead><tr><th>Study Center</th><th>Patient ID</th><th>Patient Name</th><th>Parents / Spouse Name</th><th>Age</th><th>Gender</th><th>Contact No.</th><th>Occupation</th><th>Address</th><th>Date</th><th>View</th></tr></thead><tbody>-->
		/*var txt = "<tr><td>"+s+"</td><td>"+x1[0]+"</td><td>"+x1[1]+"</td><td>"+x1[2]+"</td><td>"+x1[3]+"</td><td>"+x1[4]+"</td><td>"+x1[5]+"</td></tr>";
	t.append(txt).draw();*/
		}
		//$('#bill1').trigger("reset");
				//alert(len);
				
			}
		});

//alert('');
}
</script>
								<div class="tab-pane" id="tab-second">
										<div class="row">
                                        
                                        <div class="col-md-12">
                                            <form id="inves_report_form">
											
											
                                        <div class="form-group">
                                       
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input id="inves_report_from" name="inves_report_from" type="text" class="form-control datepicker" value="<?php $date = strtotime("-7 day");
echo date('Y-m-d', $date); ?> "/>
                                                    <span class="input-group-addon add-on"> - </span>
                                                    <input id="inves_report_to" name="inves_report_to" type="text" class="form-control datepicker" value="<?php echo date("Y-m-d"); ?>"/>
													</div>
                                                </div>
												<div class="col-md-3">
												<input id="request" name="request" type="hidden" class="form-control datepicker" value="inves_report"/>
												<a href="#" class="btn btn-primary pull-left" onClick="getinves_report();return false;">Search <span class="fa fa-floppy-o fa-right"></span></a>
												</div>
												
                                            </div>
											</form>
                                           
                                            
                                        </div>
										
										<!--<input type="button" onClick="f()">-->
										
                                        <div class="col-md-6">
                                             
											 
                                        </div>
										  <br/><br/>                                           

                                            
                                           <br><br>
                                        
										
													
											   <div class="col-md-12">
									
						
									
								 <div class="table-responsive">
								 <div class="btn-group pull-right">
									<br>
                                        <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
                                        <ul class="dropdown-menu">
                                           <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#billreporttable').tableExport({type:'excel',escape:'false',ignoreColumn:'[7]',ignorerow:'[1]'});"><img src='img/icons/xls.png' width="24"/> XLS</a></li>
                                            <li><a href="#" onClick ="$('#billreporttable').tableExport({type:'doc',ignoreColumn:'[7]',escape:'false'});"><img src='img/icons/word.png' width="24"/> Word</a></li>
                                            
                                            
                                            <li><a href="#" onClick ="$('#billreporttable').tableExport({type:'png',ignoreColumn:'[7]',escape:'false'});"><img src='img/icons/png.png' width="24"/> PNG</a></li>
                                            
                                        </ul>
                                    </div>	
									 <table id="getinves_reporttable" class="table datatable" >
      <thead>
        <tr>
          <th>Sl. No</th>		
          <th>Investigation Date</th>
          <th>Investigation Type</th>
          <th>Patient Name</th>
		  <th>Patient Contact Number</th>
          <th>Dr. Name</th>
          <th>Patient Type</th>
		  
        </tr>
      </thead>
      <tbody>
	  </tbody>
	  </table>
	  </div>

			
					  			
							
 </div> 
										
                                   
									

					</div></div>
					
					<script>
function getinves_report()
{
//alert('sdfd');
var from=$("#inves_report_from").val();
var to=$("#inves_report_to").val();

if($("#inves_report_from").val()=="" || $("#inves_report_to").val()=="")
{
alert("Please Fill DATE field");
return false;
}
		var start = $("#inves_report_from").datepicker("getDate");
        var end = $("#inves_report_to").datepicker("getDate");
        var days = (end - start) / (1000 * 60 * 60 * 24);
		if(days < 0){
			alert("From Date should be less than To date");
			return false;
		}
		if(days > 90){
			alert("Selected Date Range should not be greater than 90 days");
			return false;
		}
var t = $('#getinves_reporttable').DataTable();
$.ajax({
			type: "post",
			url: "getreports.php",
			data: $("#inves_report_form").serialize(),
			
			success: function(msg) {
			//alert(msg);
			var msg=$.trim(msg);
			//alert(msg);
			//$("#billreporttable > tbody").empty();	
			t.clear().draw(false);;	
			if(msg=="")
			{
			$("#getinves_reporttable > tbody").append("<b>No Result Found</b>");
			return false;
			}
			
				var v=msg.split('@');
				var len=v.length;
			var j=1;	
		
		for (i = 0; i <len; i++) 
		{
		var s=j++;
		var x1= v[i].split("~");
		//$("#tbl").show();<a href="printing.php?pid='.$pid.'&maxid='.$maxid.'" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left" target="_blank"><span class="fa fa-print"></span></a>
		//msg='<a href="#" onClick="edit('+x1[6]+');" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-pencil"></span></a> <a href="#" onClick="deletebill($(this));" alt="'+x1[6]+'" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-times"></span></a><a href="printbilling.php?billnumber='+x1[6]+'&patientid='+x1[1]+'" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left" target="_blank"><span class="fa fa-print"></span></a>';
		t.row.add([
        s,
        x1[0],
        x1[1],
		x1[2],
		x1[3],
		x1[4],
		x1[5],
		x1[6], 
    ]).draw();
		 <!--<div class="table-responsive"><table class="table datatable"><thead><tr><th>Study Center</th><th>Patient ID</th><th>Patient Name</th><th>Parents / Spouse Name</th><th>Age</th><th>Gender</th><th>Contact No.</th><th>Occupation</th><th>Address</th><th>Date</th><th>View</th></tr></thead><tbody>-->
		/*var txt = "<tr><td>"+s+"</td><td>"+x1[0]+"</td><td>"+x1[1]+"</td><td>"+x1[2]+"</td><td>"+x1[3]+"</td><td>"+x1[4]+"</td><td>"+x1[5]+"</td></tr>";
	t.append(txt).draw();*/
		}
		//$('#bill1').trigger("reset");
				//alert(len);
				
			}
		});

//alert('');
}

</script>
<!-- End of second tab -->
<!-- Start of fourth tab -->
	<div class="tab-pane" id="tab-fourth">
										<div class="row">
                                        
                                        <div class="col-md-12">
                                            <form id="medi_report_form">
											
											
                                        <div class="form-group">
                                       
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input id="medi_report_from" name="medi_report_from" type="text" class="form-control datepicker" value="<?php $date = strtotime("-7 day");
echo date('Y-m-d', $date); ?> "/>
                                                    <span class="input-group-addon add-on"> - </span>
                                                    <input id="medi_report_to" name="medi_report_to" type="text" class="form-control datepicker" value="<?php echo date("Y-m-d"); ?>"/>
													</div>
                                                </div>
												<div class="col-md-3">
												<input id="request" name="request" type="hidden" class="form-control datepicker" value="medi_report"/>
												<a href="#" class="btn btn-primary pull-left" onClick="getmedi_report();return false;">Search <span class="fa fa-floppy-o fa-right"></span></a>
												</div>
												
                                            </div>
											</form>
                                           
                                            
                                        </div>
										
										<!--<input type="button" onClick="f()">-->
										
                                        <div class="col-md-6">
                                             
											 
                                        </div>
										  <br/><br/>                                           

                                            
                                           <br><br>
                                        
										
													
											   <div class="col-md-12">
									
						
									
								 <div class="table-responsive">
								 <div class="btn-group pull-right">
									<br>
                                        <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
                                        <ul class="dropdown-menu">
                                           <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#billreporttable').tableExport({type:'excel',escape:'false',ignoreColumn:'[7]',ignorerow:'[1]'});"><img src='img/icons/xls.png' width="24"/> XLS</a></li>
                                            <li><a href="#" onClick ="$('#billreporttable').tableExport({type:'doc',ignoreColumn:'[7]',escape:'false'});"><img src='img/icons/word.png' width="24"/> Word</a></li>
                                            
                                            
                                            <li><a href="#" onClick ="$('#billreporttable').tableExport({type:'png',ignoreColumn:'[7]',escape:'false'});"><img src='img/icons/png.png' width="24"/> PNG</a></li>
                                            
                                        </ul>
                                    </div>	
									 <table id="getmedi_reporttable" class="table datatable" >
      <thead>
        <tr>
          <th>Sl. No</th>		
          <th>Medication Date</th>
           <th>Patient Name</th>
		  
          <th>Dr. Name</th>
		  <th>Department</th>
          <th>View Prescription</th>
		  
        </tr>
      </thead>
      <tbody>
	  </tbody>
	  </table>
	  </div>

			
					  			
							
 </div> 
										
                                   
									

					</div></div>
					
					<script>
function getmedi_report()
{
//alert('sdfd');
var from=$("#medi_report_from").val();
var to=$("#medi_report_to").val();

if($("#medi_report_from").val()=="" || $("#medi_report_to").val()=="")
{
alert("Please Fill DATE field");
return false;
}
		var start = $("#medi_report_from").datepicker("getDate");
        var end = $("#medi_report_to").datepicker("getDate");
        var days = (end - start) / (1000 * 60 * 60 * 24);
		if(days < 0){
			alert("From Date should be less than To date");
			return false;
		}
		if(days > 90){
			alert("Selected Date Range should not be greater than 90 days");
			return false;
		}
var t = $('#getmedi_reporttable').DataTable();
$.ajax({
			type: "post",
			url: "getreports.php",
			data: $("#medi_report_form").serialize(),
			
			success: function(msg) {
			//alert(msg);
			var msg=$.trim(msg);
			//alert(msg);
			//$("#billreporttable > tbody").empty();	
			t.clear().draw(false);;	
			if(msg=="")
			{
			$("#getmedi_reporttable > tbody").append("<b>No Result Found</b>");
			return false;
			}
			
				var v=msg.split('@');
				var len=v.length;
			var j=1;	
		
		for (i = 0; i <len; i++) 
		{
		var s=j++;
		var x1= v[i].split("~");
		//$("#tbl").show();<a href="printing.php?pid='.$pid.'&maxid='.$maxid.'" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left" target="_blank"><span class="fa fa-print"></span></a>
		//msg='<a href="#" onClick="edit('+x1[6]+');" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-pencil"></span></a> <a href="#" onClick="deletebill($(this));" alt="'+x1[6]+'" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-times"></span></a><a href="printbilling.php?billnumber='+x1[6]+'&patientid='+x1[1]+'" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left" target="_blank"><span class="fa fa-print"></span></a>';
		t.row.add([
        s,
        x1[0],
        x1[1],
		x1[2],
		x1[3],
		x1[4],
		x1[5],
		x1[6], 
    ]).draw();
		 <!--<div class="table-responsive"><table class="table datatable"><thead><tr><th>Study Center</th><th>Patient ID</th><th>Patient Name</th><th>Parents / Spouse Name</th><th>Age</th><th>Gender</th><th>Contact No.</th><th>Occupation</th><th>Address</th><th>Date</th><th>View</th></tr></thead><tbody>-->
		/*var txt = "<tr><td>"+s+"</td><td>"+x1[0]+"</td><td>"+x1[1]+"</td><td>"+x1[2]+"</td><td>"+x1[3]+"</td><td>"+x1[4]+"</td><td>"+x1[5]+"</td></tr>";
	t.append(txt).draw();*/
		}
		//$('#bill1').trigger("reset");
				//alert(len);
				
			}
		});

//alert('');
}

</script>
<!-- End of fourth tab -->
<!-- Start of fifth tab -->
	<div class="tab-pane" id="tab-fifth">
										<div class="row">
                                        
                                        <div class="col-md-12">
                                            <form id="service_report_form">
											
											
                                        <div class="form-group">
                                       
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input id="service_report_from" name="service_report_from" type="text" class="form-control datepicker" value="<?php $date = strtotime("-7 day");
echo date('Y-m-d', $date); ?> "/>
                                                    <span class="input-group-addon add-on"> - </span>
                                                    <input id="service_report_to" name="service_report_to" type="text" class="form-control datepicker" value="<?php echo date("Y-m-d"); ?>"/>
													</div>
                                                </div>
												<div class="col-md-3">
												<input id="request" name="request" type="hidden" class="form-control datepicker" value="service_report"/>
												<a href="#" class="btn btn-primary pull-left" onClick="getservice_report();return false;">Search <span class="fa fa-floppy-o fa-right"></span></a>
												</div>
												
                                            </div>
											</form>
                                           
                                            
                                        </div>
										
										<!--<input type="button" onClick="f()">-->
										
                                        <div class="col-md-6">
                                             
											 
                                        </div>
										  <br/><br/>                                           

                                            
                                           <br><br>
                                        
										
													
											   <div class="col-md-12">
									
						
									
								 <div class="table-responsive">
								 <div class="btn-group pull-right">
									<br>
                                        <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
                                        <ul class="dropdown-menu">
                                           <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#billreporttable').tableExport({type:'excel',escape:'false',ignoreColumn:'[7]',ignorerow:'[1]'});"><img src='img/icons/xls.png' width="24"/> XLS</a></li>
                                            <li><a href="#" onClick ="$('#billreporttable').tableExport({type:'doc',ignoreColumn:'[7]',escape:'false'});"><img src='img/icons/word.png' width="24"/> Word</a></li>
                                            
                                            
                                            <li><a href="#" onClick ="$('#billreporttable').tableExport({type:'png',ignoreColumn:'[7]',escape:'false'});"><img src='img/icons/png.png' width="24"/> PNG</a></li>
                                            
                                        </ul>
                                    </div>	
									 <table id="getservice_reporttable" class="table datatable" >
      <thead>
        <tr>
          <th>Sl. No</th>		
          <th>Service Date</th>
		  <th>Service Name</th>
		  <th>No. of Times</th>
		  <th>Service Amount</th>
           <th>Patient Name</th>
		  <th>Patient Contact Number</th>
          
		  
        </tr>
      </thead>
      <tbody>
	  </tbody>
	  </table>
	  </div>

			
					  			
							
 </div> 
										
                                   
									

					</div></div>
					
					<script>
function getservice_report()
{
//alert('sdfd');
var from=$("#service_report_from").val();
var to=$("#service_report_to").val();

if($("#service_report_from").val()=="" || $("#service_report_to").val()=="")
{
alert("Please Fill DATE field");
return false;
}
		var start = $("#service_report_from").datepicker("getDate");
        var end = $("#service_report_to").datepicker("getDate");
        var days = (end - start) / (1000 * 60 * 60 * 24);
		if(days < 0){
			alert("From Date should be less than To date");
			return false;
		}
		if(days > 90){
			alert("Selected Date Range should not be greater than 90 days");
			return false;
		}
var t = $('#getservice_reporttable').DataTable();
$.ajax({
			type: "post",
			url: "getreports.php",
			data: $("#service_report_form").serialize(),
			
			success: function(msg) {
			//alert(msg);
			var msg=$.trim(msg);
			//alert(msg);
			//$("#billreporttable > tbody").empty();	
			t.clear().draw(false);;	
			if(msg=="")
			{
			$("#getservice_reporttable > tbody").append("<b>No Result Found</b>");
			return false;
			}
			
				var v=msg.split('@');
				var len=v.length;
			var j=1;	
		
		for (i = 0; i <len; i++) 
		{
		var s=j++;
		var x1= v[i].split("~");
		//$("#tbl").show();<a href="printing.php?pid='.$pid.'&maxid='.$maxid.'" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left" target="_blank"><span class="fa fa-print"></span></a>
		//msg='<a href="#" onClick="edit('+x1[6]+');" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-pencil"></span></a> <a href="#" onClick="deletebill($(this));" alt="'+x1[6]+'" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-times"></span></a><a href="printbilling.php?billnumber='+x1[6]+'&patientid='+x1[1]+'" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left" target="_blank"><span class="fa fa-print"></span></a>';
		t.row.add([
        s,
        x1[0],
        x1[1],
		x1[2],
		x1[3],
		x1[4],
		x1[5],
		x1[6], 
    ]).draw();
		 <!--<div class="table-responsive"><table class="table datatable"><thead><tr><th>Study Center</th><th>Patient ID</th><th>Patient Name</th><th>Parents / Spouse Name</th><th>Age</th><th>Gender</th><th>Contact No.</th><th>Occupation</th><th>Address</th><th>Date</th><th>View</th></tr></thead><tbody>-->
		/*var txt = "<tr><td>"+s+"</td><td>"+x1[0]+"</td><td>"+x1[1]+"</td><td>"+x1[2]+"</td><td>"+x1[3]+"</td><td>"+x1[4]+"</td><td>"+x1[5]+"</td></tr>";
	t.append(txt).draw();*/
		}
		//$('#bill1').trigger("reset");
				//alert(len);
				
			}
		});

//alert('');
}

</script>
<!-- End of fifth tab -->
<!-- Start of sixth tab -->
	<div class="tab-pane" id="tab-sixth">
										<div class="row">
                                        
                                        <div class="col-md-12">
                                            <form id="procedure_report_form">
											
											
                                        <div class="form-group">
                                       
                                            <div class="col-md-4">
                                                <div class="input-group">
                                                    <input id="procedure_report_from" name="procedure_report_from" type="text" class="form-control datepicker" value="<?php $date = strtotime("-7 day");
echo date('Y-m-d', $date); ?> "/>
                                                    <span class="input-group-addon add-on"> - </span>
                                                    <input id="procedure_report_to" name="procedure_report_to" type="text" class="form-control datepicker" value="<?php echo date("Y-m-d"); ?>"/>
													</div>
                                                </div>
												<div class="col-md-3">
												<input id="request" name="request" type="hidden" class="form-control datepicker" value="procedure_report"/>
												<a href="#" class="btn btn-primary pull-left" onClick="getprocedure_report();return false;">Search <span class="fa fa-floppy-o fa-right"></span></a>
												</div>
												
                                            </div>
											</form>
                                           
                                            
                                        </div>
										
										<!--<input type="button" onClick="f()">-->
										
                                        <div class="col-md-6">
                                             
											 
                                        </div>
										  <br/><br/>                                           

                                            
                                           <br><br>
                                        
										
													
											   <div class="col-md-12">
									
						
									
								 <div class="table-responsive">
								 <div class="btn-group pull-right">
									<br>
                                        <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
                                        <ul class="dropdown-menu">
                                           <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#billreporttable').tableExport({type:'excel',escape:'false',ignoreColumn:'[7]',ignorerow:'[1]'});"><img src='img/icons/xls.png' width="24"/> XLS</a></li>
                                            <li><a href="#" onClick ="$('#billreporttable').tableExport({type:'doc',ignoreColumn:'[7]',escape:'false'});"><img src='img/icons/word.png' width="24"/> Word</a></li>
                                            
                                            
                                            <li><a href="#" onClick ="$('#billreporttable').tableExport({type:'png',ignoreColumn:'[7]',escape:'false'});"><img src='img/icons/png.png' width="24"/> PNG</a></li>
                                            
                                        </ul>
                                    </div>	
									 <table id="getprocedure_reporttable" class="table datatable" >
      <thead>
        <tr>
          <th>Sl. No</th>		
          <th>Procedure Date</th>
          <th>Procudure Name</th>
		  <th>No. of Times</th>
		  <th>Procedure Amount</th>
		  <th>Patient Name</th>
		  <th>Patient Contact Number</th>
          <th>Procedure by</th>
		  
        </tr>
      </thead>
      <tbody>
	  </tbody>
	  </table>
	  </div>

			
					  			
							
 </div> 
										
                                   
									

					</div></div>
					
					<script>
function getprocedure_report()
{
//alert('sdfd');
var from=$("#procedure_report_from").val();
var to=$("#procedure_report_to").val();

if($("#procedure_report_from").val()=="" || $("#procedure_report_to").val()=="")
{
alert("Please Fill DATE field");
return false;
}
		var start = $("#procedure_report_from").datepicker("getDate");
        var end = $("#procedure_report_to").datepicker("getDate");
        var days = (end - start) / (1000 * 60 * 60 * 24);
		if(days < 0){
			alert("From Date should be less than To date");
			return false;
		}
		if(days > 90){
			alert("Selected Date Range should not be greater than 90 days");
			return false;
		}
var t = $('#getprocedure_reporttable').DataTable();
$.ajax({
			type: "post",
			url: "getreports.php",
			data: $("#procedure_report_form").serialize(),
			
			success: function(msg) {
			//alert(msg);
			var msg=$.trim(msg);
			//alert(msg);
			//$("#billreporttable > tbody").empty();	
			t.clear().draw(false);;	
			if(msg=="")
			{
			$("#getprocedure_reporttable > tbody").append("<b>No Result Found</b>");
			return false;
			}
			
				var v=msg.split('@');
				var len=v.length;
			var j=1;	
		
		for (i = 0; i <len; i++) 
		{
		var s=j++;
		var x1= v[i].split("~");
		//$("#tbl").show();<a href="printing.php?pid='.$pid.'&maxid='.$maxid.'" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left" target="_blank"><span class="fa fa-print"></span></a>
		//msg='<a href="#" onClick="edit('+x1[6]+');" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-pencil"></span></a> <a href="#" onClick="deletebill($(this));" alt="'+x1[6]+'" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-times"></span></a><a href="printbilling.php?billnumber='+x1[6]+'&patientid='+x1[1]+'" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left" target="_blank"><span class="fa fa-print"></span></a>';
		t.row.add([
        s,
        x1[0],
        x1[1],
		x1[2],
		x1[3],
		x1[4],
		x1[5],
		x1[6], 
    ]).draw();
		 <!--<div class="table-responsive"><table class="table datatable"><thead><tr><th>Study Center</th><th>Patient ID</th><th>Patient Name</th><th>Parents / Spouse Name</th><th>Age</th><th>Gender</th><th>Contact No.</th><th>Occupation</th><th>Address</th><th>Date</th><th>View</th></tr></thead><tbody>-->
		/*var txt = "<tr><td>"+s+"</td><td>"+x1[0]+"</td><td>"+x1[1]+"</td><td>"+x1[2]+"</td><td>"+x1[3]+"</td><td>"+x1[4]+"</td><td>"+x1[5]+"</td></tr>";
	t.append(txt).draw();*/
		}
		//$('#bill1').trigger("reset");
				//alert(len);
				
			}
		});

//alert('');
}

</script>
<!-- End of sixth tab -->


                                        <div class="tab-pane" id="tab-first">
										<div class="row">
                                         <form class="form-horizontal" id="reports" name="reports">
                                        <div class="col-md-4">
                                            
                                            
                                            
                                            
                                            <div class="form-group">
                                               <!-- <label class="col-md-4 control-label">Psychiatric Symptoms:</label>-->
                                                <div class="col-md-8">
												<div class="input-group"> 
												<span class="input-group-addon"><span class="fa fa-pencil"></span></span>                                   
										<input name="pid" type="text" id="pid" class="form-control"  placeholder="Patient ID">
															</div>
										<span class="help-block">Patient ID</span>
							
											</div>
										
										
                                            </div>
                                            
                                            <!--<div class="form-group">
                                                <label class="col-md-3 control-label">Checkbox</label>
                                                <div class="col-md-9">                                                                                                                                        
                                                    <label class="check"><input type="checkbox" class="icheckbox" checked="checked"/> Checkbox title</label>
                                                    <span class="help-block">Checkbox sample, easy to use</span>
                                                </div>
                                            </div>-->
											
                                            <div class="form-group">
                                               <!-- <label class="col-md-4 control-label">Symptoms:</label>-->
                                                <div class="col-md-4">                                                
												                                           
										<select name="age_sel" style="width:auto" class="form-control select" id="age_sel" onChange="if (this.value == 'Between') {
                                    this.form['age2'].style.visibility = 'visible'
                                } else {
                                    this.form['age2'].style.visibility = 'hidden'
                                }
                                ;">
                                <option>Select</option>
                                <option>Equal</option>
                                <option>Less than</option>
                                <option>Greater than</option>
                                <option>Between</option>
								 </select>
								 <span class="help-block">Select Option</span>
								 </div>
								   <div class="col-md-4"> 
								 <div class="input-group"> 
												<span class="input-group-addon"><span class="fa fa-pencil"></span></span>
								<input name="age1" type="text" class="form-control" id="age1" style="width:55px" placeholder="Age" />
								
								</div>
								<span class="help-block">Age</span>
								</div>
								
								  <div class="col-md-2"> 
								   <div class="input-group"> 
												
								<input name="age2" type="text" class="form-control" id="age2" style="width:55px;visibility:hidden;" placeholder="Age" />
								

    <!--list="symp" -->						</div>
	
	</div>
										
										
                                            </div>
                                            
                                           
                                            <div class="form-group">
                                               <!-- <label class="col-md-4 control-label">Allergies(if any):</label>-->
                                                <div class="col-md-8">                                            
                                                   
                                                      <select name="gender" id="gender" class="form-control select" style="width:auto">  
                                                       <option>Select</option>
													<option>Male</option>
													<option>Female</option>
												</select>
                                                                                               
                                                    <span class="help-block">Select Gender</span>
                                                </div>
                                            </div>
                                            
                                        </div>
										
										<!--<input type="button" onClick="f()">-->
										
                                        <div class="col-md-4">
                                             <div class="form-group">
                                               <!-- <label class="col-md-4 control-label">Allergies(if any):</label>-->
                                                <div class="col-md-10">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="diagnosis" list="diag" placeholder="Diagnosis:" id="diagnosis" class="form-control"/>
														<datalist id="diag">
													<?php
													include("config_db1.php");
													$cmd2 = "select icd_id,diag_sym from diagnosis order by icd_id asc";
													$res2 = mysql_query($cmd2);
													while($rs2 = mysql_fetch_array($res2)){
														echo '<option title="'.$rs2['diag_sym'].'">'.$rs2['icd_id'].' - '.$rs2['diag_sym'].'</option>';
													}
													mysql_close($db1);
													?>
													</datalist>
                                                    </div>                                            
                                                    <span class="help-block">Diagnosis</span>
                                                </div>
                                            </div>
                                            
											<div class="form-group">
                                               <!-- <label class="col-md-4 control-label">Allergies(if any):</label>-->
                                                <div class="col-md-10">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="medicalhist" list="medi" placeholder="Other Medical History" id="medicalhist" class="form-control"/>
														<datalist id="medi">
													 <?php
														include("config_db1.php");
														$cmd3 = "select med_his from medicalhistory order by med_his asc";
														$res3 = mysql_query($cmd3);
														while($rs3 = mysql_fetch_array($res3)){
															echo '<option title="'.$rs3['med_his'].'">'.$rs3['med_his'].'</option>';
														}
														mysql_close($db1);
													?>
													</datalist>
                                                    </div>                                            
                                                    <span class="help-block">Other Medical History</span>
                                                </div>
                                            </div>
											
											<div class="form-group">
                                               <!-- <label class="col-md-4 control-label">Allergies(if any):</label>-->
                                                <div class="col-md-10">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="psyhist" placeholder="<?php echo $display; ?> History" id="psyhist"  class="form-control"/>
														
                                                    </div>                                            
                                                    <span class="help-block"><?php echo $display; ?> History</span>
                                                </div>
                                            </div>
                                        </div>
                                        
										
										<div class="col-md-4">
                                             <div class="form-group">
                                               <!-- <label class="col-md-4 control-label">Allergies(if any):</label>-->
                                                <div class="col-md-10">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="symptoms" placeholder="Symptoms:" id="symptoms" list="symp" class="form-control"/>
														<datalist id="symp">
														<?php
														include("config_db1.php");
														$cmd1 = "select symptom from symptoms order by symptom asc";
														$res1 = mysql_query($cmd1);
														while($rs1 = mysql_fetch_array($res1)){
															echo '<option title="'.$rs1['symptom'].'">'.$rs1['symptom'].'</option>';
														}
														mysql_close($db1);
														?>
														</datalist>
                                                    </div>                                            
                                                    <span class="help-block">Symptoms</span>
                                                </div>
                                            </div>
                                            
											
											<div class="form-group">
                                               <!-- <label class="col-md-4 control-label">Allergies(if any):</label>-->
                                                <div class="col-md-10">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="familyhist" placeholder="Family History" id="familyhist" list="medi" class="form-control"/>
														
                                                    </div>                                            
                                                    <span class="help-block">Family History</span>
                                                </div>
                                            </div>
											
											<div class="form-group">
                                               <!-- <label class="col-md-4 control-label">Allergies(if any):</label>-->
                                                <div class="col-md-10">                                            
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                        <input type="text" name="pershist" placeholder="Personal History" id="pershist"  class="form-control"/>
														
                                                    </div>                                            
                                                    <span class="help-block">Personal History</span>
                                                </div>
                                            </div>
											<br>
                                        </div>
                                    </div>
									</form>
									<div class="col-lg-12">
                  <div class="form-group">
				    <div class="col-lg-4">
                                    <a href="#" onClick="searching();return false;" class="btn btn-primary pull-left">Search <span class="fa fa-floppy-o fa-right"></span></a>     									</div>
									
									
									
									
									</div><br><br></div>
									
									


									<div class="col-md-12">
									

								 <div class="table-responsive">
									 <table id="reporttable" class="table datatable display" >
      <thead>
        <tr>
          <th>Sl. No</th>		
          <th>Study Center</th>
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
        </tr>
      </thead>
      <tbody>
	  </tbody>
	  
	  </table>
	   
	  </div>

					
										 </div>


									 <div class="btn-group pull-right">
									<br>
                                        <button class="btn btn-danger dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Data</button>
                                        <ul class="dropdown-menu">
                                           <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#reporttable').tableExport({type:'excel',escape:'false',ignoreColumn:'[11]',ignorerow:'[1]'});"><img src='img/icons/xls.png' width="24"/> XLS</a></li>
                                            <li><a href="#" onClick ="$('#reporttable').tableExport({type:'doc',escape:'false'});"><img src='img/icons/word.png' width="24"/> Word</a></li>
                                            <li><a href="#" onClick ="$('#reporttable').tableExport({type:'powerpoint',escape:'false'});"><img src='img/icons/ppt.png' width="24"/> PowerPoint</a></li>
                                            <li class="divider"></li>
                                            <li><a href="#" onClick ="$('#reporttable').tableExport({type:'png',escape:'false'});"><img src='img/icons/png.png' width="24"/> PNG</a></li>
                                            <li><a href="#" onClick ="$('#reporttable').tableExport({type:'pdf',escape:'false'});"><img src='img/icons/pdf.png' width="24"/> PDF</a></li>
                                        </ul>
                                    </div>

									   
                                        </div>
										                                                                       
                                       
                                    
								
					
					
					                             
	
                                                        
                                        
										
										
										
										
										
										
										
										
										
                                    </div>
                                 
									
                                </div>                                
                            
                            </form>
                            
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
        
		
	
      

        <!-- MODALS -->
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
		<script type="text/javascript" src="js/plugins/datatables/jquery.dataTables.min.js"></script>  
		        <script type="text/javascript" src="js/plugins/tableexport/tableExport.js"></script>
	<script type="text/javascript" src="js/plugins/tableexport/jquery.base64.js"></script>
	<script type="text/javascript" src="js/plugins/tableexport/html2canvas.js"></script>
	<script type="text/javascript" src="js/plugins/tableexport/jspdf/libs/sprintf.js"></script>
	<script type="text/javascript" src="js/plugins/tableexport/jspdf/jspdf.js"></script>   
        
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
		<div id="ddd">
		<!--<script type="text/javascript" src="chat/js/chat.js"></script>-->
		</div>
        <!--<script type="text/javascript" src="chat/js/jquery.js"></script>-->

       <!-- <script type="text/javascript" src="js/demo_edit_profile.js"></script>-->
        <!-- END TEMPLATE -->

    <!-- END SCRIPTS -->
	
    <!-- COUNTERS // NOT INCLUDED IN TEMPLATE -->
        <!-- GOOGLE -->
		<script>
function searching()
{

age=$("#age_sel").val();
pid=$("#pid").val();
age1=$("#age1").val();
age2=$("#age2").val();
//if(age=="Select" && $("#pid").val()=="" && $("#diagnosis").val()=="" && $("#symptoms").val()=="" && $("#medicalhist").val()==""
//&& $("#familyhist").val()=="" && $("#psyhist").val()=="" && $("#pershist").val()=="" && $("#gender").val()=="Select")
//{
//alert("Please Fill any one field");
//return false;
//}

if(age!="Select") {
if (age == "Between"){ 
if (age1 == "" || age2 == "")
{
alert("Select Between Ages");
return false;
}
}else
{ if (age1 == "") {
alert("Enter Age");
return false;
}}

}


//alert('');

$.ajax({
			type: "post",
			url: "generatereport.php",
			data: $("#reports").serialize(),
			
			success: function(msg) {
			var msg=$.trim(msg);
			//alert(msg);
			//return false;
			var t = $('#reporttable').DataTable();
			//new $.fn.DataTable.FixedColumns(table);
//t.clear().draw(false);
			if(msg=="")
			{
			t.clear().draw(false);
			return false;
			}
			
			
				var v=msg.split('@');
				var len=v.length;
			var j=1;	
			$("#reporttable > tbody").empty();
		for (i = 0; i <len; i++) 
		{
		var s=j++;
		var x1= v[i].split("~");
		//$("#tbl").show();
		var but='<a href="patient-info.php?pid='+x1[1]+'" class="profile-control-left twitter"><span class="fa fa-pencil"></span></a>';
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
		x1[8],
		x1[9],
		but, 
    ]).draw();
		
		 <!--<div class="table-responsive"><table class="table datatable"><thead><tr><th>Study Center</th><th>Patient ID</th><th>Patient Name</th><th>Parents / Spouse Name</th><th>Age</th><th>Gender</th><th>Contact No.</th><th>Occupation</th><th>Address</th><th>Date</th><th>View</th></tr></thead><tbody>-->
		/*var txt = "<tr><td>"+s+"</td><td>"+x1[0]+"</td><td>"+x1[1]+"</td><td>"+x1[2]+"</td><td>"+x1[3]+"</td><td>"+x1[4]+"</td><td>"+x1[5]+"</td><td>"+x1[6]+"</td><td>"+x1[7]+"</td><td>"+x1[8]+"</td><td>"+x1[9]+"</td><td>"+x1[5]+"</td></tr>";*/
	//$("#reporttable > tbody").append(txt);
		}
		$('#reports').trigger("reset");
				//alert(len);
				
			}
		});

//alert('');
}

</script>
		
		 
		




		
        <!--<script type="text/javascript">
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
          (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
          m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','../../../../www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-36783416-1', 'aqvatarius.com');
          ga('send', 'pageview');
        </script>-->        
        <!-- END GOOGLE -->
        
        <!-- YANDEX -->
        <!--<script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter25836617 = new Ya.Metrika({id:25836617,
                            webvisor:true,
                            accurateTrackBounce:true});
                } catch(e) { }
            });

            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";

            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
        </script>-->
        <!--<noscript><div><img src="http://mc.yandex.ru/watch/25836617" style="position:absolute; left:-9999px;" alt="" /></div></noscript>    --> 
        <!-- END YANDEX -->
    <!-- END COUNTERS // NOT INCLUDED IN TEMPLATE -->
    
    </body>
	<!--<script>
		$(document).ready(function() {
		
    var table = $('#reporttable').DataTable();
    
    $('#reporttable tbody').on( 'click', 'tr', function (){
        $(this).toggleClass('sel');
    } );
	 } );
	</script>-->
	<script>

$(document).ready(function() {
    var table = $('#billreporttable1').DataTable();
 
    $('#billreporttable tbody').on( 'click', 'tr', function () {
        $(this).toggleClass('sel');
		hi();
    } );
 
   
} );
		

	</script> 
	
	<script>
function hi()
{
//alert('');
var s="";
$("#billreporttbody").html("");
var s =$('.sel').html();
var collection = $(".sel");
collection.each(function() {
var g=$(this).html();
g="<tr>"+g+"</tr>";
  $("#billreporttbody").append(g);  
});
//alert($('.sel').length); 

}
</script> 
<script>
		 $(document).ready(function(){
			 //function for converting string into indian currency format
    function intToFormat(nStr)
    {
     nStr += '';
     x = nStr.split('.');
     x1 = x[0];
     x2 = x.length > 1 ? '.' + x[1] : '';
     var rgx = /(\d+)(\d{3})/;
     var z = 0;
     var len = String(x1).length;
     var num = parseInt((len/2)-1);
 
      while (rgx.test(x1))
      {
        if(z > 0)
        {
          x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        else
        {
          x1 = x1.replace(rgx, '$1' + ',' + '$2');
          rgx = /(\d+)(\d{2})/;
        }
        z++;
        num--;
        if(num == 0)
        {
          break;
        }
      }
     return x1 + x2;
    }
	$('#billreporttable_fee').DataTable( {
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
 
            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };
 
            // Total over all pages
            total = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Total over this page
            pageTotal = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );
 
            // Update footer
			$( api.column( 5 ).footer() ).html(
                'Rs '+intToFormat(pageTotal.toFixed(2))+' ( Rs '+ intToFormat(total.toFixed(2)) +' total)'
            );
			
        }
    } );
    
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

/*if ($(".chatbox").is(":visible")) {
  startChatSession();
}*/
	
   
    }, 5000);
});
</script> 
<!-- Mirrored from aqvatarius.com/themes/atlant/html/pages-edit-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2015 09:47:54 GMT -->
</html>



