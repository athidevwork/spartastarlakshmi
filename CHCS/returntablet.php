<?php
	$brand = $_REQUEST['brand'];
	$brand = mysql_escape_string($brand);
	include("config_db1.php");
	$cmd = "select distinct brand,company from druglist WHERE brand like '$brand%' order by brand asc";
	$res = mysql_query($cmd);
	mysql_close($db1);
	$msg = "";
	
	$array = array();
	while($rs = mysql_fetch_array($res)){
		$brand = $rs['brand'];
		include("config_db3.php");
		$sql = mysql_query("SELECT * FROM tbl_productlist WHERE productname = '$brand'");
		if($sql){
			if(mysql_num_rows($sql) != 0){
				$rs1 = mysql_fetch_array($sql);
				$code = $rs1['id'];
				$query = mysql_query("SELECT sum(aval) as avail FROM tbl_purchaseitems WHERE productid = '$code' AND status = 1");
				$rs2 = mysql_fetch_array($query);
				if($rs2['avail']) $avail = $rs2['avail'];
				else $avail = 0;
				$msg .= $brand .'-'. $avail .'~';
				array_push($array,array("label"=>$brand .'-1',"value"=>$brand));
			}else{
				array_push($array,array("label"=>$brand .'-0',"value"=>$brand));
			}
		}
	}
	echo json_encode($array);
//	$msg = substr($msg,0,-1);
//	echo $msg;
?>