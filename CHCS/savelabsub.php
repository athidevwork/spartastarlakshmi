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
	if($key[4]!="")
	$sql = "UPDATE investigationsub set result='$key[2]' where id=$key[4]"; 
	//echo $sql.'<br />';
	mysql_query($sql);
	//$id=$key[4];
	}
	//$sd=mysql_query("select inves_id from investigationsub where id='$id'");
	//$rs=mysql_fetch_array	
	//$sql = "UPDATE investigationreport set lab_date=".date('Y-m-d').",lab_atten_by='$name',complaint="" where id=$key[4]"; 	
echo 'success';
			
		//print_r($hed);
		
?>