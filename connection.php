<?php
// Database credentials
$dbhost = "lochnagar.abertay.ac.uk"; // Server where database is hosted
$dbuser = "sql2308988";              // Username to connect to the database
$dbpass = "shelf-maybe-text-flex";   // Password to connect to the database
$dbname = "sql2308988";              // Name of the database

// Create connection
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

mysqli_set_charset($con, "utf8mb4");
?>
