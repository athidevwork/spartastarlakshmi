<?php

date_default_timezone_set('Asia/Kolkata'); 

$id=$_REQUEST['id'];


include("config_db2.php");
$sql="delete from appointments  where id='$id'";
//echo $sql;
if(mysql_query($sql))
{
exit(header("Location:home.php?up=1"));
}else 
echo'error';


?>