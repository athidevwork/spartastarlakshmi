<?php
	include("../config.php");
	$sql = "UPDATE tbl_purchaseitems SET status = 1 WHERE status = 3";
	if(mysql_query($sql))
		echo 'Initial Stock Details Updated';
	else
		mysql_error();
?>
