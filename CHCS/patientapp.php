<?php
session_start();
$role=$_SESSION['role'];

date_default_timezone_set('Asia/Kolkata'); 

$id=$_REQUEST['id'];
$pid=$_REQUEST['pid'];


include("config_db2.php");
$sql=mysql_query("update appointments set status=0 where id='$id'");
//echo $sql;
//if(mysql_query($sql))
if($role==1)
exit(header("Location:patient-info.php?pid='".$pid."'"));
else
exit(header("Location:patient-hold.php?id='".$id."'"));



?>