<?php
	$id = $_REQUEST['id'];
	include("../config.php");
	$sql = "SELECT * FROM tbl_productlist WHERE id = ".$id;
	$res = mysql_query($sql);
	$rs = mysql_fetch_array($res);

	$manu = $rs['manufacturer'];
	$q = mysql_query("SELECT manufacturername FROM tbl_manufacturer WHERE  id= '$manu'");
	$r = mysql_fetch_array($q);
	$manufacturer = $r['manufacturername'];

	$status = ($rs['status'] == 1) ? "<span class='label label-sm label-success arrowed-in arrowed-in-right'>Active</span>" : "<span class='label label-sm label-arrowed arrowed-in arrowed-in-right'>Inactive</span>";
	
	$array = array("id"=>$rs['id'],"manuf"=>$manufacturer, "product"=>$rs['productname'], "generic"=>$rs['genericname'], "schedule"=>$rs['scheduletype'], "ptype"=>$rs['producttype'], "unitd"=>$rs['unitdesc'], "stype"=>$rs['stocktype'], "ptax"=>$rs['purchasetax'], "stax"=>$rs['salestax'], "mrp"=>$rs['mrp'], "price"=>$rs['unitprice'], "minqty"=>$rs['minqty'], "maxqty"=>$rs['maxqty'], "shelf"=>$rs['shelf'], "rack"=>$rs['rack'], "status"=>$status);
	
	print json_encode($array);
?>