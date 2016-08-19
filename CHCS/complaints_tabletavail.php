<?php 
					include("config_db3.php");
					$action = $_REQUEST['action'];
				if($action=='tab'){
					$tablet = $_REQUEST['tablet'];
					$cmd_ser = "select id,genericname,manufacturer,maxqty,stocktype from tbl_productlist WHERE productname='$tablet' order by productname ASC LIMIT 1";
					$res_ser = mysql_query($cmd_ser);
					while($rs_ser = mysql_fetch_array($res_ser)){
								
								$genericname=$rs_ser['genericname'];
								$manufacturer=(!empty($rs_ser['manufacturer'])) ? gettabmanufacture($rs_ser['manufacturer']) : '';
								$maxqty=$rs_ser['maxqty'];
								$drugid = $rs_ser['id'];
								$stocktype =$rs_ser['stocktype'];
					?>
                    	
                        <?php }
						echo $genericname.'@$'.$manufacturer.'@$'.$maxqty.'@$'.$drugid.'@$'.$stocktype;
				}	
				if($action=='gen'){
					$generic = $_REQUEST['generic'];
					$cmd_ser = "select productname,manufacturer,maxqty from tbl_productlist WHERE genericname='$generic' order by productname ASC LIMIT 1";
					$res_ser = mysql_query($cmd_ser);
					while($rs_ser = mysql_fetch_array($res_ser)){
								
								$productname=$rs_ser['productname'];
								$manufacturer=(!empty($rs_ser['manufacturer'])) ? gettabmanufacture($rs_ser['manufacturer']) : '';
								$maxqty=$rs_ser['maxqty'];
					?>
                    	
                        <?php }
						echo $productname.'@$'.$manufacturer.'@$'.$maxqty;
				}				
						
						function gettabmanufacture($manu){
							include("config_db3.php");
							$cmd_ser = "select manufacturername from tbl_manufacturer WHERE id = $manu LIMIT 1 ";
							$res_ser = mysql_query($cmd_ser);
							$rs_ser = mysql_fetch_array($res_ser);
								return $rs_ser['manufacturername'];
						}
						mysql_close($db3);
						?>
						