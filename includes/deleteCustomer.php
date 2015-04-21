<?php

if (isset($_POST['button'])){

$connection;

$query = mysql_query("DELETE FROM `customer` where `customerId` = '$deleteId'", $connection);

if(!$query) { $information = 'Success!';}

}
