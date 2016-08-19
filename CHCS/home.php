<?php
session_start();
$role=$_SESSION['role'];
date_default_timezone_set('Asia/Kolkata');
include("config_db1.php");
 $cmd=mysql_query("select * from settings where role='$role'");
 mysql_close($db1);
$sql=mysql_fetch_array($cmd);


$up = $_REQUEST['up'];
if($up != ''){
	echo "<script>alert('Success');</script>";
	echo "<script>window.location.href='home.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from aqvatarius.com/themes/atlant/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2015 09:32:53 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<!-- /Added by HTTrack -->
<head>
<!-- META SECTION -->
<title>DPP-Home</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<!-- END META SECTION -->
<!-- CSS INCLUDE -->
<link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css">
<link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
<!--<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script> -->
<script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
<script>


$(document).ready(function() {
if($("#reportrange").length > 0){   
        $("#reportrange").daterangepicker({                    
            ranges: {
               'Today': [moment(), moment()],
               'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Last 7 Days': [moment().subtract(6, 'days'), moment()],
               'Last 30 Days': [moment().subtract(29, 'days'), moment()],
               'This Month': [moment().startOf('month'), moment().endOf('month')],
               'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'left',
            buttonClasses: ['btn btn-default'],
            applyClass: 'btn-small btn-primary',
            cancelClass: 'btn-small',
            format: 'MM.DD.YYYY',
            separator: ' to ',
            startDate: moment().subtract('days', 29),
            endDate: moment()            
          },function(start, end) {
              //$('ul.ui-widget-content').hide();
			  $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });
        
        $("#reportrange span").html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
    }
//alert('');
$(".ranges li:last-child ").hide();
$(".range_inputs").hide();
$(".ranges ul > li ").click(function(event){
        //event.stopPropagation();
		//alert('');
		//var txt= $('.ranges ul').find('li.active').html();
		var txt= $(this).html();
		//var txt=$('#reportrange span').text();
		txt=$.trim(txt);
		$("#consname").empty();
		$("#consname").text(txt+' Consolidated Report');
		if(txt=="Today")
		txt=1;
		else if(txt=="Yesterday")
		txt=2;
		else if(txt=="Last 7 Days")
		txt=3;
		else if(txt=="Last 30 Days")
		txt=4;
		else if(txt=="This Month")
		txt=5;
		else 
		txt=6;
		
		$.ajax({
		type: "GET",
		url: "getconsolidate.php?txt="+txt,
		success: function(msg) {
		//alert(msg);
		var msg=$.trim(msg);
		var x=msg.split("~");
		
		var y=x[1]+'/'+x[0];
		
		$("#totfee").empty();
		$("#totfeegr").empty();
		$("#totfeegr").css("width", x[2]+'%');
		$("#totfee").text(y);
		$("#totfeegr").text(x[2]+'%');
		$("#duetble").empty();
		$("#duetblegr").empty();
		var z=x[4]+'/'+x[0];
		$("#duetble").text(z);
		$("#duetblegr").css("width", +x[3]+'%');
		$("#duetblegr").text(x[3]+'%');
		$("#appnum").empty();
		$("#appgr").empty();
		$("#appnum").text(x[8]);
		$("#appgr").css("width", +x[5]+'%');
		$("#appgr").text(x[5]+'%');
		var p=x[7]+'/'+x[8];
		$("#psee").empty();
		$("#pseegr").empty();
		$("#psee").text(p);
		$("#appgr").css("width", x[6]+'%');
		$("#appgr").text(x[6]+'%');
		
		}
	});
		//alert(txt);
		
		});

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
	$.ajax({
		type: "GET",
		url: "return_doctor.php",
		success: function(msg) {
		//alert(msg);
			var availableTags = msg.split("~");
			$( "#appdoctor" ).autocomplete({
			  source: availableTags
			});
		}
	});
	
});

       $(document).ready(function(){

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
		
		var txt='<a href="messages.php" class="list-group-item"><div class="list-group-status status-away"></div><img src="return_profile_img.php?name='+y[0]+'" class="pull-left" alt="'+y[0]+'"/> <span class="contacts-title">'+y[0]+' </span><p>'+y[1]+'</p></a>';
		//alert(txt);
		$('#appmsg').append(txt);
		});
		}
});
	
   
    }, 5000);
});
        </script>
