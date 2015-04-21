  <?php
  $error='';
if (isset($_POST['submit']))
	{
			include('security.php');
			$jobName = input_required('jName', 'You must include a job name'); 
			$customerid = input_required('customerid', 'You must select a customer');
			$description = input_required('description', 'You must include a description');
			$start = input_required('start', 'You must select an start date');
			$end = input_required('end', 'You must select an end date');
			$address1 = input_required('address1', 'You must include an address');
			$address2 = input('address2');
			$town = input_required('town', 'You must include a town');
			$postcode = input_required('postcode', 'You must include a postcode');
			
			if($error=='')
			{
				include('connection.php');
				
				$insertion = mysql_query( "INSERT INTO `job` (`jobName`, `jobDescription`, `customerId`, `jobStart`, `jobEnd`,`streetAddress1`, `streetAddress2`, `town`, `postcode`) VALUES ('$jobName', '$description', '$customerid', '$start', '$end', '$address1', '$address2', '$town', '$postcode')", $connection);
				
				if (!$insertion)
				{
					$error.= 'Could not insert into database (please contact an admin). ' . mysql_error();	
				}else{
					$confirm = true;
					header('location: viewJobs.php');
				}
			}
	}
