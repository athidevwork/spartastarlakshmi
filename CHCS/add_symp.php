<?php
	$symptoms = $_REQUEST['symptoms'];
	$symptoms = mysql_escape_string($symptoms);	
	if($symptoms != ""){
		include("config_db1.php");
		$cmd = "INSERT INTO symptoms (id, symptom) VALUES (NULL, '$symptoms');";
		if(mysql_query($cmd))
			echo 'inserted';
		else
			echo 'unable to insert';
		mysql_close($db1);
	}else{
		echo 'Symptoms cannot be left blank';
	}
?>