<?php
include("config_db2.php");
	date_default_timezone_set('Asia/Kolkata');
	function get_ipid($univ_num)
   {
		include("config_db2.php");
		$lab_id = strtolower($lab_id);
		
	$ex=mysql_query("select inv_pat_id from inv_patient where patientid = '$univ_num' AND pat_ip_status=0");
	$ex1=mysql_fetch_array($ex);
	$inv_pat_id=$ex1['inv_pat_id'];
	return $inv_pat_id;
	}
	$pid = $_REQUEST['pid'];
	$pat_ip_id = get_ipid($_REQUEST['pid']);
	
	$action = $_REQUEST['action'];
	
	include("config_db2.php");
	$cmds=mysql_query($cmd);
						
?>

<h3>Room Details</h3>

					<table id="room_decription_ids" class="table table-striped table-bordered table-hover" width="75%">
										<thead>
										<tr>
										<th>#</th>
										<th>Room No</th>
										<th>IN Time</th>
										<th>Out Time</th>
										<th>Fees</th>
										</tr>
										</thead>
										 <tbody>
                       
                        <?php 
					include("config_db2.php");
					
					 $cmd = "select * from room_bill_details where ip_no='$pat_ip_id' and paid_status!='1' AND vacate ='yes'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						$rm_id = $rs['room_id'];
						include("config_db1.php");
						$cmd_get_rm_no = mysql_query("select room from room_no where id ='$rm_id'");
						$cmd_get_rm_no_array = mysql_fetch_array($cmd_get_rm_no);
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $cmd_get_rm_no_array['room']; ?></td>
						<td><?php echo $rs['from_time']; ?></td>
						<td><?php echo $rs['to_time']; ?></td>
                        <td><?php echo $rs['fees_amount']; ?></td>
                        </tr>
					<?php }
				?>

                        </tbody>
                    </table>