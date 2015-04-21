  <?php 
  include('includes/session.php'); //Checks session details
include('includes/accessControl.php'); //Include User access control function
 
 $a = true; //allows admin users access to the page
 $m = true; //allows manager users access to the page
 $u = false; //denies regular users to access the page
 $n = false; //denies users who are not logged in access to the page
 
 access($a,$m,$u,$n,$session_group); //calling access function

include('includes/connection.php'); //Includes the SQL server connection details
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
        
        <?php include('includes/newCustomer.php'); //includes the php code for the page
        
        ?> 
    </head>

    <body>

<form class="form" action="" method="post" role="form" oninput="ps2.setCustomValidity(ps2.value != ps1.value ? 'Passwords do not match.' : '')"> <!-- javascript that makes sure the inputted passwords match -->
    <div class="container-fluid">
    <section class="container">
		<div class="container-page">				
			<div class="col-md-6 col-md-offset-3">
				<h3 class="dark-grey">Create Customer</h3>
				
				
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
				
				<div class="form-group col-lg-12">
					<label>Name</label>
					<input type="text"class="form-control" id="username" name="name" required>
				</div>
				
				<div class="form-group col-lg-6">
					<label>Telephone</label>
					<input type="tel" class="form-control" id="phone" name="tel" required>
				</div>
				
				<div class="form-group col-lg-6">
					<label>Email Address</label>
					<input type="email" class="form-control" id="email" name="email" required>
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
					<input type="text" class="form-control" id="surname" pattern="^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$" title="Must not contain numbers" value="<?php echo $_POST['town']; //Echos the value the user entered in the form so they do not have to write it all again
					?>" name="town" required>
				</div>	
				
				<div class="form-group col-lg-6">
					<label>Postcode</label>
					<input type="postcode" class="form-control" id="postcode" value="<?php echo $_POST['postcode']; //Echos the value the user entered in the form so they do not have to write it all again
					?>" name="postcode" max="8" style="text-transform:uppercase" pattern="[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}" title="Must be a valid UK postcode with a space" required>
				</div>	
				
				<div class="col-md-12">
				
				<a class="btn btn-default btn-lg pull-left" href="viewCustomers.php"> <i class="fa fa-angle-left"></i> Back</a>
				<button type="submit" name="submit" class="btn btn-primary btn-lg pull-right">Create</button>
				</form>
			</div>
				
							
			
				
			</div>
		
			
		</div>
	</section>
</div>	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	



    
    <?php
    include('includes/footer.php'); //includes the footer
    	

    ?>

        <!-- Bootstrap core JavaScript -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/menu.js"></script>


    </body>

</html>