<?php
	$branch = $_REQUEST['branch'];
	$date = $_REQUEST['date'];
	if($branch != "Select"){
		include("config_db1.php");
		$cmd = "SELECT `nextnumber` FROM `hospitalbranches` WHERE `branch`='$branch'";
		$res = mysql_query($cmd);
		$rs = mysql_fetch_array($res);
		$id = $rs['nextnumber']+1;
		$yr = explode('/',$date);
//		$id = $id.'/'.date('Y').'/'.strtolower(substr($branch,0,3));
		$id = $id.'/'.$yr[2].'/'.strtolower(substr($branch,0,3));
		mysql_close($db1);
		echo $id;	
	}else{
		echo '';
	}
?>