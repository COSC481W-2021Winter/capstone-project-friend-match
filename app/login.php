<?php
$username = $_POST["username"];
$password = $_POST["password"];

//TODO Change when database is figured out!
if($username != "Jeff" || $password != "password123") {
  header("Location: index.php?error=invalid");
} else {
  header("Location: home.php");
}
?>
