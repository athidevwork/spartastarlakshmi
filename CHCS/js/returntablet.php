<?php
		include("config_db1.php");
		$cmd = "select distinct brand from druglist order by brand asc";
		$res = mysql_query($cmd);
		$msg = "";
		while($rs = mysql_fetch_array($res)){
			$msg .= $rs['brand'].'~';
		}
		$msg = substr($msg,0,-1);
		echo $msg;
		mysql_close($db1);
		?>