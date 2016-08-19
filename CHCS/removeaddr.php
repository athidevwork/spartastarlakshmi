<?php
include("config_db1.php");
$id=$_REQUEST['id'];
$cmd="Delete from address where id='$id'";
if(mysql_query($cmd))
{
echo "Success";
}
else
{
echo'Error';
}
?>