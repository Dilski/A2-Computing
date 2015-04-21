  <form class="" action="" method="post" role="form" oninput="email1.setCustomValidity(email1.value != email.value ? 'Emails do not match.' : '');">
    <div class="container-fluid">
    <section class="container">
		<div class="container-page">				
			<div class="col-md-6 col-md-offset-3">
				<h3 class="dark-grey">User Settings</h3>
				
				
				<div class="col-lg-12">
					<?php if(!empty($error)) echo('<div class="alert alert-danger" role="alert">
  <strong>There is an error:</strong> '.$error.'</a>
</div>');?></h3> <?php  echo($confirm); ?>
				</div>
				
				<div class="form-group col-lg-6">
					<label>Username</label> <br />
					<?php echo($session_username);?>
				</div>
				
				<div class="form-group col-lg-6">
					<label>Group</label> <br />
					<?php echo($group_icon);?>
				</div>
								
				<div class="form-group col-lg-6">
					<label>Email Address</label>
					<input type="email" class="form-control" name="email" value="<?php echo($email);?>" required>
				</div>
				
				<div class="form-group col-lg-6">
					<label>Repeat Email Address</label>
					<input type="email" class="form-control" name="email1" value="<?php echo($email);?>" required>
				</div>	
				
				<div class="form-group col-lg-6">
					<label>First Name</label>
					<input type="text" class="form-control" name="forename" value="<?php echo($forename);?>" required>
				</div>
				
				<div class="form-group col-lg-6">
					<label>Last Name</label>
					<input type="text" class="form-control" name="surname" value="<?php echo($surname);?>" required>
				</div>
				
				<div class="form-group col-lg-6">
					<label>D.O.B</label>
					<input type="date" class="form-control" id="dob" name="dob" value="<?php echo($dob);?>" required>
				</div>	
				
				<div class="form-group col-lg-6">
					<label>Phone Number</label>
					<input type="tel" class="form-control" id="phone" name="phoneNumber" value="<?php echo($phone);?>" required>
				</div>
				
				<div class="form-group col-lg-6">
					<label>Street Address Line 1</label>
					<input type="text" class="form-control" id="address1" name="streetAddress1" value="<?php echo($address1);?> " required>
				</div>	
				
				<div class="form-group col-lg-6">
					<label>Street Address Line 2</label>
					<input type="text" class="form-control" id="address2" name="streetAddress2" value="<?php echo($address2);?>" >
				</div>
				
				<div class="form-group col-lg-6">
					<label>Town</label>
					<input type="text" class="form-control" id="town" name="town" value="<?php echo($town);?>" required>
				</div>	
				
				<div class="form-group col-lg-6">
					<label>Postcode</label>
					<input type="postcode" class="form-control" id="postcode" name="postcode" value="<?php echo($postcode);?>" max="8" style="text-transform:uppercase" pattern="[A-Za-z]{1,2}[0-9Rr][0-9A-Za-z]? [0-9][ABD-HJLNP-UW-Zabd-hjlnp-uw-z]{2}" title="Invalid postcode. Must contain a space" required>
				</div>	
				
				<div class="form-group col-lg-12 pull-right">
					<button type="submit" name="submit" class="btn btn-primary btn-lg pull-right">Save</button>
				</form>	
				</div>	
				
			<?php
			if(isset($_POST['submit']))
			{
				$error='';
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
			    
			    if($error=='')
			    {
				$sql = "UPDATE `userDetails` SET `email`='" . $_POST['email'] . "', `forename`='" . $_POST['forename'] . "', `surname`='" . $_POST['surname'] . "', `dob`='" . $_POST['dob'] . "', `phoneNumber`='" . $_POST['phoneNumber'] . "', `streetAddress1`='" . $_POST['streetAddress1'] . "', `streetAddress2`='" . $_POST['streetAddress2'] . "', `town`='" . $_POST['town'] . "', `postcode`='" . $_POST['postcode'] . "' WHERE `id` = '$session_id'";
				$ammend = mysql_query($sql, $connection);
			    }
				
				
				if(!$ammend){echo mysql_error();}
			}	
			?>
		
				
				
							
			
				
			</div>
		</div>
	</section>
</div>