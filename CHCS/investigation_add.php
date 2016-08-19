<?php
	include("config_db2.php");
	$id = $_REQUEST['id'];
	$inves = $_REQUEST['inves'];
	$note = $_REQUEST['note'];
	$reports = $_REQUEST['reports'];
	$chief = $_REQUEST['chief'];
	$pat_id = $_REQUEST['pat_id'];
	$patientname = $_REQUEST['patientname'];
	$createdate=date("Y-m-d");
//echo "INSERT INTO lab_details (id, patient_id, patientname, investigation, details, report, notes, create_date) VALUES(NULL ,'$pat_id', '$patientname', '$inves', '$reports', '$chief', '$note', '$createdate')";
	$Insql=mysql_query("INSERT INTO lab_details (id, patient_id, patientname, investigation, details, report, notes, create_date) VALUES
(NULL ,'$pat_id', '$patientname', '$inves', '$reports', '$chief', '$note', '$createdate')");
	$cmds=mysql_query($cmd);
		?>	