<?php
	include("../config.php");
	
	$id = $_REQUEST['id'];
	$username = $_REQUEST['username'];
	$userid = $_REQUEST['userid'];
	$pass = $_REQUEST['pass'];
	$role = $_REQUEST['role'];
	
	$opt1 = $_REQUEST['opt1'];
	$opt2 = $_REQUEST['opt2'];
	$opt3 = $_REQUEST['opt3'];
	$opt4 = $_REQUEST['opt4'];
	$opt5 = $_REQUEST['opt5'];
	$opt6 = $_REQUEST['opt6'];
	$opt7 = $_REQUEST['opt7'];
	$opt8 = $_REQUEST['opt8'];
	$opt9 = $_REQUEST['opt9'];
	$opt10 = $_REQUEST['opt10'];
	$opt11 = $_REQUEST['opt11'];
	$opt12 = $_REQUEST['opt12'];
	$opt13 = $_REQUEST['opt13'];
	$opt14 = $_REQUEST['opt14'];
	$opt15 = $_REQUEST['opt15'];
	$opt16 = $_REQUEST['opt16'];

	
	$cmd = "";
	$sql = "UPDATE tbl_users SET username = '$username', userid = '$userid', role = '$role', mp = '$opt1', mm = '$opt2', ms = '$opt3', mu = '$opt4', bill = '$opt5',	sr = '$opt6', pe = '$opt7',	pr = '$opt8', sa = '$opt9',	ise = '$opt10',	stka = '$opt11', srep = '$opt12', prep = '$opt13', doc = '$opt14', vat = '$opt15', sch = '$opt16' WHERE id = $id";
	if($pass != ""){
		$cmd = ", password = '$pass'";
		$sql = "UPDATE tbl_users SET username = '$username', userid = '$userid', mp = '$opt1', mm = '$opt2', ms = '$opt3', mu = '$opt4', bill = '$opt5', sr = '$opt6', pe = '$opt7',	pr = '$opt8', sa = '$opt9',	ise = '$opt10',	stka = '$opt11', srep = '$opt12', prep = '$opt13', doc = '$opt14', vat = '$opt15', sch = '$opt16', role = '$role' ".$cmd." WHERE id = $id";
	}
	if (!empty($_FILES["photo"]["name"])) {
		$fileTempName = $_FILES['photo']['tmp_name'];
		$imgData =addslashes(file_get_contents($_FILES['photo']['tmp_name']));
		$cmd = ", image = '{$imgData}'";
		$sql = "UPDATE tbl_users SET username = '$username', userid = '$userid', mp = '$opt1', mm = '$opt2', ms = '$opt3', mu = '$opt4', bill = '$opt5', sr = '$opt6', pe = '$opt7',	pr = '$opt8', sa = '$opt9',	ise = '$opt10',	stka = '$opt11', srep = '$opt12', prep = '$opt13', doc = '$opt14', vat = '$opt15', sch = '$opt16', role = '$role' ".$cmd." WHERE id = $id";
	}
	
	if(mysql_query($sql))
		echo 'User Information Updated!';
	else
		echo mysql_error();
?>