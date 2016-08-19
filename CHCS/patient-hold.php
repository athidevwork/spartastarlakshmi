<?php
	session_start();
	$username = $_SESSION['name'];
	$pid = $_REQUEST['pid'];
	$id = $_REQUEST['id'];
	include("config_db2.php");
	mysql_query("UPDATE appointments SET status = 0 WHERE id = $id");
	mysql_query("UPDATE patientdetails SET hold = 10, holdby = '$username' WHERE patientid = '$pid'");
	header("location:home.php");
?>