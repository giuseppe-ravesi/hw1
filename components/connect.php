<?php 

$host = 'localhost';
$db_name = 'hw1_db';
$user_name = 'root';
$user_password= '';

$conn = new mysqli($host, $user_name, $user_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>