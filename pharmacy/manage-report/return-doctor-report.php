<?php
	include("../config.php");
	$fromdate = $_REQUEST['fromdate'];
	$fromto = $_REQUEST['fromto'];
	$doc = $_REQUEST['doc'];
	//$billtype = $_REQUEST['billtype'];
	
	$d1 = implode("-", array_reverse(explode("/",$fromdate)));
	if($fromto == "")	$d2 = $d1;
	else $d2 = implode("-", array_reverse(explode("/",$fromto)));
	
	$sql = "select totalamt, billno,patientname,cast(datentime as date) as billdate,drname FROM tbl_billing where (datentime BETWEEN '$d1' AND '$d2')  AND ";
	if($doc == "all")
		$sql .= "drname like '%' AND ";
	else
		$sql .= "drname = '$doc' AND ";
		
	$sql .= "status = 1";
	//echo $sql;
	$array = array();
	$res = mysql_query($sql);
	$xtotal = 0;
	while($rs = mysql_fetch_array($res)){
		
		$xtotal += $rs['totalamt'];
		//$s = mysql_query("SELECT * FROM tbl_supplier WHERE id = $sup");
		//$r = mysql_fetch_array($s);
		//$supplier = $r['suppliername'] . '<br />'. $r['addressline1'] . '<br />'. $r['addressline2'] . '<br />'. $r['addressline3'] . '<br />'. $r['contactno1'];
		$array[] = array("date"=> implode("/", array_reverse(explode("-",$rs['billdate']))), "billno"=>$rs['billno'], "name" => $rs['patientname'],  "totalamt" => $rs['totalamt'],"drname" => $rs['drname']); 
	}
	$array[] = array("tamt"=>number_format($xtotal,2,".",""));
	echo json_encode($array);
?>