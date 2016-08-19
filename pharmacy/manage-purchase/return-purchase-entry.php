<?php
	$pur = $_REQUEST['pur'];
	$inv = $_REQUEST['inv'];
	include("../config.php");
	$res = mysql_query("SELECT * FROM tbl_purchaseitems WHERE purchaseid = $pur AND invoiceno = $inv");
	$array = array();
	while($rs = mysql_fetch_array($res)){
		$code = $rs['productid'];
		$q =  mysql_query("SELECT * FROM tbl_productlist WHERE id = $code");
		$r = mysql_fetch_array($q);
		
		$expirydate = implode("/",array_reverse(explode("-",$rs['expirydate'])));
		$expirydate = substr($expirydate,3);
		
		$array[] = array("id"=>$rs['id'], "code"=>$rs['productid'], "descrip"=>$r['productname'], "qty"=>$rs['qty'], "free"=>$rs['freeqty'], "batch"=>$rs['batchno'], "expiry"=>$expirydate, "price"=>$rs['pprice'],  "mrp"=>$rs['mrp'], "vat"=>$rs['vat'], "gross"=>$rs['grossamt'], "net"=>$rs['netamt']);
	}
	echo json_encode($array);
?>
