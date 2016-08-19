<?php
	$table = $_REQUEST['table'];
	$old = $_REQUEST['old'];
	$field = "";
	
	if($table != "" && $old != ""){
	
		if ($table == "Psychiatric Symptoms") {
			$table = "psysymptoms";
			$field = "symptom";
		} else if ($table == "Other Symptoms") {
			$table = "symptoms";
			$field = "symptom";
		} else if ($table == "Family / Others History") {
			$table = "medicalhistory";
			$field = "med_his";
		}
	
		include("config_db1.php");
		
		$cmd = "delete from $table where $field = '$old'";
		if(mysql_query($cmd))
			echo 'user info. deleted!';
		else
			echo 'unable to deleted';		
			
		mysql_close($db1);
	}else{
		echo 'fields cannot be left blank';
	}
?>