	 <?php 
include('includes/session.php'); //Checks session details
include('includes/accessControl.php'); //Include User access control function
include('includes/security.php'); //Include functions to validate inputs and safe against sql injections.
 
 $a = true; //allows admin users access to the page
 $m = false; //denies manager users access to the page
 $u = false; //denies regular users to access the page
 $n = false; //denies users who are not logged in access to the page
 
 access($a,$m,$u,$n,$session_group); //calling access function

$type = input_get('type'); //Gets the type of user that will be created and sanatises the input

switch ($type)
{
	case "U" : $groupName = 'User'; break; //converts the user type 'U' into a readable friendly version 'User' to be displayed
	case "M" : $groupName = 'Manager'; break; //converts the user type 'U' into a readable friendly version 'User' to be displayed
	default : header('location: viewUsers.php'); break; //if there is no user type, redirects the user back to the 'view users' page
	
}


$error='';
if (isset($_POST['submit']))
	{
		
			$key = mt_rand(100000000, 999999999);
			
			
			
			$newUserGroup = input_get('type');
			$to = input_required('email', 'You must include an email address');
			
			
			
			include('connection.php');
			
			$insertion = mysql_query( "INSERT INTO `registration` (`registrationKey`, `group`) VALUES ('$key', '$newUserGroup')", $connection);
			
			if (!$insertion)
			{
				$error.= 'Could not insert into database (please contact an admin). ' . mysql_error();	
			}
			
			if ($connection AND $insertion)
			{	
				
				
				
				$subject = "Dave Casey & Co Online Organiser Registration";
				$message = "
					<html>
					<head>
					<title>Registration</title>
					</head>
					<body>
					<p>An account has been created for you on the Dave Casey & Co Online Organiser</p>
					<p><a href='http://dilski.com/register.php?key=".$key."'> Click here to register</a></p>
					<p>You can manually register using your registration key when logging in for the first time</P
					<p>Key: ".$key."</p>
					</body>
					</html>
				";
				
				// Always set content-type when sending HTML email
				$headers = "MIME-Version: 1.0" . "\r\n";
				$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
				
				// More headers
				$headers .= 'From: <davecasey@example.com>' . "\r\n";
				$headers .= 'Cc:' . "\r\n";
				
				mail($to,$subject,$message,$headers);

				$confirm = 'An account has been created with the following details:
						<table class="table">
							<thread>
								<tr>
									<th>Key</th>
									<th>User group</th>
								</tr>
							</thread>
							<tbody>
								<tr>
									<th>'.$key.'</th>
									<th>'.$newUserGroup.'</th>
								</tr>
							</tbody>
						</table>';
						
				$disabled =' disabled ';
				$back = '<a class="btn btn-default btn-lg pull-center" href="viewUsers.php"> <i class="fa fa-angle-left"></i> Back</a>';
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

	<?php
	include('includes/menu.php'); //Includes the menu which is customised for the user
	
	
	?>
	<form class="" action="" method="post" role="form">
    <div class="container-fluid">
    <section class="container">
		<div class="container-page">				
			<div class="col-md-6 col-md-offset-3">
				<h3 class="dark-grey">Create Account</h3>
				
				
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
				
				<div class="form-group col-lg-9">
					<label>Email Address</label>
					<input class="form-control" name="email" type="email" placeholder="email address" required>
						
				</div>
				
				<div class="form-group col-lg-3">
					<label>User Type</label> <br />
					<?php echo($groupName); ?> <!-- display the user group of the account that will be created-->
				</div>
				
				<div class="col-md-12">
				
				<a class="btn btn-default btn-lg pull-left" href="viewUsers.php"><i class="fa fa-angle-left"></i> back </a>
				<button type="submit" name="submit" class="btn btn-primary btn-lg pull-right">Sumbit</button>
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