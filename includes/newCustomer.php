<?php

if (isset($_POST['submit']))
	{
		
	    $error='';
	    include('security.php');
	    
	    $name = input_required('name', 'You must include a name');
	    $phone = input_required('tel', 'You must include a phone number');
	    $email = input_required('email', 'You must include an email address');
	    $address1 = input_required('address1', 'You must include an address');
	    $address2 = input('address2');
	    $town = input_required('town', 'You must include a town');
	    $postcode = input_required('postcode', 'You must include a postcode');
	    
	    if($error==''){
	    
	    
	    include('connection.php');
	    
	    $query = mysql_query("SELECT * FROM customer WHERE name='$name'", $connection);
			
		$rows = mysql_num_rows($query);
		
		$accept = true;
	    
	    if($rows>0)
	    {
	        $accept = false;
	        $error = 'Name already taken';
	    }
	    
	    if($accept==true)
	    {
	        $insert = mysql_query( "INSERT INTO customer (`name`, `phoneNumber`, `email`, `notes`, `streetAddress1`, `streetAddress2`, `town`, `postcode`) VALUES ('$name', '$phone', '$email', 'empty', '$address1', '$address2', '$town', '$postcode')", $connection); 
			    if (!$insert)
			        $error.= mysql_error();
	    }
	    }
	}