    <?php 
include('includes/session.php'); //Checks session details
include('includes/accessControl.php'); //Include User access control function
include('includes/security.php'); //Include functions to validate inputs and safe against sql injections.
 
 $a = false; //denies admin users access to the page
 $m = true; //allows manager users access to the page
 $u = true; //allows regular users to access the page
 $n = false; //denies users who are not logged in access to the page
 
 access($a,$m,$u,$n,$session_group); //calling access function
 
 ?>
 
 
 
 <?php
 	
 	$error='';
    $ID = input_get('ID'); //Gets the holidayId that will be deleted and sanatises the input. 
    
    if($error==''){ //only runs the following code if there are no errors
    
	include('includes/connection.php'); //Includes the SQL server connection details
    
    switch($session_group) //
    {	
    	case 'U': //if the user group of the user is 'user', the sql statement only allows the user to delete a holiday record which correseponds to them
    		$sql = "DELETE FROM `holiday` WHERE `userId`='$session_id' AND `holidayId`='$ID'"; //Deletes a holiday record  
    		break;
    	case 'M'://if the user group of the user is 'manager', the sql statement allows them to delete any holiday record
    		$sql = "DELETE FROM `holiday` WHERE `holidayId`='$ID'"; //deletes a holiday record
    		break;
    }
    
    mysql_query($sql, $connection);//runs the sql statement on the database
    }
 
	header('location: dashboard.php'); //redirect the user back to the dashboard
 
 ?>