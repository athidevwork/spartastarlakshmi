<?php
include("config_db2.php");
date_default_timezone_set('Asia/Kolkata');
$current_time = date("H:i:s");
$from = $_REQUEST['reg_from'].' '.$current_time;		
$to = $_REQUEST['reg_to'].' '.$current_time;
$cur_date=date('Y-m-d').' '.$current_time;
$msg='';	

		if($_REQUEST['reg_from']!='')
		{
			 $cmd = " select * from patientdetails where time>='$from' and time<='$to' AND ip_id='' order by id desc";
		}
		else
		{
			 $cmd = " select * from patientdetails where time>='$cur_date' and time<='$cur_date' AND ip_id=''  order by id desc";
		}
		//echo $cmd;
			$res = mysql_query($cmd);
			$slno = 1;
			while($rsS = mysql_fetch_array($res))
			{
				
			$msg .= date('d-m-Y',strtotime($rsS['time'])).'~'.ucfirst($rsS['branch']).'~'.$rsS['patientid']."~".ucfirst($rsS['patientsalutation']).' '.ucfirst($rsS['patientname']).'~'.$rsS['age']."~".ucfirst($rsS['address'])."~<center><a href='patient-info.php?pid=".$rsS['patientid']."'><span class='fa fa-eye' ></span></a></center>".'@';
			}
			$msg = substr($msg, 0, -1);
			echo $msg;
		    mysql_close($db2);
?>
     