<!-- EOF CSS INCLUDE -->
</head>
<body>
<!-- START PAGE CONTAINER -->
<div class="page-container">
  <?php include('navication.php'); ?>
  <!-- START PAGE SIDEBAR -->
  <!-- END PAGE SIDEBAR -->
  <!-- PAGE CONTENT -->
  <div class="page-content" style="height:720px">
    <!-- START X-NAVIGATION VERTICAL -->
    <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
      <!-- TOGGLE NAVIGATION -->
      <li class="xn-icon-button"> <a href="#" class="x-navigation-minimize"><span class="fa fa-dedent"></span></a> </li>
      <!-- END TOGGLE NAVIGATION -->
      <!-- SEARCH -->
      <li class="xn-search">
        <form role="form" method="post" action="#" onSubmit="dispid()">
          <input type="text" id="search" onBlur="dispid()" name="search" placeholder="Search patient details..."/>
        </form>
      </li>
      <!-- END SEARCH -->
      <!-- POWER OFF -->
      <li class="xn-icon-button pull-right last"> <a href="#"><span class="fa fa-power-off"></span></a>
        <ul class="xn-drop-left animated zoomIn">
        <!--  <li><a href="pages-lock-screen.html"><span class="fa fa-lock"></span> Lock Screen</a></li> -->
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
      <!--<li class="xn-icon-button pull-right"> <a href="#"><span class="flag flag-gb"></span></a>
        <ul class="xn-drop-left xn-drop-white animated zoomIn">
          <li><a href="#"><span class="flag flag-gb"></span> English</a></li>
          <li><a href="#"><span class="flag flag-de"></span> Deutsch</a></li>
          <li><a href="#"><span class="flag flag-cn"></span> Chinese</a></li>
        </ul>
      </li>-->
      <!-- END LANG BAR -->
    </ul>
    <!-- END X-NAVIGATION VERTICAL -->
    <!-- START BREADCRUMB -->
    <ul class="breadcrumb">
      <li><a href="#">Home</a></li>
      <li class="active">Dashboard</li>
    </ul>
    <!-- END BREADCRUMB -->
    <!-- PAGE CONTENT WRAPPER -->
    <div class="page-content-wrap">
      <!-- START WIDGETS -->
      <div class="row">
        <div class="col-md-3">
          <?php
							include("config_db2.php");
									$cmd = mysql_query("SELECT
									count(id) AS count1,
									SUM(CASE WHEN `time` LIKE '".date('Y-m-d')."' THEN 1 ELSE 0 END) AS count2
									FROM patientdetails");
									$rs=mysql_fetch_array($cmd);
							 $totaluser  = $rs['count1'];
							  $newuser  = $rs['count2'];
							 mysql_close($db2);
							 ?>
          <!-- START WIDGET SLIDER -->
          <div class="widget widget-default widget-carousel">
            <div class="owl-carousel" id="owl-example">
              <div>
                <div class="widget-int num-count"><?php echo $totaluser; ?></div>
                <div class="widget-title">Registered users</div>
                <div class="widget-subtitle">In your Hospital</div>
              </div>
              <!--<div>                                    
                                        <div class="widget-title">Current</div>
                                        <div class="widget-subtitle">Visitors</div>
                                        <div class="widget-int">1,695</div>
                                    </div>-->
              <div>
                <div class="widget-title">New</div>
                <div class="widget-subtitle">Registered</div>
                <div class="widget-int"><?php echo $newuser; ?></div>
              </div>
            </div>
            <div class="widget-controls"> <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a> </div>
          </div>
          <!-- END WIDGET SLIDER -->
        </div>
        <div class="col-md-3">
          <!-- START WIDGET MESSAGES -->
          <div class="widget widget-default widget-item-icon" onClick="location.href='messages.php';">
            <div class="widget-item-left"> <span class="fa fa-envelope"></span> </div>
            <div class="widget-data">
              <div class="widget-int num-count" id="notifi">0</div>
              <div class="widget-title">New messages</div>
              <div class="widget-subtitle">In your mailbox</div>
            </div>
            <div class="widget-controls"> <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a> </div>
          </div>
          <!-- END WIDGET MESSAGES -->
        </div>
        <div class="col-md-3">
          <!-- START WIDGET REGISTRED -->
          <div class="widget widget-default widget-item-icon" onClick="location.href='messages.php';">
            <div class="widget-item-left"> <span class="fa fa-user"></span> </div>
            <div class="widget-data">
              <div id="divOnlineUserCount" class="widget-int num-count">0</div>
              <div class="widget-title">Online users</div>
              <div class="widget-subtitle">In your Hospitals</div>
            </div>
            <div class="widget-controls"> <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a> </div>
          </div>
          <!-- END WIDGET REGISTRED -->
        </div>
        <div class="col-md-3">
          <!-- START WIDGET CLOCK -->
          <div class="widget widget-danger widget-padding-sm">
            <div class="widget-big-int plugin-clock">00:00</div>
            <div class="widget-subtitle plugin-date">Loading...</div>
            <div class="widget-controls"> <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget"><span class="fa fa-times"></span></a> </div>
            <div class="widget-buttons widget-c3">
              <div class="col"> <a href="#"><span class="fa fa-clock-o"></span></a> </div>
              <div class="col"> <a href="#"><span class="fa fa-bell"></span></a> </div>
<style>
#idh:hover{
	background:none;
}
hell{
	
}
</style>
<script>
$(document).ready(function(){
    $("#apptoo").click(function(){
        $('.hell').toggle();
    });
});</script>
              <div class="col">
			  <?php if($_SESSION['role']!=3) { ?>
              <ul class="x-navigation x-navigation-horizontal x-navigation-panel" style="height:0px;">
                <!--<ul class="x-navigation temp" style="height: 40px;">-->
                <li id="apptoo" class="xn-icon-button pull-right " style="bottom: 10px; right:20px;"> <a  data-toggle="tooltip" data-placement="top" href="#" title="Fix Appointment"><span style="font-size: 18px;" class="fa fa-calendar" id="idh"></span></a>
                  <!--<ul class="x-navigation x-navigation-horizontal x-navigation-panel"> -->
                  <div class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging hell">
                    <div class="panel-heading">
                      <h3 class="panel-title"><span class="fa fa-comments"></span> Appointment</h3>
                      <div class="pull-right"> <span class="label label-danger"></span> </div>
                    </div>
                    <form class="form-horizontal" id="appointment" onSubmit="return saveapp()" action="save_app.php" role="form">
                      <div  class="panel-body list-group list-group-contacts scroll mCustomScrollbar _mCS_2 mCS-autoHide mCS_no_scrollbar" style="height: 200px;">
                        <div tabindex="0" id="mCSB_2" class="mCustomScrollBox mCS-light mCSB_vertical mCSB_inside">
                          <div id="mCSB_2_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
                            <div class="list-group-item">
                              <input name="appdate" type="text" id="appdate"class="form-control"  placeholder="Appointment Date">
                              <br>
                              <input name="apppatient" type="text" id="apppatient"  class="form-control"  placeholder="Patient Name">
                              <br>
                              <input name="appphone" type="text" id="appphone"  onBlur="appsearch()" class="form-control" placeholder="Patient Phone number or Patient id">
                              <br>
							 
                              <input name="appdoctor" type="text" id="appdoctor"  class="form-control"  placeholder="Doctor Name">
                           
						    </div>
                          </div>
                          <div style="display: none;" id="mCSB_2_scrollbar_vertical" class="mCSB_scrollTools mCSB_2_scrollbar mCS-light mCSB_scrollTools_vertical">
                            <div class="mCSB_draggerContainer">
                              <div id="mCSB_2_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 30px; top: 0px; display: block; height: 163px; max-height: 190px;" oncontextmenu="return false;">
                                <div style="line-height: 30px;" class="mCSB_dragger_bar"></div>
                              </div>
                              <div class="mCSB_draggerRail"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="panel-footer text-center">
                      <input type="reset" class="btn btn-info" value="Clear">
                      <input type="submit" class="btn btn-success" value="Fix Appointments">
                    </form>
                  </div>
                </div>
                </li>
                <!-- END MESSAGES -->
                <!-- TASKS -->
                <!-- END TASKS -->
                <!-- LANG BAR -->
                <!-- END LANG BAR -->
              </ul>
			  
			  <?php } ?>
            </div>
          </div>
        </div>
        <!-- END WIDGET CLOCK -->
      </div>
    </div>
    <!-- END WIDGETS -->
	<?php if($_SESSION['role']!=3) { 
	 include("config_db2.php");
	//echo $role;
	if($role==4) {
	$name=$_SESSION['username'];
	//echo $role;
	$fee1 = mysql_query("SELECT sum(a.`fees`)as tot,sum(a.`pay`) as pay ,concat(round(( sum(a.`pay`)/sum(a.`fees`)* 100 ),2)) AS percentage,SUM(a.`fees`-a.`pay`) AS due,concat(round(( SUM(a.`fees`-a.`pay`)/sum(a.`fees`)* 100 ),2)) AS duepercentage  FROM billing as a inner join complaints as b on a.patientid=b.patientid WHERE cast(a.created_at  as date) = '".date("Y-m-d")."' and cast(b.datetime  as date)='".date("Y-m-d")."' and b.prescribed_by='$name'");
	}
	else  {
	$fee1 =mysql_query("SELECT sum(`fees`)as tot,sum(`pay`) as pay ,concat(round(( sum(`pay`)/sum(`fees`)* 100 ),2)) AS percentage,SUM(`fees`-`pay`) AS due,concat(round(( SUM(`fees`-`pay`)/sum(`fees`)* 100 ),2)) AS duepercentage  FROM billing WHERE cast(created_at  as date) = '".date("Y-m-d")."'");
	}
	//echo $fee1;
//echo $_SESSION['role'];
	//echo "SELECT sum(fees) as tot,sum(pay) as totpay,concat(round(( tot/pay * 100 ),2),'%') AS percentage FROM billing WHERE cast(created_at  as date) = '".date("Y-m-d")."'";
	$refee=mysql_fetch_array($fee1);
	$totalfees=$refee['tot'];
	$totalpay=$refee['pay'];
	$feespercentage=$refee['percentage'];
	$duepercentage=$refee['duepercentage'];
	$totaldue=$refee['due'];
	//echo $feespercentage;
	if($totalfees=='NULL' || $totalfees=="")
	$totalfees=0;
	if($totalpay=='NULL' || $totalpay=="")
	$totalpay=0;
	if($feespercentage=='NULL' || $feespercentage=="")
	$feespercentage=0;
	if($totaldue=='NULL' || $totaldue=="")
	$totaldue=0;
	//mysql_close($db1);
    
		
	//echo "select * from appointments where date='".date("Y-m-d")."' and status=1";
	
				if($_SESSION['role']==4) 
				$sql=mysql_query("select * from appointments where date='".date("Y-m-d")."' and status=1 and doctor='".$_SESSION['username']."'");
				else
					$sql=mysql_query("select * from appointments where date='".date("Y-m-d")."' and status=1");
					//echo "select * from appointments where date='".date("Y-m-d")."' and status=1";
					$sql1=mysql_query("select id from appointments where date='".date("Y-m-d")."'");
					//echo $sql;
					$num=mysql_num_rows($sql);
					$tot=mysql_num_rows($sql1);
					if($num == 0 || $tot == 0)
						$s = 0;
					else
						$s=($num/$tot)*100;
					//include("config_db2.php");
//										$cmd=mysql_query("select sum(fees) as fees,sum(pay) as pay from billing where cast(a.created_at as date)='".date("Y-m-d")."'");						$row=mysql_fetch_array($cmd);
//										$row['fees']
				
				$ss = mysql_query("SELECT distinct patientid FROM complaints WHERE cast(datetime as date) = '".date("Y-m-d")."'");
				
				$seen = mysql_num_rows($ss);
					if($_SESSION['lidate'] < 10) {  ?>
					<div class="col-lg-12">  
									<div class="alert alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true" >x</button><div class="error-container">
									<div class="well">
										<h1 class="grey lighter smaller">
											<span class="blue bigger-125">
												<i class="ace-icon fa fa-random"></i>
																							</span>
											Something Went Wrong										</h1>

										<hr />
										<h3 class="lighter smaller">
											
											<i class="ace-icon fa fa-key icon-animated-wrench bigger-125"></i>
											Your Product License Expired with in <?php echo $_SESSION['lidate']; ?>  days										</h3>

										<div class="space"></div>

										<div>
											<h4 class="lighter smaller">Please Contact</h4>

											<ul class="list-unstyled spaced inline bigger-110 margin-15">
												<li>
													<i class="ace-icon fa fa-hand-o-right blue"></i>
													<a href="http://spartasolutions.in" target="_blank" style="text-decoration:none;">Sparta Software Solutions</a>												</li>

												<li>
													<i class="ace-icon fa fa-phone blue"></i>
													<a style="text-decoration:none;">+91 44 438 68 177</a>												</li>
											</ul>
										</div>

										<hr />
										<div class="space"></div>

										
									</div>
								</div></div> </div>
								
								
								<?php } ?>
    <div class="row">
      <div class="col-md-8">
        <!-- START SALES BLOCK -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-title-box">
              <h3 id="consname">Today Consolidated Report </h3>
              <!--<span>Sales activity by period you selected</span> -->
            </div>
            <ul class="panel-controls panel-controls-title">
              <li>
                <div id="reportrange" class="dtrange"> <span></span><b class="caret"></b> </div>
              </li>
              <li><a href="#" class="panel-fullscreen rounded"><span class="fa fa-expand"></span></a></li>
            </ul>
          </div>
          <div class="panel-body" style="min-height:463px;">
            <div class="row stacked">
              <div class="col-md-12">
                <div class="progress-list">
                  <div class="pull-left"><strong><a hrf="#" data-toggle="modal" data-target="#apptable" style="cursor:pointer">Total Appointments</a></strong></div>
                  <div class="pull-right" id="appnum"><?php echo $num . ' / ' . $tot; ?> </div>
                  <div class="progress progress-small progress-striped active">
                    <div id="appgr" class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $s; ?>%;"><?php echo $s; ?>%</div>
                  </div>
                </div>
				
                <div class="progress-list">
                  <div class="pull-left"><strong>Total Patients seen</strong></div>
                  <div class="pull-right" id="psee"><?php echo $seen . ' / ' . $tot; ?></div>
                  <div class="progress progress-small progress-striped active">
                    <div id="pseegr" class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $seen; ?>%;"><?php echo $seen; ?>%</div>
                  </div>
                </div>
                <div class="progress-list">
                  <div class="pull-left"><strong class="text-danger">Total Fees</strong></div>
                  <div class="pull-right" id="totfee"><?php echo $totalpay.'/'.$totalfees; ?></div>
                  <div class="progress progress-small progress-striped active">
                    <div id="totfeegr" class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $feespercentage.'%'; ?>;"><?php echo $feespercentage.'%';?></div>
                  </div>
                </div>
                <div class="progress-list">
                  <div class="pull-left"><strong class="text-warning">Due's</strong></div>
                  <div class="pull-right" id="duetble"><?php echo $totaldue.'/'.$totalfees; ?></div>
                  <div class="progress progress-small progress-striped active">
                    <div id="duetblegr" class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width:  <?php echo $duepercentage.'%'; ?>;"><?php echo $duepercentage.'%';?></div>
                  </div>
                </div>
                <!--<p><span class="fa fa-warning"></span> Data update in end of each hour. You can update it manual by pressign update button</p> -->
              </div>
              <div class="col-md-8">
                <div id="dashboard-map-seles" style="width: 100%; height: 200px"></div>
              </div>
            </div>
          </div>
        </div>
        <!-- END SALES BLOCK -->
      </div>
      <div class="col-md-4">
        <!-- START PROJECTS BLOCK -->
        <div class="panel panel-default">
          <div class="panel-heading">
            <div class="panel-title-box">
              <h3>Appointment</h3>
              <span>List of Appointments Today</span> </div>
            <ul class="panel-controls" style="margin-top: 2px;">
              <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
              <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
              <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span> Collapse</a></li>
                  <li><a href="#" class="panel-remove"><span class="fa fa-times"></span> Remove</a></li>
                </ul>
              </li>
            </ul>
          </div>
          <div class="panel-body panel-body-table">
            <div class="table-responsive">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th width="40%">Name</th>
					<th width="30%">Phone #</th>
                    <th width="15%">Status</th>
                    <th width="15%">Activity</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
											
											while($rs=mysql_fetch_array($sql))
											{
												$pid=$rs['patientid'];
											echo'<tr>
                                                    <td><strong>'.$rs['name'].'</strong></td>
													<td><strong>'.$rs['phono'].'</strong></td>
                                                    <td>';
													if($rs['patientid'])
													echo' <span class="label label-danger">Active</span>';
													else
													echo' <span class="label label-info">New User</span>';
													echo  '</td>
													
                                                    <td align="center">';
													if($rs['patientid']){
														if($_SESSION['role'] == 1)
															echo'<a title="View Patient Information" href="patientapp.php?pid='.$pid.'&id='.$rs['id'].'"><span class="fa fa-eye"></span></a>&nbsp;&nbsp;';
														else
															echo'<a href="patientapp.php?pid='.$pid.'&id='.$rs['id'].'"><span class="fa fa-check-square-o"></span></a>&nbsp;&nbsp;';
													}else
														echo'<a title="New Registration" href="registration.php?id='.$rs['id'].'"><span class="fa fa-file-text-o"></span></a>&nbsp;&nbsp;';
													
													echo'<a href="#" onClick="cancelapp('.$rs['id'].')"><span class="fa fa-times"></span></a>';
													echo  '</td>
                                                </tr>';
											
											} ?>
                </tbody>
              </table>
            </div> 
          </div>
        </div>
		<script>
		function cancelapp(x) {
		if(confirm('Sure to delete?')){
			window.location.href = "cancelapp.php?id="+x;			
		}
		}
		
		</script>
        <!-- END PROJECTS BLOCK -->
      </div>
    </div>
	
	<?php } ?>
    <!-- START DASHBOARD CHART -->
    <!-- END DASHBOARD CHART -->
  </div>
  <!-- END PAGE CONTENT WRAPPER -->
