<?php
$host = "localhost";
$username = "comboapp_db";
$password = "DLl7gufjeD6A";
$database = "comboapp_db";

$conn = mysqli_connect($host, $username, $password, $database);
if(!$conn) {
    die("Connection Error: " . mysqli_connect_error());
}


?>