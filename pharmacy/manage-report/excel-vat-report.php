<?php
	include("../config.php");
	$fromdate = $_REQUEST['fromdate'];
	$fromto = $_REQUEST['todate'];
	
	
	$d1 = implode("-", array_reverse(explode("/",$fromdate)));
	if($fromto == "")	$d2 = $d1;
	else $d2 = implode("-", array_reverse(explode("/",$fromto)));
	
	$sql = "SELECT sum(vat) as totvat,`invoiceno`  FROM tbl_purchaseitems WHERE (invoicedate BETWEEN '$d1' AND '$d2') AND status = 1";
	//if($paymentmode == "all")
	//	$sql .= "invoicetype like '%' AND ";
	//else
		//$sql .= "invoicetype = '$paymentmode' AND ";
		
	//$sql .= "status = 1";
	
	$array = array();
	$res = mysql_query($sql);
	$xtotal = 0;
	
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Purchase_Report.xls");
header("Pragma: no-cache");
header("Expires: 0");

	$header = array("Date","Bill #","Supplier Details","Payment Mode", "Bill Amount");
	echo implode("\t",$header). "\r\n";
	while($rs = mysql_fetch_array($res)){
		$sup = $rs['supplierid'];
		$xtotal += $rs['invoiceamt'];
		$s = mysql_query("SELECT * FROM tbl_supplier WHERE id = $sup");
		$r = mysql_fetch_array($s);
		$supplier = $r['suppliername'] . $r['addressline1'] . $r['addressline2'] . $r['addressline3'] . $r['contactno1'];

		echo implode("/", array_reverse(explode("-",$rs['invoicedate']))) . "\t" . $rs['invoiceno'] . "\t" . $supplier . "\t" . $rs['invoicetype'] . "\t" . number_format($rs['invoiceamt'],2,".","") . "\r\n";		
		
	}
	echo "\t\t\tTotal\t" . number_format($xtotal,2,".","")  . "\r\n";

?>