</div>
<!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER -->
<div id="apptable" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Todays Appointment List Status</h4>
      </div>
      <div class="modal-body" style="overflow-x:auto;">
        <div class="col-md-12">
          <table class="table" border="1" cellpadding="5" cellspacing="5">
            <thead>
              <tr>
                
              
                <th>Patient Name</th>
				  <th>Phone No. / Patient ID</th>
               	<th>Doctor Name</th>
				<th>Appointed By</th>
                <th>Time</th>
				 <th>Status</th>
  
              </tr>
            </thead>
            <tbody id="toapp">
			<?php $cmd ="select * from appointments where date='".date("Y-m-d")."' and status=1";
			
				$cmd1 = "SELECT distinct patientid FROM complaints WHERE cast(datetime as date) = '".date("Y-m-d")."'";
					$res1 = mysql_query($cmd1);
		if(mysql_num_rows($res1) !=0) {
		   $stat = "Done";
		}else
		$stat = "Unseen";
		//echo $cmd;
		$res = mysql_query($cmd);
		if(mysql_num_rows($res) !=0) {
		while($rs = mysql_fetch_array($res))
		{
			echo "<tr>
					<td>".$rs['name']."</td>
					<td>".$rs['phono']."</td>
					<td>".$rs['doctor']."</td>
					<td>".$rs['appointby']."</td>
					<td>".$rs['time']."</td>
			        <td>".$stat."</td></tr>";
			}
					} ?>
            <tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div id="serachdis" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Search result</h4>
      </div>
      <div class="modal-body" style="overflow-x:auto;">
        <div class="col-md-12">
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
              </tr>
            </thead>
            <tbody id="divserachdis">
            <tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer">
        
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
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
        <div class="pull-right"> <a href="logout.php" class="btn btn-success btn-lg">Yes</a>
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
<script type="text/javascript" src="datetimepicker/jquery.datetimepicker.js"></script>
<script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
<script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
<script type="text/javascript" src="js/plugins/scrolltotop/scrolltopcontrol.js"></script>
<script type="text/javascript" src="js/plugins/morris/raphael-min.js"></script>
<script type="text/javascript" src="js/plugins/morris/morris.min.js"></script>
<script type="text/javascript" src="js/plugins/rickshaw/d3.v3.js"></script>
<script type="text/javascript" src="js/plugins/rickshaw/rickshaw.min.js"></script>
<script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'></script>
<script type='text/javascript' src='js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'></script>
<script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>
<script type="text/javascript" src="js/plugins/owl/owl.carousel.min.js"></script>
<script type="text/javascript" src="js/plugins/moment.min.js"></script>
<script type="text/javascript" src="js/plugins/daterangepicker/daterangepicker.js"></script>
<!-- START TEMPLATE -->
<script type="text/javascript" src="js/settings.js"></script>
<script type="text/javascript" src="js/plugins.js"></script>
<script type="text/javascript" src="js/actions.js"></script>
<script type="text/javascript" src="js/demo_dashboard.js"></script>
<!-- END TEMPLATE -->
<!-- END SCRIPTS -->
<!-- COUNTERS // NOT INCLUDED IN TEMPLATE -->
<!-- GOOGLE -->
<!-- END YANDEX -->
<!-- END COUNTERS // NOT INCLUDED IN TEMPLATE -->
</body>
<link rel="stylesheet" type="text/css" href="datetimepicker/jquery.datetimepicker.css"/>
<script>



