 
 <?php
include('includes/session.php'); //Checks session details
include('includes/accessControl.php'); //Include User access control function
include('includes/security.php'); //Include functions to validate inputs and safe against sql injections.
 
 $a = true; //allows admin users access to the page
 $m = true; //allows manager users access to the page
 $u = false; //denies regular users to access the page
 $n = false; //denies users who are not logged in access to the page

 $error=''; //clears all the errors
 
 $ID = input_get('jobId'); //Gets the jobId that will be used and sanatises the input
 
 $query = mysql_query("SELECT * FROM job WHERE `jobId` = $ID", $connection); //selects the job which corresponds to the 
 $rows = mysql_fetch_assoc($query);
 
 if(mysql_num_rows($query)==0) //if there are no 
 {
    header('location: viewJobs.php');
 }
 $jobStart = $rows['jobStart'];
 $jobEnd = $rows['jobEnd'];
 $jobName = $rows['jobName'];
 
 access($a,$m,$u,$n,$session_group);
 
 include('includes/connection.php');

$connection;

$confirm = false;


$error='';
  $free=true;
if (isset($_POST['submit']))
{
	include('includes/security.php');
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
			include('includes/connection.php');
			
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


 
 ?>
 
 <!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Dave Casey & Co.</title>
        <!-- Bootstrap core CSS -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Add custom CSS here -->
        <link href="css/stylesheet.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        
    		<!-- includes -->
    		<?php  include('includes/createTask.php'); ?>
    </head>
   <body> 
    
 <?php include('includes/menu.php'); ?>
 
 
<form class="" action="" method="post" role="form" oninput="endTime.setCustomValidity((startTime.value > endTime.value) && (start.value == end.value)? 'End time must be after start time..' : ''); end.setCustomValidity(end.value < start.value ? 'End date must be after start date..' : '');">
    <div class="container-fluid">
    <section class="container">
		<div class="container-page">				
			<div class="col-md-6 col-md-offset-3">
				<h3 class="dark-grey">Create Job</h3>
				
				
				<div class="col-lg-12">
					<?php if(!empty($error)) echo('<div class="alert alert-danger" role="alert">
  <strong>There is an error:</strong> '.$error.'</a>
</div>');?></h3>
				</div>
				
				<div class="col-lg-12">
					<?php if($confirm) echo('<div class="alert alert-success" role="alert">
  <strong>Success!</strong></a>
</div>');?></h3>
				</div>
				
				<div class="form-group col-lg-12">
					<label>Job Name</label><br />
					<?php echo $jobName; ?>
				</div>
				
				<div class="form-group col-lg-6">
					<label>Assigned User</label>
					<select class="form-control" id="assignedUser" name="assignedUser" value="<?php echo $_POST['assignedUser']; ?>"required>
					<?php
							
							$query = mysql_query("SELECT * FROM login WHERE `group`='U'", $connection);
							while($rows = mysql_fetch_array($query))
							{
								$id = $rows['id'];
								$username = $rows['username'];
								echo('<option value="'.$id.'">'.$username.'</option>');	
							}
					?>
					</select>
				</div>	
				
				<div class="form-group col-lg-6">
					<label>Task Name</label>
					<input type="text" class="form-control" id="taskName" value="<?php echo $_POST['taskName']; ?>" name="taskName" required>
				</div>
				
				<div class="form-group col-lg-12">
					<label>Job Description</label>
					<textarea name="description" class="form-control" rows="5" ><?php echo $_POST['description']; ?></textarea>
				
				</div>	
				
				<div class="form-group col-lg-6">
					<label>Start Date</label>
					<input type="date" class="form-control" id="start" value="<?php echo $jobStart; ?>" min="<?php echo $jobStart; ?>" max="<?php echo $jobEnd; ?>" name="start" required>
				</div>
				
				<div class="form-group col-lg-6">
					<label>Start Time</label>
					<input type="time" class="form-control" id="startTime" value="<?php echo $_POST['jobStartTime']; ?>" name="startTime" required>
				</div>
				
				<div class="form-group col-lg-6">
					<label>End Date</label>
					<input type="date" class="form-control" id="end" value="<?php echo $jobEnd; ?>" min="<?php echo $jobStart; ?>" max="<?php echo $jobEnd; ?>" name="end" required>
				</div>
				
				<div class="form-group col-lg-6">
					<label>End Time</label>
					<input type="time" class="form-control" id="endTime" value="<?php echo $_POST['jobEndTime']; ?>" name="endTime" required>
				</div>
				
				<div class="col-md-12">
				
				
				<button type="submit" name="submit" class="btn btn-primary btn-lg pull-right">Save</button>
				</form>
			</div>
				
							
			
				
			</div>
		
			
		</div>
	</section>
</div>








	
    
     <?php include('includes/footer.php'); ?>

        <!-- Bootstrap core JavaScript -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/menu.js"></script>
        


    </body>

</html> 