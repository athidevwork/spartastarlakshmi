<?php
include("config_db1.php");
function get_labfee($lab_id_arg,$lab_sub_id_arg){
			include("config_db1.php");
		//Retrieve lab test main title from investigation table
		$inves_query=mysql_query("select title from investigation where id = $lab_id_arg AND status=1 LIMIT 1");
		$inves_query_array=mysql_fetch_array($inves_query);
		$lab_title=strtolower($inves_query_array['title']);
		
		//Lab sub title query to get fee details using title as table from investiogation
		$rate=0;
		if(!empty($lab_sub_id_arg)){
		$lab_query=mysql_query("select rate from $lab_title where id = $lab_sub_id_arg AND status=1 LIMIT 1");
		$lab_query_array=mysql_fetch_array($lab_query);
		$rate=strtolower($lab_query_array['rate']);
		}
		
		return $rate;
	}


$inves_det=$_REQUEST['inves_det'];
$fees_det=$_REQUEST['fees_det'];

$rate = get_labfee($inves_det,$fees_det);
	echo $rate;		mysql_close($db1);
?>