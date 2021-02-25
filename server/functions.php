<?php

function emptyInputSignup(...$params){
	$rtn = false;
	foreach ($params as $param){
		if(empty($param)){
			$rtn = true;
		}
	}
	return $rtn;
}

function pwdMatch($pwd, $pwdRepeat){
	$rtn;
	if($pwd != $pwdRepeat){
		$rtn = true;
	}
	else{
		$rtn = false;
	}
	return $rtn;
}

function userExists($conn, $user){
	$sql = "SELECT * FROM users WHERE usersUid = ?;";
	$stmt = mysqli_stmt_init($conn);
	if (mysqli_stmt_prepare($stmt, $sql)){
		header("location: ../app/SignUp.php?error=stmtfailed");
		exit();
	}
	
	mysqli_stmt_bind_param($stmt, 's', $user);
	mysqli_stmt_execute($stmt);
	
	$resultsData = mysqli_stmt_get_result($stmt);
	if($row = mysqli_fetch_assoc($resultsData)){
		return $row;
	}
	else{
		return false;
	}
	
	mysqli_stmt_close($stmt);
}

function createUser($conn, $name, $uid, $pwd){
	$sql = "INSERT INTO users (name, uid, password) VALUES(?, ?, ?);";
	$stmt = mysqli_stmt_init($conn);
	if (mysqli_stmt_prepare($stmt, $sql)){
		header("location: ../app/SignUp.php?error=stmtfailed");
		exit();
	}
	
	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
	
	mysqli_stmt_bind_param($stmt, "sss", $name, $uid, $hashedPwd);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);
	header("location: ../signup.php?error=none");
	exit();
}