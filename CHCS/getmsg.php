<?php
 session_start();
 $user= $_SESSION['username'];
 date_default_timezone_set('Asia/Kolkata');
	include("config_db1.php");
	$ser=$_REQUEST['x'];
	//$ser='vinoth';
	

$sql = "select chat.*,(select name from user_login where username= chat.from)as name1 from chat  where (chat.to = '".mysql_real_escape_string($_SESSION['username'])."' AND chat.from = '".mysql_real_escape_string($ser)."' OR chat.to = '".mysql_real_escape_string($ser)."' AND chat.from = '".mysql_real_escape_string($_SESSION['username'])."') order by chat.id DESC
  LIMIT 15";
  mysql_query("update chat set recd=1 where chat.to='$user'");
  //echo "update chat set recd=1 where to='$user'";
$cmd=mysql_query($sql);
while($rs1 = mysql_fetch_array($cmd)){
$msg .= $rs1['from'].'~'.$rs1['to'].'~'.$rs1['message'].'~'.$rs1['sent'].'~'.$rs1['name1'].'#';

}
//$num=mysql_num_rows($cmd);
//$msg = substr($msg 0, -1);
		
		//$bal=$tot-$paid;
//		$msg .= $pid.'~'.$name.'~'.$bal.'+'.$row.'#'.$num;
$msg = substr($msg, 0, -1);
	echo $msg;
	mysql_close($db1);
?>