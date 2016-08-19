<?php
	$output = "";
	$table = "";
	$field="";
	
	$content = $_REQUEST['content'];
	if($content != ""){		
		
		if($content == "Psychiatric Symptoms"){
            $table = "psysymptoms";$field="symptom";
        }else if($content == "Other Symptoms"){
            $table = "symptoms";$field="symptom";
        }else if($content == "Family / Others History"){
            $table = "medicalhistory";$field="med_his";
        }
	
		include("config_db1.php");
		$cmd = "select $field from $table order by $field asc";
		$res = mysql_query($cmd);
		$output = "";
		while($rs = mysql_fetch_array($res)){
			$output = $output . $rs[$field].';';
		}
		mysql_close($db1);
		echo $output;
	}
?>