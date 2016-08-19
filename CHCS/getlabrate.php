<?php
include("config_db1.php");
$inves=$_REQUEST['inves'];
$inves=strtolower($inves);
$cmd1 = "select * from $inves where status='1' order by sym asc";
//echo $cmd1;
$res1 = mysql_query($cmd1);
$num="";
echo '<div class="col-md-12"> 
<button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#addnew">Add</button>
</div><div class="col-md-12">
<div class="table-responsive"><table class="table table-bordered table-striped table-actions" id="tbllab">
			<thead>
			<tr>
				<th>No</th>
				<th scope="col">Test</th>
				<th scope="col">Rate</th>
				<th>Normal</th>
				<th style="display:none">id</th>
				<th>Action</th>
			</tr>
			</thead><tbody>	';
			$i=1;
while($rs1 = mysql_fetch_array($res1)){
echo "<tr>
		<td>".$i++."&nbsp;</td>					
		<td contenteditable='true' class='sm' >".$rs1['sym']."&nbsp;</td>
		<td contenteditable='true' class='rt' >".$rs1['rate']."&nbsp;</td>
		<td contenteditable='true' class='nor' >".$rs1['normal']."&nbsp;</td>
		<td style='display:none'>".$rs1['id']."&nbsp;</td>
		<td><a href='#' class='btn btn-danger btn-rounded btn-condensed btn-sm' onClick='delinves($(this))' width='24' id='deleteimg' alt=".$rs1['id']." ><span class='fa fa-times'></span></a></td>
		</tr>";

}echo '</tbody></table></div>';
	mysql_close($db1);
?>