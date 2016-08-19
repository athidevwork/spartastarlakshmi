<?php
session_start();
date_default_timezone_set('Asia/Kolkata'); 
$assets=$_REQUEST['assets'];
//$hed=$_REQUEST['hed'];
//$patid=$_REQUEST['pid'];
$name = $_SESSION['username'];
//$date=date('Y-m-d');
include("config_db2.php");
//print_r($assets);
foreach($assets as $assets => $key){

	if($key[8]==1) {
	$sql = "UPDATE investigationreport set notes='$key[3]',complaint='see in sub',lab_atten_by='$name',lab_date='".date('Y-m-d H:i:s')."' where id='$key[6]'"; 
	//echo $sql;
	} 
	else {	
 	$sql = "UPDATE investigationreport set notes='$key[3]',complaint='$key[2]',lab_atten_by='$name',lab_date='".date('Y-m-d H:i:s')."' where id='$key[6]'"; 
	}
	mysql_query($sql);
	}
			//echo $sql;
			
				echo 'success';
			
		//print_r($hed);
		
?>