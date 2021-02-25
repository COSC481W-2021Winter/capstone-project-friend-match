<?php

if(isset($_POST["submit"])) {
	$first = $_POST["firstName"];
	$last = $_POST["lastName"];
	$user = $_POST["username"];
	$pwd = $_POST["password"];
	$pwdRepeat = $_POST["passwordRepeat"];
	
	require_once 'friend_sql.php';
	require_once 'functions.php';
	
	if(emptyInputSignup($first, $last, $user, $pwd, $pwdRepeat) != false){
		header("location: ../app/SignUp.php?error=emptyinput");
		exit();
	}
	if(pwdMatch($pwd, $pwdRepeat) != false){
		header("location: ../app/SignUp.php?error=pwdnotmatch");
		exit();
	}
	if(userExists($conn, $user) != false){
		header(":location: ../app/SignUp.php?error=usertaken");
		exit();
	}
	
	session_start();
	$_SESSION["first"] = $first;
	$_SESSION["last"] = $last;
	$_SESSION["user"] = $user;
	$_SESSION["pwd"] = $pwd;
	
	header("location: ../app/profileedit.php");
}
else {
	header("location: ../app/SignUp.php");
}