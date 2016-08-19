 <?php
 date_default_timezone_set('Asia/Kolkata');
	include("config_db2.php");
	$ser=$_REQUEST['ser'];
	$cmd1 = "select patientid,patientname from patientdetails where patientid='$ser' or contactno='$ser' or patientname='$ser'";
	$res1 = mysql_query($cmd1);
	
	$msg = "";
	while($rs1 = mysql_fetch_array($res1)){
	$pid=$rs1['patientid'];
	$name=$rs1['patientname'];
		
	}
	$pid=trim($pid," ");
	//echo $pid;
	//$cmd=mysql_query("SELECT a.test,a.complaint,a.notes,a.id,b.bill_no,a.category,a.test FROM investigationreport as a inner join billing_content as b on b.patientid='$pid' where a.patientid='$pid' and a.complaint ='pending' and sendlab=1");
	
	$cmd=mysql_query("SELECT a.test,a.complaint,a.notes,a.id,a.bill_no,a.category,a.test,a.sub FROM investigationreport as a  where a.patientid='$pid' and a.complaint ='pending' and a.sendlab=1 and a.bill_no !=''");
	
	if(mysql_num_rows($cmd) !=0)
	{
while($rs = mysql_fetch_array($cmd)){
	//$paid=$rs1['paid'];
		//$tot=$rs1['tot'];
		$test=$rs['test'];
	$cat=$rs['category'];
	include("config_db1.php");
	$cmd =mysql_query("select title from investigation where id='$cat'");
	//echo "select title from investigation where id='$cat'";
	$rs1=mysql_fetch_array($cmd);
	$tbl=$rs1['title'];
	$sql1=mysql_query("select normal,sym from $tbl where id='$test'");
	//echo "select normal from $tbl where sym='$test'";
	$rs2=mysql_fetch_array($sql1); 
	mysql_close($db1);
		$row.=$rs2['sym'].'~'.$rs['complaint'].'~'.$rs['notes'].'~'.$rs['bill_no'].'~'.$rs['id'].'~'.$rs2['normal'].'~'.$rs['test'].'~'.$rs['sub'].'~'.$rs['id'].'@';
		//echo" 
	//<tr><td></td><td>".$rs1['test']."</td><td>".$rs1['complaint']."</td><td>".$rs1['notes']."</td><td>".$rs1['bill_no']."</td><td>".$rs1['id']."</td></tr>";
	
}//echo $paid;
$num=mysql_num_rows($cmd);
$row = substr($row, 0, -1);
$msg .= $pid.'~'.$name.'+'.$row.'#'.$num;;
echo $msg;
}else
echo 'no';
?>