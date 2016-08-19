<?php
	$id = $_REQUEST['id'];
	include("../config.php");
	$sql = "UPDATE tbl_requestmedicine SET status = 8 WHERE reqid = $id";
	if(mysql_query($sql))
		echo 'Bill Cancelled !';
	else
		echo mysql_error();
?>