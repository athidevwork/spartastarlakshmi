
<?php 
					include("config_db2.php");
					//$id=$_REQUEST['id'];
					$pat_id=$_REQUEST['pat_id'];
					
					 $cmd = "select sum(fees) as fees from fees_detailsip where patient_id='$pat_id'  and  paid_status!='1' and ip_id =''";
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
					$total_amt+=$rs['fees'];}
						?>

 <table id="dataTables-example" class="table table-striped table-bordered table-hover" width="75%">
										<thead>
										<tr>
										<th>#</th>
										<th>Description</th>
										<th>Fees</th>
										<th>Action</th>
										</tr>
										</thead>
										 <tbody>
                         <?php 
					include("config_db2.php");
					$pat_id=$_REQUEST['pat_id'];
				$cmd = "select * from fees_detailsip where patient_id='$pat_id' and paid_status!='1' AND ip_id='' ";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['description']; ?></td>
						<td><?php echo $rs['fees']; ?></td>
						<td><a href="#" onclick="delete_fee('<?php echo $rs['id'];?>','<?php echo $rs['patient_id'];?>')" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php $total_fees+=$rs['fees'];}
					
				?>
                        </tbody>
                                </table>