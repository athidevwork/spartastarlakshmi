<?php
session_start ();
$role = $_SESSION ['role'];
// $pid=$_REQUEST['pid'];
include ("config_db1.php");
$cmd = mysql_query ( "select * from settings where role='$role'" );
mysql_close ( $db1 );
$sql = mysql_fetch_array ( $cmd );

if ($sql ['labreports'] != 1) {
	echo '<script>alert("You could not access this page");</script>';
	exit ();
}

date_default_timezone_set ( 'Asia/Kolkata' );
if (isset ( $_REQUEST ['pid'] )) {
	$pid = $_REQUEST ['pid'];
	include ("config_db2.php");
	$sql1 = "SELECT patientid,patientname,age,gender FROM patientdetails WHERE patientid='$pid'";
	$result = mysql_query ( $sql1 );
	if (mysql_num_rows ( $result ) != 0) {
		$rs = mysql_fetch_array ( $result );
		$pid = $rs ['patientid'];
		$patientname = $rs ['patientname'];
		$age = $rs ['age'];
		$gender = $rs ['gender'];
	} else {
		$pid = "";
		$patientname = "";
		$age = "";
		$gender = "";
	}
	mysql_close ( $db2 );
} else {
	$pid = "";
	$patientname = "";
	$age = "";
	$gender = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- META SECTION -->
<title>DPP-LAB Sample List</title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<link rel="icon" href="favicon.ico" type="image/x-icon" />
<!-- END META SECTION -->

<!-- CSS INCLUDE -->
<link rel="stylesheet" href="css/bootstrap/bootstrap.min.css">
<link rel="stylesheet" href="css/fontawesome/font-awesome.min.css">
<link href="css/editor.css" type="text/css" rel="stylesheet" />
<link rel="stylesheet" type="text/css"
	href="css/cropper/cropper.min.css" />
<!--  EOF CSS INCLUDE -->

<!-- CSS INCLUDE -->
<link rel="stylesheet" type="text/css" id="theme"
	href="css/theme-default.css" />
<!-- EOF CSS INCLUDE -->

<style>
.modal-body {
	max-height: 500px;
	overflow: auto;
}

.ui-autocomplete {
	z-index: 2147483647;
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
						<input type="text" onBlur="dispid()" name="search" id="search"
							placeholder="Search..." />
					</form>
				</li>
				<!-- END SEARCH -->
				<!-- POWER OFF -->
				<li class="xn-icon-button pull-right last"><a href="#"><span
						class="fa fa-power-off"></span></a>
					<ul class="xn-drop-left animated zoomIn">
						<!-- <li><a href="pages-lock-screen.html"><span class="fa fa-lock"></span> Lock Screen</a></li>-->
						<li><a href="#" class="mb-control" data-box="#mb-signout"><span
								class="fa fa-sign-out"></span> Sign Out</a></li>
					</ul></li>
				<!-- END POWER OFF -->
				<!-- MESSAGES -->
				<li class="xn-icon-button pull-right"><a href="#"><span
						class="fa fa-comments"></span></a>
					<div id="new" class="informer informer-danger"></div>
					<div
						class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
						<div class="panel-heading">
							<h3 class="panel-title">
								<span class="fa fa-comments"></span> Messages
							</h3>
							<div class="pull-right">
								<span id="new1" class="label label-danger"></span>
							</div>
						</div>
						<div id="appmsg"
							class="panel-body list-group list-group-contacts scroll"
							style="height: 200px;"></div>
						<div class="panel-footer text-center">
							<a href="messages.php">Show all messages</a>
						</div>
					</div></li>
				<!-- END MESSAGES -->
				<!-- TASKS -->
					<?php
					include ("config_db2.php");
					$quer = mysql_query ( "Select * from patientdetails where hold!=0" );
					$tothold = mysql_num_rows ( $quer );
					mysql_close ( $db2 );
					?>
                    <li class="xn-icon-button pull-right"><a href="#"><span
						class="fa fa-tasks"></span></a>
					<div class="informer informer-warning"><?php echo $tothold; ?></div>
					<div
						class="panel panel-primary animated zoomIn xn-drop-left xn-panel-dragging">
						<div class="panel-heading">
							<h3 class="panel-title">
								<span class="fa fa-tasks"></span> Hold
							</h3>
							<div class="pull-right">
								<span class="label label-warning"><?php echo $tothold;?> holding</span>
							</div>
						</div>
						<div class="panel-body list-group scroll" style="height: 200px;">  
							<?php			
while ( $ho = mysql_fetch_array ( $quer ) ) {
								$per = $ho ['hold'];
								?>                              
                                <a class="list-group-item"
								href="pausecom.php?pid=<?php echo $ho['patientid']; ?>"> <strong><?php echo $ho['patientname']; ?></strong>
								<div class="progress progress-small progress-striped active">
									<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $per; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $per; ?>%;">50%</div>
								</div> <small class="text-muted">hold By: <?php echo $ho['holdby']; ?>, on <?php echo date('d  M  Y').' /'; echo $per; ?>%</small>
							</a>
                                  <?php }?>                          
                            </div>
						<div class="panel-footer text-center">
							<a href="pages-tasks.html">Show all tasks</a>
						</div>
					</div></li>
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
					<div class="col-md-1"></div>
					<div class="col-md-10">
						<div class="panel panel-default"></div>
					</div>
					<div class="col-md-1"></div>
					<div class="col-md-12">
						<div class="panel panel-default tabs">
							<ul class="nav nav-tabs" role="tablist">
								<li class="active"><a href="#tab-first" role="tab"
									data-toggle="tab">LAB Sample List</a></li>
								<li><a href="#tab-second" role="tab" data-toggle="tab">LAB
										Reports</a></li>
							</ul>

							<div class="panel-body tab-content">
								<div class="tab-pane active" id="tab-first">

									<br />
									<br /> <br>
									<br>
									<table class="table" id="getpatienttable">
										<thead>
											<tr>
												<th width="5%">S. No</th>
												<th width="8%">Date</th>
												<th width="10%">Patient IP Id</th>
												<th width="10%">LAB Sample No</th>
												<th width="10%">Patient ID</th>
												<th width="15%">Patient Name</th>
												<th width="15%">Test Name</th>
												<th width="5%">Collected</th>
												<th width="2%">View Report</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>

								<div class="tab-pane" id="tab-second">
									<div class="row">

										<div class="col-md-12">
											<form id="bill1">


												<div class="form-group">
													<label class="col-md-2 control-label">Range</label>
													<div class="col-md-3">
														<select name="select_rpt_type" id="select_rpt_type"
															class="select" style="font-weight: bold; width: 160px;">
															<option value="">Select Date Type</option>
															<option value="datereq">Reported Date</option>
															<option value="datecollect">Requested Date</option>
															<option value="datereportgen">Collected Date</option>
														</select>
													</div>
													<div class="col-md-4">
														<div class="input-group">

															<input id="from" name="from" type="text"
																class="form-control datepicker"
																value="<?php
																
$date = strtotime ( "-7 day" );
																echo date ( 'Y-m-d', $date );
																?> " /> <span
																class="input-group-addon add-on"> - </span> <input
																id="to" name="to" type="text"
																class="form-control datepicker"
																value="<?php echo date("Y-m-d"); ?>" />
														</div>
													</div>
													<div class="col-md-3">
														<a href="#" class="btn btn-primary pull-left"
															onClick="getsamplereportstable()">Search <span
															class="fa fa-floppy-o fa-right"></span></a>
													</div>
												</div>
											</form>
										</div>
										<div class="col-md-6"></div>
										<br />
										<br /> <br>
										<br>
										<table class="table" id="getsamplereportstable">
											<thead>
												<tr>
													<th width="5%">Sl. No</th>
													<th width="8%">Date</th>
													<th width="10%">Bill Number</th>
													<th width="10%">LAB Sample No</th>
													<th width="10%">Patient ID</th>
													<th width="15%">Patient Name</th>
													<th width="15%">Test Name</th>
													<th width="5%">Collected On</th>
													<th width="2%">Reported on/View Report</th>
												</tr>
											</thead>
											<tbody>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<!-- END PAGE CONTENT WRAPPER -->
						</div>
						<!-- END PAGE CONTENT -->
					</div>
					<!-- END PAGE CONTAINER -->

					<div id="labsampletestreportedit_modal" class="modal fade"
						role="dialog" style="z-index: 9999;">
						<div class="modal-dialog modal-lg ">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Add/Update Report</h4>
								</div>
								<div class="modal-body">
									<div class="col-md-12">
										<div class="panel-body" id="labsampletest_report">
											<input type="hidden" id="txtEditor_id"> <input type="hidden"
												id="txtEditor_normal_id">
											<div class="txtEditor"></div>

											<!-- START JQUERY VALIDATION PLUGIN -->
                           <?php  date_default_timezone_set('Asia/Kolkata');   ?>
                                   
                            <!-- END JQUERY VALIDATION PLUGIN -->
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<!--<button type="button" class="btn btn-primary" onClick="printbill()" data-dismiss="modal">Print</button>-->
									<button type="button" id='add_update_lab_report_save'
										data-id='' class="btn btn-primary"
										onclick="add_update_lab_report_save();return false;"
										data-dismiss="modal">Add/Update</button>
									<button type="button" id='update_lab_report_revert_to_default'
										data-id='' class="btn btn-primary"
										onclick="update_lab_report_revert_to_default();return false;">Reset
										to Default</button>
									<button type="button" class="btn btn-primary"
										data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>

					<div id="labsampletestedit_modal" class="modal fade" role="dialog">
						<div class="modal-dialog modal-lg">
							<!-- Modal content-->
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Investigation Details</h4>
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
									<button type="button" class="btn btn-primary"
										data-dismiss="modal">Close</button>
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
									<button type="button" data-dismiss="modal"
										class="btn btn-primary" data-value="1">Continue</button>
									<button type="button" data-dismiss="modal" class="btn"
										data-value="0">Cancel</button>
								</div>
							</div>

						</div>
					</div>



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
									<button type="button" class="btn btn-default"
										data-dismiss="modal">Close</button>
								</div>
							</div>

						</div>
					</div>


					<div class="message-box message-box-info animated fadeIn"
						id="message-box-info">
						<div class="mb-container">
							<div class="mb-middle">
								<div class="mb-title">
									<span class="fa fa-info"></span> Insert
								</div>
								<div class="mb-content">
									<p>New Data Added</p>
								</div>
								<div class="mb-footer">
									<button
										class="btn btn-default btn-lg pull-right mb-control-close"
										data-dismiss="message-box">Close</button>
								</div>
							</div>
						</div>
					</div>

					<div class="message-box message-box-success animated fadeIn"
						id="message-box-update">
						<div class="mb-container">
							<div class="mb-middle">
								<div class="mb-title">
									<span class="fa fa-check"></span> Success
								</div>
								<div class="mb-content">
									<div id="appendmsg1"></div>
								</div>
								<div class="mb-footer">
									<a href="complaints.php?pid=<?php echo $pid; ?>"
										class="btn btn-default btn-lg pull-right">Close</a>
								</div>
							</div>
						</div>
					</div>

					<div class="message-box message-box-danger animated fadeIn"
						id="message-box-error">
						<div class="mb-container">
							<div class="mb-middle">
								<div class="mb-title">
									<span class="fa fa-times"></span> Error
								</div>
								<div class="mb-content">
									<div id="appenderror"></div>
								</div>
								<div class="mb-footer">
									<button
										class="btn btn-default btn-lg pull-right mb-control-close">Close</button>
								</div>
							</div>
						</div>
					</div>

					<div class="message-box animated fadeIn" data-sound="alert"
						id="mb-signout">
						<div class="mb-container">
							<div class="mb-middle">
								<div class="mb-title">
									<span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?
								</div>
								<div class="mb-content">
									<p>Are you sure you want to log out?</p>
									<p>Press No if youwant to continue work. Press Yes to logout
										current user.</p>
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
					<div class="message-box animated fadeIn" data-sound="alert"
						id="mb-remove-row">
						<div class="mb-container">
							<div class="mb-middle">
								<div class="mb-title">
									<span class="fa fa-times"></span> Remove <strong>Data</strong>
									?
								</div>
								<div class="mb-content">
									<p>Are you sure you want to remove this row?</p>
									<p>Press Yes if you sure.</p>
								</div>
								<div class="mb-footer">
									<div class="pull-right">
										<a href="#" id="yes"
											class="btn btn-success btn-lg mb-control-yes">Yes</a> <a
											href="#" id="no" class="btn btn-default btn-lg mb-control-no">No</a>
									</div>
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

					<script type="text/javascript"
						src="js/plugins/jquery/jquery.min.js"></script>
					<script type="text/javascript"
						src="js/plugins/jquery/jquery-ui.min.js"></script>
					<script type="text/javascript"
						src="js/plugins/jquery/jquery.ui.dialog.patch.js"></script>
					<script type="text/javascript"
						src="js/plugins/bootstrap/bootstrap.min.js"></script>

					<script type="text/javascript"
						src="js/plugins/jquery/jquery-migrate.min.js"></script>
					<!-- END PLUGINS -->

					<!-- START THIS PAGE PLUGINS-->
					<script type="text/javascript" src="js/demo_tables.js"></script>
					<script type='text/javascript'
						src='js/plugins/icheck/icheck.min.js'></script>
					<script type="text/javascript"
						src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
					<script type="text/javascript"
						src="js/plugins/datatables/jquery.dataTables.min.js"></script>

					<script type="text/javascript"
						src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
					<script type="text/javascript" src="js/plugins/form/jquery.form.js"></script>
					<script type="text/javascript"
						src="js/plugins/bootstrap/bootstrap-datepicker.js"></script>
					<script type="text/javascript"
						src="js/plugins/bootstrap/bootstrap-file-input.js"></script>
					<script type="text/javascript"
						src="js/plugins/bootstrap/bootstrap-select.js"></script>
					<script type="text/javascript"
						src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
					<script type='text/javascript'
						src='js/plugins/maskedinput/jquery.maskedinput.min.js'></script>
					<script type="text/javascript"
						src="js/plugins/cropper/cropper.min.js"></script>
					<script type="text/javascript" src="js/faq.js"></script>

					<script type='text/javascript'
						src='js/plugins/noty/themes/default.js'></script>
					<!-- END THIS PAGE PLUGINS-->

					<!-- START TEMPLATE -->
					<script type="text/javascript" src="js/settings.js"></script>

					<script type="text/javascript" src="js/plugins.js"></script>
					<script type="text/javascript" src="js/actions.js"></script>
					<script src="js/editor.js"></script>

					<!-- <script type="text/javascript" src="js/demo_edit_profile.js"></script>-->
					<!-- END TEMPLATE -->

</body>
<script>
			$(document).ready(function() {
				$(".txtEditor").Editor({'texteffects':false,'textformats':false,'fonteffects':false,'actions' : false,'insertoptions' : false,'extraeffects' : false,'advancedoptions' : false,'screeneffects':false,'bold': true,'italics': true,'underline':true,'ol':false,'ul':false,'undo':false,'redo':false,'aligneffects':true,'l_align':true,'r_align':true,'c_align':true,'justify':true,'insert_link':false,'unlink':false,'insert_img':false,'hr_line':false,'block_quote':false,'source':false,'strikeout':false,'indent':false,'outdent':false,'fonts':false,'styles':false,'print':false,'rm_format':false,'status_bar':false,'font_size':false,'color':false,'splchars':false,'insert_table':false,'select_all':false,'togglescreen':false});				
			});
</script>
<script> 
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
$(document).ready(function(){
			  
	getsamplereportstable();
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

</script>
<!-- Mirrored from aqvatarius.com/themes/atlant/html/pages-edit-profile.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2015 09:47:54 GMT -->
</html>

<script>
window.load(getpatientlist());

function getsamplereportstable(){
	var from=$("#from").val();
	var to=$("#to").val();
	var select_rpt_type =$("#select_rpt_type").val();

	if($("#from").val()=="" && $("#to").val()=="")
	{
		alert("Please Fill any one field");
		return false;
	}

	var t = $('#getsamplereportstable').DataTable();

	$.ajax({
				type: "post",
				url: "returngetsampledteaillist_ip.php",
				data: {from:from,to:to,select_rpt_type:select_rpt_type,action:'report'},
				success: function(msg) {
				var msg=$.trim(msg);
				t.clear().draw(false);;	
				if(msg=="")
				{
				$("#getsamplereportstable > tbody").append("<b>No Result Found</b>");
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
function getpatientlist(){
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
			url: "returngetsampledteaillist_ip.php",
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

function add_update_lab_report_save(){
	var labreportid = $("#txtEditor_id").val();
	//alert(labreportid);
	var htmltext = $(".txtEditor").Editor("getText");
	$('#'+labreportid).html(htmltext);
}
function update_lab_report_revert_to_default(){
	var labreportnormalid_value = $("#txtEditor_normal_id").val();
	//alert(labreportid);
	$(".txtEditor").Editor("setText", labreportnormalid_value);
	return false;
}

function edit_lab_report(report){
	var labreport = $(report).data('id');
	var labreport_normal = $(report).data('normal-id');
	var report_normal_text = $('#'+labreport_normal).html();
	var report_text = $('#'+labreport).html();
	if(report_text.trim() ==''){
		var report_text = report_normal_text;
	}
	//alert($('#'+labreport).html());
	$(".txtEditor").Editor("setText", report_text);
	$("#txtEditor_id").val(labreport);
	$("#txtEditor_normal_id").val(report_normal_text);
	
}

function get_iplab_list(sampleno){
	var labsampleno = $(sampleno).data('id');
	 //console.log(labsampleno);
	//return false;	
		$.ajax({
		type: "POST",
		url: "returngetlabdteaillist_ip.php",
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
	
	function addlabtest_update(){
		var test_sample_no = $("#test_sample_no").val();
		var test_title = $("#test_title").val();
		var test_category = $("#test_category").val();
		var test_app_name = $("#test-app-name").val();
		var test_app_desgn = $("#test_app-desgn").val();
		var table = $("#labtest-dataTables");
		var asset = [];
		table.find('tbody > tr').each(function (rowIndex, r) {
			var cols = [];
			$(this).find('td').each(function (colIndex, c) {
				//alert(colIndex);
				
				if(colIndex == 4){
					cols.push($(this).find('div').html());
				}else{
					cols.push(c.textContent);
				}
			});
			asset.push(cols);
		}); 
	//console.log(asset.toString());
	//return false;
	  $.ajax({
		type: "POST",
		url: "returngetlabdteaillist_ip.php",
		data: {
			sampleno:test_sample_no,
			test_title:test_title,
			test_category:test_category,
			test_app_name:test_app_name,
			test_app_desgn:test_app_desgn,
			asset:asset,
			action:'update',
		},
		success: function(msg) {
			//console.log(msg);
			//return false;
			$('#labsampletestedit_report').html(msg);
			var info='Reports Updated';
			$(".infomsg").empty();
			$(".infomsg").append(info);
			$('#myModal_infomsg').modal('show');
			
		}
	});
	}
	
	function checksamplecollect(checkbox){
		//$('#confirm_infomsg').modal('show');
		$("#confirm_infomsg .infomsg").empty();
			var msg ='Once Sample collected checked can not be reverted. Please confirm.';
			$("#confirm_infomsg .infomsg").append(msg);
		$('#confirm_infomsg')
        .modal({ backdrop: 'static', keyboard: false })
        .one('click', '[data-value]', function (e) {
            if($(this).data('value')) {
				if (checkbox.checked) {
			var id =checkbox.value;
			var t = $('#getpatienttable').DataTable();

		$.ajax({
			type: "post",
			url: "returngetsampledteaillist_ip.php",
			data: {
				id:id,
				action:'collectdateupdate',
			},
			success: function(msg) {
				var msg=$.trim(msg);
				//console.log(msg);
				//return false;
				if(msg=="opnotpaid"){
					$(checkbox).prop('checked', false);
					var info='OP Patient is not Paid for this LAB Sample. Sample can only be collected once paid.';
					$(".infomsg").empty();
					$(".infomsg").append(info);
					$('#myModal_infomsg').modal('show');
					return false;
				}
				if(msg=="sentexternal"){
					$(checkbox).prop('checked', false);
					var info='Sample can not be collected. Sample already sent to external.';
					$(".infomsg").empty();
					$(".infomsg").append(info);
					$('#myModal_infomsg').modal('show');
					return false;
				}
				t.clear().draw(false);
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
        } else{
				$(checkbox).prop('checked', false);
		}
        });
	}
	
	function labtest_print(sampleno){
		
		//$('#confirm_infomsg').modal('show');
		$("#confirm_infomsg .infomsg").empty();
			var msg ='Once Test Report Generated, Report can not be edited. Please confirm.';
			$("#confirm_infomsg .infomsg").append(msg);
		$('#confirm_infomsg')
        .modal({ backdrop: 'static', keyboard: false })
        .one('click', '[data-value]', function (e) {
            if($(this).data('value')) {
		$('#labsampletestedit_modal').modal('hide');		
		var t = $('#getpatienttable').DataTable();

		$.ajax({
			type: "post",
			url: "returngetsampledteaillist_ip.php",
			data: {
			sampleno:sampleno,
			action:'reportdateupdate',
		},
			success: function(msg) {
				var msg=$.trim(msg);
				t.clear().draw(false);;
				window.open("lab_ip_report_generate.php?sampleno="+sampleno);
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
        });
	}
</script>