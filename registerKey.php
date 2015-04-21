 <?php 
include('includes/session.php');
include('includes/accessControl.php');
 
 $a = false; //allow admin
 $m = false; //allow manager
 $u = false; //allow user
 $n = true; //allow anyone
 
 access($a,$m,$u,$n,$session_group);

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
    
    <?php
    	
    	  if (isset($_POST['submit']) AND !empty($_POST['key']))
    {	
    	include('includes/connection.php');
    	include('includes/security.php');
    	
    	$key = input_get('key');

			$query = mysql_query("SELECT * FROM registration WHERE registrationKey='$key'", $connection);
			
			$rows = mysql_num_rows($query);
	
			if ($rows == 1) 
			{
				header('location: /register.php?key='.$key.'');
			}
			else 
			{
				$error = "Invalid Key!";
			}
			
			mysql_close($connection);
    			
    }
    ?>

    <body>
	
<div class="container" style='padding-top:20px;'>
	<div class="row">
      <div class="col-md-6 col-md-offset-3">
        <div class="well well-sm">
          <form class="form-horizontal" action="" method="post" role="form">
          <fieldset>
            <legend class="text-center">Enter Registration Key</legend>
    
            <!-- Name input-->
            <div class=" col-md-8 col-md-offset-2">
            <div class="form-group">
               <input id="key" name="key" type="text" placeholder="key" class="form-control" pattern="[0-9]{9}" title="Must be a 9 digit number." required>
              
            </div>
            </div>
    
            <!-- Form actions -->
           
            <div class="form-group">
              <div class="col-md-12 text-left">
              	<a class="btn btn-default btn-lg pull-left" href="signin.php"> <i class="fa fa-angle-left"></i> Back</a>
                <button type="submit" name="submit" class="btn btn-primary btn-lg pull-right">Submit</button>
              </div>
            </div>
            <h3 class="text-center"><?php echo($error);?></h3> <?php  echo($confirm); ?>
          </fieldset>
          </form>
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