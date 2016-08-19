<?php
	
	$from = $_REQUEST['from'];			$to = $_REQUEST['to'];		
		
include("config_db2.php");		
		
			$cmd = " select GROUP_CONCAT(c.description SEPARATOR ', ')as des, b.patientname,a.patientid,a.bill_no,a.fees,a.pay,a.balance,cast(a.created_at as date) as created_at from  billing as a inner join patientdetails as b on a.patientid=b.patientid inner join  billing_content as c on c.bill_no=a.bill_no where (cast(a.created_at as date) BETWEEN '$from' AND '$to') group by c.bill_no";
			echo $cmd;
			$res = mysql_query($cmd);
			$slno = 1;
			while($rsS = mysql_fetch_array($res))
			{
				//$pid = $rs['patientid'];
				$msg .= $rsS['patientname'].'~'.$rsS['patientid'].'~'.$rsS['des']."~".$rsS['fees'].'~'.$rsS['pay']."~".$rsS['created_at'].'~'.$rsS['bill_no'].'@';
			}
			$msg = substr($msg, 0, -1);
			echo $msg;
		
		
	
		mysql_close($db2);
	
?>
     
