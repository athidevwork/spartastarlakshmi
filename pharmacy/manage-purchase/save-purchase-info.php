<?php
	$invoiceno = $_REQUEST['invoiceno'];
	include("../config.php");
	
	$res = mysql_query("SELECT payment, purchaseid FROM tbl_purchase WHERE id = $invoiceno");
	$rs = mysql_fetch_array($res);
	$purchaseid = $rs['purchaseid'];
	$paymentid =  $rs['payment'];

	mysql_query("UPDATE tbl_purchaseitems SET status = 1 WHERE purchaseid = $purchaseid AND status = 2");
	mysql_query("UPDATE tbl_payment SET status = 1 WHERE id = $paymentid AND status = 2");
	$q = "UPDATE tbl_purchase SET status = 1 WHERE id = $invoiceno AND status = 2";
	if(mysql_query($q))
		echo 'Purchase Entry Saved';
	else
		echo mysql_error();
?>