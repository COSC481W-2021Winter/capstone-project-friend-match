<?php

if(isset($_POST["submit"])) {
	require_once 'friend_sql.php';
	require_once 'functions.php';
	
	
	$username = $_POST['username'];
	$pwd = $_POST['password'];
	
	/*
	if(emptyInputSignup($username, $password) != false){
		header("Location: ../app/index.php?error=emptyinput");
		exit();
	}
	*/
	$row = userExists($conn, $username);
	if($row == false){
		header("Location: ../app/index.php?error=nouserexsits");
		exit();
	}
	if(password_verify($pwd, $row['password']) == false){
		header("Location: ../app/index.php?error={$pwd}{$row['password']}");
		exit();
	}
	
	session_start();
	$_SESSION["uid"] = row['userid'];
	header("Location: ../app/home.php");
}
else {
	header("location: ../app/index.php?error=nopost");
}
?>