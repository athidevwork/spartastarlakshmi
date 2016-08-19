<?php
	include("../config.php");
	$sql = "SELECT * FROM tbl_productlist ORDER BY status desc";
	$res = mysql_query($sql);
	$i = 1;
	$data = array();
	while($rs = mysql_fetch_array($res)){
		$id = $rs['id'];
		$q = mysql_query("SELECT productid, batchno, expirydate, sum(aval) as avail, mrp FROM tbl_purchaseitems WHERE productid = $id AND status = 1 GROUP BY productid, batchno, expirydate");
		if(mysql_num_rows($q) != 0){
			
			while($r = mysql_fetch_array($q)){
				
				$ee = $r['expirydate'];
				$expirydate = implode("/",array_reverse(explode("-",$r['expirydate'])));
				$expirydate = substr($expirydate,3);
				
				$start_date = date('Y-m-d');
				$end_date = date('Y-m-d', strtotime("+60 days"));
				
				if(strtotime($ee) <= strtotime($end_date) && $ee != 0000-00-00)
				{
						
				$x = array('#'=>$i++,
							'type'=>$rs['stocktype'], 
							 'product'=>$rs['productname'], 
							 'batch'=>$r['batchno'], 
							 'expiry'=>$expirydate, 
							 'avail'=>$r['avail'], 
							 'shelf'=>$rs['shelf'], 
							 'rack'=>$rs['rack'],
							 'mrp'=>$r['mrp'],
							 'alrt'=>$alert);
				array_push($data, $x);
			}
			}
			}
		
		
	}
    $results = array(
            "sEcho" => 1,
        "iTotalRecords" => count($data),
        "iTotalDisplayRecords" => count($data),
          "aaData"=>$data);
echo json_encode($results);
?>