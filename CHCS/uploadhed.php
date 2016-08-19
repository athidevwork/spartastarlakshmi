<?php
//mysql_query("set global max_allowed_packet=1000000000;");
include("config_db1.php");
if (!empty($_FILES["header"]["name"])) {
			$filename = $_FILES['header']['name'];
			$header =addslashes(file_get_contents($_FILES['header']['tmp_name']));
			$cmd=mysql_query("update print_image set header='$header' where id =1");
		}else
			$header = "";
			
			if (!empty($_FILES["footer"]["name"])) {
			$filename = $_FILES['footer']['name'];
			$footer =addslashes(file_get_contents($_FILES['footer']['tmp_name']));
			$cmd=mysql_query("update print_image set footer='$footer' where id =1");
		}else
			$footer = "";
			


//$cmd=mysql_query("update print_image set header='$header',footer='$footer' where id =1");
//echo mysql_error();
//echo "update print_image set header='$header',footer='$footer' where id =1";
header("Location:master_entry.php");

?>