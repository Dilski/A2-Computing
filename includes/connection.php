<?php
	$connection = mysql_connect("localhost", "root", "this"); //connect to database server
	if(!$connection) //if that fails 
		{
			$error.='Could not connect to the database (please contact an admin). ' . mysql_error();//Add an error message to the list of current errors
			break;
		}

	$database = mysql_select_db("project", $connection);//select the database
	
	