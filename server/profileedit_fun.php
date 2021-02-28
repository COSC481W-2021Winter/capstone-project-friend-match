<?php
session_start();
require_once 'friend_sql.php';
require_once 'functions.php';

$hasid = !isset($_SESSION["uid"]) || empty($_SESSION["uid"]);

if(isset($_SESSION["username"]) && $hasid){
	$uid = createUser($conn, $_SESSION["username"], $_SESSION["password"]);
	$_SESSION["uid"] = $uid;
	$first = $_SESSION["firstName"];
	$last = $_SESSION["lastName"];
	$city = "a";
	$bio = $_SESSION["description"];
	$intrest = "a";
	
	if(emptyInputSignup($first, $last, $city) != false){
		header("location: ../app/profileedit.php?error=emptyinput");
		exit();
	}
	
	createProfile($conn, $uid, $first, $last, $city, $bio, $intrest);
	header("location: ../app/home.php?error=none");
}
elseif($hasid) {
	$uid = $_SESSION["uid"];
	$bio = $_SESSION["description"];
	$intrest = "";
	
	if(emptyInputSignup($uid, $bio) != false){
		header("location: ../app/profileedit.php?error=emptyinput");
		exit();
	}
	
	header("location: ../app/home.php?error=none");
	updateProfile($conn, $uid, $city, $bio, $intrest);
}
else {
	header("location: ../app/SignUp.php?error=nosession");
}
?>