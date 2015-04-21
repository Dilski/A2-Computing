<?php
$error='';
if (isset($_POST['submit']))
	{
		
			$key = mt_rand(100000000, 999999999);
			
			
			
			$newUserGroup = $_GET['type'];
			
			include('connection.php');
			
			$insertion = mysql_query( "INSERT INTO `registration` (`registrationKey`, `group`) VALUES ('$key', '$newUserGroup')", $connection);
			
			if (!$insertion)
			{
				$error.= 'Could not insert into database (please contact an admin). ' . mysql_error();	
			}
			
			if ($connection AND $insertion)
			{
				$confirm = 'An account has been created with the following details:
						<table class="table">
							<thread>
								<tr>
									<th>Key</th>
									<th>User group</th>
								</tr>
							</thread>
							<tbody>
								<tr>
									<th>'.$key.'</th>
									<th>'.$newUserGroup.'</th>
								</tr>
							</tbody>
						</table>';
						
				$disabled =' disabled ';
				$back = '<a class="btn btn-default btn-lg pull-center" href="viewUsers.php"> <i class="fa fa-angle-left"></i> Back</a>';
			}
							

			
		
	}
