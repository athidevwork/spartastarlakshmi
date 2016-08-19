<?php
 session_start();
 //echo $_SESSION['username'];
 date_default_timezone_set('Asia/Kolkata');
	include("config_db1.php");
	$ser=$_REQUEST['x'];
	$sent=$_REQUEST['sent'];
	//$ser='vinoth';
	

$sql = "insert into chat (chat.from,chat.to,message,sent) values ('".mysql_real_escape_string($_SESSION['username'])."', '".mysql_real_escape_string($ser)."','".mysql_real_escape_string($sent)."',NOW())";
$cmd=mysql_query($sql);
if($cmd)
echo $_SESSION['username'].'('.$_SESSION['name'].')';
//$num=mysql_num_rows($cmd);
//$msg = substr($msg 0, -1);
		
		//$bal=$tot-$paid;
//		$msg .= $pid.'~'.$name.'~'.$bal.'+'.$row.'#'.$num;

	mysql_close($db1);
?>