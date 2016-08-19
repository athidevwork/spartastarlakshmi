<?php
session_start();
include("config_db1.php");
$pass=$_REQUEST['pass'];
$cmd="update user_login set password='$pass' where username='".$_SESSION['username']."'";
//echo $cmd;
if(mysql_query($cmd))
{
echo'sucess';
} 
else
{
echo "Error";
}
?>