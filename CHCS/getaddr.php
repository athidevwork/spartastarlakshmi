<?php
include("config_db1.php");
$id=$_REQUEST['id'];
$cmd="select * from address where id='$id'";
$res=mysql_query($cmd);
while($rs=mysql_fetch_array($res))
{
$msg .=$rs['name'].'~'.$rs['email'].'~'.$rs['about'].'~'.$rs['address'].'~'.$rs['phone'].'~'.$rs['id'];

}

echo $msg;

?>