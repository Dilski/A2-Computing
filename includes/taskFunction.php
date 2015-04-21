<?php function job($dateToCheck)
			{
				include('includes/connection.php');
				$sql = "SELECT * FROM `job` WHERE `jobStart` <= '$dateToCheck' AND `jobEnd` >= '$dateToCheck' ";
				$query = mysql_query($sql, $connection);
				if(mysql_num_rows($query)==0)
				{
				}
				else
				{	
					echo'<ul>';
					
					while($rows = mysql_fetch_array($query))
						{
							echo('<li><a href="../viewJob.php?ID='.$rows['jobId'].'">'.$rows['jobName'].'</a></li>');	
						}
					
					
					
					echo'</ul>';
				}
			}
			
		function tasks($dateToCheck, $session_idd)
			{
				include('includes/connection.php');
			
				
				$sql = "SELECT * FROM `task` WHERE date(taskStart) <= '$dateToCheck' AND date(taskEnd) >= '$dateToCheck' AND `userId` = '$session_idd'";
				$query = mysql_query($sql, $connection);
				if(mysql_num_rows($query)==0)
				{
				}
				else
				{	
					echo'<ul>';
					
					while($rows = mysql_fetch_array($query))
						{
							echo('<li><a href="../viewTask.php?ID='.$rows['taskId'].'">'.$rows['taskName'].'</a></li>');	
						}
					
					
					
					echo'</ul>';
				}
			}
			
			
			
	
			
			?>