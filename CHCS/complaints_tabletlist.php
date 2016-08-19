<?php 
					include("config_db3.php");
					$seltype = gettabtype($_REQUEST['seltype']);
					$action = $_REQUEST['action'];
					
					if($action=='name_list'){
						$cmd_ser = "select productname from tbl_productlist WHERE stocktype='$seltype' order by productname ASC ";
						$res_ser = mysql_query($cmd_ser);
						$num = mysql_num_rows($res_ser);
						if($num >0){
						while($rs_ser = mysql_fetch_array($res_ser)){
									$productname=$rs_ser['productname'];
									//$genericname=$rs_ser['genericname'];
									
						?>
							<option value="<?php echo $productname; ?>">
							<?php }
						}else{
							echo 'no';
						}
					}
					if($action=='gen_list'){
						$cmd_ser = "select genericname from tbl_productlist WHERE stocktype='$seltype' order by productname ASC ";
						$res_ser = mysql_query($cmd_ser);
						$num = mysql_num_rows($res_ser);
							if($num >0){
						while($rs_ser = mysql_fetch_array($res_ser)){
									//$productname=$rs_ser['productname'];
									$genericname=$rs_ser['genericname'];
									
						?>
							<option value="<?php echo $genericname; ?>">
							<?php }
						}else{
							echo 'no';
						}
					}
						function gettabtype($type){
							include("config_db3.php");
							$cmd_ser = "select producttype from tbl_producttype WHERE id = $type LIMIT 1 ";
							$res_ser = mysql_query($cmd_ser);
							
							$rs_ser = mysql_fetch_array($res_ser);
								return $rs_ser['producttype'];
						}
						mysql_close($db3);
						?>
						
						