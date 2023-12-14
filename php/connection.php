<?php
$host = "mysql28.unoeuro.com";
$user = "nikolajhartwich_dk";
$password = "4nbg9RFhB2GE3D6rkyct";
$database = "nikolajhartwich_dk_db";

// Create a connection
$conn = new mysqli($host, $user, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
