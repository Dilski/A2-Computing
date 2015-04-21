<?php function access($a, $m, $u, $n, $group)
	{
		$allow = false;
			
		if($n == true)
			$allow = 'true';
			
		if(($group == 'A') && ($a == true))
			$allow = 'true';
			
		if(($group == 'M') && ($m == true))
			$allow = 'true';
			
		if(($group == 'U') && ($u == true))
			$allow = 'true';
	
		if($allow == false)
			{
				mysql_close($connection);
				header('location: errors/401.html');
			}
	}
	
	

	
	