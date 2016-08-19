<?php
 session_start();
 //echo $_SESSION['username'];
 date_default_timezone_set('Asia/Kolkata');
	include("config_db1.php");
	if(isset($_REQUEST['s']))
	$ser=$_REQUEST['s'];
	$msg='';
	//$ser='vinoth';
	$sql ="select `from`,GROUP_CONCAT(message order by id desc SEPARATOR '<br /> ')as message from chat  where chat.to ='".mysql_real_escape_string($_SESSION['username'])."' and chat.recd=0 group by `from`";
// echo $sql;
$cmd=mysql_query($sql);
$cmd1=mysql_num_rows($cmd);
//$msg =" ";
while($rs=mysql_fetch_array($cmd))
{
 $msg .=$rs['from'].'~'.$rs['message'].'@';	
}

$msg = substr($msg, 0, -1);
echo $cmd1.'#'.$msg;
//while($rs1 = mysql_fetch_array($cmd)){
//$msg .= $rs1['from'].'~'.$rs1['to'].'~'.$rs1['message'].'~'.$rs1['sent'].'#';
//$cmd1 = mysql_query("update chat set recd=1 where id='".$rs1['id']."'");
//}

//$num=mysql_num_rows($cmd);
//$msg = substr($msg 0, -1);
		
		//$bal=$tot-$paid;
//		$msg .= $pid.'~'.$name.'~'.$bal.'+'.$row.'#'.$num;
//$msg = substr($msg, 0, -1);
	//echo $msg;
	mysql_close($db1);
?>