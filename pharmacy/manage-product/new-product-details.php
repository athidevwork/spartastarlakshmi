<?php
	include("../config.php");
	
	$product = $_REQUEST['product'];			$product = mysql_escape_string($product);

$product = preg_replace('!\s+!', ' ', $product);

	$generic = $_REQUEST['generic'];			$generic = mysql_escape_string($generic);
	$manufacturername = $_REQUEST['manufact'];	$manufacturername = mysql_escape_string($manufacturername);
	
	$q = mysql_query("SELECT id FROM tbl_manufacturer WHERE manufacturername = '$manufacturername'");
	$rs = mysql_fetch_array($q);
	$manufacturer = $rs['id'];
	
	$schedule = $_REQUEST['schedule'];
	$producttype = $_REQUEST['producttype'];	
	$unitdesc = $_REQUEST['unitdesc'];
	$stocktype = $_REQUEST['stocktype'];
	$ptax = $_REQUEST['ptax'];
	$stax = $_REQUEST['stax'];
	//$mrp = $_REQUEST['mrp'];
	//$price = $_REQUEST['price'];
	$minqty = $_REQUEST['minqty'];
	$maxqty = $_REQUEST['maxqty'];
	$shelf = $_REQUEST['shelf'];
	$rack = $_REQUEST['rack'];
	
	$sql = "INSERT INTO tbl_productlist (id, productname, genericname, scheduletype, producttype, manufacturer, unitdesc, stocktype, purchasetax, salestax, minqty, maxqty, shelf, rack, status) VALUES (NULL, '$product', '$generic', '$schedule', '$producttype', '$manufacturer', '$unitdesc', '$stocktype', '$ptax', '$stax', '$minqty', '$maxqty', '$shelf', '$rack', '1')";
	if(mysql_query($sql))
		echo 'New Product Added!';
	else
		echo mysql_error();
?>
 
