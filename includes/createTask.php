    <?php
  $error='';
  $free=true;
if (isset($_POST['submit']))
{
	include('security.php');
	$jobId = $ID;
	$userId = input_required('assignedUser', 'You must select a user');
	$taskName = input_required('taskName', 'You must include a task name');
	$taskDescription = input_required('description', 'You must include a description');
	$taskStart = input_required('start', 'You must include a start date.').' '.input_required('startTime', 'You must include a start time').':00';
	$taskEnd = input_required('end', 'You must include a end date.').' '.input_required('endTime', 'You must include a end time').':00';
	
	$existingTasks = mysql_query("SELECT * FROM `task` WHERE `userId`='$userId'", $connection);
	while($rows=mysql_fetch_array($existingTasks))
	{
		$existingStart = $rows['taskStart'];
		$existingEnd = $rows['taskEnd'];
		
		
		if(($taskStart < $existingStart) && ($taskEnd > $existingStart))
			$free = false;
		
		if(($taskStart < $existingEnd) && ($taskEnd > $existingEnd))
			$free = false;
			
		if(($taskstart > $existingStart) && ($taskEnd < $existingEnd))
			$free = false;
			
			
		
		$taskStart = date_create($rows['taskStart']);
		$taskEnd = date_create($rows['taskEnd']);
		$taskStartTime = substr($rows['taskStart'], 10, -3);
		$taskEndTime = substr($rows['taskEnd'], 10, -3);
		
		$startFormat = $taskStartTime.' - '.date_format($taskStart, 'm/d/y');
		$endFormat = $taskEndTime.' - '.date_format($taskEnd, 'm/d/y');
		
			
		$overlap.="User has a task between ".$startFormat." and ".$endFormat.". <br />";
			
	}
	
	
	if($error=='')
	{
	if ($free==true)
	{
		
			
			
			
			$taskStart = input_required('start', 'You must include a start date.').' '.input_required('startTime', 'You must include a start time').':00';
			$taskEnd = input_required('end', 'You must include a end date.').' '.input_required('endTime', 'You must include a end time').':00';
			include('connection.php');
			
			$sql = "INSERT INTO `task` (`jobId`, `userId`, `taskName`, `taskDescription`, `taskStart`, `taskEnd`) VALUES ('$jobId', '$userId', '$taskName', '$taskDescription', '$taskStart', '$taskEnd');";
			
			$insertion = mysql_query($sql, $connection);
			
			
			
			if (!$insertion)
			{
				$error.= 'Could not insert into database (please contact an admin). ' . mysql_error();	
			}else{
				$confirm = true;
				header('location: viewJobs.php?ID='.$jobId);
			}
			
	}
	else
	{
		$error = "The user already has tasks on this date. <br />".$overlap;	
	}
	
	}
}