<?php
session_start();
date_default_timezone_set('Asia/Kolkata'); 
	
		$patid=$_REQUEST['u'];
				$diabetes = $_REQUEST['p'];
				$hypertension = $_REQUEST['r'];
				$coronary = $_REQUEST['q'];	
				$asthma =$_REQUEST['s'];
				
			$psy = $_REQUEST['w'];
	$med = $_REQUEST['x'];
	$fam = $_REQUEST['y'];
	$per = $_REQUEST['z'];
	$cad = $_REQUEST['a'];
	$aller = $_REQUEST['t'];
	$blood = $_REQUEST['blood'];
	
	//$id = $_REQUEST['u'];
	if($med !="") {
	$med = str_replace("~","<br />",$med);
	$med .= '<br />'; }
	
	if($aller !="") {
	$aller = str_replace("~","<br />",$aller);
	$aller .= '<br />'; }
	
	if($fam !="") {
	$fam = str_replace("~","<br />",$fam);
	$fam .= '<br />'; }
	
	if($per !="") {
	$per = str_replace("~","<br />",$per);
	$per .= '<br />'; }
	
	if($psy !="") {
	$psy = str_replace("~","<br />",$psy);
	$psy .= '<br />'; }
	
			
			$user = $_SESSION['username'];
			//$datepicker=$_REQUEST['datepicker'];
			$date=date('Y-m-d');
			//echo $aller;		
			include("config_db2.php");
			$sql ="
			INSERT INTO medicalhistory (id, patientid, diabetes, hypertension, coronary, asthma, medicalhistory, familyhistory, personalhistory, psychiatrichistory, prescribed_by, datetime,cad,allergies,bloodgroup) VALUES (NULL, '$patid', '$diabetes', '$hypertension', '$coronary', '$asthma', '$med', '$fam', '$per', '$psy', '$user', '$date','$cad','$aller','$blood') ON DUPLICATE KEY 
			update    diabetes='$diabetes', hypertension='$hypertension', coronary='$coronary', asthma='$asthma', medicalhistory='$med', familyhistory='$fam', personalhistory='$per', psychiatrichistory='$psy', prescribed_by='$user', datetime='$date',cad='$cad',allergies='$aller',bloodgroup='$blood'";
			
			
			//echo $sql;
			
			if(mysql_query($sql))
			{
				mysql_close($db2);
				echo "Success";
		}
		else{
				echo "Error";		
		}
		
	
?>