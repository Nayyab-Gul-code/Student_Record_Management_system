<?php
// Database Configuration - WAMP Server
$host = "localhost";
$user = "root";
$password = "";        // WAMP mein by default password EMPTY hota hai
$database = "student_db";

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>