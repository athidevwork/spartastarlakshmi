<?php
include("config_db2.php");
			date_default_timezone_set('Asia/Kolkata');
			
				$patient_id = $_REQUEST['patient_id'];
				$cmd_lab_sample_query = mysql_query("select id,patient_id,ip_id,labsampleno,sampletesttitle,sampletestsubtitle,datereq,datecollect,datereportgen from lab_testsample_ip WHERE patient_id ='$patient_id' order by id desc");
			
		
		//echo $cmd;
			
			while($cmd_lab_sample_array = mysql_fetch_array($cmd_lab_sample_query))
			{
				$pat_id = $cmd_lab_sample_array['patient_id'];
				$ip_id = $cmd_lab_sample_array['ip_id'];
				$sampletesttitle = $cmd_lab_sample_array['sampletesttitle'];
				$sampletestsubtitle = $cmd_lab_sample_array['sampletestsubtitle'];
				$datereq = date('M j Y g:i A',strtotime($cmd_lab_sample_array['datereq']));
				$pat_type= 'OP';
				if(!empty($ip_id))
					$pat_type= 'IP';
				
				$labsampleno = $cmd_lab_sample_array['labsampleno'];
				$datecollect = $cmd_lab_sample_array['datecollect'];
				if(empty($datecollect))
					$datecollect = "Not Collected";
				else
					$datecollect = date('M j Y g:i A',strtotime($cmd_lab_sample_array['datecollect']));
				$datereportgen = $cmd_lab_sample_array['datereportgen'];
				if(empty($datereportgen))
					$datereportgen = "Report Not Generated";
				else
					$datereportgen = date('M j Y g:i A',strtotime($cmd_lab_sample_array['datereportgen']));
				$sample_edit = '<a data-id="'.$cmd_lab_sample_array['labsampleno'].'" onclick="get_iplab_list(this);return false;" data-toggle="modal" href="#labsampletestedit_modal">'.ucfirst($cmd_lab_sample_array['labsampleno']).'</a>';
				$report_view ='';
					
					
					
					$msg .= $sample_edit.'~'.$pat_type.'~'.$sampletesttitle."~".$sampletestsubtitle.'~'.$datereq.'~'.$datecollect."~".$datereportgen.'@';	
					
				
			}
			$msg = substr($msg, 0, -1);
			echo $msg;
		    mysql_close($db2);
?>
     
