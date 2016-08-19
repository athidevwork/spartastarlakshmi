<?php
include("config_db2.php");
date_default_timezone_set('Asia/Kolkata');
$current_time = date("H:i:s");
$from = $_REQUEST['from'].' '.$current_time;		
$to = $_REQUEST['to'].' '.$current_time;
$cur_date=date('Y-m-d').' '.$current_time;
$msg='';	
		if($_REQUEST['from']!='')
		{
			 $cmd = " select * from inv_patient where create_date>='$from' and create_date<='$to' AND pat_ip_status='0' order by id desc";
		}
		else
		{
			 $cmd = " select * from inv_patient where create_date>='$cur_date' and create_date<='$cur_date' AND pat_ip_status='0'  order by id desc";
		}
		//echo $cmd;
			$res = mysql_query($cmd);
			$slno = 1;
			while($rsS = mysql_fetch_array($res))
			{
			$msg .= date('d-m-Y',strtotime($rsS['create_date'])).'~'.$rsS['inv_pat_id'].'~'.ucfirst($rsS['branch']).'~'.$rsS['patientid']."~".ucfirst($rsS['patientname']).'~'.$rsS['age']."~".ucfirst($rsS['address'])."~<center><a href='patient-info.php?pid=".$rsS['patientid']."'><span class='fa fa-eye' ></span></a></center>".'@';
			}
			$msg = substr($msg, 0, -1);
			echo $msg;
		    mysql_close($db2);
?>
     
