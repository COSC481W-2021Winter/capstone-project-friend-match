<?php

function emptyInput(...$params){
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
	$sql = 'SELECT * FROM users WHERE username = ?;';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('s', $user);
	$stmt->execute();

	$result = $stmt->get_result();
	if($row = $result->fetch_assoc()){
		return $row;
	}
	else{
		return false;
	}

	$stmt->close();
}

function createUser($conn, $name, $pwd){
	//create user
	$sql = "INSERT INTO users (username, password) VALUES(?, ?);";
	$stmt = $conn->prepare($sql);

	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

	$stmt->bind_param('ss', $name, $hashedPwd);
	$stmt->execute();

	//return most recent users id
	return mysqli_insert_id($conn);
	$stmt->close();
}

function createProfile($conn, $uid, $fname, $lname, $city, $bio, $interest){
	//create user
	$sql = 'INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES(?, ?, ?, ?, ?, ?);';
	$stmt = $conn->prepare($sql);

	$stmt->bind_param('isssss', $uid, $fname, $lname, $city, $bio, $interest);
	$stmt->execute();
	$stmt->close();
}

function updateProfile($conn, $uid, $city, $bio, $interest){
	$sql = "UPDATE profiles SET city = ?, bio = ?, interests = ? WHERE userid = ?;";
	$stmt = $conn->prepare($sql);

	$stmt->bind_param('sssi', $city, $bio, $interest, $uid);
	$stmt->execute();
	$stmt->close();
}

function getUserId($conn,$user) {
	$inbetween = userExists($conn, $user);
	return $inbetween['userid'];

}
?>
