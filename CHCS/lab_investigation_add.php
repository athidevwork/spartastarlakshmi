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
	function generate_labsampleno(){
			include("config_db2.php");
		$sample_id_query=mysql_query("select id from lab_testsample_ip order by id DESC LIMIT 1");
		$sample_id_query=mysql_fetch_array($sample_id_query);
		$sample_id=$sample_id_query['id'];
		$sample_id = 'LAB'.str_pad($sample_id+1, 9, '0', STR_PAD_LEFT);	
		return $sample_id;
	}
	
	$action = $_REQUEST['action'];
	$pat_id = $_REQUEST['pat_id'];
	$current_date = date('Y-m-d H:i:s');
	
	if($action == 'add'){
	$lab_id = $_REQUEST['lab_id'];
	$lab_sub_id = $_REQUEST['lab_sub_id'];
	$reports = $_REQUEST['reports'];
	$note = $_REQUEST['note'];
	$fee = get_labfee($lab_id,$lab_sub_id);
		if($pat_id != "")
		{
			include("config_db2.php");
			 $query = "INSERT INTO lab_details_ip (id,patient_id,lab_id,lab_sub_id,fees,reports,notes,createdby,created_date) VALUES (NULL,'$pat_id','$lab_id','$lab_sub_id','$fee','$reports','$note','','$current_date')";
			mysql_query($query);
		}
	}
	//block execute if action is save to insert and update sample no and requested date only
	if($action == 'save'){
	$test_title = $_REQUEST['test_title'];
	$test_category = $_REQUEST['test_category'];
	$asset = $_REQUEST['asset'];
	$ip_id = $_REQUEST['ip_id'];
	$labsampleno =  generate_labsampleno();
	$bill_queue = 0;	
	
	foreach($asset as $key=>$value){
		
		$lab_ids[]=$value[0];
		
	}
	$lab_ids_string = implode(',',$lab_ids);
	
		if($pat_id != "")
		{
			include("config_db2.php");
			$lab_fee_query = mysql_query("select * from lab_details_ip where patient_id='$pat_id' and paid_status!='1' AND bill_queue != '1' AND id IN ($lab_ids_string)");
			$fee=0;
			if(mysql_num_rows($lab_fee_query)){
				while($lab_fee_array = mysql_fetch_array($lab_fee_query)){
					$fee +=$lab_fee_array['fees'];
				}
				$lab_sampleno_update_query = mysql_query("UPDATE lab_details_ip SET labsampleno='$labsampleno' where patient_id='$pat_id' AND id IN ($lab_ids_string)");
				if(empty($ip_id))
					$bill_queue = 1;
				
				$lab_sample_query = mysql_query("INSERT INTO `lab_testsample_ip` (`id`, `patient_id`, `ip_id`, `bill_number`, `labsampleno`, `sampletesttitle`, `sampletestsubtitle`, `sampleapprover`, `sampleapproverdesign`, `datereq`, `datecollect`, `datereportgen`, `paid_status`, `bill_queue`, `testtotalamt`, `createby`, `createon`, `updatedon`) VALUES (NULL, '$pat_id', '$ip_id', '', '$labsampleno', '$test_title', '$test_category', '', '', CURRENT_TIMESTAMP, NULL, NULL, '', '$bill_queue', '$fee', '$current_date', '', CURRENT_TIMESTAMP)");
			}
			
		}
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
					$query = "select * from lab_details_ip where patient_id='$pat_id' and paid_status!='1' AND bill_queue != '1' AND labsampleno =''";
					$i=1;
					$labtest_list_query = mysql_query($query);
					while($rs = mysql_fetch_array($labtest_list_query)){
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

		