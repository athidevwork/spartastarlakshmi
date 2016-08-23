<?php
include ("config_db1.php");
$procedure_name = $_REQUEST ['procedure_name'];
$ptypes = $_REQUEST ['ptypes'];
$pamount = $_REQUEST ['pamount'];
$id = $_REQUEST ['id'];
if ($id != "") {
	$cmd = "update procedure_creation set procedure_name='$procedure_name',ptypes='$ptypes',pamount='$pamount' where id=" . $id;
	/*if (mysql_query ( $cmd ))
		echo 'Procedure info. updated!';
	else
		echo 'unable to update';*/
}
if ($id == "") {
	$cmd = "INSERT INTO procedure_creation(procedure_name, ptypes, pamount)VALUES('$procedure_name','$ptypes','$pamount')";
	/*if (mysql_query ( $cmd ))
		echo 'Procedure info. Inserted!';
	else
		echo 'unable to Insert';*/
}
if(!mysql_query($cmd))
	echo 'Unable to Insert/Update procedure - '. mysql_error();
mysql_close ( $db1 );
?>