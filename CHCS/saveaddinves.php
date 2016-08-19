<?php
//session_start();
date_default_timezone_set('Asia/Kolkata'); 
$normal=$_REQUEST['normal'];
$test=$_REQUEST['test'];
$rate=$_REQUEST['rate'];
//$hed=$_REQUEST['hed'];
$inves=$_REQUEST['inves'];

$inves=strtolower($inves);
//echo $inves;
//$user = $_SESSION['username'];
//$date=date('Y-m-d');
	include("config_db1.php");
	$cmd=mysql_query("CREATE TABLE IF NOT EXISTS $inves (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sym` varchar(200) NOT NULL,
  `rate` varchar(25) NOT NULL,
  `normal` varchar(500) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '1 for active 0 for non active',
  PRIMARY KEY (`id`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=61 ;
");
	$sql = "INSERT INTO $inves (`sym`, `rate`, `normal`) VALUES ('$test','$rate','$normal')";

			//echo $sql;
	
			if(mysql_query($sql))
			{	echo 'Test Created';
			}else
			echo 'Test could not be create. Please try again later';
			
	
			
		//print_r($hed);
		
?>