<?php
	date_default_timezone_set('Asia/Kolkata');
	$current_time = date("H:i:s");
	
	
	//calculate days b/w dates
	function calculatedays($start,$end){
        $date1 = new DateTime($start);
        $date2 = new DateTime($end);
        $interval = $date1->diff($date2);
        return $interval;
		}


	// returns single patient record
	function get_patient_record($pid){
		include("config_db2.php");
		$query="SELECT patientsalutation,patientname,contactno FROM patientdetails WHERE patientid='$pid' LIMIT 1";
	   $one=mysql_query($query) or die (mysql_error());
	   $r=mysql_fetch_array($one);
	   return($r);
	}
	// returns single service record
	function get_service_record($sid)
	{
		include("config_db1.php");
		$query="SELECT service_name,types,amount FROM service_creation WHERE id='$sid' LIMIT 1";
	   $one=mysql_query($query) or die (mysql_error());
	   $r=mysql_fetch_array($one);
	   return($r);
	}
	// returns single procedure record
	function get_procedure_record($proid)
	{
		include("config_db1.php");
		$query="SELECT procedure_name,ptypes,pamount FROM procedure_creation WHERE id='$proid' LIMIT 1";
	   $one=mysql_query($query) or die (mysql_error());
	   $r=mysql_fetch_array($one);
	   return($r);
	}
	function get_labtype($lab_id_arg){
			include("config_db1.php");
		//Retrieve lab test main title from investigation table
		$inves_query=mysql_query("select title from investigation where id = $lab_id_arg AND status=1 LIMIT 1");
		$inves_query_array=mysql_fetch_array($inves_query);
		$lab_title=strtolower($inves_query_array['title']);
		
		return $lab_title;
	}
	function get_labtest($lab_id_arg,$lab_sub_id_arg){
			include("config_db1.php");
			//return 'here';
		//Retrieve lab test main title from investigation table
		$inves_query=mysql_query("select title from investigation where id = $lab_id_arg AND status=1 LIMIT 1");
		$inves_query_array=mysql_fetch_array($inves_query);
		$lab_title=strtolower($inves_query_array['title']);
		
		//Lab sub title query to get fee details using title as table from investiogation
		$sym='';
		if(!empty($lab_sub_id_arg)){
		$lab_query=mysql_query("select sym from $lab_title where id = $lab_sub_id_arg AND status=1 LIMIT 1");
		$lab_query_array=mysql_fetch_array($lab_query);
		$sym=strtolower($lab_query_array['sym']);
		}
		return $sym;
	}
	
	//return room name
	function get_room_name($room){
	  include("config_db1.php");
		$sql2="select room from  room_no where id='$room'"; 
		$rs2=mysql_query($sql2);
		while($rsdata2=mysql_fetch_array($rs2))
		{
			$room=$rsdata2['room'];
  		}
		return $room;
	}
	
	//return ward name
	function get_ward_name($ward_names){
		include("config_db1.php");
	   $sql2="select ward_name from  ward_creation where  id='$ward_names'"; 
	  $rs2=mysql_query($sql2);
		while($rsdata2=mysql_fetch_array($rs2))
		{
		   $ward_name=$rsdata2['ward_name'];
		}
	  return $ward_name;
	}
  
  //return consultant name
  function get_consult_name($id){
	  include("config_db1.php");
	$cmd_ser2 = "select doctor_name from doctor_creation where id='$id'";
	$res_ser2 = mysql_query($cmd_ser2);
	while($rs_ser2 = mysql_fetch_array($res_ser2)){
				$name=$rs_ser2['doctor_name'];
				}
				return $name;
	}
	//Start of Admission Report
	
	if($_REQUEST['request']=='admission_report_table'){
		
		$admission_report_discharge_date_from = $_REQUEST['admission_report_discharge_date_from'].' '.$current_time;
		$admission_report_discharge_date_to = $_REQUEST['admission_report_discharge_date_to'].' '.$current_time;
		$admission_report_age_from = empty($_REQUEST['admission_report_age_from']) ? 'NULL' : $_REQUEST['admission_report_age_from'];
		$admission_report_age_to = empty($_REQUEST['admission_report_age_to']) ? 'NULL' : $_REQUEST['admission_report_age_to'];
		$age_sql ='';
		if(!empty($admission_report_age_from) || !empty($admission_report_age_to))
			$age_sql = " AND b.age between coalesce($admission_report_age_from, b.age) and coalesce($admission_report_age_to, b.age)";
		$admission_report_gender = $_REQUEST['admission_report_gender'];
		$gender_sql ='';
		if(!empty($admission_report_gender))
			$gender_sql =" AND b.gender='$admission_report_gender'";	
		$admission_report_address = $_REQUEST['admission_report_address'];
		$address_sql ='';
		if(!empty($admission_report_address))
			$address_sql =" AND b.address LIKE '%$admission_report_address%'";	
		$ptype_condition='';	

		include("config_db2.php");
				
			
				$cmd = "select a.inv_pat_id,a.patientid,a.discharge_on,a.create_date,b.patientsalutation,b.patientname,a.ward,a.room,a.consultant,a.depart,a.type,b.contactno,a.source from inv_patient as a INNER JOIN patientdetails as b on a.patientid=b.patientid where a.discharge_on BETWEEN '$admission_report_discharge_date_from' AND '$admission_report_discharge_date_to' $age_sql $gender_sql $address_sql";
				//echo $cmd;
				$res = mysql_query($cmd);
				$slno = 1;
				
				
				while($rsS = mysql_fetch_array($res))
				{
					$patientid = $rsS['patientid'];
					$inv_pat_id = $rsS['inv_pat_id'];
					$patient_name = ucwords($rsS['patientsalutation']).' '.ucwords($rsS['patientname']);
					$ward = get_ward_name($rsS['ward']);
					$room = get_room_name($rsS['room']);
					$source = $rsS['source'];
					$contactno = $rsS['contactno'];
					$consultant = get_consult_name($rsS['consultant']);
					$depart = $rsS['depart'];
					$type = $rsS['type'];
					$discharge_on = date('M j Y g:i A',strtotime($rsS['discharge_on']));
					$create_date = date('M j Y g:i A',strtotime($rsS['create_date']));
					
					$msg .= $create_date.'~'.$patientid.'~'.$inv_pat_id.'~'.$patient_name."~".$source.'~'.$ward.'/'.$room."~".$consultant.'/'.$depart."~".$type."~".$discharge_on.'@';
				}
				$msg = substr($msg, 0, -1);
				echo $msg;
			
			
		
			mysql_close($db2);
	}
	
	//Start Bill report
	if($_REQUEST['request']=='bill'){
		$ptype = $_REQUEST['ptye'];
		$from = $_REQUEST['from'].' '.$current_time;
		$to = $_REQUEST['to'].' '.$current_time;
		$ptype_condition='';	

		include("config_db2.php");
				
			if($ptype =='IP')
				$ptype_condition = " AND a.type ='IP'";
			if($ptype =='OP')
				$ptype_condition = " AND a.type ='OP'";
			if($ptype =='ADVANCE')
				$ptype_condition = " AND a.type ='advance'";
				$cmd = " select a.id,a.type,b.patientname,a.patientid,a.bill_no,a.fees,a.pay,a.balance,cast(a.created_at as date) as created_at from  billing as a inner join patientdetails as b on a.patientid=b.patientid where (cast(a.created_at as date) BETWEEN '$from' AND '$to') $ptype_condition group by a.bill_no order by a.id DESC";
				//echo $cmd;
				$res = mysql_query($cmd);
				$slno = 1;
				
				
				while($rsS = mysql_fetch_array($res))
				{
					$report_view='';
					if($rsS['type'] =='IP')
					$report_view = "<center><a href='printbillip.php?bill_number=".$rsS['bill_no']."&patient_id=".$rsS['patientid']."' target='_blank'><span class='fa fa-eye' ></span></a></center>";
					if($rsS['type'] =='OP')
					$report_view = "<center><a href='printbill.php?patientid=".$rsS['patientid']."&billnumber=".$rsS['bill_no']."' target='_blank'><span class='fa fa-eye' ></span></a></center>";
					if($rsS['type'] =='advance')
					$report_view = "<center><a href='printadvancebill.php?patient_id=".$rsS['patientid']."&bill_number=".$rsS['bill_no']."' target='_blank'><span class='fa fa-eye' ></span></a></center>";
					//$pid = $rs['patientid'];
					$msg .= $rsS['patientname'].'~'.$rsS['patientid'].'~'.$rsS['type']."~".$rsS['fees'].'~'.$rsS['pay']."~".date('M j Y',strtotime($rsS['created_at'])).'~'.$report_view.'@';
				}
				$msg = substr($msg, 0, -1);
				echo $msg;
			
			
		
			mysql_close($db2);
	}
	
	//Start of Investigation Report
	
	if($_REQUEST['request']=='inves_report'){
		
		$from = $_REQUEST['inves_report_from'].' '.$current_time;
		$to = $_REQUEST['inves_report_to'].' '.$current_time;
		$ptype_condition='';	

		include("config_db2.php");
				
			
				$cmd = " select a.ip_id,a.datereq,b.patient_id,a.createby,b.lab_id,b.lab_sub_id from  lab_testsample_ip as a INNER JOIN lab_details_ip as b on a.labsampleno=b.labsampleno where a.datereq BETWEEN '$from' AND '$to'";
				//echo $cmd;
				$res = mysql_query($cmd);
				$slno = 1;
				
				
				while($rsS = mysql_fetch_array($res))
				{
					$inves_date = date('M j Y g:i A',strtotime($rsS['datereq']));
					$inves_type = get_labtype($rsS['lab_id']);
					//echo $rsS['lab_sub_id'];
					$inves_test = get_labtest($rsS['lab_id'],$rsS['lab_sub_id']);
					$inves_typetest = ucwords($inves_type).'-'.ucwords($inves_test);
					$pdetail = get_patient_record($rsS['patient_id']);
					$pname = ucwords($pdetail['patientsalutation']).' '.ucwords($pdetail['patientname']);
					$pcontact = $pdetail['contactno'];
					$drname = ucwords($rsS['createby']);
					$ptype= 'IP';
					if(empty($rsS['ip_id']))
						$ptype='OP';
					
					
					$msg .= $inves_date.'~'.$inves_typetest.'~'.$pname."~".$pcontact.'~'.$drname."~".$ptype.'@';
				}
				$msg = substr($msg, 0, -1);
				echo $msg;
			
			
		
			mysql_close($db2);
	}
	//Start of Medi Report
	
	if($_REQUEST['request']=='medi_report'){
		
		$from = $_REQUEST['medi_report_from'].' '.$current_time;
		$to = $_REQUEST['medi_report_to'].' '.$current_time;
		$ptype_condition='';	

		include("config_db2.php");
				
			
				$cmd = " select a.datetime,a.patientid,a.prescribed_by,a.id from  prescriptiondetail as a where a.datetime BETWEEN '$from' AND '$to'";
				//echo $cmd;
				$res = mysql_query($cmd);
				$slno = 1;
				
				
				while($rsS = mysql_fetch_array($res))
				{
					$medi_date = date('M j Y g:i A',strtotime($rsS['datetime']));
					//$medi_type = get_labtype($rsS['lab_id']);
					//echo $rsS['lab_sub_id'];
					//$medi_test = get_labtest($rsS['lab_id'],$rsS['lab_sub_id']);
					//$medi_typetest = ucwords($medi_type).'-'.ucwords($medi_test);
					$pdetail = get_patient_record($rsS['patientid']);
					$pname = ucwords($pdetail['patientsalutation']).' '.ucwords($pdetail['patientname']);
					$pcontact = $pdetail['contactno'];
					$drname = ucwords($rsS['prescribed_by']);
					$depname='';
					$pview_link='printing.php?pid='.$rsS['patientid'].'&maxid='.$rsS['id'];
					$report_view = "<a href='".$pview_link."' target='_blank'><span class='fa fa-eye' ></span></a>";
					$ptype= 'IP';
					if(empty($rsS['ip_id']))
						$ptype='OP';
					
					
					$msg .= $medi_date.'~'.$pname.'~'.$drname."~".$depname.'~'.$report_view.'@';
				}
				$msg = substr($msg, 0, -1);
				echo $msg;
			
			
		
			mysql_close($db2);
	}
	//Start of Service Report
	
	if($_REQUEST['request']=='service_report'){
		
		$from = $_REQUEST['service_report_from'].' '.$current_time;
		$to = $_REQUEST['service_report_to'].' '.$current_time;
		$ptype_condition='';	

		include("config_db2.php");
				
			
				$cmd = " select a.created_date,a.patient_id,a.service_id,a.given_details,a.total_count from  services_details as a where a.created_date BETWEEN '$from' AND '$to'";
				//echo $cmd;
				$res = mysql_query($cmd);
				$slno = 1;
				
				
				while($rsS = mysql_fetch_array($res))
				{
					$service_date = date('M j Y',strtotime($rsS['created_date']));
					$service_detail =  get_service_record($rsS['service_id']);
					$service_name = $service_detail['service_name'];
					$service_no_times = $rsS['given_details'];
					$service_amount = $rsS['total_count'];
					//$medi_type = get_labtype($rsS['lab_id']);
					//echo $rsS['lab_sub_id'];
					//$medi_test = get_labtest($rsS['lab_id'],$rsS['lab_sub_id']);
					//$medi_typetest = ucwords($medi_type).'-'.ucwords($medi_test);
					
					$pdetail = get_patient_record($rsS['patient_id']);
					$pname = ucwords($pdetail['patientsalutation']).' '.ucwords($pdetail['patientname']);
					$pcontact = $pdetail['contactno'];
					
					
					
					$msg .= $service_date.'~'.$service_name.'~'.$service_no_times."~".$service_amount.'~'.$pname.'~'.$pcontact.'@';
				}
				$msg = substr($msg, 0, -1);
				echo $msg;
			
			
		
			mysql_close($db2);
	}
	//Start of Service Report
	
	if($_REQUEST['request']=='procedure_report'){
		
		$from = $_REQUEST['procedure_report_from'].' '.$current_time;
		$to = $_REQUEST['procedure_report_to'].' '.$current_time;
		$ptype_condition='';	

		include("config_db2.php");
				
			
				$cmd = " select a.created_date,a.patient_id,a.procedure_id,a.given_details,a.total_count,a.consultant from  procedure_details as a where a.created_date BETWEEN '$from' AND '$to'";
				//echo $cmd;
				$res = mysql_query($cmd);
				$slno = 1;
				
				
				while($rsS = mysql_fetch_array($res))
				{
					$procedure_date = date('M j Y',strtotime($rsS['created_date']));
					$procedure_detail =  get_procedure_record($rsS['procedure_id']);
					$procedure_name = $procedure_detail['procedure_name'];
					$procedure_no_times = $rsS['given_details'];
					$procedure_amount = $rsS['total_count'];
					$procedure_doneby = ucwords($rsS['consultant']);
					//$medi_type = get_labtype($rsS['lab_id']);
					//echo $rsS['lab_sub_id'];
					//$medi_test = get_labtest($rsS['lab_id'],$rsS['lab_sub_id']);
					//$medi_typetest = ucwords($medi_type).'-'.ucwords($medi_test);
					
					$pdetail = get_patient_record($rsS['patient_id']);
					$pname = ucwords($pdetail['patientsalutation']).' '.ucwords($pdetail['patientname']);
					$pcontact = $pdetail['contactno'];
					
					
					
					$msg .= $procedure_date.'~'.$procedure_name.'~'.$procedure_no_times."~".$procedure_amount.'~'.$pname.'~'.$pcontact.'~'.$procedure_doneby.'@';
				}
				$msg = substr($msg, 0, -1);
				echo $msg;
			
			
		
			mysql_close($db2);
	}
?>
     
