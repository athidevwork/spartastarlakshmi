 <?php
	include("config_db1.php");
	$cmd1 = "select username from user_login order by id asc";
	$res1 = mysql_query($cmd1);
	$msg = "";
	while($rs1 = mysql_fetch_array($res1)){
		$msg .= $rs1['username'].'~';
	}
	$msg = substr($msg, 0, -1);
	echo $msg;
	mysql_close($db1);
?>