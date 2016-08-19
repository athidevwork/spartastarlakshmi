<?php
	$id = $_REQUEST['id'];
	include("../config.php");
	$rs = mysql_fetch_array(mysql_query("SELECT * FROM tbl_billing_items WHERE id = $id"));
	$code = $rs['code'];
	
	$r1 = mysql_fetch_array(mysql_query("SELECT * FROM tbl_productlist WHERE id = $code"));

	$array = array();
	array_push($array, array("type"=>$r1['stocktype']));
	array_push($array, array("desc"=>$r1['productname']));	

	$sql = mysql_query("SELECT distinct batchno FROM tbl_purchaseitems WHERE status = 1 AND productid = $code AND aval > 0");
	while($r = mysql_fetch_array($sql)){
		array_push($array, array("batch"=>$r['batchno']));
	}
	echo json_encode($array);
	
?>