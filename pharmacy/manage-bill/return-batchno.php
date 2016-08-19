<?php
	$type = $_REQUEST['type'];
	$prod = urldecode($_REQUEST['prod']);
	$prod = mysql_escape_string($prod);
	include('../config.php');
	
	$cmd = mysql_query("SELECT id FROM tbl_productlist WHERE productname = '$prod'");
	$rs = mysql_fetch_array($cmd);
	if($rs['id']){
		$id = $rs['id'];
		$sql = mysql_query("SELECT distinct batchno FROM tbl_purchaseitems WHERE status = 1 AND productid = $id AND aval > 0");
		$array = array();
		while($r = mysql_fetch_array($sql)){
			array_push($array, array("batch"=>$r['batchno']));
		}
		echo json_encode($array);
	}else{
		echo "error1";
	}
	
?>