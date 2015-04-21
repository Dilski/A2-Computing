 
 	 
 	 
 	 

 <?php
include('includes/session.php');
include('includes/accessControl.php');
include('includes/security.php');
 
 $a = true; //allow admin
 $m = true; //allow manager
 $u = false; //allow user
 $n = false; //allow anyone
 
 
 $ID = $_GET['ID'];
 
 access($a,$m,$u,$n,$session_group);

$ID = input_get('ID');

$query = mysql_query("SELECT * FROM customer WHERE `customerId` = '$ID'", $connection);

$row = mysql_fetch_assoc($query);

$editId = $row['customerId'];
$username = $row['name'];
$phone = $row['phoneNumber'];
$email = $row['email'];
$notes = $row['notes'];
$address1 = $row['streetAddress1'];
$address2 = $row['streetAddress2'];
$town = $row['town'];
$postcode = $row['postcode'];



if (empty($editId)) header('location: viewCustomers.php');

if (isset($_POST['submit']))
	{
			
		    $phone = input_required('tel', 'You must include a phone number');
		    $email = input_required('email', 'You must include an email address');
		    $address1 = input_required('address1', 'You must include an address');
		    $address2 = input('address2');
		    $town = input_required('town', 'You must include a town');
		    $postcode = input_required('postcode', 'You must include a postcode');
		    $notes = input('notes');
			
			if ($error=='');
			{
				include('connection.php');
				
				
				$update = mysql_query( "UPDATE customer SET phoneNumber='$phone', email='$email', notes='$notes', streetAddress1='$address1', streetAddress2='$address2', town='$town', postcode='$postcode' WHERE customerId=$editId", $connection); 
				    if (!$update)
				        $error.= mysql_error();
				
				if ($update)
				{
					$confirm = true;
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
    </head>
   <body> 
    
 <?php include('includes/menu.php'); ?>
 
 
<form class="" action="" method="post" role="form" oninput="end.setCustomValidity(end.value < start.value ? 'End date must be after start date..' : ''); ">
    <div class="container-fluid">
    <section class="container">
		<div class="container-page">				
			<div class="col-md-6 col-md-offset-3">
				<h3 class="dark-grey">Edit Customer</h3>
				
				
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
					<label>Name</label> <br />
					<?php echo $username;?>
				</div>
				
				<div class="form-group col-lg-6">
					<label>Phone</label>
					<input type="tel" class="form-control" id="tel" name="tel" value="<?php echo $phone;?>" required>
				</div>
				
				<div class="form-group col-lg-6">
					<label>Email Address</label>
					<input type="email" class="form-control" id="email" name="email" value="<?php echo $email;?>"required>
				</div>
				
				<div class="form-group col-lg-6">
					<label>Street Address 1</label>
					<input type="text" class="form-control" id="address1" name="address1" value="<?php echo $address1;?>"required>
				</div>	
				
				<div class="form-group col-lg-6">
					<label>Street Address 2</label>
					<input type="text" class="form-control" id="address2" name="address2" value="<?php echo $address2;?>">
				</div>
				
				<div class="form-group col-lg-6">
					<label>Town</label>
					<input type="text" class="form-control" id="town" name="town" value="<?php echo $town;?>" required>
				</div>	
				
				<div class="form-group col-lg-6">
					<label>Postcode</label>
					<input type="postcode" class="form-control" id="postcode" value="<?php echo $postcode;?>" name="postcode" max="8" style="text-transform:uppercase" pattern="[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}" title="Invalid postcode. Must contain a space" required>
				</div>
				
				<div class="form-group col-lg-12">
					<label>Notes</label>
					<textarea name="notes" class="form-control" rows="5" ><?php echo $notes;?></textarea>
				</div>	
				
				<div class="col-md-12">
				
					<a class="btn btn-default btn-lg pull-left" href="viewCustomer.php?ID=<?php echo $ID; ?>"> <i class="fa fa-angle-left"></i> Customers</a>
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