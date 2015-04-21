<?php 

include('includes/session.php');


switch($session_group)
{
	case 'U':
		include('includes/dashboard.php');
		break;
	case 'M':
		include('includes/dashboardM.php');
		break;
	case 'A':
		header('location: viewUsers.php');
		break;
}






?>