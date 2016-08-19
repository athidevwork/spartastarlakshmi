<?php
	$id = $_REQUEST['id'];
	include("../config.php");
	$sql = "DELETE FROM tbl_purchaseitems WHERE id = $id AND status = 2";
	if(mysql_query($sql))
		echo 'ok';
	else
		mysql_error();
?>
