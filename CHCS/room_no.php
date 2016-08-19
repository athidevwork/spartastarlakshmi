<?php
	$ward = $_REQUEST['ward'];
	if($ward != "Select"){
		include("config_db1.php");
		$cmd = "SELECT room FROM room_no WHERE ward_names='$ward' AND where vacant=''";
		$res = mysql_query($cmd);
		$rs = mysql_fetch_array($res);
		$id = $rs['room'];
		echo $id;	
	}else{
		echo '';
	}
?>
