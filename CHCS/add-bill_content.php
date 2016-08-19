<?php
	session_start();
	$name = $_SESSION['username'];
	
	$pid=$_REQUEST['id'];
	$pay=$_REQUEST['pay'];
	$fees=$_REQUEST['fees'];
	$des = $_REQUEST['des'];
	$bill = $_REQUEST['bill'];		
	
	$des = mysql_escape_string($des);
	$fees = mysql_escape_string($fees);
	$pay = mysql_escape_string($pay);
	$pid = mysql_escape_string($pid);
	//$route = mysql_escape_string($route);
	//$duration = mysql_escape_string($duration);
				
	include("config_db2.php");
	
	
	$sql = "INSERT INTO billing_content ( fees, description, bill_no, created_by, patientid) VALUES ('$fees', '$des', '$bill', '$name', '$pid')";
	mysql_query($sql);
	
	$query5 = "select * from billing_content order by id desc limit 1";
	$res5 = mysql_query($query5);
	$rs5 = mysql_fetch_array($res5);
			
	echo "<tr>
	<td></td>	
		<td>".$rs5['description']."&nbsp;</td>					
		<td >".$rs5['fees']."&nbsp;</td>
		<td><a href='#' class='btn btn-danger btn-rounded btn-condensed btn-sm' onClick='delItem($(this))' width='24' id='deleteimg' alt='".$rs5['id']."' ><span class='fa fa-times'></span></a></td>
		</tr>";
?>