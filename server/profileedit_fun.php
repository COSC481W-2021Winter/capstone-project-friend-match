<?php
session_start();
require_once 'friend_sql.php';
require_once 'functions.php';

$hasid = !isset($_SESSION["userid"]) || empty($_SESSION["userid"]);

if(isset($_SESSION["username"]) && $hasid){
	$uid = createUser($conn, $_SESSION["username"], $_SESSION["password"]);
	$_SESSION["userid"] = $uid;
	$first = $_SESSION["firstName"];
	$last = $_SESSION["lastName"];
	$bio = $_SESSION["description"];
	$intrest = "a";
	
	if(emptyInputSignup($bio, $first, $bio) != false){
		header("location: ../app/profileedit.php?error=emptyinput");
		exit();
	}
	
	createProfile($conn, $uid, $first, $last, $bio, $intrest);
	header("location: ../app/home.php?error=none");
}
elseif($hasid) {
	$uid = $_SESSION["userid"];
	$bio = $_SESSION["description"];
	$intrest = "";
	
	if(emptyInputSignup($uid, $bio) != false){
		header("location: ../app/profileedit.php?error=emptyinput");
		exit();
	}
	
	header("location: ../app/home.php?error=none");
	//updateProfile($conn, $uid, $bio, $intrest);
}
else {
	header("location: ../app/SignUp.php?error=nosession");
}
?>