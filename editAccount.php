  <?php 
include('includes/session.php');
include('includes/accessControl.php');
include('includes/security.php');
 
 $a = true; //allow admin
 $m = false; //allow manager
 $u = false; //allow user
 $n = false; //allow anyone
 
 access($a,$m,$u,$n,$session_group);

$ID = input_get('ID');

$connection;

$query = mysql_query("SELECT * FROM login WHERE `ID` = '$ID'", $connection);

$row = mysql_fetch_assoc($query);

$editId = $row['id'];
$editUsername = $row['username'];
$editGroup = $row['group'];

if (empty($editId)) header('location: viewUsers.php');


$check = mysql_query( "SELECT * FROM userDetails WHERE id = '$editId'", $connection); 
			    if (!$check)
			        $error.= mysql_error(); 
			        
	$row = mysql_fetch_assoc($check);
    
    //$username
    $forename = $row['forename'];
    $surname = $row['surname'];
    $dob = $row['dob'];
    $phone = $row['phoneNumber'];
    $employed = $row['employed'];
    $email = $row['email'];
    $notes = $row['notes'];
    $address1 = $row['streetAddress1'];
    $address2 = $row['streetAddress2'];
    $town = $row['town'];
    $postcode = $row['postcode'];
    



$error='';
$editId= input_get('ID');
if (isset($_POST['submit']))
	{
			include('security.php');
			$group = $_POST['optradiog'];
			$employed = $_POST['optradioe'];
			$forename = input_required('forename', 'You must include a forename');
		    $surname = input_required('surname', 'You must include a surname');
		    $dob = input_required('dob', 'You must include a D.O.B');
		    $phone = input_required('phoneNumber', 'You must include a phone number');
		    $email = input_required('email', 'You must include an email address');
		    $address1 = input_required('streetAddress1', 'You must include a street address');
		    $address2 = input('streetAddress2');
		    $town = input_required('town', 'You must include a town');
		    $postcode = input_required('postcode', 'You must include a postcode');
		    $notes = input('notes');
		    
		    if($error==''){
			
			
			include('includes/connection.php');
			
			$insertion = mysql_query( "UPDATE `login` SET `group` = '".$group."' WHERE `id` = ".$editId."", $connection);
			
			if (!$insertion)
			{
				$error.= 'Could not insert into database (please contact an admin). ' . mysql_error();	
			}
			
			$insert = mysql_query( "UPDATE userDetails SET forename='$forename', surname='$surname', dob='$dob', phoneNumber='$phone', email='$email', employed='$employed', notes='$notes', streetAddress1='$address1', streetAddress2='$address2', town='$town', postcode='$postcode' WHERE id=$editId", $connection); 
			    if (!$insert)
			        $error.= mysql_error();
			
			if ($connection AND $insertion AND $insert)
			{
				header('location: viewAccount.php');
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

	<?php
	include('includes/menu.php');
	
	
	?>
	
<form class="" action="" method="post" role="form">
    <div class="container-fluid">
    <section class="container">
		<div class="container-page">				
			<div class="col-md-6 col-md-offset-3">
				<h3 class="dark-grey">Edit User</h3>
				
				
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
					<label>Username</label> <br />
					<?php echo($editUsername);?>
				</div>
				
				<div class="form-group col-lg-6">
					<label>Dob</label>
					<input type="date" class="form-control" name="dob" value="<?php echo($dob);?>">
				</div>	
				
				<div class="form-group col-lg-6">
					<label>Group</label><br />
					<label class="radio-inline">
							      <input type="radio" name="optradiog" <?php if (isset($editGroup) && $editGroup=="M") echo "checked";?>
								value="M">Manager
							    </label>
							    <label class="radio-inline">
							      <input type="radio" name="optradiog" <?php if (isset($editGroup) && $editGroup=="U") echo "checked";?>
								value="U">User
							    </label>
				</div>
				
				<div class="form-group col-lg-6">
					<label>Employed</label><br />
					<label class="radio-inline">
							      <input type="radio" name="optradioe" <?php if (isset($employed) && $employed=="1") echo "checked";?>
								value="1">Yes
							    </label>
							    <label class="radio-inline">
							      <input type="radio" name="optradioe" <?php if (isset($employed) && $employed=="0") echo "checked";?>
								value="0">No
							    </label>
				</div>
				

				
				
				
				
				
				<div class="form-group col-lg-6">
					<label>Forename</label>
					<input type="text" class="form-control" name="forename" value="<?php echo($forename);?>">
				</div>	
				
				<div class="form-group col-lg-6">
					<label>Surname</label>
					<input type="text" class="form-control" name="surname" value="<?php echo($surname);?>">
				</div>
				
				<div class="form-group col-lg-6">
					<label>Phone Number</label>
					<input type="tel" class="form-control" name="phoneNumber" value="<?php echo($phone);?>">
				</div>
				
				<div class="form-group col-lg-6">
					<label>Email Address</label>
					<input type="email" class="form-control" name="email" value="<?php echo($email);?>">
				</div>
				
				
				<div class="form-group col-lg-6">
					<label>Street Address 1</label>
					
					<input type="text" class="form-control" name="streetAddress1" value="<?php echo($address1);?> ">
				</div>	
				
				<div class="form-group col-lg-6">
					<label>Street Address 2</label>
					<input type="text" class="form-control" name="streetAddress1" value="<?php echo($address1);?> ">
				</div>	
				
				<div class="form-group col-lg-6">
					<label>Town</label>
					<input type="text" class="form-control" name="town" value="<?php echo($town);?>">
				</div>	
				
				<div class="form-group col-lg-6">
					<label>Postcode</label>
					<input type="postcode" class="form-control" id="postcode" value="TS23 3JB" name="postcode" value="<?php echo($postcode);?>" max="8" style="text-transform:uppercase" pattern="[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}" title="Invalid postcode. Must contain a space" required="">
				</div>	
				
				<div class="form-group col-lg-12">
					<label>Notes</label>
					<textarea name="notes" class="form-control" rows="5" ><?php echo $notes;?></textarea>
				</div>	
				
				<div class="col-md-12">
				
					<a class="btn btn-default btn-lg pull-left" href="viewUsers.php"> <i class="fa fa-angle-left"></i> Users</a>
					<button type="submit" name="submit" class="btn btn-primary btn-lg pull-right">Save</button>
				</form>
				</div>
				
				
				
							
			
				
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