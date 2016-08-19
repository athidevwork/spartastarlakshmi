<?php
	session_start();
	date_default_timezone_set('Asia/Kolkata'); 
	$patid=$_REQUEST['y'];
	$sym=$_REQUEST['s'];
	//$allergies = $_REQUEST['x'];
	$allergies = mysql_escape_string($allergies);
	$user = $_SESSION['username'];
	$content = str_replace("~","<br />",$sym);
	$content .= '<br />';
	//$datepicker=date('Y-m-d');
	//$date=date('Y-m-d');
	include("config_db2.php");
			$sql = "INSERT INTO complaints (complaintid, patientid, symptoms, prescribed_by) VALUES (NULL, '$patid', '$content', '$user');";
			//echo $sql;
			if(mysql_query($sql)){
				mysql_close($db2);
				echo "Success";
			}
			else{
				mysql_close($db2);
				echo "Error occured";
				//exit();			
			}
		
?>