<?php
	$id = $_REQUEST['id'];
	include("../config.php");
	
	$r = mysql_query("SELECT purchaseid FROM tbl_billing_items WHERE bid = $id");
	while($rs = mysql_fetch_array($r)){
		$pid = $rs['purchaseid'];
		
		$ids = explode(";",$pid);
		for($i=0 ; $i<count($ids); $i++){
			$val =  explode("-",$ids[$i]);
			$q = "UPDATE tbl_purchaseitems SET aval = aval + $val[1] WHERE id = $val[0]";
			mysql_query($q);
		}
	}
	
	$cmd = mysql_query("DELETE FROM tbl_billing_items WHERE bid = $id");
	$cmd = "DELETE FROM tbl_billing WHERE id = $id";
	if(mysql_query($cmd))
		echo 'Deleted !';
	else
		echo mysql_error();
?>
