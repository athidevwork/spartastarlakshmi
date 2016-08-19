<?php
 session_start();
 //echo $_SESSION['username'];
 date_default_timezone_set('Asia/Kolkata');
	include("config_db1.php");
	$ser=$_REQUEST['s'];
	//$ser='vinoth';
$sql = "select * from chat  where chat.to ='".mysql_real_escape_string($_SESSION['username'])."' and chat.from ='".mysql_real_escape_string($ser)."'  and chat.recd=0 order by id DESC LIMIT 15";
 // echo $sql;
$cmd=mysql_query($sql);
while($rs1 = mysql_fetch_array($cmd)){
$msg .= $rs1['from'].'~'.$rs1['to'].'~'.$rs1['message'].'~'.$rs1['sent'].'#';
$cmd1 = mysql_query("update chat set recd=1 where id='".$rs1['id']."'");
}

//$num=mysql_num_rows($cmd);
//$msg = substr($msg 0, -1);
		
		//$bal=$tot-$paid;
//		$msg .= $pid.'~'.$name.'~'.$bal.'+'.$row.'#'.$num;
$msg = substr($msg, 0, -1);
	echo $msg;
	mysql_close($db1);
?>