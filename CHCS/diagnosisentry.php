<?php
	session_start();
	 date_default_timezone_set('Asia/Kolkata'); 
	$patid=$_REQUEST['y'];
	$provisionaldiagnosis = $_REQUEST['s'];
	$diagnosis = $_REQUEST['x'];
	$provisionaldiagnosis = str_replace("~","<br />",$provisionaldiagnosis);
	$provisionaldiagnosis .= '<br />';
	$diagnosis = str_replace("~","<br />",$diagnosis);
	$diagnosis .= '<br />';
	$user = $_SESSION['username'];
			
			//$datepicker=$_REQUEST['datepicker'];
			$date=date('Y-m-d');
			
			include("config_db2.php");
			
			$sql = "INSERT INTO tbl_diagnosis (complaintid, patientid, provisionaldiagnosis, diagnosis, prescribed_by, datetime) VALUES (NULL, '$patid', '$provisionaldiagnosis', '$diagnosis', '$user', '$date');";
			
			if(mysql_query($sql)){
				mysql_close($db2);
				echo 'Sucess';
			}
			else{
				mysql_close($db2);
		}
?>