<?php
session_start();
	include("config_db2.php");
	$name = $_SESSION['username'];
	$labsampleno = $_REQUEST['id'];
	$external = trim($_REQUEST['external']);
	$bill_queue =0;
	if(empty($external))
		$bill_queue =1;
				$lab_sampleno_update_query = mysql_query("SELECT id FROM lab_testsample_ip where labsampleno='$labsampleno' AND datecollect IS NOT NULL");
				if(mysql_num_rows($lab_sampleno_update_query) > 0){
					if(empty($external))
						echo 'failure-Test could not be added to Internal queue. Test Already collected. Contact your Lab.';
					else
						echo 'failure-Test could not be added to External queue. Test Already collected. Contact your Lab.';
					exit;
				}
				$lab_sampleno_update_query = mysql_query("UPDATE lab_testsample_ip SET labsampleno='$labsampleno',bill_queue='$bill_queue',test_external='$external' where labsampleno='$labsampleno'");
				if($lab_sampleno_update_query){
					if(empty($external))
						echo 'success-Test added to Internal queue';
					else
						echo 'success-Test added to External queue';
					exit;
				}
				else{
					if(empty($external))
						echo 'failure-Test could not be added to Internal queue. Please try again';
					else
						echo 'failure-Test could not be added to External queue. Please try again';
					exit;
				}
				
	
	
	
?>
