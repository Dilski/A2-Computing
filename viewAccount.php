 <?php 
include('includes/session.php');
include('includes/accessControl.php');
include('includes/security.php');
 
 $a = true; //allow admin
 $m = true; //allow manager
 $u = false; //allow user
 $n = false; //allow anyone
 
 access($a,$m,$u,$n,$session_group);

$ID = input_get('ID');
$error='';

if($error==''){

$connection;


$query = mysql_query("SELECT * FROM login WHERE `ID` = '$ID'", $connection);

$row = mysql_fetch_assoc($query);

$viewId = $row['id'];
$username = $row['username'];
$viewGroup = $row['group'];

}

if (empty($viewId)) header('location: viewUsers.php');


if ((isset($_POST['submit']))&&($session_group =='A'))
    		{
    			$query = mysql_query("DELETE FROM `login` where `id` = '".$ID."'", $connection);

				if($query) { 
					
					header('location: viewCustomers.php');
					
					}
				else
				{
					$error.='Error:'.mysql_error();	
				}
    		}
    		
 $check = mysql_query( "SELECT * FROM userDetails WHERE id = '$viewId'", $connection); 
			    if (!$check)
			        $error.= mysql_error(); 
			        
	$row = mysql_fetch_assoc($check);
    
    //$username
    $forename = $row['forename'];
    $surname = $row['surname'];
    $dob = $row['dob'];
    $phone = $row['phoneNumber'];
    $employedd = $row['employed'];
    $email = $row['email'];
    $notes = $row['notes'];
    $address1 = $row['streetAddress1'];
    $address2 = $row['streetAddress2'];
    $town = $row['town'];
    $postcode = $row['postcode'];
    //viewid
    
    switch($employedd)
    {
        case '1':
            $employed = 'Yes';
            break;
        case '0':
            $employed = 'No';
            break;
    }
    
    switch($viewGroup)
    {
	case 'A':
	$group_icon = "<i class='fa fa-wrench'></i>  Admin";
	break;
	
	case 'M':
	$group_icon = "<i class='fa fa-laptop'></i>  Manager";
	break;
	
	case 'U':
	$group_icon = "<i class='fa fa-user'></i>  User";
	break;
    }
    
    


if (isset($_POST['edit']))
	{
			include('includes/security.php');
		    $notes = input('notes');

			include('includes/connection.php');
			
			$insertion = mysql_query( "UPDATE `userDetails` SET `notes` = '".$notes."' WHERE `id` = ".$viewId."", $connection);
			
			if (!$insertion)
			{
				$error.= 'Could not insert into database (please contact an admin). ' . mysql_error();	
			}
			
			
			if ($connection AND $insertion)
			{
				$save = 'Saved';
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
        <link href="/css/viewUser.css" rel="stylesheet">
        
        <link href="css/profilePanel.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
        
        <?php  ?>
        
    </head>

    <body>

	<?php
	include('includes/menu.php');
	
	?>
	


<div class="container">
      <div class="row">
      <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
        
       <br>
      </div>
        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3 toppad" >
   
   
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">View User</h3>
            </div>
            <div class="panel-body">
              <div class="row">
                
                <div class=" col-md-12 col-lg-12 "> 
                  <table class="table table-user-information">
                    <tbody>
                      	<tr>
	                        <td>Id:</td>
	                        <td><?php echo($viewId);?></td>
	                      </tr>
	                      <tr>
	                        <td>Group:</td>
	                        <td><?php echo($group_icon);?></td>
	                      </tr>
	                      
	                      <tr>
	                        <td>Employed:</td>
	                        <td><?php echo($employed);?></td>
	                      </tr>
	                      <tr>
	                        <td>Username:</td>
	                        <td><?php echo($username);?></td>
	                      </tr>
	                      <tr>
	                        <td>First name(s):</td>
	                        <td><?php echo($forename);?></td>
	                      </tr>
	                      <tr>
	                        <td>Last name:</td>
                            <td><?php echo($surname);?></td>
	                      </tr>
	                      <tr>
	                        <td>Date of Birth:</td>
                            <td><?php echo($dob);?></td>
	                      </tr>
	                      <tr>
	                        <td>Phone number::</td>
	                        <td><?php echo($phone);?></td>
	                      </tr>
	                      
	                      <tr>
	                        <td>Email address:</td>
	                        <td><?php echo($email);?></td>
	                      </tr>
	                      <tr>
	                        <td>Address:</td>
	                        <td><?php echo($address1);
	                                  echo($address2);?></td>
	                       </td>
	                      </tr>
	                      <tr>
	                        <td>Town:</td>
	                        <td><?php echo($town);?></td>
	                      </tr>
	                     <tr>
	                        <td>Postcode:</td>
	                        <td><?php echo($postcode);?></td>
	                     </tr>
	                     <tr>
	                        <td>Notes:</td><form method="post" role="form">
	                        <td><textarea name="notes" class="form-control" rows="5" ><?php echo $notes;?></textarea>
	                        	<?php echo $save; ?>
	                        	<span class="pull-right"><button type="submit" name="edit" class="btn btn-primary btn-sm pull-right">Save</button></span></td>
	                        	</form>
	                     </tr>
	                     
                     
                    </tbody>
                  </table>
                  
                </div>
              </div>
            </div>
                 <div class="panel-footer ">
                 
                 			
                       
                         <?php if($session_group=='A') echo'<a href="editAccount.php?ID='.$ID.'" data-original-title="Edit this customer" data-toggle="tooltip" type="button" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
                            <a data-original-title="Remove this customer" data-title="Delete" data-toggle="modal" data-target="#delete" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>';?>
                           
                        
                        
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
        <h4 class="modal-title custom_align" id="Heading">Delete User</h4>
      </div>
          <div class="modal-body">
       
       <span class="glyphicon glyphicon-warning-sign"></span> Are you sure you want to delete this User?
       
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