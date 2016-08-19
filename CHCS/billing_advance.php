<?php
session_start();
$role=$_SESSION['role'];
date_default_timezone_set('Asia/Kolkata'); 
		include("config_db2.php");

$patient_id=$_REQUEST['patientid'];
$pat_name=$_REQUEST['pat_name'];
$ip_no=$_REQUEST['ip_no'];


		 function get_admitdate($inv_pat_id)
						 {
							$cmd1 = "select create_date from inv_patient where inv_pat_id='$inv_pat_id'";
							$res1 = mysql_query($cmd1);
							while($rs1 = mysql_fetch_array($res1))
							{
								$create_date = $rs1['create_date'];
							} 
							 return $create_date;
							 }
                        
						 
						 $cmd = "select max(inv_pat_id) as inv_pat_id from inv_patient order by id asc";
							$res = mysql_query($cmd);
							while($rs = mysql_fetch_array($res))
							{
								$inv_pat_id = $rs['inv_pat_id'];
								$admit_date=get_admitdate($inv_pat_id);
							}
                     $cmd=mysql_query("select * from settings where role='$role'");
$print_bill=$sql['print_bill'];

?> 

       <script type="text/javascript">

function add_advance(adv_amt,description,patient_id,patient_name,ip_no)
		{
		$.ajax({
        type: "POST",
		url: "advance_db.php",
		data: "adv_amt="+adv_amt+"&description="+description+"&patient_id="+patient_id+"&patient_name="+patient_name+"&ip_no="+ip_no+"&action=add_advance",
		success: function(msg){
			//alert(msg);
			//jQuery("#advance_sub_list_div").html(msg);
		window.close();	
		}
			});
       }
 
</script>
<style type="text/css">
	.ui-dialog {overflow: visible;}

</style>
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from aqvatarius.com/themes/atlant/html/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2015 09:48:25 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=utf-8" /><!-- /Added by HTTrack -->
<head>        
        <!-- META SECTION -->
        <title>DPP-Billing</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->    
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container" style="background:#33414E;">
            
            <!-- START PAGE SIDEBAR -->
            <!-- END PAGE SIDEBAR -->
            
            <!-- PAGE CONTENT -->
            <div class="page-content" >
                
           <div class="page-content-wrap">
                
                    <div class="row">
                        
                        <div class="col-md-12"> 
						 <div class="panel panel-default">   
						  <div class="panel-body" style="background:#33414E;" >                    
						
                            <!-- START JQUERY VALIDATION PLUGIN -->
                           <?php  date_default_timezone_set('Asia/Kolkata');   ?>
                                    <form id="jvalidate" role="form" class="form-horizontal">
                            
                                    <h5 >&nbsp;&nbsp;&nbsp;</h5>
                                        <div class="form-group">
										 <div class="col-md-4" align="left">
                                     <label class="col-md-6 control-label"  >Advance Amount:</label>  
                                            <div class="col-md-6" >
                                             <input type="text"  class="form-control" name="adv_amt" id="adv_amt" />

                                                <span class="help-block"></span> 
												</div>                                        
												   </div>
											   
                                   
                                                     <div class="col-md-4">
                                            <label class="col-md-3 control-label"  >Description:</label>  
                                            <div class="col-md-9"  >
                                <textarea class="form-control" name="description" id="description" placeholder="Description"  ></textarea>
                                                  <span class="help-block"></span>  
												</div>                                        
												   </div>       
                       
										</div>

                                        <div class="form-group">
                                        										 <div class="col-md-3" align="center">
</div>
										 <div class="col-md-5" align="center">
                                         								<input type="submit" class="btn btn-info btn-block" style="width:100px;" name="submit" id="submit"  onClick="add_advance(adv_amt.value,description.value,'<?php echo $patient_id?>','<?php echo $pat_name;?>','<?php echo $ip_no;?>')" value="Admit"/>

                                    </div>
                                    										 <div class="col-md-5" align="center">
