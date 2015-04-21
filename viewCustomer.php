  <?php 
include('includes/session.php');
include('includes/accessControl.php');
include('includes/security.php');
 
 $a = true; //allow admin
 $m = true; //allow manager
 $u = false; //allow user
 $n = false; //allow anyone
 
 access($a,$m,$u,$n,$session_group);

include('includes/connection.php');


$ID = input_get('ID');

if($error=='')
{

	$query = mysql_query("SELECT * FROM customer WHERE `customerId` = '$ID'", $connection);
	
	$row = mysql_fetch_assoc($query);
	
	$editId = $row['customerId'];
	$username = $row['name'];
	
	if (isset($_POST['submit']))
		{
			$query = mysql_query("DELETE FROM `customer` where `customerId` = '".$ID."'", $connection);
	
			if($query) 
			{ 
				header('location: viewCustomers.php');
			}
			else
			{
				$error.='Error:'.mysql_error();	
			}
		}

}




$check = mysql_query( "SELECT * FROM customer WHERE customerId = '$editId'", $connection); 
	if (!$check)
		{
			$error.= mysql_error(); 
		}
			        
$row = mysql_fetch_assoc($check);
    
//$username
$phone = $row['phoneNumber'];
$email = $row['email'];
$notes = $row['notes'];
$address1 = $row['streetAddress1'];
$address2 = $row['streetAddress2'];
$town = $row['town'];
$postcode = $row['postcode'];

$error='';

$editId= input_get('ID');

if (isset($_POST['submit']))
	{
		$notes = $_POST['notes'];
		$insert = mysql_query( "UPDATE customer SET notes='$notes' WHERE customerId=$editId", $connection); 
		if (!$insert)
		{
			$error.= mysql_error();
		}
			
		if ($connection AND $insertion AND $insert)
		{
			header('location: viewAccount.php');
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
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="css/profilePanel.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        
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
              <h3 class="panel-title">View Customer</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                
                <div class=" col-md-12 col-lg-12 "> 
                  <table class="table table-user-information">
                    <tbody>
                      	<tr>
	                        <td>Name:</td>
	                        <td><?php echo $username;?></td>
	                      </tr>
	                      <tr>
	                        <td>Phone number::</td>
	                        <td><?php echo $phone;?></td>
	                      </tr>
	                      
	                      <tr>
	                        <td>Email address:</td>
	                        <td><a href="mailto:<?php echo $email;?>" target="_top"><?php echo $email;?></a>
	                      </tr>
	                      <tr>
	                        <td>Address:</td>
	                        <td><?php echo $address1;?>
	                            <?php echo $address2;?>   
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
	                      <tr>
	                        <td>Notes:</td>
	                        <td><?php echo $notes;?></td>
	                     </tr>
	                     
                     
                    </tbody>
                  </table>
                  
                </div>
              </div>
            </div>
                 <div class="panel-footer ">
                 
                 			
                       
                            <a href="editCustomer.php?ID=<?php echo $ID ?>" data-original-title="Edit this customer" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this customer" data-title="Delete" data-toggle="modal" data-target="#delete" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                           
                        
                        
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
        <h4 class="modal-title custom_align" id="Heading">Delete Customer</h4>
      </div>
          <div class="modal-body">
       
       <span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this Customer?
       
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