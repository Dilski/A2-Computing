   <?php 
include('includes/session.php');
include('includes/accessControl.php');
 
 $a = true; //allow admin
 $m = true; //allow manager
 $u = false; //allow user
 $n = false; //allow anyone
 
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
        <link href="css/tablePanel.css" rel="stylesheet">
        
        <link href="css/noMoreTables.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        
        <style>
        	
        	@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {
        	#no-more-tables td:nth-of-type(1):before { content: "Job"; }
        	#no-more-tables td:nth-of-type(2):before { content: "Customer"; }
        	#no-more-tables td:nth-of-type(3):before { content: "Start"; }
        	#no-more-tables td:nth-of-type(4):before { content: "End"; }
        	#no-more-tables td:nth-of-type(5):before { content: "View"; }
        	}
        </style>
       
        
        
		<!-- includes -->
    </head>

    <body>

	<?php include('includes/menu.php'); ?>
	
	
	<div class="container">
	<div id="no-more-tables">
    	<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Jobs</h3>
						<div class="pull-right">
							<span title="Create Jobs">
								<a style="color: #fff" href="createJob.php"> <i  class="glyphicon glyphicon-plus"></i> </a>
							</span>
						</div>
					</div>
					
					<div class="panel-body">
						<input type="text" class="form-control" id="filter" data-action="filter" placeholder="Filter That Dosen't Work" />
					</div>
					<table class="table table-hover" id="dev-table">
						<thead>
							<tr>
								<th> Job Name </th>
								<th> Customer Name </th>
								<th> Start </th>
								<th> End </th>
								<th> View </th>
							</tr>
						</thead>
						<tbody>
<?php
			include('connection.php');
			
			
			$query = mysql_query("SELECT * FROM job WHERE DATE(jobEnd) >=DATE(NOW()) ORDER BY jobStart ASC", $connection);
			
			
			while($rows = mysql_fetch_array($query))
			{
				$cId = $rows['customerId'];
				$jName = $rows['jobName'];
				$jStart = date_create($rows['jobStart']);
				$jEnd = date_create($rows['jobEnd']);
				$jCustomerId = $rows['customerId'];
				$jId = $rows['jobId'];
					$customerQuery = mysql_query("SELECT name FROM customer WHERE customerId=$cId", $connection);
					$roww = mysql_fetch_array($customerQuery);
					$customerName = $roww['name'];
				
				echo('<tr>');
					echo('<td>'.$jName.'</td>');
					
					echo('<td><p title="View"><a class="btn btn-primary btn-sm" href="viewCustomer.php?ID='.$cId.'" >'.$customerName.'</span></a></p></td>');
					
					echo('<td>'); echo(date_format($jStart, 'l jS F Y')); echo('</td> ');
					
					echo('<td>'); echo(date_format($jEnd, 'l jS F Y')); echo('</td> ');
					
					echo('<td><p title="View"><a class="btn btn-primary btn-xs" href="viewJob.php?ID='.$jId.'" ><span class="glyphicon glyphicon-eye-open"></span></a></p></td>');
					
				echo('</tr>');
			}
			
			?>
									</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	


    
    <?php include('includes/footer.php'); ?>

        <!-- Bootstrap core JavaScript -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/menu.js"></script>


    </body>

</html>