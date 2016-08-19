<?php
	$table = $_REQUEST['table'];
	$old = $_REQUEST['old'];
	$newdata = $_REQUEST['new'];
	$newdata = mysql_escape_string($newdata);

    $field = "";
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
	$cmd = "UPDATE $table set $field = '$newdata' where $field ='$old'";
	//echo $cmd;
	if(mysql_query($cmd))
		echo 'user info. updated!';
	else
		echo 'unable to update';
	mysql_close($db1);
    
?>