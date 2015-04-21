   <?php 
include('includes/session.php');
include('includes/accessControl.php');
include('includes/security.php');
 
 $a = true; //allow admin
 $m = true; //allow manager
 $u = false; //allow user
 $n = false; //allow anyone
 
 access($a,$m,$u,$n,$session_group);
 
$error='';

$ID = input_get('ID');
 
 
 if($error=='')
 {
 $query = mysql_query("SELECT * FROM job WHERE `jobId` = '$ID'", $connection);

$rows = mysql_fetch_assoc($query);

$cId = $rows['customerId'];
$jName = $rows['jobName'];
$jStart = date_create($rows['jobStart']);
$description = $rows['jobDescription'];
$jEnd = date_create($rows['jobEnd']);
$jCustomerId = $rows['customerId'];
$streetAddress1 = $rows['streetAddress1'];
$streetAddress2 = $rows['streetAddress2'];
$postcode = $rows['postcode'];
$town = $rows['town'];
$jId = $rows['jobId'];
$customerQuery = mysql_query("SELECT name FROM customer WHERE customerId=$jCustomerId", $connection);
$roww = mysql_fetch_array($customerQuery);
$customerName = $roww['name'];
}
if($jName == '')
 	header('location: viewJobs.php');
 	
 	
 	
if (isset($_POST['submit']))
	{
		$query = mysql_query("DELETE FROM `job` where `jobId` = '".$ID."'", $connection);

		if($query) { 
			
			header('location: viewJobs.php');
			
			}
	}
    		
    		
    		

 
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
        <link href="css/profilePanel.css" rel="stylesheet">
        <link href="css/tablePanel.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        
  
       
        
		<!-- includes -->
    </head>

    <body>

	<?php include('includes/menu.php'); ?>
	<div class="container">
      <div class="row">
      <div class="col-md-6  toppad  pull-right col-md-offset-3 ">
        
       <br>
      </div>
        <div class="col-md-6" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">Job Details</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                
                
                
                <div class=" col-md-12 col-lg-12 "> 
                  <table class="table table-user-information">
                    <tbody>
                      	<tr>
	                        <td>Name:</td>
	                        <td><?php echo $jName;?></td>
	                      </tr>
	                      <tr>
	                        <td>Description:</td>
	                        <td><?php echo $description;?></td>
	                      </tr>
	                      <tr>
	                      	<td>Customer:</td>
	                      	<td><p title="View"><a href="viewCustomer.php?ID=<?php echo $jCustomerId; ?>" ><?php echo $customerName?></span></a></p></td>
	                      </tr>
	                      <tr>
	                        <td>Start:</td>
	                        <td><?php echo(date_format($jStart, 'l jS F Y'));?></td>
	                      </tr>
	                      <tr>
	                        <td>End:</td>
	                        <td><?php echo(date_format($jEnd, 'l jS F Y'));?></td>
	                      </tr>
	                     
	                      <tr>
	                        <td>Address:</td>
	                        <td><?php echo $streetAddress1;?>
	                            <?php echo $streetAddress2;?>   
	                        </td>
	                      </tr>
	                      <tr>
	                        <td>Town:</td>
	                        <td><?php echo $town;?></td>
	                      </tr>
	                     <tr>
	                        <td>Postcode:</td>
	                        <td><?php echo $postcode;?>
	                      </tr>
	                     
                     
                    </tbody>
                  </table>
                  
                </div>
              </div>
            </div>
                 <div class="panel-footer ">
                 
                 			
                       
                            <a href="editJob.php?ID=<?php echo $ID ?>" data-original-title="Edit this user" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this user" data-title="Delete" data-toggle="modal" data-target="#delete" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                           
                        
                        
                    </div>
            
          </div>
        </div>
        
        <link href="css/noMoreTables.css" rel="stylesheet">
        <style>
        	@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {
        	#no-more-tables td:nth-of-type(1):before { content: "Task"; }
        	#no-more-tables td:nth-of-type(2):before { content: "Assigned To"; }
        	#no-more-tables td:nth-of-type(3):before { content: "Start"; }
        	#no-more-tables td:nth-of-type(4):before { content: "End"; }
        	#no-more-tables td:nth-of-type(5):before { content: "View"; }
        	}
        </style>
        
        
        
        <div id='no-more-tables'>
        <div class="col-md-6">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Tasks</h3>
						<div class="pull-right">
							<span title="Create Task">
								<a style="color: #fff" href="createTask.php?jobId=<?php echo $ID;?>"> <i  class="glyphicon glyphicon-plus"></i> </a>
							</span>
						</div>
					</div>
					
					<div class="panel-body">
						<input type="text" class="form-control" id="filter" data-action="filter" placeholder="Filter That Dosen't Work" />
					</div>
					<table class="table table-hover" id="dev-table">
						<thead>
							<tr>
								<th> Task </th>
								<th> Assigned To </th>
								<th> Start </th>
								<th> End </th>
								<th> View </th>
							</tr>
						</thead>
						<tbody>
<?php
			include('connection.php');
			
			
			$query = mysql_query("SELECT * FROM task WHERE jobId = $ID ORDER BY taskStart ASC", $connection);
			
			
			
			while($rows = mysql_fetch_array($query))
			{
				$taskId = $rows['taskId'];
				$userId = $rows['userId'];
				$taskName = $rows['taskName'];
				$taskNameId = $rows['taskNameId'];
				$taskStart = date_create($rows['taskStart']);
				$taskEnd = date_create($rows['taskEnd']);
				$taskStartTime = substr($rows['taskStart'], 10, -3);
				$taskEndTime = substr($rows['taskEnd'], 10, -3);
					$userQuery = mysql_query("SELECT * FROM login WHERE id = $userId", $connection);
						$roww = mysql_fetch_array($userQuery);
						$userName = $roww['username'];
				
				echo('<tr>');
					echo('<td>'.$taskName.'</td>');  
					
					echo('<td><p title="View"><a class="btn btn-primary btn-sm" href="viewAccount.php?ID='.$userId.'" >'.$userName.'</span></a></p></td>');
					
					echo('<td>'); echo($taskStartTime.' - ');  echo(date_format($taskStart, 'l jS F Y')); echo('</td> ');
					
					echo('<td>'); echo($taskEndTime.' - ');  echo(date_format($taskEnd, 'l jS F Y')); echo('</td> ');
					
					echo('<td><p title="View"><a class="btn btn-primary btn-xs" href="viewTask.php?ID='.$taskId.'" ><span class="glyphicon glyphicon-eye-open"></span></a></p></td>');
					
				echo('</tr>');
			}
			$amtOfRows = mysql_num_rows($query);
			 if($amtOfRows < 1)
			 	echo('<tr><td>There are no tasks</td></tr>');
			?>
									</tbody>
					</table>
				</div>
			</div>
		</div>
		</div>
        
        
        
        
        
      </div>
    </div> 
    

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete Job</h4>
      </div>
          <div class="modal-body">
       
       <span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Job?
       
      </div>
        <div class="modal-footer ">
        <form method="post" role="form">
        <button type="submit" name="submit" id="submit" value="submit" class="btn btn-danger" ><span class="glyphicon glyphicon-ok-sign"></span> Yes</button>
        <button type="button" class="btn btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> No</button>
        </form>
      </div>
        </div>
    <!-- /.modal-content --> 
  </div>
      <!-- /.modal-dialog --> 
    </div>
    
    
    <?php include('includes/footer.php'); 
    
    
    
    	
    		?>

        <!-- Bootstrap core JavaScript -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/menu.js"></script>


    </body>

</html>