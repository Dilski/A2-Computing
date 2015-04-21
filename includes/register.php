<?php

if (isset($_POST['submit']))
	{
		include('security.php');
		
	    $notes = input('notes');
		
		
		
		
	    $username = input_required('username');
	    $password = crypt("sha256", input_required('ps2'));
	    $forename = input_required('forename', 'You must include a forename');
	    $surname = input_required('surname', 'You must include a surname');
	    $dob = input_required('dob', 'You must include a D.O.B');
	    $phone = input_required('tel', 'You must include a phone number');
	    $email = input_required('email', 'You must include an email address');
	    $address1 = input_required('address1', 'You must include a street address');
	    $address2 = input('address2');
	    $town = input_required('town', 'You must include a town');
	    $postcode = input_required('postcode', 'You must include a postcode');
	    //group
	    
	    include('connection.php');
	    
	    $query = mysql_query("SELECT * FROM login WHERE username='$username'", $connection);
			
		$rows = mysql_num_rows($query);
		
		$accept = true;
	    
	    if($rows>0)
	    {
	        $accept = false;
	        $error = 'Username already taken';
	    }
	    
	    if($accept==true && $error=='')
	    {
	        $insertion = mysql_query( "INSERT INTO login (`username`, `password`, `group`) VALUES ('$username', '$password', '$group')", $connection);
	        
	        if (!$insertion)
			{
				$error.= 'Could not insert into database (please contact an admin). ' . mysql_error();	
			}
			
			if($insertion)
			{
			    $result = mysql_query("SELECT id FROM login WHERE username ='$username'", $connection);
			    
			    $row = mysql_fetch_row($result);
			    $id = $row['0'];
			    
			    $insert = mysql_query( "INSERT INTO userDetails (`id`, `forename`, `surname`, `dob`, `phoneNumber`, `email`, `employed`, `notes`, `streetAddress1`, `streetAddress2`, `town`, `postcode`) VALUES ('$id', '$forename', '$surname', '$dob', '$phone', '$email', '1', 'empty', '$address1', '$address2', '$town', '$postcode')", $connection); 
			    if (!$insert)
			        $error.= mysql_error();
			        
			    if ($insert)
			    {
			        mysql_query("DELETE FROM registration WHERE registrationKey='$key'", $connection);
			        
					$to = $email;
					$subject = "Dave Casey & Co Online Organiser Registration Success";
					$message = "
						<html>
						<head>
						<title>Registration Success</title>
						</head>
						<body>
						<p>You have been successfully registered on the Dave Casey & Co Online Organiser</p>
						<p> You can log in at any time <a href='http://dilski.com/signin.php'>here</a>, or by clicking on the 'Employee Login' from the menu on Dilski.com.</p>
						<p>Thank you.</P>
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
			        header('location: /registrationSuccess.php');
			    }
			}
	    }
	    
	}