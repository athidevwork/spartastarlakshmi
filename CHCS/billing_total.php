

<?php 
					include("config_db2.php");
					$id=$_REQUEST['id'];
					$total_amt2=0;
					$cmd = "select sum(fees) as fees from fees_detailsip where patient_id='$id' and paid_status!='1' and ip_id=''";
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
					$total_amt+=$rs['fees'];}
					
					$cmd1 = "select sum(testtotalamt) as feesnew from lab_testsample_ip where patient_id='$id' AND ip_id='' AND paid_status!='1' AND bill_queue='1'";
					$res1 = mysql_query($cmd1);
					while($rs1 = mysql_fetch_array($res1)){
					$total_amt1+=$rs1['feesnew'];}
					
					$cmd = "select sum(total_count) as total_count from services_details where patient_id='$id' and paid_status!='1' AND bill_queue='1'";
					$res = mysql_query($cmd);
					while($rs = mysql_fetch_array($res)){
					$total_amt2+=$rs['total_count'];}
					$totz=$total_amt+$total_amt1+$total_amt2;
					//echo "select sum(a.fees)as tot ,sum(a.pay) as paid from billing as a where a.patientid='$id' AND ip_id='' AND balance='1'";
					$cmd=mysql_query("select bal_amt from billing as a where a.patientid='$id' AND ip_id='' AND balance='1' order by id DESC limit 1");
					while($rs1 = mysql_fetch_array($cmd)){
						$old_bal=$rs1['bal_amt'];
					}
					$old_bal = $old_bal;
					$totz = $totz + $old_bal
						?>
										 <div class="col-md-4">
                                            <label class="col-md-3 control-label">Total:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value="<?php echo $totz; ?>" style=" font-weight:bold" readonly  name="total" id="total"/>
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
												   </div> 
												   <div class="col-md-4">
                                            <label class="col-md-3 control-label">Pay:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"  onBlur="cal()" name="pay" id="pay" value="<?php echo $totz; ?>" />
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
												   </div> 