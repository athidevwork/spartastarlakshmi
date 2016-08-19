  <?php
include("config_db2.php");
	$id = $_REQUEST['id'];
	$name = $_REQUEST['name'];
	$ip_id = $_REQUEST['ip_id'];
	$created_date=date("Y-m-d");
	$des = $_REQUEST['des'];
	$fees = $_REQUEST['fees'];
	$pid = get_pat_id($ip_id);
	$pname =get_pat_name($ip_id);
		 $billnumber= date-time(yyyyMMddHHmmss);

	 function get_pat_id($ip_id)
  {
	  		include("config_db2.php");
   $sql2="select * from  inv_patient where inv_pat_id='$ip_id'"; 
  $rs2=mysql_query($sql2);
	while($rsdata2=mysql_fetch_array($rs2))
	  {
	   $patientid=$rsdata2['patientid'];
  		}
  return $patientid;
  }
  
  
   function get_pat_name($ip_id)
  {
	  		include("config_db2.php");
   $sql2="select * from  inv_patient where inv_pat_id='$ip_id'"; 
  $rs2=mysql_query($sql2);
	while($rsdata2=mysql_fetch_array($rs2))
	  {
	   $patientname=$rsdata2['patientname'];
  		}
  return $patientname;
  }
  
  
	if($fees != "")
	{
	 $cmd = "INSERT INTO fees_detailsip (id,patient_id,bill_number,pat_name,ip_id,description,fees,created_date) VALUES (NULL,'$pid','','$pname','$ip_id','$des','$fees','$created_date')";
	}
	$cmds=mysql_query($cmd);
						
?>
<table id="decription_ids" class="table table-striped table-bordered table-hover" width="75%">
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
					$cmd = "select * from fees_detailsip where paid_status!='1' and patient_id='$pid'";
					$i=1;
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
						?>
                        <tr>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo $rs['description']; ?></td>
						<td><?php echo $rs['fees']; ?></td>
						<td><a href="#" onclick="delete_fee('<?php echo $rs['id'];?>','<?php echo $rs['patient_id'];?>');return false;" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php $total_fees+=$rs['fees'];}
				?>
                        </tbody>
                                </table>
                                 