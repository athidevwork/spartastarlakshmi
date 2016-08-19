<?php
//session_start();
date_default_timezone_set('Asia/Kolkata'); 
$assets=$_REQUEST['assets'];
$lab=$_REQUEST['lab'];
//$hed=$_REQUEST['hed'];
$inves=$_REQUEST['inves'];

$inves=strtolower($inves);
//echo $inves;
//$user = $_SESSION['username'];
//$date=date('Y-m-d');
include("config_db1.php");
if($inves !='select')
{
foreach($assets as $assets => $key){
$key[2]=trim($key[2], "\t\n\r\0\x0B\xc2\xa0\Â");
$key[3]=trim($key[3], "\t\n\r\0\x0B\xc2\xa0\Â");
$key[1]=trim($key[1], "\t\n\r\0\x0B\xc2\xa0\Â");

	$sql ="update $inves set sym='$key[1]',rate='$key[2]',normal='$key[3]' where id='$key[4]';";
	$query = mysql_query($sql); 
	}
	
	}
			//echo $sql;
	//$sql = "update settings set lab='$lab'";
	
			if($query)
				echo 'Lab Details Updated';
			else
				echo 'Lab Details Could not be Updated. Please try again later.';
			
	
			
		//print_r($hed);
		
?>