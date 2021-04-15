<?php
$servername = "localhost";
$username = isset($_SERVER["SQL_USERNAME"]) ? $_SERVER["SQL_USERNAME"] : "root";
$password = isset($_SERVER["SQL_PASSWORD"]) ? $_SERVER["SQL_PASSWORD"] : "";
$database = "friend-match";

require_once __DIR__ . "/../server/functions.php";
// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}

$username = $_POST["username"];
$password = $_POST["password"];

$row = userExists($conn, $username);
if($row == false){
	header("Location: ../app/index.php?error=invalid");
	exit();
}
if(password_verify($password, $row['password']) == false){
	header("Location: ../app/index.php?error=invalid");
	exit();
}

session_start();
$_SESSION["uid"] = $row['userid'];
header("Location: ../app/home.php")
?>
