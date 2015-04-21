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
			
		    $notes = $_POST['notes'];
			
			
			include('connection.php');
			
			
			$insert = mysql_query( "UPDATE customer SET notes='$notes' WHERE customerId=$editId", $connection); 
			    if (!$insert)
			        $error.= mysql_error();
			
			if ($connection AND $insertion AND $insert)
			{
				header('location: viewAccount.php');
			}
		
	}

