<?php
	session_start();
	$user = $_SESSION['username'];
	date_default_timezone_set('Asia/Kolkata');
include("config_db2.php");
$pat_id = $_REQUEST['pat_id'];
$created_date=date("Y-m-d H:i:s");
$servicecmd = mysql_query("UPDATE services_details SET bill_queue='1',insert_from='OP CHART' where patient_id='$pat_id' AND bill_queue='0'");
if($servicecmd){
	$query = "INSERT INTO chart_ot (id,ref_id,patientid,ip_no,insert_from,room_no,name,age,doa,cons,intimedate,description,shift_patient,outtime,vacant_chk,created_date) VALUES (NULL, '','$pat_id','','OP CHART','','','','','','','','','','','$created_date')";
		$cmd=mysql_query($query);
		if($cmd){
			echo "Patient OT Activity Added.";
			exit;
		}else{
		echo "Patient OT Activity could not be added.";
		exit;
	}
	}else{
		echo "Patient OT Activity could not be added.";
		exit;
	}
?>