<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "friendMatch";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

?>
