




<?php 

 	session_start();
	include('includes/connection.php');
	$user_check = $_SESSION['users_name'];
	$sql_check = mysql_query("SELECT * FROM login WHERE username='$user_check'", $connection);
	$row = mysql_fetch_assoc($sql_check);
	
	
	$session_username=$row['username'];
	$session_group=$row['group'];
	
	
	
	if (isset($session_username))
	{
	mysql_close($connection);
	header('location: dashboard.php');
	}
	
	session_start();
include('includes/security.php');
$error='';
if (isset($_POST['submit']))
	{
		if( (empty($_POST['inputUser'])) || (empty($_POST['inputPassword'])) )
		{
			$error = "Invalid username or password";
		}
		else
		{
			$username=input('inputUser');
			$password=crypt("sha256", input('inputPassword'));


			if($error=='')
			{
			include('connection.php');

			$query = mysql_query("SELECT * FROM login WHERE password='$password' AND username='$username'", $connection);
			
			$rows = mysql_num_rows($query);
	
			if ($rows == 1) 
			{
				$_SESSION['users_name']=$username;
				    header("location: dashboard.php");   
			}
			else 
			{
				$error = "Invalid username or password";
			}
			
			mysql_close($connection);
			}

		}
	}
	
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Dave Casey & Co.</title>

   <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="css/login.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">

    

</head>
  <body>
    <div class="container">
		 
        <form class="form-signin" role="form" action="" method="post">
          <h2 class="form-signin-heading" style="text-align:center">Please sign in</h2>
          <label for="inputUser" class="sr-only">Username</label>
          <input name="inputUser" type="User" id="inputUser" class="form-control" placeholder="Username" required autofocus>

          <label for="inputPassword" class="sr-only">Password</label>
          <input name="inputPassword" type="password" id="inputPassword" class="form-control" placeholder="Password" required>

          <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Sign in</button>
          <p style="color:red; text-align:center" class="help-block"><?php echo $error; ?></p>
          
          <p class="help-block" style="text-align:center;">First time user?</p>
          <a type="button" href='registerKey.php'class="btn btn-lg btn-block btn-success">Create account</a>
         </form>

    </div> <!-- /container -->
  </body>
</html>