</div>                                               
                                    
                       
                            
                            <!-- END JQUERY VALIDATION PLUGIN -->
                          
				
							
							
						
							</div>
							
							</form>
                            <!-- END JQUERY VALIDATION PLUGIN -->
                            </div>
							</div>
							
							
							
                        </div>
                <!-- END PAGE TITLE -->                
                
                <!-- PAGE CONTENT WRAPPER -->
                </div></div>
                    </div>

                    
                </div>
                <!-- END PAGE CONTENT WRAPPER -->                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
        
        <!-- MESSAGE BOX-->
		<div class="message-box message-box-success animated fadeIn" id="message-box-success">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-check"></span> Success</div>
                    <div class="mb-content">
                        <div id="appendmsg">
						</div>
                    </div>
                    <div class="mb-footer">
                        <a href="billing.php" class="btn btn-default btn-lg pull-right" >Close</a>
                    </div>
                </div>
            </div>
        </div>
		
		<div class="message-box message-box-danger animated fadeIn" id="message-box-error">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-times"></span> Error</div>
                    <div class="mb-content">
                        <div id="appenderror">
						</div>
                    </div>
                    <div class="mb-footer">
                        <button class="btn btn-default btn-lg pull-right mb-control-close">Close</button>
                    </div>
                </div>
            </div>
        </div>
		
		<div class="message-box message-box-info animated fadeIn" id="message-box-info">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-info"></span> Info</div>
                    <div class="mb-content">
					<div id="appendinfo">
						</div>
                       
                    </div>
                    <div class="mb-footer">
						<div class="pull-right">
                        <button class="btn btn-default btn-lg" onClick="removebtn()">Close</button>
						</div>
                    </div>
                </div>
			</div>
		</div>
		
		
        <div class="message-box animated fadeIn" data-sound="alert" id="mb-signout">
            <div class="mb-container">
                <div class="mb-middle">
                    <div class="mb-title"><span class="fa fa-sign-out"></span> Log <strong>Out</strong> ?</div>
                    <div class="mb-content">
                        <p>Are you sure you want to log out?</p>                    
                        <p>Press No if youwant to continue work. Press Yes to logout current user.</p>
                    </div>
                    <div class="mb-footer">
                        <div class="pull-right">
                            <a href="logout.php" class="btn btn-success btn-lg">Yes</a>
                            <button class="btn btn-default btn-lg mb-control-close">No</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END MESSAGE BOX-->

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="audio/alert.mp3" preload="auto"></audio>
        <audio id="audio-fail" src="audio/fail.mp3" preload="auto"></audio>
        <!-- END PRELOADS -->                 
        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="js/plugins/bootstrap/bootstrap.min.js"></script>
        <!-- END PLUGINS -->
        
        <!-- THIS PAGE PLUGINS -->
        <script type='text/javascript' src='js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        
        <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-datepicker.js'></script>        
        <script type='text/javascript' src='js/plugins/bootstrap/bootstrap-select.js'></script>        

        <script type='text/javascript' src='js/plugins/validationengine/languages/jquery.validationEngine-en.js'></script>
        <script type='text/javascript' src='js/plugins/validationengine/jquery.validationEngine.js'></script>        

        <script type='text/javascript' src='js/plugins/jquery-validation/jquery.validate.js'></script>                

        <script type='text/javascript' src='js/plugins/maskedinput/jquery.maskedinput.min.js'></script>
        <!-- END THIS PAGE PLUGINS -->               

        <!-- START TEMPLATE -->
        <script type="text/javascript" src="js/settings.js"></script>
        
        <script type="text/javascript" src="js/plugins.js"></script>
        <script type="text/javascript" src="js/actions.js"></script>
        <!-- END TEMPLATE -->
        
        <script type="text/javascript">
		jQuery('#ward').on('change', function() {
			txt = $('#ward').val();
			if(txt==1)
			return false;
			jQuery.ajax({
				type: "post",
				url: "room_no.php",
				data: {
					ward: txt,
				},
				success: function(value) {
					jQuery("#room").val(value).selectmenu('refresh', true);

				}
			});
		});

		function removebtn() {
	$('#message-box-info').toggle();
	}
		function addreq()
		{
		
		var id= $('#id').val();
		//alert(id);
		$.ajax({
		type: "POST",
		url: "add_req.php",
		data: { 
		id:id,
		},
		success: function(msg) {
		//alert(msg);
		msg=$.trim(msg);
		if(msg !='no')
		$("#dataTables-example > tbody").append(msg);
		
			var i=1;
			var sum=0;
			$( "#dataTables-example tbody tr" ).each( function(){
		 $(this).find("td").eq(0).text(i++);
  			var s=$(this).find("td").eq(2).text();
			// s=parseInt(s);
			// alert(s);
			sum += Number(s);
			//alert(sum);
		});
			//alert(sum);
			$("#total").val(sum);
			cal();
		}
		
	});
		
		
		}
		
		
		
		
		
		
		function save()
		{
		//alert('');
		var pay = $('#pay').val();
		var total = $('#total').val();
		var name = $('#name').val();
		var id= $('#id').val();
		var bal = $('#bal').val();
		var bill= $('#print_bill').val();

		if(pay=="")
		return false;
		if(name=="")
		return false;
		if(id=="")
		return false;
		
	
		table = $("#dataTables-example");
    var asset = [];
    table.find('tbody > tr').each(function (rowIndex, r) {
        var cols = [];
        $(this).find('td').each(function (colIndex, c) {
            cols.push(c.textContent);
        });
        asset.push(cols);
    }); 
	//alert('');
		$.ajax({
		type: "POST",
		url: "save_bill.php",
		data: { assets: asset,
		pay:pay,
		total:total,
		id:id,
		bal:bal,
		},
		success: function(msg) {
		var msg=$.trim(msg);
		var x=msg.split("~");
		//alert(msg);
		
		//alert(bill);
		if(x[0]=='Success')
		{
		if(bill==1) {
		window.open("printbill.php?billnumber="+x[1]);
		}	
		
		$('#message-box-success').modal('toggle');
		$("#appendmsg").empty();
	msg='<p><span class="fa fa-check">Billing  Sucessfully Added</span></p>';
	$("#appendmsg").append(msg);
	
	//$('#message-box-update').toggle();
	}
	
	else
		{
	$("#appenderror").empty();
	msg='<p><span class="fa fa-check">Error Occured During Billing Try again !</span></p>';
	$("#appenderror").append(msg);
	$('#message-box-error').toggle();
	
	}
		
		//window.location.reload();
		//window.location.href=window.location.href;
	}	
		
	});
	}
		
		
		function delItem(x){	
		$("#total").val("");
	var row = x.closest("tr");
	 //row.find("td").eq(4).text("0");
		row.remove();
		 var sum=0;
		 var i=1;
		 $( "#dataTables-example tbody tr" ).each( function(){
		 $(this).find("td").eq(0).text(i++);
  			var s=$(this).find("td").eq(2).text();

			sum += Number(s);
			});
			$("#total").val(sum);
			var bal = $('#old').val();
		var pay = $('#pay').val();
		var total = $('#total').val();
		var amt=Number(total)-Number(pay);
		var due=Number(amt)+Number(bal);
		//alert(due);
		$('#bal').val(due);
			//cal();
			//$("#total").val(sum);
}

		function cal()
		{
		//alert($('#billing').text());
		var tbody = $("#dataTables-example tbody");

		if (tbody.children().length == 0) {
    	//alert('Table Sholud not blank');
		$('#pay').val("");
		return false;
	}
		var bal = $('#old').val();
		var pay = $('#pay').val();
		var total = $('#total').val();
		var amt=Number(total)-Number(pay);
		var due=Number(amt)+Number(bal);
		$('#bal').val(due);
		//alert(due);
		}

		function add()
		{
		$("#total").val("");
		var fees = $('#fees').val();
		var des = $('#des').val();
		//alert('');
		if(des =="")
		{
		$('#message-box-info').toggle();
		$("#appendinfo").empty();
	msg='<p><span class="fa fa-check">Description Should Not Blank !</span></p>';
	$("#appendinfo").append(msg);
			return false;
			}
		if(fees =="")
		{
		$('#message-box-info').toggle();

		$("#appendinfo").empty();
	msg='<p><span class="fa fa-check">Fees should not be blank !</span></p>';
	$("#appendinfo").append(msg);
	return false;
			}
			var txt = "<tr><td></td><td>"+des+"</td><td>"+fees+"</td><td><a href='#' onClick='delItem($(this))' class='btn btn-danger btn-condensed'><span class='fa fa-times'></span></a></td><td style='display:none'>0</td></tr>";
	$("#dataTables-example > tbody").append(txt);
			 $('#fees').val('');
		 $('#des').val('');
		 var sum=0;
		 var i=1;
		 $( "#dataTables-example tbody tr" ).each( function(){
		 $(this).find("td").eq(0).text(i++);
  			var s=$(this).find("td").eq(2).text();
			
			sum += Number(s);
		});
			//alert(sum);
			$("#total").val(sum);
			cal();
		}
		
		
            var jvalidate = $("#jvalidate").validate({
                ignore: [],
                rules: {                                            
                       
                        id: {
                                required: true
                               
                        },
                        
                        name: {
                                required: true,
                                
                        },
                        pay: {
                                required: true,
                              
                        },
                        
                        
                       
                    },			
   			 	
					
    	                                   
                }); 
				
				
				function get()
				{
				//alert('');
				$("#oldtable > tbody").html("");
				$("#dataTables-example > tbody").html("");
				var ser = $('#ser').val();
				ser=$.trim(ser);
				ser=ser.split('-');
				ser=ser[0];
				if(ser =="")
				return false;
			//alert(ser);
			$.ajax({
		type: "POST",
		url: "returnget.php",
		data: {ser:ser},
		success: function(msg) {
		var msg=$.trim(msg);
		//alert(msg);
		if(msg=='~~0+#0') {
		$('#message-box-info').toggle();
		$("#appendinfo").empty();
	msg='<p><span class="fa fa-check">Request Not Found !</span></p>';
	$("#appendinfo").append(msg);
		//alert('');
		$('#name').val('');
		$('#id').val('');
		
		return false;
		}
		else {
		var y=msg.split('+');
		var x=y[0].split('~');
		$('#name').val(x[1]);
		$('#id').val(x[0]);
		$('#old').val(x[2]);
		var z=y[1].split('#');
		var last=z[1];
		
		var v=z[0].split('@');
		var j=0;
		for (i = 0; i <last; i++) 
		{
		var s=j++;
		var x1= v[i].split("~");
		$("#tbl").show();
		var txt = "<tr><td>"+s+"</td><td>"+x1[0]+"</td><td>"+x1[1]+"</td><td>"+x1[2]+"</td></tr>";
	$("#oldtable > tbody").append(txt);
		
		}
		
		
		}
			addreq();	
		}
	});

	}
				
				$(document).ready(function() {
 	$.ajax({
		type: "GET",
		url: "return_detail.php",
		success: function(msg) {

			var availableTags = msg.split("~");
			$( "#ser" ).autocomplete({
			  source: availableTags
			});
		}
	});
	
	$.ajax({
		type: "GET",
		url: "returnsymptom.php",
		success: function(msg) {
			var availableTags = msg.split("~");
			$( "#pid" ).autocomplete({
			  source: availableTags
			});
		}
	});
		});                                   



        </script> 
		
		<script>
	updateOnlineStatus();
	setInterval("updateOnlineStatus()", 5000);
	function updateOnlineStatus() { 
		$.ajax({	
			url: 'update-online-status.php',
			type:'POST',
			success:function(){
			}
		});
	}


 $(document).ready(function(){

   setInterval(function(){ 
  
//
	
	$.ajax({
		type: "POST",
		url: "msgnotifi.php",
		
		success: function(msg) {
		//alert(msg);
		$('#appmsg').empty();
		var msg=$.trim(msg);
		if(msg=="0#")
		return false;
		msg=msg.split('#');
		x=msg[1].split('@');
		$("#notifi").text(msg[0]);
		$("#new").text(msg[0]);
		$("#new1").text(msg[0]);
		$.each( x, function( key,value ) {
		y=value.split('~');
		
		/*var txt='<a href="#" onClick="chatWith(y[0])" class="list-group-item"><div class="list-group-status status-away"></div><img src="return_profile_img.php?name='+y[0]+'" class="pull-left" alt="'+y[0]+'"/> <span class="contacts-title">'+y[0]+' </span><p>'+y[1]+'</p></a>';*/
		var txt='<a href="message.php"  class="list-group-item"><div class="list-group-status status-away"></div><img src="return_profile_img.php?name='+y[0]+'" class="pull-left" alt="'+y[0]+'"/> <span class="contacts-title">'+y[0]+' </span><p>'+y[1]+'</p></a>';
		//alert(txt);
		//chatWith(y[0]);
		//startChatSession();
		//$("#ddd").empty();
		//$('#ddd').load('chat/js/chat.js');
		//$("#ddd").load("chat/js/chat.js");
		$('#appmsg').append(txt);
		});
		}
});

if ($(".chatbox").is(":visible")) {
  startChatSession();
}
	
   
    }, 5000);
});
</script>       
    <!-- END SCRIPTS -->          

    <!-- COUNTERS // NOT INCLUDED IN TEMPLATE -->
        <!-- GOOGLE -->
                
        <!-- END GOOGLE -->
        
        <!-- YANDEX -->
        
             
        <!-- END YANDEX -->
    <!-- END COUNTERS // NOT INCLUDED IN TEMPLATE -->
    </body>

<!-- Mirrored from aqvatarius.com/themes/atlant/html/form-validation.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 02 Jul 2015 09:48:33 GMT -->
</html>






