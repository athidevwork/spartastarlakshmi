<?php
	session_start(); 
	include("config_db1.php");
	if ($_SESSION["uid"]) {
		$cmd = "UPDATE user_login SET lastlogin = CURRENT_TIMESTAMP WHERE id = ".$_SESSION['uid'];
		mysql_query($cmd) or die(mysql_error());
	}
?>