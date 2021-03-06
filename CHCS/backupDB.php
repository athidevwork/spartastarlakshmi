<?php
backup_tables('localhost','root','','dps_master');
backup_tables('localhost','root','','dps_patients');
backup_tables('localhost','root','','pharmacy');
backup_tables('localhost','root','','ds-db');

/* backup the db OR just a table */
function backup_tables($host,$user,$pass,$name,$tables = '*')
{
	$browserResponse.="Attempting to connect to Database".$name;	
	$link = mysql_connect($host,$user,$pass);
	mysql_select_db($name,$link);
	
	//get all of the tables
	if($tables == '*')
	{
		$tables = array();
		$result = mysql_query('SHOW TABLES');
		while($row = mysql_fetch_row($result))
		{
			$tables[] = $row[0];
		}
	}
	else
	{
		$tables = is_array($tables) ? $tables : explode(',',$tables);
	}
	
	//cycle through
	foreach($tables as $table)
	{
		$result = mysql_query('SELECT * FROM '.$table);
		$num_fields = mysql_num_fields($result);
		$numRows = mysql_num_rows($result);
		
		$return.= 'DROP TABLE '.$table.';';
		$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
		$return.= "\n\n".$row2[1].";\n\n";
		
		$browserResponse.=$table.'->'.$numRows.", ";
		if ($numRows > 0)
			$return.= 'INSERT INTO '.$table.' VALUES'."\n";		
		for ($i = 0; $i < $num_fields; $i++) 
		{
			$currentRow = 0;
			while($row = mysql_fetch_row($result))
			{
				$return.= '(';				
				for($j=0; $j < $num_fields; $j++) 
				{
					$row[$j] = addslashes($row[$j]);
					$row[$j] = ereg_replace("\n","\\n",$row[$j]);
					if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
					if ($j < ($num_fields-1)) { $return.= ','; }
				}
				$currentRow++;
				//$browserResponse.="currentRow=".$currentRow."\n";
				if ($currentRow < $numRows) { $return.= "),\n"; }
				else $return.= ");\n";
			}
		}
		$return.="\n\n\n";
	}
	
	//save file
	$date = date('m/d/Y h:i:s a', time());
    $backup_name        = "localhost_".$date.".sql";
	$handle = fopen('db-backup-'.time().'-'.(md5(implode(',',$tables))).'.sql','w+');
	//$handle = fopen('db-backup-'.$backup_name.'-'.(md5(implode(',',$tables))).'.sql','w+');
	fwrite($handle,$return);
	fclose($handle);
	
	$browserResponse.="\nDB Export for DB ".$name." Complete - ".$date."\n";
	echo str_replace(array("\r\n","\r","\n"),'<br>',$browserResponse);
}
?>