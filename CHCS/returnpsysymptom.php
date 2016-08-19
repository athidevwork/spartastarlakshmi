<?php
session_start();
	include("config_db1.php");
	 $cat=$_SESSION['category'];
 	$cm=mysql_query("select display_name,tbl_name from complaint_tbl_name where id=$cat");
	
	$v=mysql_fetch_array($cm);
	$table=$v['tbl_name'];
	//echo $table;
	//$cmd = "select symptom from $table order by symptom asc";
	echo $cmd;
	$res = mysql_query($cmd);
	$msg = "";
	while($rs = mysql_fetch_array($res)){
		$msg .= $rs['symptom'].'~';
	}
	$msg = substr($msg, 0, -1);
	echo $msg;
	mysql_close($db1);
?>