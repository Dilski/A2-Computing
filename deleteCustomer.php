 <?php 
include('includes/session.php');
include('includes/accessControl.php');
include('includes/security.php');
 
 $a = true; //allow admin
 $m = true; //allow manager
 $u = false; //allow user
 $n = false; //allow anyone
 
 access($a,$m,$u,$n,$session_group);

$ID = input_get('ID');

$connection;

$query = mysql_query("SELECT * FROM customer WHERE `customerId` = '$ID'", $connection);

$row = mysql_fetch_assoc($query);

$deleteId = $row['customerId'];
$deleteName = $row['name'];

if (empty($deleteId)) header('location: viewCustomers.php');

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
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    </head>

    <body>

	<?php
	include('includes/menu.php');
	include('includes/deleteCustomer.php');
	
	
	?>
	
<div class="container" style='padding-top:20px;'>
	<div class="row">
    	<div class="col-md-6 col-md-offset-3">
        	<div class="well well-sm text-center">
        	
	        	<legend> Delete User </legend>
	        	
	        	<h3> Are you sure you wish to delete this customer? </h3>
	        	
	        	<div class="row">
	        		<div class="col-md-12 text-center">
			        	<h4> ID: <?php echo($deleteId); ?> </h4>
			        	<h4> Name: <?php echo($deleteName); ?> </h4>
			        	
			        </div>
	        	
	        	</div>
	        	
				<div class="row">
					
					<div class="col-md-12 text-left">
						<a class="btn btn-danger btn-lg pull-left" href="viewCustomers.php"><i class="fa fa-times"></i> no </a>
					
						<form method="post" role="form" action="">
						<button type='submit' name='button' class="btn btn-success btn-lg pull-right"><i class="fa fa-check"></i> yes </button>
						</form>
					</div>
					
					<h3> <?php echo($information); ?> </h3>
				</div>
        	
        	</div>
    	</div> 
	</div>
</div>


    
    <?php
    include('includes/footer.php');
    ?>

        <!-- Bootstrap core JavaScript -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/menu.js"></script>


    </body>

</html>  