     <?php 
include('includes/session.php'); //Checks session details
include('includes/accessControl.php'); //Include User access control function
include('includes/security.php'); //Include functions to validate inputs and safe against sql injections.
 
 $a = false; //denies admin users access to the page
 $m = true; //allows manager users access to the page
 $u = false; //denies regular users to access the page
 $n = false; //denies users who are not logged in access to the page
 
 access($a,$m,$u,$n,$session_group); //calling access function
 
 ?>
 
 
 
 <?php
 
    $ID = input_get('ID'); //Gets the holidayId that will be accepted and sanatises the input
    
    include('includes/connection.php'); //Includes the SQL server connection details
    
    mysql_query("UPDATE `holiday` SET `status`='a' WHERE `holidayId`='$ID'", $connection); //Change the status of a holiday record to 'a' for 'accepted'
 
    header('location: dashboard.php'); //redirect the user back to the dashboard
 
 ?>