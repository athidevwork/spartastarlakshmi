<?php
	date_default_timezone_set('Asia/Kolkata');
	$current_time = date("H:i:s");
	$from = $_REQUEST['from'].' '.$current_time;
	$to = $_REQUEST['to'].' '.$current_time;
		
include("config_db2.php");		
		
			$cmd = " select a.id,a.type,b.patientname,a.patientid,a.bill_no,a.fees,a.pay,a.balance,cast(a.created_at as date) as created_at from  billing as a inner join patientdetails as b on a.patientid=b.patientid where (cast(a.created_at as date) BETWEEN '$from' AND '$to') group by a.bill_no order by a.id DESC";
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
				$msg .= $rsS['patientname'].'~'.$rsS['patientid'].'~'.$rsS['type']."~".$rsS['fees'].'~'.$rsS['pay']."~".$rsS['created_at'].'~'.$report_view.'@';
			}
			$msg = substr($msg, 0, -1);
			echo $msg;
		
		
	
		mysql_close($db2);
	
?>
     
