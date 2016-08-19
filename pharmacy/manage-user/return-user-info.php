<?php
	$id = $_REQUEST['id'];
	include("../config.php");
	$sql = "SELECT * FROM tbl_users WHERE id = ".$id;
	$res = mysql_query($sql);
	$rs = mysql_fetch_array($res);
	$role = $rs['role'];
	$status = $rs['status'];
	$roletype = ($role == 1) ? "Admin" : "User";
	$statustype = ($status == 1) ? "<span class='label label-sm label-success arrowed-in arrowed-in-right'>Active</span>" : "<span class='label label-sm label-arrowed arrowed-in arrowed-in-right'>Expired</span>";
	echo $rs['username'] . '~' . $rs['userid'] . '~' . $roletype . '~' . $statustype . '~' . $rs['id'];
	
	if($rs['mp']) echo '~<span class="label label-info arrowed-right arrowed-in">Manage Product</span>';
	else echo '~<span class="label arrowed">Manage Users</span>';
		
	if($rs['mm']) echo '~<span class="label label-info arrowed-right arrowed-in">Manage Manufacturer</span>';
	else echo '~<span class="label arrowed">Manage Manufacturer</span>';
		
	if($rs['ms']) echo '~<span class="label label-info arrowed-right arrowed-in">Manage Supplier</span>';
	else echo '~<span class="label arrowed">Manage Supplier</span>';
		
	if($rs['mu']) echo '~<span class="label label-info arrowed-right arrowed-in">Manage User</span>';
	else echo '~<span class="label arrowed">Manage User</span>';

	if($rs['bill']) echo '~<span class="label label-info arrowed-right arrowed-in">Billing</span>';
	else echo '~<span class="label arrowed">Billing</span>';
		
	if($rs['sr']) echo '~<span class="label label-info arrowed-right arrowed-in">Sales Return</span>';
	else echo '~<span class="label arrowed">Sales Return</span>';
	
	if($rs['pe']) echo '~<span class="label label-info arrowed-right arrowed-in">Purchase Entry</span>';
	else echo '~<span class="label arrowed">Purchase Entry</span>';
		
	if($rs['pr']) echo '~<span class="label label-info arrowed-right arrowed-in">Purchase Return</span>';
	else echo '~<span class="label arrowed">Purchase Return</span>';
		
	if($rs['sa']) echo '~<span class="label label-info arrowed-right arrowed-in">Stock Availability</span>';
	else echo '~<span class="label arrowed">Edit Billing</span>';

	if($rs['ise']) echo '~<span class="label label-info arrowed-right arrowed-in">Initial Stock Entry</span>';
	else echo '~<span class="label arrowed">Initial Stock Entry</span>';
		
	if($rs['stka']) echo '~<span class="label label-info arrowed-right arrowed-in">Stock Adjustment</span>';
	else echo '~<span class="label arrowed">Stock Adjustment</span>';
	
	if($rs['srep']) echo '~<span class="label label-info arrowed-right arrowed-in">Sales Report</span>';
	else echo '~<span class="label arrowed">Sales Report</span>';
		
	if($rs['prep']) echo '~<span class="label label-info arrowed-right arrowed-in">Purchase Report</span>';
	else echo '~<span class="label arrowed">Purchase Report</span>';
	
	if($rs['doc']) echo '~<span class="label label-info arrowed-right arrowed-in">Doctor Report</span>';
	else echo '~<span class="label arrowed">Doctor Report</span>';
	
	if($rs['vat']) echo '~<span class="label label-info arrowed-right arrowed-in">Vat Report</span>';
	else echo '~<span class="label arrowed">Vat Report</span>';
	
	if($rs['sch']) echo '~<span class="label label-info arrowed-right arrowed-in">Schedule Report</span>';
	else echo '~<span class="label arrowed">Schedule Report</span>';
		
		
?>