<?php
include ("config_db1.php");
$department_names = $_REQUEST ['department_names'];
$descriptions = $_REQUEST ['descriptions'];
$id = $_REQUEST ['id'];
if ($id != "") {
	$cmd = "update department_creation set department_names='$department_names',descriptions='$descriptions' where id=" . $id;
	/*if (mysql_query ( $cmd ))
		echo 'Department info. updated!';
	else
		echo 'unable to update';*/
}
if ($id == "") {
	$cmd = "INSERT INTO department_creation(department_names,descriptions)VALUES('$department_names','$descriptions')";
	/*if (mysql_query ( $cmd ))
		echo 'Department info. Inserted!';
	else
		echo 'unable to Insert';*/
}
if(!mysql_query($cmd))
	echo 'Unable to Insert/Update dept - '. mysql_error();
mysql_close ( $db1 );
?>