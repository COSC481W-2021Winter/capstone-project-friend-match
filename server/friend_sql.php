<?php
$servername = "localhost";
$username = isset($_SERVER["SQL_USERNAME"]) ? $_SERVER["SQL_USERNAME"] : "root";
$password = isset($_SERVER["SQL_PASSWORD"]) ? $_SERVER["SQL_PASSWORD"] : "";
$dbName = "friend-match";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";

?>
