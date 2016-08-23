<?php
include ("config_db1.php");
$department_name = $_REQUEST ['department_name'];
$doctor_name = $_REQUEST ['doctor_name'];
$mobile_no = $_REQUEST ['mobile_no'];
$id = $_REQUEST ['id'];
if ($id != "") {
	$cmd = "update doctor_creation set department_name='$department_name',doctor_name='$doctor_name',mobile_no='$mobile_no' where id=" . $id;
	/*if (mysql_query ( $cmd ))
		echo 'Doctor info. updated!';
	else
		echo 'unable to update';*/
}
if ($id == "") {
	$cmd = "INSERT INTO doctor_creation(department_name,doctor_name, mobile_no)VALUES('$department_name','$doctor_name','$mobile_no')";
	/*if (mysql_query ( $cmd ))
		echo 'Doctor info. Inserted!';
	else
		echo 'unable to Insert';*/
}
if(!mysql_query($cmd))
	echo 'Unable to Insert/Update doctor - '. mysql_error();
mysql_close ( $db1 );
?>