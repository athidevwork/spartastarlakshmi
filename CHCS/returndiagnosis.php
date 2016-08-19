 <?php
	include("config_db1.php");
	$cmd2 = "select icd_id,diag_sym from diagnosis order by icd_id asc";
	$res2 = mysql_query($cmd2);
	$msg = "";
	while($rs2 = mysql_fetch_array($res2)){
		$msg .= $rs2['diag_sym'].' - '.$rs2['icd_id'].'~';
	}
	$msg = substr($msg, 0, -1);
	echo $msg;
	mysql_close($db1);
?>