<?php
	$id = $_REQUEST['id'];
	include("../config.php");

	$r = mysql_query("SELECT purchaseid, amount, bid FROM tbl_billing_items WHERE id = $id");
	$rs = mysql_fetch_array($r);
	$pid = $rs['purchaseid'];
	$amt = $rs['amount'];
	$bid = $rs['bid'];
	
	$ids = explode(";",$pid);
	for($i=0 ; $i<count($ids); $i++){
		$val =  explode("-",$ids[$i]);
		$q = "UPDATE tbl_purchaseitems SET aval = aval + $val[1] WHERE id = $val[0]";
		mysql_query($q);
	}
	
	$cmd = "DELETE FROM tbl_billing_items WHERE id = $id";
	if(mysql_query($cmd)){
		$cmd = "UPDATE tbl_billing SET totalamt = totalamt - $amt, netamt = netamt - $amt, paidamt = paidamt - $amt WHERE id = $bid";
		mysql_query($cmd);
		echo 'Deleted !~'.$amt."~".$rs['bid'];
	}else
		echo mysql_error();
?>
