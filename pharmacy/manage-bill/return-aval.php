<?php
	$prod = urldecode($_REQUEST['prod']);
	$prod = mysql_escape_string($prod);
	$batch = $_REQUEST['batch'];
	
	include('../config.php');
	
	$cmd = mysql_query("SELECT id FROM tbl_productlist WHERE productname = '$prod'");
	$rs = mysql_fetch_array($cmd);
	if($rs['id']){
		$id = $rs['id'];
		$sql = mysql_query("SELECT distinct aval FROM tbl_purchaseitems WHERE status = 1 AND productid = $id AND batchno = '$batch'");
		$array = array();
		while($r = mysql_fetch_array($sql)){
			
			$aval = $r['aval'];
			
			array_push($array, array("aval"=>$aval));
		}
		echo json_encode($array);
	}else{
		echo "error1";
	}
	
?>