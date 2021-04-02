<?php
require_once 'friend_sql.php';
require_once 'functions.php';
session_start();
$uid = $_SESSION['uid'];

//update username
if (isset($_POST['submit-username'])){
	$user = $_POST['username'];
	$pwd = $_POST['password'];
	
	if(emptyInput($uid, $user, $pwd) != false){
		header("location: ../app/account.php?error=emptyinput");
		exit();
	}
	if(!verify_password($conn,$uid, $pwd)){
		header("location: ../app/account.php?error=incorrectpwd");
		exit();
	}
	updateUsername($conn, $uid, $user, $pwd);
	header("location: ../app/account.php?error=success");
}

//update password
else if (isset($_POST['submit-password'])){
	$user = $_POST['username'];
	$pwd = $_POST['password'];
	
	if(emptyInput($uid, $user, $pwd) != false){
		header("location: ../app/account.php?error=emptyinput");
		exit();
	}
	if(!verify_username($conn,$uid, $user)){
		header("location: ../app/account.php?error=incorrectusername");
		exit();
	}
	updateUsername($conn, $uid, $user, $pwd);
	header("location: ../app/account.php?error=success");
}

//update names
else if (isset($_POST['submit-names'])){
	$pwd = $_POST['password'];
	$fname = $_POST['firstName'];
	$lname = $_POST['lastName'];
	
	if(emptyInput($uid, $fname, $lname, $pwd) != false){
		header("location: ../app/account.php?error=emptyinput");
		exit();
	}
	if(!verify_password($conn,$uid, $pwd)){
		header("location: ../app/account.php?error=incorrectpwd");
		exit();
	}
	updateProfileName($conn, $uid, $fname, $lname);
	header("location: ../app/account.php?error=success");
}
else {
	header("location: ../app/account.php?error=IDK");
}
?>