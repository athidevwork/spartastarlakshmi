<?php
function get_labtype($lab_id_arg){
			include("config_db1.php");
		//Retrieve lab test main title from investigation table
		$inves_query=mysql_query("select title from investigation where id = $lab_id_arg AND status=1 LIMIT 1");
		$inves_query_array=mysql_fetch_array($inves_query);
		$lab_title=strtolower($inves_query_array['title']);
		
		return $lab_title;
	}
include("config_db1.php");
$inves=get_labtype($_REQUEST['inves']);
$cmd1 = "select id,sym from $inves WHERE status =1 order by sym desc";
$res1 = mysql_query($cmd1);
if(mysql_num_rows($res1)){
	while($rs1 = mysql_fetch_array($res1)){
	$num .=$rs1['sym'].'+'.$rs1['id'].'~';
	}
}
$num = substr($num,0,-1);
	echo $num;		
	mysql_close($db1);
	
	
?>