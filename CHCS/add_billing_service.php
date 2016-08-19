  <?php
include("config_db2.php");


	$id = $_REQUEST['service'];
	$patient_name = $_REQUEST['patient_name'];
	$patient_id = $_REQUEST['pat_id'];
	$mrd_no = $_REQUEST['mrd_no'];
	$ref_no = $_REQUEST['ref_no'];
	function get_name_service($id)
	{
		include("config_db1.php");
					$cmd11 = "select * from service_creation where id='$id'";
					$res11 = mysql_query($cmd11);
					while($rs11 = mysql_fetch_array($res11))
					{
						$service_name=$rs11['service_name'];
					}
	return $service_name;
	}
	
	function get_hours_amt($id)
	{
		include("config_db1.php");
					$cmd11 = "select * from service_creation where id='$id'";
					$res11 = mysql_query($cmd11);
					while($rs11 = mysql_fetch_array($res11))
					{
						$amount_hrs=$rs11['amount'];
					}
	return $amount_hrs;
	}
	
	function get_name_types($id)
	{
		include("config_db1.php");
					$cmd11 = "select * from service_creation where id='$id'";
					$res11 = mysql_query($cmd11);
					while($rs11 = mysql_fetch_array($res11))
					{
						$types=$rs11['types'];
					}
	return $types;
	}
	function get_amountss($id)
	{
		include("config_db2.php");
					$cmd11 = "select * from services_details where service_id='$id'";
					$res11 = mysql_query($cmd11);
					while($rs11 = mysql_fetch_array($res11))
					{
						$given_details=$rs11['given_details'];
					}
	return $given_details;
	}
		$service_name=get_name_service($id);
		$types=get_name_types($id);
		$service_no=$_REQUEST['service_no'];
	    $created_date=date("Y-m-d");
	   $count=get_amountss($id);
	  $get_amt_hrs= get_hours_amt($id);
	   $total=$get_amt_hrs*$service_no;
	
	
     include("config_db2.php");

    	$cmd = "INSERT INTO services_details (id,insert_from,service_id,service_name,duration,count,given_details,total_count,created_date,patient_id,ip_no,bill_queue) VALUES (NULL,'BILLING','$id','$service_name','$types','$get_amt_hrs','$service_no','$total','$created_date','$patient_id','$mrd_no','1')";
		$cmds=mysql_query($cmd);
?>


                        <table id="services_ids" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                        <tr>
                        <th>#</th>
                        <th>Services</th>
                        <th>Count</th>
						<th>Amount <br>per Count</th>
                        <th>Amount</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         <?php 
				$cmd = "select * from services_details where patient_id='$patient_id' and paid_status!='1' AND bill_queue='1'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						$insert_from='BILLING';
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['service_name']."/".$rs['duration']; ?></td>
						<td><?php echo $rs['given_details']; ?></td>
						<td><?php echo $rs['count']; ?></td>
						<td><?php echo $rs['total_count']; ?></td>
						<td><a href="#" onclick="delete_servicess('<?php echo $rs['id'];?>','<?php echo $insert_from;?>','<?php echo $ref_no;?>');return false;" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php }
				?>
                        </tbody>
                        </table>
