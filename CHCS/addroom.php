<?php
include ("config_db1.php");
$ward_names = $_REQUEST ['ward_names'];
$room = $_REQUEST ['room'];
$rate = $_REQUEST ['rate'];
$id = $_REQUEST ['id'];
if ($id != "") {
	$cmd = "update room_no set ward_names='$ward_names',room='$room',rate='$rate' where id=" . $id;
	/*
	 * if(mysql_query($cmd)) echo 'Room No info. updated!'; else echo 'unable to update';
	 */
}
if ($id == "") {
	$cmd = "INSERT INTO room_no(ward_names,room,rate,vacant)VALUES('$ward_names','$room','$rate','yes')";
	/*
	 * if(mysql_query($cmd)) echo 'Room No info. Inserted!'; else echo 'unable to Insert';
	 */
}
if (! mysql_query ( $cmd ))
	echo 'Unable to Insert/Update room - ' . mysql_error ();
mysql_close ( $db1 );
?>