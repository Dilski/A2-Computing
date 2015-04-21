  <?php 
include('includes/session.php');
include('includes/accessControl.php');
include('includes/security.php');
 
 $a = true; //allow admin
 $m = true; //allow manager
 $u = true; //allow user
 $n = false; //allow anyone
 
 access($a,$m,$u,$n,$session_group);

include('includes/connection.php');

$connection;

$error='';

$ID = input_get('ID');

$connection;

if($error=='')
{
if (isset($_POST['submit']))
    		{
    			$query = mysql_query("DELETE FROM `task` where `taskId` = '".$ID."'", $connection);

				if($query) { 
					
					header('location: viewTask.php?ID='.$ID);
					
					}
				else
				{
					$error.='Error:'.mysql_error();	
				}
    		}
    		
    		
    		
    		
$query = mysql_query("SELECT * FROM task WHERE taskId = $ID ORDER BY taskStart ASC", $connection);
			
			
$amtRows = mysql_num_rows($query);


$rows = mysql_fetch_array($query);

		$taskId = $rows['taskId'];
		$userId = $rows['userId'];
		$jobId = $rows['jobId'];
		$taskName = $rows['taskName'];
		$taskNameId = $rows['taskNameId'];
		$taskDescription = $rows['taskDescription'];
		$taskStart = date_create($rows['taskStart']);
		$taskEnd = date_create($rows['taskEnd']);
		$taskStartTime = substr($rows['taskStart'], 10, -3);
		$taskEndTime = substr($rows['taskEnd'], 10, -3);
			$userQuery = mysql_query("SELECT * FROM login WHERE id = $userId", $connection);
				$roww = mysql_fetch_array($userQuery);
				$userName = $roww['username'];
			$jobQuery = mysql_query("SELECT * FROM job WHERE jobId = $jobId", $connection);
				$rowww = mysql_fetch_array($jobQuery);
				$jobName = $rowww['jobName'];
}	

if ($amtRows < 1)
	header('location: viewJobs.php')
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
        <link href="css/profilePanel.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        
        <?php include('includes/viewTask.php');?>
    </head>

    <body>
    
    <?php include('includes/menu.php'); ?>
    
    
    
<div class="container">
      <div class="row">
      <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
        
       <br>
      </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">View Task</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                
                <div class=" col-md-12 col-lg-12 "> 
                  <table class="table table-user-information">
                    <tbody>
                      	<tr>
	                        <td>Task name:</td>
	                        <td><?php echo $taskName;?></td>
	                      </tr>
	                      <tr>
	                        <td>Job name:</td>
	                        <td><?php if($session_group<>'U') {echo ('<a class="" href="viewJob.php?ID='.$jobId.'" >'.$jobName.'</span></a>');}else{echo ($jobName);}?></td>
	                      </tr>
	                      <tr>
	                        <td>Assigned user:</td>
	                        <td><?php if($session_group<>'U') {echo ('<a class="" href="viewAccount.php?ID='.$userId.'" >'.$userName.'</span></a>');}else{echo ($userName);}?></td>
	                      </tr>
	                      <tr>
	                        <td>Job description:</td>
	                        <td><?php echo $taskDescription;?></td>
	                      </tr>
	                      <tr>
	                        <td>Task Start:</td>
	                        <td><?php echo($taskStartTime.' - ');  echo(date_format($taskStart, 'l jS F Y')); ?></td>
	                      </tr>
	                      <tr>
	                        <td>Task End:</td>
	                        <td><?php echo($taskEndTime.' - ');  echo(date_format($taskEnd, 'l jS F Y')); ?></td>
	                      </tr>
	                     
                     
                    </tbody>
                  </table>
                  
                </div>
              </div>
            </div>
               <?php if($session_group<>'U'){ echo('  <div class="panel-footer ">
                 
                 			
                       
                            <a href="editTask.php?ID=<?php echo $ID ?>" data-original-title="Edit this customer" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this customer" data-title="Delete" data-toggle="modal" data-target="#delete" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                           
                        
                        
                    </div>');}?>
            
          </div>
        </div>
      </div>
    </div> 
    

<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
      <div class="modal-dialog">
    <div class="modal-content">
          <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
        <h4 class="modal-title custom_align" id="Heading">Delete task</h4>
      </div>
          <div class="modal-body">
       
       <span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this task?
       
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