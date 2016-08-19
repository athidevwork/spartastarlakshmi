<?php
include("config_db2.php");
			date_default_timezone_set('Asia/Kolkata');
			function get_ip_id($pid){
				include("config_db2.php");
				$Isql=mysql_fetch_array(mysql_query("select inv_pat_id from inv_patient where patientid='$pid' and pat_ip_status='0' limit 1"));
				$ipid=$Isql['inv_pat_id'];
				return $ipid;
			}
			function get_ip_id_count($pid){
				include("config_db2.php");
				$Isql=mysql_query("select inv_pat_id from inv_patient where patientid='$pid' and pat_ip_status='0' limit 1");
				$rscount=mysql_num_rows($Isql);
				return $rscount;
			}
			function check_op_paid($labtestsampleid){
				//return "SELECT ip_id FROM lab_testsample_ip WHERE id='$labtestsampleid' AND paid_status=0 AND ip_id=''";
				$sample_test_query=mysql_query("SELECT patient_id FROM lab_testsample_ip WHERE id='$labtestsampleid' AND paid_status=0 AND ip_id=''");
				$sample_test_query_array = mysql_fetch_array($sample_test_query);
				$sample_test_num_rows = mysql_num_rows($sample_test_query);
				$ip_id_exists_count = get_ip_id_count($sample_test_query_array['patient_id']);
				if($sample_test_num_rows ==1 && $ip_id_exists_count==0)
				return 'opnotpaid';
				else
				return 'ip';
			}
			function check_lab_sent_external($labtestsampleid){
				//return "SELECT ip_id FROM lab_testsample_ip WHERE id='$labtestsampleid' AND paid_status=0 AND ip_id=''";
				$sample_test_query=mysql_query("SELECT ip_id FROM lab_testsample_ip WHERE id='$labtestsampleid' AND test_external='yes' limit 1");
				$sample_test_num_rows = mysql_num_rows($sample_test_query);
				if($sample_test_num_rows ==1)
				return 'sentexternal';
				else
				return 'internal';
			}
			if($_REQUEST['action'] =='reportdateupdate'){
				$sampleno = $_REQUEST['sampleno'];
				//$current_date = date("d-m-Y H:i:sa");
				//$mysqltime = date ("Y-m-d H:i:s", $current_date);
				$sample_test_query=mysql_query("UPDATE lab_testsample_ip SET datereportgen=CURRENT_TIMESTAMP WHERE labsampleno='$sampleno'");
				
				
			}
			if($_REQUEST['action'] =='collectdateupdate'){
				$id = $_REQUEST['id'];
				$check_op_paid_value = check_op_paid($id);
				if($check_op_paid_value =='opnotpaid'){
					echo 'opnotpaid';
					exit;
					
				}
				$check_lab_sent_external = check_lab_sent_external($id);
				if($check_lab_sent_external =='sentexternal'){
					echo 'sentexternal';
					exit;
					
				}
				//$current_date = date("d-m-Y H:i:sa");
				//$mysqltime = date ("Y-m-d H:i:s", $current_date);
				$sample_test_query=mysql_query("UPDATE lab_testsample_ip SET datecollect=CURRENT_TIMESTAMP,bill_queue='1' WHERE id='$id'");
				
				
			}
			if($_REQUEST['action'] =='report'){
				$current_time = date("H:i:s");
				$from = $_REQUEST['from'].' '.$current_time;
				$to = $_REQUEST['to'].' '.$current_time;
				$select_rpt_type = 'datereportgen';
				if(!empty($_REQUEST['select_rpt_type']))
				$select_rpt_type =$_REQUEST['select_rpt_type'];
				
				//echo "select id,patient_id,ip_id,labsampleno,sampletesttitle,datereq,datecollect,datereportgen from lab_testsample_ip WHERE datereportgen BETWEEN '$from' AND '$to' order by id desc";
				$cmd_lab_sample_query=mysql_query("select id,patient_id,ip_id,labsampleno,sampletesttitle,datereq,datecollect,datereportgen from lab_testsample_ip WHERE datereportgen !='' AND $select_rpt_type BETWEEN '$from' AND '$to' AND test_external='' order by id desc");
			}else{
				$cmd_lab_sample_query = mysql_query("select id,patient_id,ip_id,labsampleno,sampletesttitle,datereq,datecollect,datereportgen from lab_testsample_ip WHERE datereportgen IS NULL AND test_external='' order by id desc");
			}
		
		//echo $cmd;
			
			while($cmd_lab_sample_array = mysql_fetch_array($cmd_lab_sample_query))
			{
			$pat_id = $cmd_lab_sample_array['patient_id'];
			$ip_id = $cmd_lab_sample_array['ip_id'];
			$cmd_ip_pat_query = mysql_query("select * from inv_patient WHERE patientid='$pat_id' AND inv_pat_id='$ip_id' limit 1");
			$cmd_ip_pat_array = mysql_fetch_array($cmd_ip_pat_query);
			$labsampleno = $cmd_lab_sample_array['labsampleno'];
			$datereportgen = $cmd_lab_sample_array['datereportgen'];
			$sample_edit = '<a data-id="'.$cmd_lab_sample_array['labsampleno'].'" onclick="get_iplab_list(this);return false;" data-toggle="modal" href="#labsampletestedit_modal">'.ucfirst($cmd_lab_sample_array['labsampleno']).'</a>';
			$report_view ='';
			if(!empty($datereportgen)){
				$sample_edit = ucfirst($cmd_lab_sample_array['labsampleno']);
				$report_view = "<center><a href='lab_ip_report_generate.php?sampleno=".$labsampleno."' target='_blank'>".date('M j Y g:i A', strtotime($cmd_lab_sample_array['datereportgen']))." <span class='fa fa-eye' ></span></a></center>";
			}
			$pdetail = get_patient_record($cmd_lab_sample_array['patient_id']);
			$lab_pat_ip_id = get_ip_id($cmd_lab_sample_array['patient_id']);
			$pname = ucwords($pdetail['patientsalutation']).' '.ucwords($pdetail['patientname']);
			
				if($_REQUEST['action'] =='report'){
					$msg .= date('M j Y g:i A',strtotime($cmd_lab_sample_array['datereq'])).'~'.$cmd_lab_sample_array['bill_number'].'~'.$sample_edit.'~'.$cmd_lab_sample_array['patient_id']."~".$pname.'~'.$cmd_lab_sample_array['sampletesttitle'].'~'.date('M j Y g:i A', strtotime($cmd_lab_sample_array['datecollect'])).'~'.$report_view.'@';
				}elseif(empty($cmd_lab_sample_array['datecollect'])){
				$msg .= date('M j Y g:i A',strtotime($cmd_lab_sample_array['datereq'])).'~'.$lab_pat_ip_id.'~'.$sample_edit.'~'.$cmd_lab_sample_array['patient_id']."~".$pname.'~'.$cmd_lab_sample_array['sampletesttitle'].'~<input name="lab_detail_tbl_colsample_ids" onclick="checksamplecollect(this)" id="lab_detail_tbl_colsample_ids" type="checkbox" value="'.$cmd_lab_sample_array['id'].'" >'."~".$report_view.'@';
				}else{
				$msg .= date('M j Y g:i A',strtotime($cmd_lab_sample_array['datereq'])).'~'.$lab_pat_ip_id.'~'.$sample_edit.'~'.$cmd_lab_sample_array['patient_id']."~".$pname.'~'.$cmd_lab_sample_array['sampletesttitle'].'~<input name="lab_detail_tbl_colsample_ids" id="lab_detail_tbl_colsample_ids" type="checkbox" value="" disabled checked>'."~".$report_view.'@';	
					
				}
			}
			$msg = substr($msg, 0, -1);
			echo $msg;
		    mysql_close($db2);
			// returns single patient record
	function get_patient_record($pid){
		include("config_db2.php");
		$query="SELECT patientsalutation,patientname,contactno FROM patientdetails WHERE patientid='$pid' LIMIT 1";
	   $one=mysql_query($query) or die (mysql_error());
	   $r=mysql_fetch_array($one);
	   return($r);
	}
?>
     
