<?php

// Mysql settings

$user			= "user";
$password	= "password";
$database	= "database";
$host			= "localhost";

//mysqli_connect($host,$user,$password, $database);
$connection = mysqli_connect($host,$user,$password, $database);
//mysqli_select_db($connection, $database) or die( "Unable to select database");

?>