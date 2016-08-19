 <?php
 date_default_timezone_set('Asia/Kolkata');
	include("config_db2.php");
	$ser=$_REQUEST['id'];
	$cmd1 = "select a.category as cat,b.category,a.sym_id,a.sub_cat,a.result,a.id,a.inves_id from investigationsub as a inner join investigationreport as b on a.inves_id=b.id where inves_id='$ser' order by a.sym_id asc";
	//echo $cmd1;
	//$res1 = mysql_query($cmd1);
	if($res1=mysql_query($cmd1)) {
	
	$msg = "";
	mysql_close($db2);
	include("config_db1.php");
	echo "<center>
                <table id='subreport' class='table  table-bordered table-hover'>
				        <thead>
  <tr>
    <td>no</td>
    <td>Name</td>
    <td>Report</td>
    <td>Normal</td>
    <td style ='display:none;'>id</td>

  </tr>
  	 </thead>
	 <tbody >";
  
  $dum="";
  $dum1="";
  $i=1;
	while($rs1 = mysql_fetch_array($res1)){
		$cat=$rs1['cat'];
		$tblcat=$rs1['category'];
		$sym_id=$rs1['sym_id'];
		$subcatid=$rs1['sub_cat'];
		$subid=$rs1['id'];
		$result=$rs1['result'];
	
	$cmd =mysql_query("select title from investigation where id='$tblcat'");
	$rs1=mysql_fetch_array($cmd);
	$tbl=$rs1['title'];
	$sql1=mysql_query("select sym from $tbl where id='$sym_id'");
	$getsym=mysql_fetch_array($sql1);
	
	if($cat==3) {
	$dum=$sym_id;
	//echo $dum.'<br />';
	//echo $dum1.'<br />';
	if($dum != $dum1) {
	echo '<tr style="background-color: #E6BCC9;">
		<td>'.$i++.'</td>
		<td colspan="3">'.$getsym['sym'].'</td>
		<td style ="display:none;">no</td>
		</tr>';
	}
	$cmd2=mysql_query("select sym,testid,normal from sub_test where category='$tblcat' and id='$subcatid'");
	$fd=mysql_fetch_array($cmd2);
	
	echo "<tr>		
					<td></td>
					<td>".$fd['sym']."</td>
					<td contenteditable='true'>".$result."</td>
					
					<td>".$fd['normal']."</td>
					<td style ='display:none;'>".$subid."</td>";
					
	$dum1=$dum;	
			}
			else {
				
			echo "<tr>		
					<td>".$i++."</td>
					<td>".$getsym['sym']."</td>
					<td contenteditable='true'>".$result."</td>
				
					<td>".$getsym['normal']."</td>
					<td style ='display:none;'>".$subid."</td>";
					
					
		}
		//$name=$rs1['patientname'];
	}
	echo " </tbody>
                </table>
				</center>";
}
else {
 echo 'Error';
}
	
	
	
	
	/*$pid=trim($pid," ");
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
echo 'no';*/
?>