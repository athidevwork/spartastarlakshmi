<?php
include("config_db2.php");
	$room_no = $_REQUEST['room_no'];
	$name = $_REQUEST['name'];
	$age = $_REQUEST['age'];
	$doa = date('Y-m-d',strtotime($_REQUEST['doa']));
	$cons = $_REQUEST['cons'];
	$intimedate = date('Y-m-d H:i:sa',strtotime($_REQUEST['intimedate']));
	$chart_ot_no = $_REQUEST['chart_ot_no'];
	$remarks=mysql_real_escape_string($_REQUEST['description']);
    $remarks1=str_replace("\$1quot;",'"',$remarks);
    $remarks12=str_replace("\$1amp;",'&',$remarks1);
    $descriptions=str_replace("\$1nbsp;",'    ',$remarks12);
	$shift_patient = $_REQUEST['shift_patient'];
	$outtime = date('Y-m-d H:i:sa',strtotime($_REQUEST['outtime']));
	$vacant_chk = $_REQUEST['vacant_chk'];	
	$created_date=date("Y-m-d");
	if($chart_ot_no != ""){
		$cmd = "INSERT INTO chart_ot (id,ref_id,insert_from,room_no,name,age,doa,cons,intimedate,description,shift_patient,outtime,vacant_chk,created_date) VALUES (NULL, '$chart_ot_no','CHART OT','$room_no','$name','$age','$doa','$cons','$intimedate','$descriptions','$shift_patient','$outtime','$vacant_chk','$created_date')";
		echo "Added Successfully!!";
	}
	$cmds=mysql_query($cmd);
						
?>
