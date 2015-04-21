 <?php 
include('includes/session.php');
include('includes/accessControl.php');
include('includes/security.php');
 
 $a = false; //allow admin
 $m = false; //allow manager
 $u = false; //allow user
 $n = true; //allow anyone
 
 access($a,$m,$u,$n,$session_group);

$key = input_get('key');

include('includes/connection.php');

$connection;

$query = mysql_query("SELECT * FROM registration WHERE `registrationKey` = '$key'", $connection);

$row = mysql_fetch_assoc($query);

$group = $row['group'];

if (empty($group)) header('location: registerKey.php');

switch($group)
{
	case 'A':
	$group_icon = '<i class="fa fa-wrench"></i>  Admin';

	break;
	
	case 'M':
	$group_icon = '<i class="fa fa-laptop"></i>  Manager';
	break;
	
	case 'U':
	$group_icon = '<i class="fa fa-user"></i>  User';
	break;
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
        
        <?php include('includes/register.php');?>
    </head>

    <body>
    
    <form class="" action="" method="post" role="form" oninput="ps2.setCustomValidity(ps2.value != ps1.value ? 'Passwords do not match.' : ''); email1.setCustomValidity(email1.value != email.value ? 'Emails do not match.' : '');">
    <div class="container-fluid">
    <section class="container">
		<div class="container-page">				
			<div class="col-md-6">
				<h3 class="dark-grey">Registration</h3>
				
				
				<div class="col-lg-12">
					<?php if(!empty($error)) echo('<div class="alert alert-danger" role="alert">
  <strong>There is an error:</strong> '.$error.'</a>
</div>');?></h3> <?php  echo($confirm); ?>
				</div>
				
				<div class="form-group col-lg-6">
					<label>Registration ID</label> <br />
					<?php echo($key);?>
				</div>
				
				<div class="form-group col-lg-6">
					<label>Group</label> <br />
					<?php echo($group_icon);?>
				</div>
				
				<div class="form-group col-lg-12">
					<label>Username</label>
					<input type="text"class="form-control" id="username" value="<?php echo $_POST['username']; ?>" name="username" required>
				</div>
				
				<div class="form-group col-lg-6">
					<label>Password</label>
					<input type="password"class="form-control" id="password1"  name="ps1" required>
				</div>
				
				<div class="form-group col-lg-6">
					<label>Repeat Password</label>
					<input type="password"class="form-control" id="password2" name="ps2" required>
				</div>
								
				<div class="form-group col-lg-6">
					<label>Email Address</label>
					<input type="email" class="form-control" id="email" value="<?php echo $_POST['email']; ?>" name="email" required>
				</div>
				
				<div class="form-group col-lg-6">
					<label>Repeat Email Address</label>
					<input type="email" class="form-control" id="email1" value="<?php echo $_POST['email1']; ?>" name="email1" required>
				</div>	
				
				<div class="form-group col-lg-6">
					<label>First Name</label>
					<input type="text" class="form-control" id="forename" value="<?php echo $_POST['forename']; ?>" name="forename" required>
				</div>
				
				<div class="form-group col-lg-6">
					<label>Last Name</label>
					<input type="text" class="form-control" id="surname" value="<?php echo $_POST['surname']; ?>" name="surname" required>
				</div>
				
				<div class="form-group col-lg-6">
					<label>D.O.B</label>
					<input type="date" class="form-control" id="dob" value="<?php echo $_POST['dob']; ?>" name="dob" required>
				</div>	
				
				<div class="form-group col-lg-6">
					<label>Phone Number</label>
					<input type="tel" class="form-control" id="phone" value="<?php echo $_POST['tel']; ?>" name="tel" required>
				</div>
				
				<div class="form-group col-lg-6">
					<label>Street Address Line 1</label>
					<input type="text" class="form-control" id="surname" value="<?php echo $_POST['address1']; ?>" name="address1" required>
				</div>	
				
				<div class="form-group col-lg-6">
					<label>Street Address Line 2</label>
					<input type="text" class="form-control" id="surname" value="<?php echo $_POST['address2']; ?>" name="address2" >
				</div>
				
				<div class="form-group col-lg-6">
					<label>Town</label>
					<input type="text" class="form-control" id="surname" value="<?php echo $_POST['town']; ?>" name="town" required>
				</div>	
				
				<div class="form-group col-lg-6">
					<label>Postcode</label>
					<input type="postcode" class="form-control" id="postcode" value="<?php echo $_POST['postcode']; ?>" name="postcode" max="8" style="text-transform:uppercase" pattern="[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}" title="Invalid postcode. Must contain a space" required>
				</div>			
				
							
			
				
			</div>
		
			<div class="col-md-6">
				<h3 class="dark-grey">Terms and Conditions</h3>
				
<p>Please read these Terms and Conditions carefully before using the Dave Casey & Co Organiser.</p>

<p>Your access to and use of the Service is conditioned on your acceptance of and compliance with these Terms. These Terms apply to all visitors, users and others who access or use the Service.</p>

<p>By accessing or using the Service you agree to be bound by these Terms. If you disagree with any part of the terms then you may not access the Service.</p>

<p><strong>Accounts</strong></p>

<p>When you create an account with us, you must provide us information that is accurate, complete, and current at all times. Failure to do so constitutes a breach of the Terms, which may result in immediate termination of your account on our Service.</p>

<p>You are responsible for safeguarding the password that you use to access the Service and for any activities or actions under your password, whether your password is with our Service or a third-party service.</p>

<p>You agree not to disclose your password to any third party. You must notify us immediately upon becoming aware of any breach of security or unauthorized use of your account.</p>    


<p><strong>Governing Law</strong></p>

<p>These Terms shall be governed and construed in accordance with the laws of United Kingdom, without regard to its conflict of law provisions.</p>

<p>Our failure to enforce any right or provision of these Terms will not be considered a waiver of those rights. If any provision of these Terms is held to be invalid or unenforceable by a court, the remaining provisions of these Terms will remain in effect. These Terms constitute the entire agreement between us regarding our Service, and supersede and replace any prior agreements we might have between us regarding the Service.</p>

<p><strong>Changes</strong></p>

<p>We reserve the right, at our sole discretion, to modify or replace these Terms at any time. If a revision is material we will try to provide at least 30 days notice prior to any new terms taking effect. What constitutes a material change will be determined at our sole discretion.</p>

<p>By continuing to access or use our Service after those revisions become effective, you agree to be bound by the revised terms. If you do not agree to the new terms, please stop using the Service.</p>

<p><strong>Contact Us</strong></p>

<p>If you have any questions about these Terms, please contact us.</p>
				
				<button type="submit" name="submit" class="btn btn-primary btn-lg pull-right">Register</button>
				</form>
			</div>
		</div>
	</section>
</div>

	
	


    
    <?php
    include('includes/footer.php');
    	

    ?>

        <!-- Bootstrap core JavaScript -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/menu.js"></script>


    </body>

</html>