
 <?php
include('includes/session.php'); //Checks session details
include('includes/accessControl.php'); //Include User access control function
include('includes/security.php'); //Include functions to validate inputs and safe against sql injections.
 
$a = true; //allows admin users access to the page
 $m = true; //allows manager users access to the page
 $u = false; //denies regular users to access the page
 $n = false; //denies users who are not logged in access to the page
 
 $ID = input_get('ID'); //Gets the ID that will be accepted and sanatises the input
 
 access($a,$m,$u,$n,$session_group); //calling access function
 
 include('includes/connection.php'); //Includes the SQL server connection details
 
 $error='';
if (isset($_POST['submit']))
	{
		$jobName = input_required('jName', 'You must include a job name'); 
		$customerid = input_required('customerid', 'You must select a customer');
		$description = input_required('description', 'You must include a description');
		$start = input_required('start', 'You must select an start date');
		$end = input_required('end', 'You must select an end date');
		$address1 = input_required('address1', 'You must include an address');
		$address2 = input('address2');
		$town = input_required('town', 'You must include a town');
		$postcode = input_required('postcode', 'You must include a postcode');
		
		if($error=='')
		{
			$query = mysql_query( "INSERT INTO `job` (`jobName`, `jobDescription`, `customerId`, `jobStart`, `jobEnd`,`streetAddress1`, `streetAddress2`, `town`, `postcode`) VALUES ('$jobName', '$description', '$customerid', '$start', '$end', '$address1', '$address2', '$town', '$postcode')", $connection);
			
			if (!$query)
			{
				$error.= 'Could not insert into database (please contact an admin). ' . mysql_error();	
			}else{
				$confirm = true;
				header('location: viewJobs.php');
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
        
    		<!-- includes the php code for the page -->
    		<?php  include('includes/createJob.php'); ?>
    </head>
   <body> 
    
 <?php include('includes/menu.php'); //Includes the menu which is customised for the user
 ?>
 
 
<form class="" action="" method="post" role="form" oninput="end.setCustomValidity(end.value < start.value ? 'End date must be after start date..' : ''); ">
    <div class="container-fluid">
    <section class="container">
		<div class="container-page">				
			<div class="col-md-6 col-md-offset-3">
				<h3 class="dark-grey">Create Job</h3>
				
				
				<div class="col-lg-12">
					<?php if(!empty($error)) echo('<div class="alert alert-danger" role="alert">
  <strong>There is an error:</strong> '.$error.'</a>
</div>');?></h3> <!-- if there is an error, displays it in an error box -->
				</div>
				
				<div class="col-lg-12">
					<?php if($confirm) echo('<div class="alert alert-success" role="alert">
  <strong>Success!</strong> An email has been sent to: '.$_POST['email'].'</a>
</div>');?></h3> <!-- a success message is displayed in a box -->
				</div>
				
				<div class="form-group col-lg-6">
					<label>Job Name</label>
					<input type="text"class="form-control" id="jName"  name="jName" value="<?php echo $_POST['jName']; //Echos the value the user entered in the form so they do not have to write it all again
					?>" >
				</div>
				
				<div class="form-group col-lg-6">
					<label>Customer Name</label>
					<select class="form-control" id="customerid" name="customerid" value="<?php echo $_POST['customerid']; //Echos the value the user entered in the form so they do not have to write it all again
					?>"required>
					<?php
							
							$query = mysql_query("SELECT * FROM customer", $connection); //selects all of the customer records
							while($rows = mysql_fetch_array($query)) //puts all of the customer records in an array and loops for each customer record
							{
								$cName = $rows['name']; //puts the name of the customer in a variables
								$cId = $rows['customerId']; //puts the ID of the customer in a variables
								echo('<option value="'.$cId.'">'.$cName.'</option>');	//puts a new option in the dropdown box, which shows as the customers name and value is the customers ID
							}
							//This makes a dropdown box containing the name of every customer, and with the value as the customers ID
					?>
					</select>
						
				</div>
				
				<div class="form-group col-lg-12">
					<label>Description</label>
					<textarea class="form-control" id="description" name="description" required><?php echo $_POST['description']; //Echos the value the user entered in the form so they do not have to write it all again
					?></textarea>
				</div>
				
				<div class="form-group col-lg-6">
					<label>Start Date</label>
					<input type="date" class="form-control" id="start" value="<?php echo $_POST['start']; //Echos the value the user entered in the form so they do not have to write it all again
					?>" name="start" required>
				</div>	
				
				<div class="form-group col-lg-6">
					<label>End Date</label>
					<input type="date" class="form-control" id="end" value="<?php echo $_POST['end']; //Echos the value the user entered in the form so they do not have to write it all again
					?>" name="end" required>
				</div>
			
				<div class="form-group col-lg-6">
					<label>Street Address Line 1</label>
					<input type="text" class="form-control" id="surname" value="<?php echo $_POST['address1']; //Echos the value the user entered in the form so they do not have to write it all again
					?>" name="address1" required>
				</div>	
				
				<div class="form-group col-lg-6">
					<label>Street Address Line 2</label>
					<input type="text" class="form-control" id="surname" value="<?php echo $_POST['address2']; //Echos the value the user entered in the form so they do not have to write it all again
					?>" name="address2" >
				</div>
				
				<div class="form-group col-lg-6">
					<label>Town</label>
					<input type="text" class="form-control" id="surname" value="<?php echo $_POST['town']; //Echos the value the user entered in the form so they do not have to write it all again
					?>" name="town" required>
				</div>	
				
				<div class="form-group col-lg-6">
					<label>Postcode</label>
					<input type="postcode" class="form-control" id="postcode" value="<?php echo $_POST['postcode']; //Echos the value the user entered in the form so they do not have to write it all again
					?>" name="postcode" max="8" style="text-transform:uppercase" pattern="[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}" title="Invalid postcode. Must contain a space" required>
				</div>	
				
				<div class="col-md-12">
				
				
				<button type="submit" name="submit" class="btn btn-primary btn-lg pull-right">Save</button>
				</form>
			</div>
				
							
			
				
			</div>
		
			
		</div>
	</section>
</div>

	
    
     <?php include('includes/footer.php'); //includes the footer 
     ?> 

        <!-- Bootstrap core JavaScript -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/menu.js"></script>


    </body>

</html> 