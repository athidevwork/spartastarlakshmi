<?php
session_start();
date_default_timezone_set('Asia/Kolkata'); 
$assets=$_REQUEST['assets'];
//$hed=$_REQUEST['hed'];
//$patid=$_REQUEST['pid'];
$name = $_SESSION['username'];
//$date=date('Y-m-d');
$current_date = date('Y-m-d H:i:s');
include("config_db2.php");
//print_r($assets);

foreach($assets as $key => $value){
	
	
	//if($key[4]!="")
		$sql = "UPDATE lab_details_ip set reports='$value[6]',notes='$value[7]' where id=$value[0]";
		if(!empty($value[8])){
		$sql = "UPDATE lab_details_ip set reports='$value[6]',notes='$value[7]',sample_col_date='$current_date' where id=$value[0]";
		}	
	//echo $sql.'<br />';
	mysql_query($sql);
	//$id=$key[4];
	}
	//$sd=mysql_query("select inves_id from investigationsub where id='$id'");
	//$rs=mysql_fetch_array	
	//$sql = "UPDATE investigationreport set lab_date=".date('Y-m-d').",lab_atten_by='$name',complaint="" where id=$key[4]"; 	
echo 'Lab Report Saved';
			
		//print_r($hed);
		
?>