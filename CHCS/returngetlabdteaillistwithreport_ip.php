 <?php
 date_default_timezone_set('Asia/Kolkata');
 
	include("config_db2.php");
	
	$ids=implode(',',$_REQUEST['ids']);
	$pid = $_REQUEST['pid'];
	$report_id = $pid.date('d-m-YH-i-s');
	$current_date = date('Y-m-d H:i:s');
	//echo "UPDATE lab_details_ip SET report_id='$report_id' where id IN ($ids)";
	$cmd_lab_details_repor_tquery = mysql_query("UPDATE lab_details_ip SET report_id='$report_id',sample_rept_date='$current_date' where id IN ($ids)");
	if($cmd_lab_details_repor_tquery){
		echo $report_id;
	}
	else{
		echo '';
	}
	