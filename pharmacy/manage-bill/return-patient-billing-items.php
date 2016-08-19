<?php
	$id = $_REQUEST['id'];
	include('../config.php');
	$array = array();
	$sql = mysql_query("SELECT * FROM tbl_billing_items WHERE (status = 2 or status = 3) AND bid = $id ORDER BY id asc");
	$tot = 0;
	while($rs = mysql_fetch_array($sql)){
		$code = $rs['code'];
		$expirydate = implode("/",array_reverse(explode("-",$rs['expirydate'])));
		$exp = substr($expirydate,3);
		$cmd = mysql_query("SELECT * FROM tbl_productlist WHERE id = '$code'");
		$r = mysql_fetch_array($cmd);
		$desc = $r['productname'];
//		$desc1 =  substr($r['stocktype'],0,3) . '. ' . $r['productname'];
		$type = $r['stocktype'];
		$tot += $rs['amount'];
		$q = mysql_query("SELECT * FROM tbl_requestmedicine WHERE drugtype = '$type' AND drugname = '$desc'");
		$x = mysql_fetch_array($q);
		if($x['frequency'])
			$array[] = array("code"=>$code,"desc"=>$desc,"freq"=>$x['frequency'],"dur"=>$x['duration'],"spec"=>$x['specification'],"qty"=>$rs['qty'],"batch"=>$rs['batchno'],"expi"=>$exp,"amt"=>$rs['amount'],"id"=>$rs['id']);
		else
			$array[] = array("code"=>$code,"desc"=>$desc,"freq"=>'-',"dur"=>'-',"spec"=>'-',"qty"=>$rs['qty'],"batch"=>$rs['batchno'],"expi"=>$exp,"amt"=>$rs['amount'],"id"=>$rs['id']);
	}
	$cmdx = mysql_query("SELECT * FROM  tbl_outofstock WHERE billingid = $id");
	while($rx = mysql_fetch_array($cmdx)){
		$pid = $rx['reqpid'];
		$qx = mysql_query("SELECT * FROM tbl_requestmedicine WHERE id = '$pid'");
		$s = mysql_fetch_array($qx);
		$desc = $s['drugname'];
//		$desc = substr($s['drugtype'],0,3) . '. ' . $s['drugname'];
		$array[] = array("code"=>'-',"desc"=>$desc,"freq"=>$s['frequency'],"dur"=>$s['duration'],"spec"=>$s['specification'],"qty"=>'-',"batch"=>'-',"expi"=>'-',"amt"=>'-',"id"=>'-',"vatval"=>'-');
	}
	$array[] = array("tot"=>$tot);
	echo json_encode($array);	
?>