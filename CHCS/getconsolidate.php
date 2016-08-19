<?php
session_start();
$role=$_SESSION['role'];
date_default_timezone_set('Asia/Kolkata');
$data=$_REQUEST['txt'];
include("config_db2.php");
if($data==1) {
$range="cast(a.created_at  as date)='".date("Y-m-d")."'";
$range1="cast(b.datetime  as date)='".date("Y-m-d")."'";
$range2="cast(date  as date)='".date("Y-m-d")."'";
$range3="cast(datetime as date)='".date("Y-m-d")."'";
//echo $range;
}
else if($data==2) {
//$date=date('d-m-Y', strtotime("+2 days"));
$range="cast(a.created_at  as date)='".date('Y-m-d', strtotime("-1 days"))."'";
$range1="cast(b.datetime  as date)='".date('Y-m-d', strtotime("-1 days"))."'";
$range2="cast(date  as date)='".date('Y-m-d', strtotime("-1 days"))."'";
$range3="cast(datetime  as date)='".date('Y-m-d', strtotime("-1 days"))."'";
//echo $range;
}
else if($data==3) {
//$date=date('d-m-Y', strtotime("+2 days"));
$range="(cast(a.created_at  as date) between '".date('Y-m-d', strtotime("-6 days"))."' and '".date("Y-m-d")."')";
$range1="(cast(b.datetime  as date) between '".date('Y-m-d', strtotime("-6 days"))."' and '".date("Y-m-d")."')";
$range2="(cast(date  as date) between '".date('Y-m-d', strtotime("-6 days"))."' and '".date("Y-m-d")."')";
$range3="(cast(datetime  as date) between '".date('Y-m-d', strtotime("-6 days"))."' and '".date("Y-m-d")."')";
//echo $range;
}
else if($data==4) {
//$date=date('d-m-Y', strtotime("+2 days"));
$range="(cast(a.created_at  as date) between '".date('Y-m-d', strtotime("-30 days"))."' and '".date("Y-m-d")."')";
$range1="(cast(b.datetime  as date) between '".date('Y-m-d', strtotime("-30 days"))."' and '".date("Y-m-d")."')";
$range2="(cast(date  as date) between '".date('Y-m-d', strtotime("-30 days"))."' and '".date("Y-m-d")."')";
$range3="(cast(datetime  as date) between '".date('Y-m-d', strtotime("-30 days"))."' and '".date("Y-m-d")."')";
//echo $range;
}
else if($data==5) {
//$date=date('d-m-Y', strtotime("+2 days"));
$range="DATE_FORMAT(CAST(a.created_at as DATE), '%m-%Y')= DATE_FORMAT(CURDATE(),'%m-%Y')";
$range1="DATE_FORMAT(CAST(b.datetime as DATE), '%m-%Y')= DATE_FORMAT(CURDATE(),'%m-%Y')";
$range2="DATE_FORMAT(CAST(date as DATE), '%m-%Y')= DATE_FORMAT(CURDATE(),'%m-%Y')";
$range3="DATE_FORMAT(CAST(datetime as DATE), '%m-%Y')= DATE_FORMAT(CURDATE(),'%m-%Y')";
//echo $range;
}
else {
//$date=date('d-m-Y', strtotime("+2 days"));
$range="DATE_FORMAT(CAST(a.created_at as DATE), '%Y-%m')= DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m')";
$range1="DATE_FORMAT(CAST(b.datetime as DATE), '%Y-%m')= DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m')";
$range2="DATE_FORMAT(CAST(date as DATE), '%Y-%m')= DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m')";
$range3="DATE_FORMAT(CAST(datetime as DATE), '%Y-%m')= DATE_FORMAT(NOW() - INTERVAL 1 MONTH, '%Y-%m')";
//echo $range;
}


if($role==4) {
	$name=$_SESSION['username'];
	//echo $role;
	$fee1 = mysql_query("SELECT sum(a.`fees`)as tot,sum(a.`pay`) as pay ,concat(round(( sum(a.`pay`)/sum(a.`fees`)* 100 ),2)) AS percentage,SUM(a.`fees`-a.`pay`) AS due,concat(round(( SUM(a.`fees`-a.`pay`)/sum(a.`fees`)* 100 ),2)) AS duepercentage  FROM billing as a inner join complaints as b on a.patientid=b.patientid WHERE $range and $range1 and b.prescribed_by='$name'");
	}
	else  {
	$fee1 =mysql_query("SELECT sum(a.`fees`)as tot,sum(a.`pay`) as pay ,concat(round(( sum(a.`pay`)/sum(a.`fees`)* 100 ),2)) AS percentage,SUM(a.`fees`-a.`pay`) AS due,concat(round(( SUM(a.`fees`-a.`pay`)/sum(a.`fees`)* 100 ),2)) AS duepercentage  FROM billing as a WHERE $range");
	}
	
	$refee=mysql_fetch_array($fee1);
	$totalfees=$refee['tot'];
	$totalpay=$refee['pay'];
	$feespercentage=$refee['percentage'];
	$duepercentage=$refee['duepercentage'];
	$totaldue=$refee['due'];
	//echo $feespercentage;
	if($totalfees=='NULL' || $totalfees=="")
	$totalfees=0;
	if($totalpay=='NULL' || $totalpay=="")
	$totalpay=0;
	if($feespercentage=='NULL' || $feespercentage=="")
	$feespercentage=0;
	if($totaldue=='NULL' || $totaldue=="")
	$totaldue=0;
	if($duepercentage=='NULL' || $duepercentage=="")
	$duepercentage=0;
	
	if($_SESSION['role']==4) 
				$sql=mysql_query("select * from appointments where $range2 and status=1 and doctor='".$_SESSION['username']."'");
				else
					$sql=mysql_query("select * from appointments where $range2 and status=1");
					//echo "select * from appointments where date='".date("Y-m-d")."' and status=1";
					$sql1=mysql_query("select id from appointments where $range2");
					//echo $sql;
					$num=mysql_num_rows($sql);
					$tot=mysql_num_rows($sql1);
					if($num == 0 || $tot == 0)
						$s = 0;
					else
						$s=($num/$tot)*100;
					//include("config_db2.php");
//										$cmd=mysql_query("select sum(fees) as fees,sum(pay) as pay from billing where cast(a.created_at as date)='".date("Y-m-d")."'");						$row=mysql_fetch_array($cmd);
//										$row['fees']
				if($_SESSION['role']==4) {
				$ss = mysql_query("SELECT distinct patientid FROM complaints WHERE $range3 and prescribed_by='".$_SESSION['username']."'"); }
				else
				$ss = mysql_query("SELECT distinct patientid FROM complaints WHERE $range3");
				
				//echo "SELECT distinct patientid FROM complaints WHERE $range3";
				$seen = mysql_num_rows($ss);
	
	mysql_close($db2);
	echo $totalfees.'~'.$totalpay.'~'.$feespercentage.'~'.$duepercentage.'~'.$totaldue.'~'.$s.'~'.$seen.'~'.$num.'~'.$tot;