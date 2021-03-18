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

//~~~~~~~~~~~User Stuff~~~~~~~~~~~~~~~~~~~

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

//~~~~~~~~~~~Profile Stuff~~~~~~~~~~~~~~~~~~~

function createProfile($conn, $uid, $fname, $lname, $city, $bio, $interest){
	//create user
	$sql = 'INSERT INTO profiles (userid, firstName, lastName, city, bio, interests) VALUES(?, ?, ?, ?, ?, ?);';
	$stmt = $conn->prepare($sql);
	
	$stmt->bind_param('isssss', $uid, $fname, $lname, $city, $bio, $interest);
	$stmt->execute();
	$stmt->close();
}

function getProfile($conn, $uid){
	$sql = 'SELECT * FROM profiles WHERE userid = ?;';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('i', $uid);
	$stmt->execute();
	
	$result = $stmt->get_result();
	return $result;
	
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

//~~~~~~~~~~~Matches Stuff~~~~~~~~~~~~~~~~~~~
//create mathc with user's id and other's id
function createMatch($conn, $uid, $likeid){
	$sql = "INSERT INTO matches (userid, likeid) VALUES(?, ?);";
	$stmt = $conn->prepare($sql);	
	$stmt->bind_param('ii', $uid, $likeid);
	$stmt->execute();
	$stmt->close();
}

//return list of liked ids if user liked other and other liked user
function getMatches($conn, $uid){
	$sql = 'SELECT M1.likeid FROM matches M1, matches M2 WHERE M1.userid = ? && M1.likeid = M2.userid && M2.likeid = ?;';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('ii', $uid, $uid);
	$stmt->execute();
	$result = $stmt->get_result();
	return $result;
	$stmt->close();
}
?>


