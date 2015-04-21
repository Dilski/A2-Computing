  
 <?php
include('includes/session.php');
include('includes/accessControl.php');
 
 $a = false; //allow admin
 $m = true; //allow manager
 $u = true; //allow user
 $n = false; //allow anyone
 
 
 access($a,$m,$u,$n,$session_group);
 
 include('includes/connection.php');

$connection;

$confirm = false;



  $error='';
  $free=true;
if (isset($_POST['submit']))
{
	
	include('includes/security.php');
	$userId = $session_id;
	$start = input_required('start', 'You must include an start date');
	$end = input_required('end', 'You must include an end date');
	
	dateCheck($start, $end, 'Start date must be before end date.');
	
	if($error=='')
	{
		if ($free==true)
		{
				include('connection.php');
				
				$userId = $session_id;
				$start = $_POST['start'];
				$end = $_POST['end'];
				
				$sql = "INSERT INTO `holiday` (`userId`, `status`, `start`, `end`) VALUES ('$userId', 'p', '$start', '$end')";
				
				$error.=$sql;
				
				$insertion = mysql_query($sql, $connection);
				
				if (!$insertion)
				{
					$error.= 'Could not insert into database (please contact an admin). ' . mysql_error();	
				}else{
					$confirm = true;
					header('location: dashboard.php');
				}
				
		}
		else
		{
			$error = "You have tasks/jobs on the selected dates. <br />".$overlap;	
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
        
        
    		
    </head>
   <body> 
    
 <?php include('includes/menu.php'); ?>
 
 
<form class="" action="" method="post" role="form" oninput="end.setCustomValidity(end.value < start.value ? 'End date must be after start date..' : '');">
    <div class="container-fluid">
    <section class="container">
		<div class="container-page">				
			<div class="col-md-6 col-md-offset-3">
				<h3 class="dark-grey">New Holiday Request</h3>
				
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
				
				
				
				<div class="form-group col-lg-6">
					<label>Start Date</label>
					<input type="date" title="Date in the form YYYY-MM-DD" pattern="^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$" class="form-control" id="start" value="<?php echo $_POST['start']; ?>"name="start" required>
				</div>
				
				<div class="form-group col-lg-6">
					<label>End Date</label>
					<input type="date" class="form-control" title="Date in the form YYYY-MM-DD" pattern="^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$" value="<?php echo $_POST['end']; ?>" id="end" name="end" required>
				</div>
				
				<div class="col-md-12">
				
				
				<button type="submit" name="submit" class="btn btn-primary btn-lg pull-right">Submit</button>
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