<?php
	session_start();
	$user = $_SESSION['username'];
	
	$id = $_REQUEST['id'];
	$drugname = $_REQUEST['drugname'];
	$dosage = $_REQUEST['dosage'];
	$specification = $_REQUEST['specification'];
	$frequency = $_REQUEST['frequency'];
	$route = $_REQUEST['route'];
	$duration = $_REQUEST['duration'];		
	
	$drugname = mysql_escape_string($drugname);
	$dosage = mysql_escape_string($dosage);
	$specification = mysql_escape_string($specification);
	$frequency = mysql_escape_string($frequency);
	$route = mysql_escape_string($route);
	$duration = mysql_escape_string($duration);
				
	include("config_db2.php");
	$query5 = "select * from prescriptiondetail where id = $id";
	$res5 = mysql_query($query5);
	$rs5 = mysql_fetch_array($res5);
	
	$date = $rs5['datetime'];
	$oldid = $rs5['id'];
	$patid = $rs5['patientid'];
	
	$sql = "INSERT INTO prescriptiondetail (id, patientid, drugname, dosage, specification, frequency, route, duration,prescribed_by, datetime) VALUES ('$oldid', '$patid', '$drugname', '$dosage', '$specification', '$frequency', '$route', '$duration' ,'$user' ,'$date')";
	mysql_query($sql);
	
	$query5 = "select max(slno) as slno from prescriptiondetail where id = $oldid";
	$res5 = mysql_query($query5);
	$rs5 = mysql_fetch_array($res5);
			
	echo "<tr>
		<td>".$drugname."&nbsp;</td>					
		<td >".dosage."&nbsp;</td>
		<td >".specification."&nbsp;</td>
		<td >".$frequency."&nbsp;</td>
		<td >".$duration."&nbsp;</td>
		<td><a href='#' class='btn btn-danger btn-rounded btn-condensed btn-sm' onClick='delItemmed($(this))' width='24' id='deleteimg' alt='".$rs5['slno']."' ><span class='fa fa-times'></span></a></td>
		</tr>";
?>