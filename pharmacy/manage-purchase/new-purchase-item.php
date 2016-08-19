<?php
	session_start();
	$username = $_SESSION['phar-username'];
	$peinvoiceno = $_REQUEST['peinvoiceno'];
	$pepurchaseno = $_REQUEST['pepurchaseno'];

	$peproductname = $_REQUEST['peproductname'];
	$peqty = $_REQUEST['peqty'];
	$pefree = $_REQUEST['pefree'];
	$pebatch = $_REQUEST['pebatch'];
	
	$peexpiry = $_REQUEST['peexpiry'];
	$peexpiry1 = $peexpiry;
	$peexpiry = "27/" . $peexpiry;
	$peexpiry = implode("-",array_reverse(explode("/",$peexpiry)));
	
	$pepprice = $_REQUEST['pepprice'];
	$pemrp = $_REQUEST['pemrp'];
	$avail = $peqty + $pefree;

	include("../config.php");
	$sql = "SELECT * FROM tbl_productlist WHERE productname = '$peproductname'";
	$res = mysql_query($sql);
	$rs = mysql_fetch_array($res);
	
	$productid = $rs['id'];
	$avail = $avail * $rs['unitdesc'];

	$vat = $_REQUEST['pevatp'];
	$gross = $_REQUEST['pevat'];
/*	$vat = $rs['salestax'];
	$gross = $peqty * $pepprice * $vat / 100;	*/
	$netamt = $peqty * $pepprice;
	
	$s = mysql_query("SELECT AUTO_INCREMENT FROM information_schema.tables WHERE TABLE_SCHEMA = '".DATABASE."' AND TABLE_NAME = 'tbl_purchaseitems'");
	$r = mysql_fetch_array($s);
	$id = $r['AUTO_INCREMENT'];
	
	$cmd = "INSERT INTO tbl_purchaseitems (id, purchaseid, invoiceno, productid, qty, freeqty, batchno, expirydate, pprice, mrp, vat, grossamt, netamt, aval, username, datentime, status) VALUES (NULL, '$pepurchaseno', '$peinvoiceno', '$productid', '$peqty', '$pefree', '$pebatch', '$peexpiry', '$pepprice', '$pemrp', '$vat', '$gross', '$netamt', '$avail', '$username', CURRENT_TIMESTAMP, '2')";
	if(mysql_query($cmd)){
		mysql_query("UPDATE tbl_productlist mrp = $pemrp SET id = $productid");
		$array = array("id"=>$id, "code"=>$productid, "descrip"=>$peproductname, "qty"=>$peqty, "free"=>$pefree, "batch"=>$pebatch, "expiry"=>$peexpiry1, "price"=>$pepprice,  "mrp"=>$pemrp, "vat"=>$vat, "gross"=>$gross, "net"=>$netamt);
		echo json_encode($array);
	}else
		echo mysql_error();
?>