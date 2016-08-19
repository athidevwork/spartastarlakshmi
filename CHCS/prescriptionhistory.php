  <?php
  include("config_db2.php");
  $pid = $_REQUEST['pid'];
  	$query4 = "select id,cast(datetime as date)as datetime,prescribed_by from prescriptiondetail where patientid='$pid' group by id order by id desc";
	$res4 = mysql_query($query4);
	if(mysql_num_rows($res4) != 0){
		
		while($rs4 = mysql_fetch_array($res4)){
			$query5 = "select * from prescriptiondetail where patientid='$pid' and id ='".$rs4['id']."'";
			$res5 = mysql_query($query5);
			if(mysql_num_rows($res5) != 0){
				echo '<div class="panel panel-default">
                                
                                <div class="panel-body faq">
                                    

                                    <div class="faq-item">
                                        <div class="faq-title"><span class="fa fa-angle-down"></span>'.$rs4['datetime'].'
										 </div>
										
                                        <div class="faq-text">
										
										<div class="table-responsive">
                                           <table class="table table-bordered table-striped table-actions">
					<thead>
					<tr>
						<th>Drug Name</th>
						<th>Dosage</th>
						<th>Specification</th>
						<th>Frequency</th>
						<th>Duration</th>
					</tr>
					</thead><tbody>	';
				while($rs5 = mysql_fetch_array($res5)){
					$maxid = $rs5['id'];
					echo "<tr>
						<td class='med'>".$rs5['drugname']."&nbsp;</td>					
						<td class='med'>".$rs5['dosage']."&nbsp;</td>
						<td class='med'>".$rs5['specification']."&nbsp;</td>
						<td class='med'>".$rs5['frequency']."&nbsp;</td>
						<td class='med'>".$rs5['duration']."&nbsp;</td>
						</tr>";
				}
				echo '<tr>
						<td colspan="2" style="color:#CC0000">Prescribed by : '.$rs4['prescribed_by'].'</td>
						<td><div style="text-align:center;cursor:pointer;"><!--<a href="#" onClick="medupdate('.$maxid.')" class="btn btn-default btn-rounded btn-condensed btn-sm pull-right"><span class="fa fa-pencil"></span></a>-->
						 &nbsp; <a href="printing.php?pid='.$pid.'&maxid='.$maxid.'" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left" target="_blank"><span class="fa fa-print"></span></a></div></td>						
					</tr>';
				echo '</tbody></table></div></div>
                                    </div>
                                    
                                </div>
                            </div>';
			}
		}
	}
	mysql_close($db2);	
?>