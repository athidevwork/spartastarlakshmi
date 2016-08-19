<?php
	$id = $_REQUEST['maxid'];
	include("config_db2.php");

	$query5 = "select * from prescriptiondetail where id =$id";
	$res5 = mysql_query($query5);
	if(mysql_num_rows($res5) != 0){
	
		echo '<div class="table-responsive"><table class="table table-bordered table-striped table-actions" id="tblXPrescription">
			<thead>
			<tr>
				<th>Drug Name</th>
				<th>Dosage</th>
				<th>Specification</th>
				<th>Frequency</th>
				<th>Duration</th>
				<th>Action</th>
			</tr>
			</thead><tbody>	';
		while($rs5 = mysql_fetch_array($res5)){
			echo "<tr>
				<td >".$rs5['drugname']."&nbsp;</td>					
				<td >".$rs5['dosage']."&nbsp;</td>
				<td >".$rs5['specification']."&nbsp;</td>
				<td >".$rs5['frequency']."&nbsp;</td>
				<td >".$rs5['duration']."&nbsp;</td>
				<td ><a href='#' class='btn btn-danger btn-rounded btn-condensed btn-sm' onClick='delItemmed($(this))' width='24' id='deleteimg' alt='".$rs5['slno']."' ><span class='fa fa-times'></span></a></td>
				</tr>";
		}
		echo '</tbody></table></div><br />';
	}
	mysql_close($db2);	
	echo "<script>
	function delItemmed(x) {
		if(confirm('Sure to delete?')){
			var txt = x.attr('alt');
			$.ajax({
				type: 'post',
				url: 'delete-prescription.php?maxid='+txt,
				success: function(msg) {
					if(msg == 'ok')
						x.closest('td').html('Deleted');
					else	
						alert(msg);
				}
			});			
		}
	}
	</script>";
?>