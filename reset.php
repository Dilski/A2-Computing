   <?php 
include('includes/session.php');
include('includes/accessControl.php');
 
 $a = true; //allow admin
 $m = false; //allow manager
 $u = false; //allow user
 $n = false; //allow anyone
 
 access($a,$m,$u,$n,$session_group);
 
 ?>
 
 
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
        <link href="css/login.css" rel="stylesheet">
        
        <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    </head>
    

<body>
<div class="jumbotron">
    <div class="row">
        <div class="col-md-12">
            <div class="error-stuff">
                <h1>
                    Danger</h1>
                <h2>
                    Factory Reset</h2>
                <div class="error-details">
                    This will delete all users, jobs, tasks, customers and holidays!
                </div>
                <div class="error-leave">
                    <form class="" action="" method="post" role="form" >
                    
                    		<a onclick="window.history.back()" class="btn btn-primary btn-lg">
                         Cancel</a>
				             <button class="btn btn-lg btn-danger" type=submit id='submit' name='submit'>
				        Factory Reset</button> 
				    <form>
                </div>
            </div>
        </div>
    </div>
</div> 







    </body>

</html>

<?php

if(isset($_POST['submit']))
{
	
	$connection = mysql_connect("localhost", "root", "this");
	if(!$connection)
		{
			$error.='Could not connect to the database (please contact an admin). ' . mysql_error();
			break;
		}
	mysql_query("DROP DATABASE `project`", $connection);
	mysql_query("CREATE DATABASE `project` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;", $connection);
	
	$database = mysql_select_db("project", $connection);
	
	mysql_query("DROP TABLE IF EXISTS `customer`", $connection);
	mysql_query("CREATE TABLE IF NOT EXISTS `customer` (
  `customerId` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `streetAddress1` varchar(255) DEFAULT NULL,
  `streetAddress2` varchar(255) DEFAULT NULL,
  `town` varchar(255) DEFAULT NULL,
  `postcode` varchar(8) DEFAULT NULL,
  `phoneNumber` varchar(15) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `notes` longtext,
  PRIMARY KEY (`customerId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;", $connection);
	mysql_query("DROP TABLE IF EXISTS `holiday`;", $connection);
	mysql_query("CREATE TABLE IF NOT EXISTS `holiday` (
  `holidayId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `status` varchar(1) NOT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  PRIMARY KEY (`holidayId`),
  KEY `userId` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;", $connection);
	mysql_query("DROP TABLE IF EXISTS `job`;", $connection);
	mysql_query("CREATE TABLE IF NOT EXISTS `job` (
  `jobId` int(11) NOT NULL AUTO_INCREMENT,
  `jobName` varchar(255) NOT NULL,
  `jobDescription` longtext NOT NULL,
  `customerId` int(11) NOT NULL,
  `streetAddress1` varchar(255) NOT NULL,
  `streetAddress2` varchar(255) NOT NULL,
  `town` varchar(255) NOT NULL,
  `postcode` varchar(8) NOT NULL,
  `jobStart` date NOT NULL,
  `jobEnd` date NOT NULL,
  PRIMARY KEY (`jobId`),
  KEY `customerId` (`customerId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;", $connection);
	mysql_query("DROP TABLE IF EXISTS `login`;", $connection);
	mysql_query("CREATE TABLE IF NOT EXISTS `login` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `group` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;", $connection);
	mysql_query("INSERT INTO `login` (`id`, `username`, `password`, `group`) VALUES
(1, 'Admin', 'pabfAyLG.bjjI', 'A');", $connection);
	mysql_query("DROP TABLE IF EXISTS `registration`;", $connection);
	mysql_query("CREATE TABLE IF NOT EXISTS `registration` (
  `registrationKey` varchar(9) NOT NULL,
  `group` char(1) NOT NULL,
  PRIMARY KEY (`registrationKey`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;", $connection);
	mysql_query("DROP TABLE IF EXISTS `task`;", $connection);
	mysql_query("CREATE TABLE IF NOT EXISTS `task` (
  `taskId` int(11) NOT NULL AUTO_INCREMENT,
  `jobId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `taskName` varchar(256) NOT NULL,
  `taskDescription` longtext NOT NULL,
  `taskStart` date NOT NULL,
  `taskEnd` date NOT NULL,
  `taskStartTime` time NOT NULL,
  `taskEndTime` time NOT NULL,
  PRIMARY KEY (`taskId`),
  KEY `userId` (`userId`),
  KEY `jobId` (`jobId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;", $connection);
	mysql_query("DROP TABLE IF EXISTS `userDetails`;", $connection);
	mysql_query("CREATE TABLE IF NOT EXISTS `userDetails` (
  `id` int(11) NOT NULL,
  `forename` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `phoneNumber` varchar(15) NOT NULL,
  `email` varchar(255) NOT NULL,
  `employed` tinyint(1) NOT NULL,
  `notes` longtext NOT NULL,
  `streetAddress1` varchar(255) NOT NULL,
  `streetAddress2` varchar(255) NOT NULL,
  `town` varchar(255) NOT NULL,
  `postcode` varchar(8) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;", $connection);
	mysql_query("ALTER TABLE `emergencyContact`
  ADD CONSTRAINT `emergencyContact_ibfk_1` FOREIGN KEY (`id`) REFERENCES `userDetails` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;", $connection);
	mysql_query("ALTER TABLE `holiday`
  ADD CONSTRAINT `holiday_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;", $connection);
	mysql_query("ALTER TABLE `job`
  ADD CONSTRAINT `job_ibfk_1` FOREIGN KEY (`customerId`) REFERENCES `customer` (`customerId`) ON DELETE CASCADE ON UPDATE CASCADE;", $connection);
	mysql_query("ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`userId`) REFERENCES `login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `task_ibfk_3` FOREIGN KEY (`jobId`) REFERENCES `job` (`jobId`) ON DELETE CASCADE ON UPDATE CASCADE;", $connection);
	mysql_query("ALTER TABLE `userDetails`
  ADD CONSTRAINT `userDetails_ibfk_1` FOREIGN KEY (`id`) REFERENCES `login` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;", $connection);
	
	
}


?>