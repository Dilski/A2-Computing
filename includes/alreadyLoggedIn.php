 <?php
 	session_start();
	include('connection.php');
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
	