
<?php

		include("config_db2.php");
		if(isset($_REQUEST['x']))
		$x=$_REQUEST['x'];
		else
		$x=0;
		$pid = $_REQUEST['ser'];
		$pid=trim($pid);
		
function get_ip_id($pid,$name)
{
	$Isql=mysql_query("select * from inv_patient where patientid='$pid' and patientname='$name' and pat_ip_status='0'");
	$rscount=mysql_num_rows($Isql);
	return $rscount;
} 

		$cmd = "select branch, patientid, patientsalutation, patientname, guardiansalutation, guardianname, age, gender, contactno, occupation, address, cast(time as date) as time from patientdetails where patientname like '%$pid%' or patientid like '$pid' or contactno like '%$pid%' order by patientname asc";
		//echo $cmd;
		$res = mysql_query($cmd);
		if(mysql_num_rows($res) !=0) {
		while($rs = mysql_fetch_array($res))
		{
			$pid = $rs['patientid'];
			$name=$rs['patientname'];
			$check_item=get_ip_id($pid,$name);
			echo "<tr>
					<td>".$rs['branch']."</td>
					<td>".$rs['patientid']."</td>
					<td>".$rs['patientsalutation']." ".$rs['patientname']."</td>
					<td>".$rs['guardiansalutation']." ".$rs['guardianname']."</td>
					<td>".$rs['age']."</td>
					<td>".$rs['gender']."</td>
					<td>".$rs['contactno']."</td>
					<td>".$rs['occupation']."</td>
					<td>".$rs['address']."</td>
					<td>".$rs['time']."</td>";
					if($x==1)
					echo "<td><center><a href='#' alt='$pid~$name' onClick='addapp($(this));'><span class='fa fa-eye' ></span></a></center></td>";
					else
					echo "<td><center><a href='patient-info.php?pid=$pid'><span class='fa fa-eye' ></span></a></center></td>" ?>
					<td><?php if($check_item==0)  { ?><a href="#" onClick="javascript:window.open('admit_form.php?mrd_no=<?php echo $rs['patientid'];?>&patientname=<?php echo $rs['patientname'];?>','new_popup','height=600,width=1000,scrollbars=no,resizable=no,left=50,top=50,toolbar=no,location=no,directories=no,status=no');return false;" class="btn btn-primary pull-left"><span class="fa fa-floppy-o fa-right"></span>ADMIT</a><?php } else { ?><a href="complaints.php?pid=<?php echo $rs['patientid']; ?>" class="btn btn-primary pull-left"><span class="fa fa-floppy-o fa-right"></span>ADMITTED</a><?php } ?></td>
					<?php "<td>".$rs['time']."</td>
				</tr>";
				
		} } else { echo 'No Patient record found. Try with different keyword.'; }
		mysql_close($db2);
	
?>