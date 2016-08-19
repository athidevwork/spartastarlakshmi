<?php 
	$id = $_REQUEST['id'];
	include("config.php");
	$sql = "select image from tbl_users where id=".$id;
	$result = mysql_query("$sql") or die("Invalid query: " . mysql_error());
	header("Content-type: image/jpeg");
	if(mysql_result($result, 0))
		echo mysql_result($result, 0);
	else{
		$sql = "select image from tmpimage where id=1";
		$result = mysql_query("$sql") or die("Invalid query: " . mysql_error());
		echo mysql_result($result, 0);
	}
	mysql_close($db);
?>