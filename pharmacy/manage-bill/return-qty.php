<?php
	$prod = urldecode($_REQUEST['prod']);
	$prod = mysql_escape_string($prod);
	$batch = $_REQUEST['batch'];

	$qty = $_REQUEST['qty'];
	$expiry = $_REQUEST['expiry'];
	$expiry = "27/".$expiry;
	$expiry = implode("-",array_reverse(explode("/",$expiry)));

	include('../config.php');
	
	$cmd = mysql_query("SELECT id FROM tbl_productlist WHERE productname = '$prod'");
	$rs = mysql_fetch_array($cmd);

	if($rs['id']){
		$id = $rs['id'];
		$sql = mysql_query("SELECT sum(aval) as avail FROM tbl_purchaseitems WHERE status = 1 AND productid = $id AND batchno = '$batch' AND expirydate = '$expiry'");
		$r = mysql_fetch_array($sql);
		
		if($qty <= $r['avail']) ;
		else

			echo 'Maximum allowed Qty : '.$r['avail'];
	}else{
		echo "error1";
	}
	
?>