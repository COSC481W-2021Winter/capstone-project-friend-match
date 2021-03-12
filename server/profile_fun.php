<?php
session_start();
require_once 'friend_sql.php';
require_once 'functions.php';

$hasid = !isset($_SESSION["uid"]);
if(isset($_SESSION["username"]) && $hasid){
  $uid = $_SESSION["uid"];
  $first = $_SESSION["firstName"];
  $last = $_SESSION["lastName"];
  $city = $_SESSION["city"];
  $bio = $_SESSION["description"];
  $interest = $_SESSION["interests"];

  if(emptyInput($first, $last, $user, $pwd, $pwdRepeat) != false){
		header("location: ../app/profile.php?error=emptyinput");
		exit();
	}

}
$id = $_SESSION["uid"];
 ?>
