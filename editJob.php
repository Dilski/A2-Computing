
 	 
 	 
 	 

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

if($error=='')
{
 $query = mysql_query("SELECT * FROM job WHERE `jobId` = '$ID'", $connection);

$rows = mysql_fetch_assoc($query);

$cId = $rows['customerId'];
$jName = $rows['jobName'];
$jStart = $rows['jobStart'];
$description = $rows['jobDescription'];
$jEnd = $rows['jobEnd'];
$jCustomerId = $rows['customerId'];
$streetAddress1 = $rows['streetAddress1'];
$streetAddress2 = $rows['streetAddress2'];
$postcode = $rows['postcode'];
$town = $rows['town'];
$jId = $rows['jobId'];
$customerQuery = mysql_query("SELECT name FROM customer", $connection);
$roww = mysql_fetch_array($customerQuery);
$customerName = $roww['name'];

}

if($jName == '')
 	header('location: viewJobs.php');


 
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
    		<?php  include('includes/editJob.php'); ?>
    </head>
   <body> 
    
 <?php include('includes/menu.php'); ?>
 
 
<form class="" action="" method="post" role="form" oninput="end.setCustomValidity(end.value < start.value ? 'End date must be after start date..' : ''); ">
    <div class="container-fluid">
    <section class="container">
		<div class="container-page">				
			<div class="col-md-6 col-md-offset-3">
				<h3 class="dark-grey">Edit Job</h3>
				
				
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
					<label>Job Name</label>
					<input type="text"class="form-control" id="jName"  name="jName" value="<?php echo $jName; ?>" required>
				</div>
				
				<div class="form-group col-lg-6">
					<label>Customer Name</label>
					<select class="form-control" id="customerId" name="customerId" required>
					<?php
							
							$query = mysql_query("SELECT * FROM customer", $connection);
							while($rows = mysql_fetch_array($query))
							{
								$cName = $rows['name'];
								$cId = $rows['customerId'];
								echo('<option'); if($cId == $jCustomerId){echo(' selected');} echo(' value="'.$cId.'">'.$cName.'</option>');	
							}
					?>
					</select>
						
				</div>
				
				<div class="form-group col-lg-12">
					<label>Description</label>
					<textarea class="form-control" id="description" name="description" required><?php echo $description; ?></textarea>
				</div>
				
				<div class="form-group col-lg-6">
					<label>Start Date</label>
					<input type="date" class="form-control" id="start" value="<?php echo $jStart; ?>" name="start" required>
				</div>	
				
				<div class="form-group col-lg-6">
					<label>End Date</label>
					<input type="date" class="form-control" id="end" value="<?php echo $jEnd; ?>" name="end" required>
				</div>
			
				<div class="form-group col-lg-6">
					<label>Street Address Line 1</label>
					<input type="text" class="form-control" id="surname" value="<?php echo $streetAddress1; ?>" name="address1" required>
				</div>	
				
				<div class="form-group col-lg-6">
					<label>Street Address Line 2</label>
					<input type="text" class="form-control" id="surname" value="<?php echo $streetAddress2; ?>" name="address2" >
				</div>
				
				<div class="form-group col-lg-6">
					<label>Town</label>
					<input type="text" class="form-control" id="surname" value="<?php echo $town; ?>" name="town" required>
				</div>	
				
				<div class="form-group col-lg-6">
					<label>Postcode</label>
					<input type="postcode" class="form-control" id="postcode" value="<?php echo $postcode; ?>" name="postcode" max="8" style="text-transform:uppercase" pattern="[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}" title="Invalid postcode. Must contain a space" required>
				</div>	
				
				<div class="col-md-12">
				
				<a href="viewJob.php?ID=<?php echo $ID; ?>" class="btn btn-default btn-lg pull-left">Back</a>	
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