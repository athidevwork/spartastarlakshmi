<?php
session_start();
include("config_db2.php");
	
	date_default_timezone_set('Asia/Kolkata');

	$patient_id = $_REQUEST['patient_id'];
	$ip_no = $_REQUEST['ip_no'];
	if($_REQUEST['action']=="add_advance")
	{
	$adv_amt = $_REQUEST['adv_amt'];
	$description = $_REQUEST['description'];
	$created_date=date("Y-m-d H:i:s");
	$bill_number = abs(date-time(yyyyMMddHHmmss)); 
	$name = $_SESSION['username'];
	$patient_name = $_REQUEST['patient_name'];
	$ip_no = $_REQUEST['ip_no'];
	 $cmd = mysql_query("INSERT INTO ip_patientadv (id,patientid,pat_name,ip_no,advance_amt,description,created_date,active,bill_number,paid_status) VALUES (NULL,'$patient_id','$patient_name','$ip_no','$adv_amt','$description','$created_date',1,'$bill_number','1')");
	 $result = mysql_query("insert into billing (patientid,ip_id,fees,pay,balance,bal_amt,created_by,bill_no,created_at,type,status) values ('$patient_id','$ip_no','0','$adv_amt','0','0','$name','$bill_number','$created_date','advance',0)");
	 if($result){
		 echo "Success~".$bill_number;
		 exit;
		 
	 }else{
		 $cmd = mysql_query("DELETE FROM ip_patientadv WHERE bill_number=$bill_number");
		 echo "Error~".$bill_number;
		 exit;
	 }
	}
	//if($_REQUEST['action']=="del_advance")
	//{
	
	//$id = $_REQUEST['id'];
	//$cmd = mysql_query("DELETE FROM ip_patientadv WHERE id=$id");
	//}
	
	if($_REQUEST['action']=="list"){
						
?>
<table id="advance_id" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                       <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th>Advance Amount</th>
                        
                        </tr>
                        </thead>
                        <tbody>
                         <?php 
					$cmd = "select * from ip_patientadv where patientid='$patient_id' AND ip_no='$ip_no' and paid_status ='1' and active=1 ";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						$id=$rs['id'];
						//$insert_from='CHART OT';
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['description']; ?></td>
						<td><?php echo $rs['advance_amt']; ?></td>
						
                        </tr>
					<?php }
				?>

                        </tbody>
                    </table>
	<?php
		}
	?>