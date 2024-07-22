<?php
$servername = "localhost";
$username = "root";
$password = "root";  // replace 'your_password' with your actual MySQL root password
$dbname = "dbms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
