<?php
	include("../config.php");
	
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

	if (!empty($_FILES["photo"]["name"])) {
		$fileTempName = $_FILES['photo']['tmp_name'];
		$imgData = addslashes(file_get_contents($_FILES['photo']['tmp_name']));
	}else
		$imgData = "";
		
	$sql = "INSERT INTO tbl_users (id, username, userid, password, role, image, mp, mm, ms, mu, bill, sr, pe, pr, sa, ise, stka, srep, prep, doc, vat, sch, status) VALUES (NULL, '$username', '$userid', '$pass', '$role', '{$imgData}', '$opt1', '$opt2', '$opt3', '$opt4', '$opt5', '$opt6', '$opt7', '$opt8', '$opt9', '$opt10', '$opt11', '$opt12', '$opt13','$opt14', '$opt15', '$opt16','1');";
	if(mysql_query($sql))
//		echo 'New User Added!';
		echo $sql;	
	else
		echo mysql_error();
?>
 
