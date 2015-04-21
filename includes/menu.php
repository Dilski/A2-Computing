<?php 

echo('
<style>
#noscript {
  font-family: sans-serif;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 101;
  text-align: center;
  font-weight: bold;
  font-size: 120%;
  color: #fff;
  background-color: #ae0000;
  padding: 5px 0 5px 0;

}
</style>


<noscript> 
		<div id="noscript">
			You must enable Javascript to use this website properly!
		</div>
	</noscript>');

switch($session_group)
{
	case 'A':
	$group_icon = '<i class="fa fa-wrench"></i>';

	break;
	
	case 'M':
	$group_icon = '<i class="fa fa-laptop"></i>';
	break;
	
	case 'U':
	$group_icon = '<i class="fa fa-user"></i>';
	break;
}


switch($session_group)
{
	case 'A':
	$menu_items='
	<li><a href="viewUsers.php"><i class="fa fa-users"></i> Users</a></li>
	<li><a href="viewCustomers.php"><i class="fa fa-building-o"></i> Customers</a></li>
	
	<li>
        <hr style="background:#FFFFFF; border:0; height:7px" />
    </li>
    
    <li><a href="http://dilski.com/createAccount.php?type=U"><i class="fa fa-users"></i> New User</a></li>
    <li><a href="http://dilski.com/createAccount.php?type=M"><i class="fa fa-users"></i> New Manager </a></li>
	<li><a href="reset.php"><i class="fa fa-refresh"></i> Factory Reset</a></li>
	
	';
	break;
	
	case 'M':
	$menu_items='
	<li><a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a></li>
	<li><a href="calendar.php"><i class="fa fa-calendar"></i> Calendar</a></li>
	<li><a href="viewJobs.php"><span class="glyphicon glyphicon-list"></span> Jobs</a></li>
	<li><a href="viewUsers.php"><i class="fa fa-users"></i> Users</a></li>
	<li><a href="viewCustomers.php"><i class="fa fa-building-o"></i> Customers</a></li>
	<li><a href="viewHolidayRequests.php"><i class="fa fa-plane"></i> Holiday Requests </a></li>
	
	<li>
        <hr style="background:#FFFFFF; border:0; height:7px" />
    </li>
    
	
	<li><a href="newHolidayRequest.php"><i class="fa fa-plane"></i> New holiday request</a></li>
	<li><a href="createCustomer.php"><i class="fa fa-building-o"></i> New Customer </a></li>
	<li><a href="http://dilski.com/createJob.php"><span class="glyphicon glyphicon-list"></span> New Job </a></li>
	';
	break;
	
	case 'U':
	$menu_items='
	<li><a href="dashboard.php"><i class="fa fa-home"></i> Dashboard</a></li>
	<li><a href="calendar.php"><i class="fa fa-calendar"></i> Calendar</a></li>
	
	<li>
        <hr style="background:#FFFFFF; border:0; height:7px" />
    </li>
	
	<li><a href="newHolidayRequest.php"><i class="fa fa-plane"></i> New holiday request</a></li>
	';
	break;
}

echo '

         <a id="menu-toggle" href="#" class="btn btn-primary btn-lg toggle"><i class="icon-reorder"></i></a>
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                 <a id="menu-close" href="#" class="btn btn-default btn-lg pull-right toggle"><i class="icon-remove"></i></a>
                <li class="sidebar-brand"><a href="#">Dave Casey & Co</a>
                </li>
                
				
				' . $menu_items . '
				
                <li>
                    <hr style="background:#FFFFFF; border:0; height:7px" />
                </li>
                <li class="sidebar-brand"><a> ' . $group_icon . ' ' . $session_username . '</a></li>
                ';
                if($session_group<>'A'){echo'<li><a href="settings.php"><i class="fa fa-cog"></i> Settings</a>';}
                
                
                
echo            '
                </li>
                <li><a href="logout.php"><i class="fa fa-sign-out"></i> Log out</a>
                </li>

            </ul>
      </div>
        <!-- /Side Menu -->
';

