<?php
		include("config_db1.php");
		$gen=$_REQUEST['generic'];
		$cmd = "select distinct content from druglist where content like '%$gen%' order by content asc";
		//echo $cmd;
		$res = mysql_query($cmd);
		$msg = "";
		while($rs = mysql_fetch_array($res)){
			$msg .= $rs['content'].'~';
		}
		$msg = substr($msg,0,-1);
		echo $msg;
		mysql_close($db1);
?>