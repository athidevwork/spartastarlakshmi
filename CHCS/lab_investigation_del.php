<?php
	include("config_db2.php");
	function get_labfee($lab_id_arg,$lab_sub_id_arg){
			include("config_db1.php");
		//Retrieve lab test main title from investigation table
		$inves_query=mysql_query("select title from investigation where id = $lab_id_arg AND status=1 LIMIT 1");
		$inves_query_array=mysql_fetch_array($inves_query);
		$lab_title=strtolower($inves_query_array['title']);
		
		//Lab sub title query to get fee details using title as table from investiogation
		$rate=0;
		if(!empty($lab_sub_id_arg)){
		$lab_query=mysql_query("select rate from $lab_title where id = $lab_sub_id_arg AND status=1 LIMIT 1");
		$lab_query_array=mysql_fetch_array($lab_query);
		$rate=strtolower($lab_query_array['rate']);
		}
		
		return $rate;
	}
	function get_labtype($lab_id_arg){
			include("config_db1.php");
		//Retrieve lab test main title from investigation table
		$inves_query=mysql_query("select title from investigation where id = $lab_id_arg AND status=1 LIMIT 1");
		$inves_query_array=mysql_fetch_array($inves_query);
		$lab_title=strtolower($inves_query_array['title']);
		
		return $lab_title;
	}
	function get_labtest($lab_id_arg,$lab_sub_id_arg){
			include("config_db1.php");
		//Retrieve lab test main title from investigation table
		$inves_query=mysql_query("select title from investigation where id = $lab_id_arg AND status=1 LIMIT 1");
		$inves_query_array=mysql_fetch_array($inves_query);
		$lab_title=strtolower($inves_query_array['title']);
		
		//Lab sub title query to get fee details using title as table from investiogation
		$sym='';
		if(!empty($lab_sub_id_arg)){
		$lab_query=mysql_query("select sym from $lab_title where id = $lab_sub_id_arg AND status=1 LIMIT 1");
		$lab_query_array=mysql_fetch_array($lab_query);
		$sym=strtolower($lab_query_array['sym']);
		}
		return $sym;
	}	
	$patient_id = $_REQUEST['pat_id'];
	
	$lab_id = $_REQUEST['row_id'];
	
	
	if($patient_id != "")
	{
		include("config_db2.php");
		 $cmd1 = "DELETE FROM lab_details_ip WHERE id='$lab_id'";
		$cmds1=mysql_query($cmd1);
    }
	
	
?>


					<table id="investable" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                        <th>No</th>
                        <th>Type </th>
                        <th>Test</th>
                        <th>Reports</th>
                        <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                         <?php 
						 
						include("config_db2.php");
						
	 $query = "select * from lab_details_ip where patient_id='$patient_id' and paid_status!='1' AND bill_queue != '1' AND labsampleno =''";
					$i=1;
					$res = mysql_query($query);
					while($rs = mysql_fetch_array($res)){
						?>
                        <tr>
						<td style="display:none"><?php echo $rs['id'] ?> </td>
                        <td><?php echo $i++; ?> </td>
						<td><?php echo get_labtype($rs['lab_id']); ?></td>
						<td><?php echo get_labtest($rs['lab_id'],$rs['lab_sub_id']); ?></td>
						<td><?php echo $rs['reports']; ?></td>
						<td><a href="#" onclick="delete_lab_inves_details('<?php echo $rs['id'];?>','<?php echo $rs['patient_id'];?>');return false;" class="btn btn-danger btn-condensed"><span class="fa fa-times"></span></a></td>
                        </tr>
					<?php }
				?>

                        </tbody>
                    </table>

		