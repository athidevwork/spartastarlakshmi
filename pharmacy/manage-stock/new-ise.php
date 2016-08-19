<?php
	session_start();
	$username = $_SESSION['phar-username'];
	$peinvoiceno = 0;
	$pepurchaseno = 0;
	$peproductname = $_REQUEST['peproductname'];
	$peqty = $_REQUEST['peqty'];
	$pefree = 0;
	$pebatch = $_REQUEST['pebatch'];
	
	$peexpiry = $_REQUEST['peexpiry'];
	$peexpiry1 = $peexpiry;
	$peexpiry = "27/" . $peexpiry;
	$peexpiry = implode("-",array_reverse(explode("/",$peexpiry)));
	
	$pepprice = 0;
	$pemrp = $_REQUEST['pemrp'];
	$avail = $peqty + $pefree;

	include("../config.php");
	$sql = "SELECT * FROM tbl_productlist WHERE productname = '$peproductname'";
	$res = mysql_query($sql);
	$rs = mysql_fetch_array($res);
	
	$productid = $rs['id'];
	$vat = 0;
	$gross = 0;
	$avail = $avail * $rs['unitdesc'];
	$netamt = $peqty * $pepprice;
	
	$s = mysql_query("SELECT AUTO_INCREMENT FROM information_schema.tables WHERE TABLE_SCHEMA = '".DATABASE."' AND TABLE_NAME = 'tbl_purchaseitems'");
	$r = mysql_fetch_array($s);
	$id = $r['AUTO_INCREMENT'];
	
	$cmd = "INSERT INTO tbl_purchaseitems (id, purchaseid, invoiceno, productid, qty, freeqty, batchno, expirydate, pprice, mrp, vat, grossamt, netamt, aval, username, datentime, status) VALUES (NULL, '$pepurchaseno', '$peinvoiceno', '$productid', '$peqty', '$pefree', '$pebatch', '$peexpiry', '$pepprice', '$pemrp', '$vat', '$gross', '$netamt', '$avail', '$username', CURRENT_TIMESTAMP, '3')";
	if(mysql_query($cmd)){
//		mysql_query("UPDATE tbl_productlist mrp = $pemrp SET id = $productid");
		$array = array("id"=>$id, "code"=>$productid, "descrip"=>$peproductname, "qty"=>$peqty, "batch"=>$pebatch, "expiry"=>$peexpiry1, "mrp"=>$pemrp, "net"=>$netamt);
		echo json_encode($array);
	}else
		echo mysql_error();
?>