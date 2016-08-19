<?php
	include("config_db1.php");
	$cmd1 = "SELECT med_his FROM medicalhistory order by med_his asc";
	$res1 = mysql_query($cmd1);
	$msg = "";
	while($rs1 = mysql_fetch_array($res1)){
		$msg .= $rs1['med_his'].'~';
	}
	$msg = substr($msg, 0, -1);
	echo $msg;
	mysql_close($db1);
?> 