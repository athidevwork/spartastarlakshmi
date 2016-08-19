<?php 
					include("config_db2.php");
					$id=$_REQUEST['id'];
					
					$cmd = "select sum(fees) as fees from fees_details where patient_id='$id' and paid_status!='1'";
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
					$total_amt+=$rs['fees'];}
					
					 $cmd = "select sum(fees) as fees from patientlabdetails where patient_id='$id'";
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
					 $total_amts+=$rs['fees'];}
					 $tot=$total_amt+$total_amts;
						?>

