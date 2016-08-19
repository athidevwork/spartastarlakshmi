<?php
	include("../config.php");
	$fromdate = $_REQUEST['fromdate'];
	$fromto = $_REQUEST['fromto'];
	//$paymentmode = $_REQUEST['paymentmode'];
	//$billtype = $_REQUEST['billtype'];
	
	$d1 = implode("-", array_reverse(explode("/",$fromdate)));
	if($fromto == "")	$d2 = $d1;
	else $d2 = implode("-", array_reverse(explode("/",$fromto)));
	
	$sql = "select vat, invoiceno,datentime FROM tbl_purchaseitems where (datentime BETWEEN '$d1' AND '$d2') AND status = 1 group by invoiceno";
	//echo $sql;
	//$sql .= "status = 1";
	$array = array();
	$res = mysql_query($sql);
	$xtotal = 0;
	while($rs = mysql_fetch_array($res)){
		//$sup = $rs['invoiceno'
		//echo  $rs['invoiceno'];
		$xtotal += $rs['vat'];
		//$s = mysql_query("SELECT * FROM tbl_supplier WHERE id = $sup");
		//$r = mysql_fetch_array($s);
		//$supplier = $r['suppliername'] . '<br />'. $r['addressline1'] . '<br />'. $r['addressline2'] . '<br />'. $r['addressline3'] . '<br />'. $r['contactno1'];
		$array[] = array("date"=> implode("/", array_reverse(explode("-",$rs['datentime']))), "billno"=>$rs['invoiceno'],  "vat" => $rs['vat']); 
	}
//echo $xtotal;
$array[] = array("tamt"=>number_format($xtotal,2,".",""));
	echo json_encode($array);
?>