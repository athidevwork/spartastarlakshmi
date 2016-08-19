<?php
	include("../config.php");
	$fromdate = $_REQUEST['fromdate'];
	$fromto = $_REQUEST['fromto'];
	$paymentmode = $_REQUEST['paymentmode'];
	$billtype = $_REQUEST['billtype'];
	
	/*$d1 = implode("-", array_reverse(explode("/",$fromdate)));
	if($fromto == "")	$d2 = $d1;
	else $d2 = implode("-", array_reverse(explode("/",$fromto)));*/
	
	$d1 = $fromdate;
	if($fromto == "")	$d2 = $d1;
	$d2 = $fromto;
	
	$sql = "SELECT cast(datentime as date) as billdate, billno, patientname, drname, totalamt, paymentmode FROM tbl_billing WHERE (datentime BETWEEN '$d1' AND '$d2') AND ";
	if($paymentmode == "all")
		$sql .= "paymentmode like '%' AND ";
	else
		$sql .= "paymentmode = '$paymentmode' AND ";
		
	$sql .= "status = 1";
	$array = array();
	$res = mysql_query($sql);
	$xtotal = 0;
	while($rs = mysql_fetch_array($res)){
		$xtotal += $rs['totalamt'];
		$array[] = array("date"=> implode("/", array_reverse(explode("-",$rs['billdate']))), "billno"=>$rs['billno'], "paymentmode" => $rs['paymentmode'], "patientname" => $rs['patientname'], "drname" => $rs['drname'], "totalamt" => $rs['totalamt']); 
	}
	$array[] = array("tamt"=>number_format($xtotal,2,".",""));
	echo json_encode($array);
?>