<?php
	$strCon = mysql_connect("localhost","raunyuuh_artpart","afpf@1162014");
	if(!$strCon)
	{
		
		echo mysql_error();
	}
	else
	{
	
		$strDb = mysql_select_db("raunyuuh_artpartformapp",$strCon);
		if(!$strDb)
		{
			echo mysql_error();
		}
		else
		{
			
			echo "Done";
		}
		
	}
?>