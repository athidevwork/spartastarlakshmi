 <?php
 date_default_timezone_set('Asia/Kolkata');
	include("config_db2.php");
	$bill=$_REQUEST['bill'];
	
	$cmd=mysql_query("select * from billing as a where a.bill_no='$bill' and a.status=1");
	$rs1 = mysql_fetch_array($cmd);
	$paid=$rs1['pay'];
	$tot=$rs1['fees'];
	$pid=$rs1['patientid'];
	
	$cmd1 = "select patientid,patientname from patientdetails where patientid='$pid'";
	$res1 = mysql_query($cmd1);
	
	$msg = "";
	$rs1 = mysql_fetch_array($res1);
	$name=$rs1['patientname'];
		
	
	
//echo $paid;
//$row="";

	
	echo '<div class="col-md-12">  
	  <form id="jvalidate" role="form" class="form-horizontal">
                                    <div class="panel-body"> 
									<div class="col-md-12">
									
									<div class="form-group">
										 <div class="col-md-4">
                                            <label class="col-md-3 control-label">Patient ID:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value='.$pid.' name="pid" id="pid"/>
                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
												   
												   <div class="form-group">
										 <div class="col-md-4">
                                            <label class="col-md-3 control-label">Patient Name:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value='.$name.'/>
                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
												   
												   <div class="form-group">
										 <div class="col-md-4">
                                            <label class="col-md-3 control-label">Bill Number:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" value='.$bill.' name="bill" id="bill"/>
                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
									</div>                                   
                                        	   
										<div class="form-group">
										 <div class="col-md-4">
                                            <label class="col-md-3 control-label">Description:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control" name="des" id="des"/>
                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
											   
                                   
                                                     <div class="col-md-4">
                                            <label class="col-md-3 control-label">Fees:</label>  
                                            <div class="col-md-9">
                                                <input type="text" class="form-control"  name="fees" id="fees"/>
                                                <span class="help-block"></span> 
												</div>                                        
												   </div>  
												   <div class="col-md-1">
                                           <a href="#"  onClick="addnewitem();" class="btn btn-default btn-rounded btn-condensed btn-sm pull-left"><span class="fa fa-plus"></span></a>                                   
												   </div>     
                       
										</div>
										<div class="col-md-12">
										
										<center>
										<table id="dataTables-example" class="table table-striped table-bordered table-hover">
										<thead>
										<tr>
										<th>No</th>
										<th>Description&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										<th>Fees&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
										<th>Action</th>
										</tr>
										</thead>
										<tbody id="billing" name="billing">';
										$cmd=mysql_query("select * from billing_content where bill_no='$bill'");
										$i=1;
											while($rs1 = mysql_fetch_array($cmd)){
											echo '<tr>
											<td>'.$i++.'</td>
											<td>'.$rs1['description'].'</td>
											<td>'.$rs1['fees'].'</td>
											<td><a href="#" class="btn btn-danger btn-rounded btn-condensed btn-sm" onClick="delItem($(this))" width="24" id="deleteimg" alt="'.$rs1['id'].'" ><span class="fa fa-times"></span></a></td>
											</tr>';
									}
										
										 echo ' </tbody>
                                </table></center>
										</div>
										<div id="tbl" style="display:none">
										<div class="col-md-8">
										
										
										</div>
										</div>
										 <div class="col-md-4 btn-group pull-right">
                                            <label class="col-md-3 control-label">Total:</label>  
                                            <div class="col-md-9">
                                        <input type="text" class="form-control" value="'.$tot.'" readonly="readonly"  name="total" id="total"/>
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
												   </div>  
												    
												    <div class="col-md-4 btn-group pull-right">
                                            <label class="col-md-3 control-label">Pay:</label>  
                                            <div class="col-md-9">
                                           <input type="text" class="form-control" value="'.$paid.'"  onBlur="cal()" name="pay" id="pay"/>
                                                <span class="help-block">&nbsp;&nbsp;</span> 
												</div>                                        
												   </div>  
												   
												   
												                                                                                
                                        <div class="btn-group pull-right">
                                           
                                        </div>                                                                                                                          
                                    </div>                                               
                                    </form>
									 </div>';
                                          
										
										  echo "<script>
	function delItem(x) {
		if(confirm('Sure to delete?')){
			var txt = x.attr('alt');
			$.ajax({
				type: 'post',
				url: 'delete-bill_content.php?id='+txt,
				success: function(msg) {
					if(msg == 'ok')
						x.closest('td').html('Deleted');
					else	
						alert(msg);
				}
			});			
		}
	}
	
	
	function addnewitem()
		{
		$('#total').val('');
		var fees = $('#fees').val();
		var des = $('#des').val();
		var bill = $('#bill').val();
		var id = $('#pid').val();
		//alert('');
		if(des =='')
		{
		alert('description should not be blank');
			return false;
			}
		if(fees =='')
		{
	alert('Fees should not be blank');
	return false;
			}
			
			$.ajax({
				type: 'post',
				url: 'add-bill_content.php',
				data:{fees:fees,des:des,bill:bill,id:id,},
				success: function(msg) {
				$('#dataTables-example > tbody').append(msg);
					
				}
			});			
			
	
			 $('#fees').val('');
		 $('#des').val('');
		 var sum=0;
		 var i=1;
		 $( '#dataTables-example tbody tr' ).each( function(){
		 $(this).find('td').eq(0).text(i++);
  			var s=$(this).find('td').eq(2).text();
			
			sum += Number(s);
		});
			
			$('#total').val(sum);
			
		}
	</script> ";
     
	
?>