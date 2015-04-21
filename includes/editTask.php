     <?php
  $error='';
  $free=true;
  $overlap = '';
if (isset($_POST['submit']))
	{
		
			
			
		
		
		
		
		include('security.php');
	$jobId = $ID;
	$userId = input_required('assignedUser', 'You must select a user');
	$taskName = input_required('taskName', 'You must include a task name');
	$taskDescription = input_required('description', 'You must include a description');
	$taskStart = input_required('start', 'You must include a start date.').' '.input_required('startTime', 'You must include a start time').':00';
	$taskEnd = input_required('end', 'You must include a end date.').' '.input_required('endTime', 'You must include a end time').':00';
				
				
	$existingTasks = mysql_query("SELECT * FROM `task` WHERE `userId`='$userId' AND `taskId`<>'$ID'", $connection);
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
	
	
	if ($free==true && $error==''){
			include('connection.php');
			
			include('security.php');
			$jobId = $ID;
			$userId = input_required('assignedUser', 'You must select a user');
			$taskName = input_required('taskName', 'You must include a task name');
			$taskDescription = input_required('description', 'You must include a description');
			$taskStart = input_required('start', 'You must include a start date.').' '.input_required('startTime', 'You must include a start time').':00';
			$taskEnd = input_required('end', 'You must include a end date.').' '.input_required('endTime', 'You must include a end time').':00';
			
			$sql = "UPDATE `task` SET `userId`='$userId', `taskName`='$taskName', `taskDescription`='$taskDescription', `taskStart`='$taskStart', `taskEnd`='$taskEnd' WHERE `taskId`='$ID';";
			
			$insertion = mysql_query($sql, $connection);
			
			if (!$insertion)
			{
				$error.= 'Could not insert into database (please contact an admin). ' . mysql_error();	
			}else{
				$confirm = true;
				header('location: viewTask.php?ID='.$taskId);
			}
			
	}	else
	{
		$error = "The user already has task at this time. <br />".$overlap;
		
		$query = mysql_query("SELECT * FROM task WHERE taskId = $ID ORDER BY taskStart ASC", $connection);
			
			
$amtRows = mysql_num_rows($query);


$rows = mysql_fetch_array($query);

		$taskId = $rows['taskId'];
		$userId = $rows['userId'];
		$jobId = $rows['jobId'];
		$taskName = $rows['taskName'];
		$taskNameId = $rows['taskNameId'];
		$taskDescription = $rows['taskDescription'];
		$taskStart = substr($rows['taskStart'], 0, 10);
		$taskEnd = substr($rows['taskEnd'], 0, 10);
		$taskStartTime = substr($rows['taskStart'], 11, -3);
		$taskEndTime = substr($rows['taskEnd'], 11, -3);
			$userQuery = mysql_query("SELECT * FROM login WHERE id = $userId", $connection);
				$roww = mysql_fetch_array($userQuery);
				$userName = $roww['username'];
			$jobQuery = mysql_query("SELECT * FROM job WHERE jobId = $jobId", $connection);
				$rowww = mysql_fetch_array($jobQuery);
				$jobName = $rowww['jobName'];
	}
			
	}
