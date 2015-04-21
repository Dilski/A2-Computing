     <?php 
include('includes/session.php');
include('includes/accessControl.php');
include('includes/security.php');
 
 $a = true; //allow admin
 $m = true; //allow manager
 $u = true; //allow user
 $n = false; //allow anyone
 
 access($a,$m,$u,$n,$session_group);

$ID = input_get('ID');


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
        <link href="/css/viewUser.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        
        <?php  ?>
        
    </head>

    <body>

	<?php
	include('includes/menu.php');
	
	$check = mysql_query( "SELECT * FROM userDetails WHERE id = '".$session_id."'", $connection); 
			    if (!$check)
			        $error.= mysql_error(); 
			        
	$row = mysql_fetch_assoc($check);
    
    //$username
    $forename = $row['forename'];
    $surname = $row['surname'];
    $dob = $row['dob'];
    $phone = $row['phoneNumber'];
    $employedd = $row['employed'];
    $email = $row['email'];
    $address1 = $row['streetAddress1'];
    $address2 = $row['streetAddress2'];
    $town = $row['town'];
    $postcode = $row['postcode'];
    //viewid
    
    switch($employedd)
    {
        case '1':
            $employed = 'Yes';
            break;
        case '0':
            $employed = 'No';
            break;
            
    }
    
    switch($session_group)
    {
	case 'A':
	$group_icon = "<i class='fa fa-wrench'></i>  Admin";
	break;
	
	case 'M':
	$group_icon = "<i class='fa fa-laptop'></i>  Manager";
	break;
	
	case 'U':
	$group_icon = "<i class='fa fa-user'></i>  User";
	break;
    }
	
	if($session_group<>'A'){include('includes/settingsUM.php');}
	
	
	?>



    
    <?php
    include('includes/footer.php');
    ?>

        <!-- Bootstrap core JavaScript -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/menu.js"></script>