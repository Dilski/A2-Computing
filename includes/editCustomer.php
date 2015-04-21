 <?php

$check = mysql_query( "SELECT * FROM customer WHERE customerId = '$editId'", $connection); 
			    if (!$check)
			        $error.= mysql_error(); 
			        
	$row = mysql_fetch_assoc($check);
    
    //$username
    $phone = $row['phoneNumber'];
    $email = $row['email'];
    $notes = $row['notes'];
    $address1 = $row['streetAddress1'];
    $address2 = $row['streetAddress2'];
    $town = $row['town'];
    $postcode = $row['postcode'];
    

include('security.php');

$error='';
$editId= input_get('ID');
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

