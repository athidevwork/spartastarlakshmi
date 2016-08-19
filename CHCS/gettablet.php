<?php
	$generic = $_REQUEST['brand'];
	$generic = mysql_escape_string($generic);
	//$company = $_REQUEST['company'];
	if($generic != ""){
		include("config_db1.php");
		//if($company =="")
		$cmd = "select * from druglist where brand = '$generic'";
		//echo $cmd;
		//else
//		$cmd = "select * from druglist where brand = '$generic' and company='$company'";
		$res = mysql_query($cmd);
		//$brand = "";
		//echo $cmd;
		while($rs = mysql_fetch_array($res)){
			$brand =$rs['content'];
			$msg .=$rs['brand'].'--'.$rs['company'].'#';
		}
		mysql_close($db1);
		$msg = substr($msg, 0, -1);
		echo $brand.'@'.$msg;	
	}else{
		echo '';
	}
?>