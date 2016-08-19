<?php
	$product = urldecode($_REQUEST['product']);
	include("../config.php");
	$sql = "SELECT * FROM tbl_productlist WHERE productname = '$product'";
	$res = mysql_query($sql);
	$rs = mysql_fetch_array($res);
	
	$array = array("productname"=>$rs['productname'],"mrp"=>$rs['mrp'],"vat"=>$rs['salestax']);
	
	print json_encode($array);
?>