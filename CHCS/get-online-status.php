<?php 
	session_start(); 
	if (!$_SESSION["uid"]) die; // Don't give the list to anybody not logged in 
	include("config_db1.php");
	$query = mysql_query("SELECT id FROM user_login WHERE lastlogin > NOW()-60");
	$output = mysql_num_rows($query);
	echo $output; 
?>