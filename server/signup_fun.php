<?php

if(isset($_POST["submit"])) {
	$first = $_POST['firstName'];
	$last = $_POST['lastName'];
	$user = $_POST['username'];
	$pwd = $_POST['password'];
	$pwdRepeat = $_POST['passwordRepeat'];
	
	require_once 'friend_sql.php';
	require_once 'functions.php';
	
	//check empty input
	if(emptyInput($first, $last, $user, $pwd, $pwdRepeat) != false){
		header("location: ../app/SignUp.php?error=emptyinput");
		exit();
	}
	//check password confirmed
	if(pwdMatch($pwd, $pwdRepeat) != false){
		header("location: ../app/SignUp.php?error=pwdnotmatch");
		exit();
	}
	//check if user already exsits
	if(userExists($conn, $user) != false){
		header("location: ../app/SignUp.php?error=usertaken");
		exit();
	}
	
	session_start();
	$_SESSION['firstName'] = $first;
	$_SESSION['lastName'] = $last;
	$_SESSION['username'] = $user;
	$_SESSION['password'] = $pwd;
	$_SESSION['uid'] = NULL;
	$_SESSION['bigTest'] = "doIt";
	
	header("location: ../app/profileedit.php");
}
else {
	header("location: ../app/SignUp.php");
}
?>