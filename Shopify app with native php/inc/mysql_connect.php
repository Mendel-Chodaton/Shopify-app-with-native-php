<?php
$host = "localhost";
$username = "USERNAME";
$password = "DATABASE_PASSWORD";
$database = "DATABASE_NAME";

$conn = mysqli_connect($host, $username, $password, $database);
if(!$conn) {
    die("Connection Error: " . mysqli_connect_error());
}


?>
