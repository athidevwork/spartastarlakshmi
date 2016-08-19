<?php
	$id = $_REQUEST['id'];
	include("../config.php");
	$sql = "SELECT * FROM tbl_users WHERE id = ".$id;
	$res = mysql_query($sql);
	$rs = mysql_fetch_array($res);
	$role = $rs['role'];
	$status = $rs['status'];
	echo $rs['username'] . '~' . $rs['userid'] . '~' . $role . '~' . $status .  '~' . $rs['id'] . '~' . $rs['mp'] . '~' .	$rs['mm'] . '~' .	$rs['ms'] . '~' .	$rs['mu'] . '~' .	$rs['bill'] . '~' .	$rs['sr'] . '~' .	$rs['pe'] . '~' .	$rs['pr'] . '~' .	$rs['sa'] . '~' .	$rs['ise'] . '~' .	$rs['stka'] . '~' .	$rs['srep'] . '~' .	$rs['prep'] . '~' .	$rs['doc']. '~' .	$rs['vat']. '~' .	$rs['sch'];
?>