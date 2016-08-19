<?php
session_start();

$id=$_REQUEST['name'];
//$id = $_SESSION['username'];
	include("config_db1.php");
	$sql = "select img from user_login where username='$id'";
	$result = mysql_query("$sql") or die("Invalid query: " . mysql_error());
	header("Content-type: image/jpeg");
	if(mysql_result($result, 0))
		echo mysql_result($result, 0);
	else{
	include("config_db2.php");
		$sql = "select image from tempimg where id=1";
		$result = mysql_query("$sql") or die("Invalid query: " . mysql_error());
		echo mysql_result($result, 0);
	}
	//mysql_close($db1);
?>