$('#appdate').datetimepicker({
	lang:'en',
	format:'Y-m-d g:i:A',
	formatTime:'g:i:A',
	minDate:0, // yesterday is minimum date
});


function appsearch() {
	var ser=$("#appphone").val();
	x=1;
 	if(ser=="")
  return false;
  $.ajax({
			type: "post",
			url: "search.php",
			data:{ser:ser ,x:x,},
			success: function(msg) {
			//alert(msg);
				$("#divserachdis").html(msg);
			}
		});
		$('#serachdis').modal('toggle');
	
	}

	

  
function saveapp()
{
if($("#appdate").val()=="")
{
alert("Date Should not Blank");
return false;
}
if($("#appphone").val()=="")
{
alert("Phone Number Should not Blank");
return false;
}

if($("#appdoctor").val()=="")
{
alert("Doctor Name Should not Blank");
return false;
}

}

function addapp(x)
{
var txt = x.attr('alt');
var msg=txt.split("~");
$("#appphone").val(msg[0])
$("#apppatient").val(msg[1])
$('#serachdis').modal('toggle');
$('#apptoo').hasClass("active"); 
}

  function dispid()
  {
  //var x=x;
  var ser=$("#search").val();
 	if(ser=="")
  return false;
  $.ajax({
			type: "post",
			url: "search.php?ser="+ser,
			success: function(msg) {
			//alert(msg);
			var msg=$.trim(msg);
			
				$("#divserachdis").html(msg);
		if(msg !='none')
		$('#serachdis').modal('toggle');
			}
		});
		
		
  
  }
		
</script>
<script>
	updateOnlineStatus();
	getOnlineStatus();
	setInterval("updateOnlineStatus(),getOnlineStatus()", 5000);
	function updateOnlineStatus() { 
		$.ajax({	
			url: 'update-online-status.php',
			type:'POST',
			success:function(){
			}
		});
	}
	function getOnlineStatus() { 
		$.ajax({	
			url: 'get-online-status.php',
			type:'POST',
			success:function(msg){
				if(msg != ""){
					$("#divOnlineUserCount").html(msg);
				}
			}
		});
	}
</script>
<!-- Mirrored from aqvatarius.com/themes/atlant/html/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2015 09:36:05 GMT -->
</html>
<?php
$msgx = $_REQUEST['msgx'];
if($msgx != ''){
	echo "<script>alert('Success');</script>";
	echo "<script>window.location.href='home.php';</script>";
} ?>