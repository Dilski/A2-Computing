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
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
        
        <link href="css/tablePanel.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        
		<!-- includes -->
    </head>

    <body>

	<?php include('includes/menu.php'); ?>
	
	
	<div class="container">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-primary">
					<div class="panel-heading">
						<h3 class="panel-title">Customers</h3>
						<div class="pull-right">
							<span title="Create Jobs">
								<a style="color: #fff" href="createCustomer.php"> <i  class="glyphicon glyphicon-plus"></i> </a>
							</span>
						</div>
					</div>
					
					<div class="panel-body">
						<input type="text" class="form-control" id="filter" data-action="filter" placeholder="Filter That Dosen't Work" />
					</div>
					<table class="table table-hover" id="dev-table">
						<thead>
							<tr>
								<th> ID </th>
								<th> Customer Name </th>
								<th> View </th>
							</tr>
						</thead>
						<tbody>
<?php
			include('connection.php');
			
			
			$query = mysql_query("SELECT * FROM customer", $connection);
			
			
			while($rows = mysql_fetch_array($query))
			{
				$cid = $rows['customerId'];
				$cname = $rows['name'];
				
				echo('<tr>');
					echo('<td>'.$cid.'</td>');
					echo('<td>'.$cname.'</td>');
					echo('<td><p title="View"><a class="btn btn-primary btn-xs" href="viewCustomer.php?ID='.$cid.'" ><span class="glyphicon glyphicon-eye-open"></span></a></p></td>');
					
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
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	



    
    <?php include('includes/footer.php'); ?>

        <!-- Bootstrap core JavaScript -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        <script src="js/menu.js"></script>


    </body>

</html>