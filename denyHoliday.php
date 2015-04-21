      <?php 
include('includes/session.php');
include('includes/accessControl.php');
include('includes/security.php');
 
 $a = false; //allow admin
 $m = true; //allow manager
 $u = false; //allow user
 $n = false; //allow anyone
 
 access($a,$m,$u,$n,$session_group);
 
 ?>
 
 
 
 <?php
 
    $ID = input_get('ID');
    
    include('includes/connection.php');
    
    mysql_query("UPDATE `holiday` SET `status`='d' WHERE `holidayId`='$ID'", $connection);
 
    header('location: dashboard.php');
 
 ?>