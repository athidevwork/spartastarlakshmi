<?php
session_start();
date_default_timezone_set('Asia/Kolkata'); 
	include("config_db2.php");
	$pid=$_REQUEST['id'];
		$lab_details = $_REQUEST['lab_details'];
	 
	 $billnumber= date-time(yyyyMMddHHmmss);
	foreach($lab_details as $lab_detail => $key){
	 $result = mysql_query("insert into billing_content_patient (patientid,fees,lab,details,bill_no,created_by) values ('$pid','$key[3]','$key[1]','$key[2]','$billnumber','$name')");
	if($key[4]!=0)
	{
	mysql_query("update investigationreport set sendlab =1 ,bill_no='$billnumber' where patientid='$pid' and id='$key[4]'");  
	//echo"update investigationreport set savelab=1 where patientid='$pid' and id='$key[4]'";
	}
		}
		
		
	
	?>