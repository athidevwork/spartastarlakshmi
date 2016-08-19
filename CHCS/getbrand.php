<?php
	$generic = $_REQUEST['generic'];
	if($generic != ""){
		include("config_db1.php");
		$cmd = "select brand,company from druglist where content = '$generic'";
		$res = mysql_query($cmd);
		$brand = "";
		while($rs = mysql_fetch_array($res)){
			$brand = $brand . $rs['brand'] . '--' . $rs['company'] .';';
		}
		mysql_close($db1);
		$brand = substr($brand, 0, -1);
		echo $brand;	
	}else{
		echo '';
	}
?>