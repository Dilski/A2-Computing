  
 <?php
include('includes/session.php');
include('includes/accessControl.php');
include('includes/security.php');
 
 $a = true; //allow admin
 $m = true; //allow manager
 $u = false; //allow user
 $n = false; //allow anyone
 
 
 $ID = input_get('ID');
 
 
 
 access($a,$m,$u,$n,$session_group);
 
 include('includes/connection.php');

$connection;

$confirm = false;

$error='';

if($error='')
{
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
if ($amtRows < 1)
	header('location: viewJobs.php')





 
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
    		<?php  include('includes/editTask.php'); ?>
    </head>
   <body> 
    
 <?php include('includes/menu.php'); ?>
 
 
<form class="" action="" method="post" role="form" oninput="endTime.setCustomValidity((startTime.value > endTime.value) && (start.value == end.value)? 'End time must be after start time..' : ''); end.setCustomValidity(end.value < start.value ? 'End date must be after start date..' : '');">
    <div class="container-fluid">
    <section class="container">
		<div class="container-page">				
			<div class="col-md-6 col-md-offset-3">
				<h3 class="dark-grey">Edit Task</h3>
				
				
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
					<select class="form-control" id="assignedUser" name="assignedUser" value="<?php echo $userId; ?>"required>
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
					<input type="text" class="form-control" id="taskName" value="<?php echo $taskName; ?>" name="taskName" required>
				</div>
				
				<div class="form-group col-lg-12">
					<label>Task Description</label>
					<textarea name="description" class="form-control" rows="5" ><?php echo $taskDescription; ?></textarea>
				
				</div>	
				
				<div class="form-group col-lg-6">
					<label>Start Date</label>
					<input type="date" class="form-control" id="start" value="<?php echo $taskStart; ?>" min="<?php echo $jobStart; ?>" max="<?php echo $jobEnd; ?>" name="start" required>
				</div>
				
				<div class="form-group col-lg-6">
					<label>Start Time</label>
					<input type="time" class="form-control" id="startTime" value="<?php echo $taskStartTime; ?>" name="startTime" required>
				</div>
				
				<div class="form-group col-lg-6">
					<label>End Date</label>
					<input type="date" class="form-control" id="end" value="<?php echo $taskEnd; ?>" min="<?php echo $jobStart; ?>" max="<?php echo $jobEnd; ?>" name="end" required>
				</div>
				
				<div class="form-group col-lg-6">
					<label>End Time</label>
					<input type="time" class="form-control" id="endTime" value="<?php echo $taskEndTime; ?>" name="endTime" required>
				</div>
				
				<div class="col-md-12">
				<span class="pull-left">
					<a href="viewTask.php?ID=<?php echo $ID; ?>" class="btn btn-default btn-lg"> Back </a>
				</span>
				
				
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