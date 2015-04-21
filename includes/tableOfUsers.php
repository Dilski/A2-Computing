<?php

function userTable($a){
include('connection.php');


$query = mysql_query("SELECT * FROM login WHERE `group` = '".$a."'", $connection);


while($rows = mysql_fetch_array($query))
{
	$uid = $rows['id'];
	$uname = $rows['username'];
	
	echo('<tr>');
		echo('<td>'.$uid.'</td>');
		echo('<td>'.$uname.'</td>');
		echo('<td> 
				<div class="dropdown">
  					<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-expanded="true"> 
  						Actions <span class="caret"></span>
  					</button>
						  <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
						    <li role="presentation"><a role="menuitem" tabindex="-1" href="viewAccount.php?ID='.$uid.'"> <i class="fa fa-user"></i> View</a></li>
						    <li role="presentation"><a role="menuitem" tabindex="-1" href="editAccount.php?ID='.$uid.'"> <i class="fa fa-pencil"></i> Edit</a></li>
						    <li role="presentation"><a role="menuitem" tabindex="-1" href="deleteAccount.php?ID='.$uid.'"> <i class="fa fa-times"></i> Delete</a></li>
						  </ul>
						</div>
			</td>');
	echo('</tr>');
}
echo('<th> <a class="btn btn-primary" href="createAccount.php?type='.$a.'"><i class="fa fa-plus"></i> Create </a> </th> <th /> <th />');

}