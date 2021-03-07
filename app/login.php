<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "friend-match";

require_once __DIR__ . "/../server/functions.php";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND password=?;");
$stmt->bind_param("ss", $username, $password);

$username = $_POST["username"];
$password = $_POST["password"];

$stmt->execute();
$result = $stmt->get_result();

if(!$result || mysqli_num_rows($result) != 1) {
  header("Location: index.php?error=invalid");
} else {
  $_SESSION["uid"] = getUserId($conn,$username);
  header("Location: home.php");
}

$stmt->close();
$conn->close();
?>

