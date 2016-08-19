<?php
session_start();
$role=$_SESSION['role'];
date_default_timezone_set('Asia/Kolkata'); 
		include("config_db2.php");
		function get_ipno($pat_id)
		{
					 $cmd = "select * from ip_patientadv where patientid='$pat_id' ";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						$ip_no=$rs['ip_no'];
					}
			return $ip_no;
			}
		
		$pat_id=$_REQUEST['pat_id'];
		$ip_no=get_ipno($pat_id);
		?>


<table id="advance_id" class="table table-striped table-bordered table-hover" width="30%">
                        <thead>
                       <tr>
                        <th>#</th>
                        <th>Description</th>
                        <th>Advance Amount</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         <?php 
					 $cmd = "select * from ip_patientadv where patientid='$pat_id' and ip_no='$ip_no' and paid_status!='1' ";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						$id=$rs['id'];
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['description']; ?></td>
						<td><?php echo $rs['advance_amt']; ?></td>
						<td><a href="#" onclick="delete_advance('<?php echo $rs['id'];?>','<?php echo $rs['patientid'];?>','<?php echo $ip_no;?>')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php } ?>

                        </tbody>
                    </table>
