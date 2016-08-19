<?php
	$id = $_REQUEST['id'];
	include("../config.php");
	
	$res = mysql_query("SELECT payment, purchaseid FROM tbl_purchase WHERE id = $id");
	$rs = mysql_fetch_array($res);
	$purchaseid = $rs['purchaseid'];
	$paymentid =  $rs['payment'];

	mysql_query("DELETE FROM tbl_purchaseitems WHERE purchaseid = $purchaseid AND status = 2");
	mysql_query("DELETE FROM tbl_payment WHERE id = $paymentid AND status = 2");
	$q = "DELETE FROM tbl_purchase WHERE id = $id AND status = 2";
	if(mysql_query($q))
		echo 'Deleted !';
	else
		echo mysql_error();
?>