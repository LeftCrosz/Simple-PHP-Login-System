<?php
$host = "localhost";
$user = "root";
$pass = "";
$database = "user_db";

$conn = new mysqli($host, $user, $pass, $database);

if ($conn -> connect_error) {
    echo "Failed to connect to MySQL: " . $conn -> connect_error;
    exit();
}
?>
