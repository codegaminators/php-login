<?php
if (!isset($_SESSION)) {
    session_start();
}

$host = "localhost";
$port  = 3306;
$username = "root";
$password = "root";
$database_name = "authentication";

$dbConnection = new mysqli($host,$username,$password,$database_name,$port);
$dbConnection->get_connection_stats() or die("Connection to DB Failed");
// echo "connected";