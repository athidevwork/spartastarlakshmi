<?php
include("config_db1.php");
$ward=$_REQUEST['ward'];

$cmd1 = "select * from room_no where ward_names='$ward' AND (vacant='' OR vacant='yes') ";
//echo $cmd1;
$res1 = mysql_query($cmd1);
//$num="";
while($rs1 = mysql_fetch_array($res1))
{
$room .=$rs1['room'].'+'.$rs1['id'].'~';
}
$room = substr($room,0,-1);

	echo $room;		
	mysql_close($db1);
?>