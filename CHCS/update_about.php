<?php
session_start();
include("config_db1.php");
$name=$_REQUEST['name'];
$email=$_REQUEST['email'];
$about=$_REQUEST['about'];
$location=$_REQUEST['location'];
$dob=$_REQUEST['dob'];
$cmd="update user_login set name='$name',email='$email',about='$about',location='$location',dob='$dob' where username='".$_SESSION['username']."'";
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