  <?php 
include('includes/session.php'); //Checks session details
include('includes/accessControl.php'); //Include User access control function
 
 $a = false; //denies admin users to access the page
 $m = true; //allows manager users to access the page
 $u = true; //allows regular users to access the page
 $n = false; //denies users who are not logged in access to the page
 
 access($a,$m,$u,$n,$session_group); //calling access function
 
 
 ?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Dave Casey & Co.</title>

        <!-- Bootstrap core CSS  -->
        <link href="css/bootstrap.min.css" rel="stylesheet">

        <!-- Add custom CSS here -->
        <link href="css/stylesheet.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
       	<link href="../css/tablePanel.css" rel="stylesheet" type="text/css">
       	<link href="../css/calendar.css" rel="stylesheet" type="text/css">
    </head>

    <body>
	<?php
	include('includes/menu.php'); //Includes the menu which is customised for the user
	include('includes/taskFunction.php'); //includes the functions which puts the correct tasks or jobs into the calendar for the user
	?>
	

<div class="container">
	<div class="row">
		<div class="col-md-12">
<div class="col-md-12">
	<div class="panel panel-primary">
	<div class="panel-heading">Calendar</div>
	  <div class="panel-body">
	  <!-- Passes the date using GET for the calendar -->
	  <form method='get' class="form-inline">
		<div class="form-group">
	    	<label for="date">Month/Year</label>
	    	<input type="month" class="form-control" name="date" id="date" required>
	  	</div>
	  <input class='btn btn-default' type="submit" value="Submit">
		   
		  
		  
		  
		 <a class='btn btn-default' style="float:right;" href="calendar.php?date="> This Month </a> 
		</form>	
	  
	  
			  

		
<?php
if($session_group=='U')//If the person using it is a 'user' type, then include the calendar which shows the tasks assigned to them
{
include('includes/calendarU.php');
}

if($session_group=='M')//If the person using it is a 'manager' type, then include the calendar which shows every job
{
include('includes/calendarM.php');
}
?>



		</div>
	</div>
</div>
</div>
</div>

   
    
    
    
    <?php
    include('includes/footer.php'); //includes the footer
    ?>

        <!-- Bootstrap core JavaScript -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/menu.js"></script>


    </body>

</html> 