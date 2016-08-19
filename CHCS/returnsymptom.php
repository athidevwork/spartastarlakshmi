 <?php
	include("config_db1.php");
	$cmd1 = "select symptom from symptoms order by symptom asc";
	$res1 = mysql_query($cmd1);
	$msg = "";
	while($rs1 = mysql_fetch_array($res1)){
		$msg .= $rs1['symptom'].'~';
	}
	$msg = substr($msg, 0, -1);
	echo $msg;
	mysql_close($db1);
?>