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

function updateProfile($conn, $uid, $city, $bio, $interest, $photo){
	$sql = 'UPDATE profiles SET city="' . $city . '", bio="' . $bio . '", interests="' . $interest . '", photo="' . $photo . '" WHERE userid=' . $uid . ';';
	if(mysqli_query($conn, $sql)) {
		echo "all good";
	} else {
		echo mysqli_error($conn);
	}
}

function getUserId($conn,$user) {
	$inbetween = userExists($conn, $user);
	return $inbetween['userid'];

}

function getUserProfiles($conn, $uid, $firstName, $lastName, $city, $bio, $interest) {
	$sql = 'SELECT * FROM profiles VALUES(?, ?, ?, ?, ?, ?);';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('isssss', $uid, $firstName, $lastName, $city, $bio, $interest);
	$stmt->execute();
	$stmt->close();

}

function getEligibleUsers($conn, $uid) {
	$sql = 'SELECT city FROM profiles WHERE userid="' . $uid . '";';
	$res = mysqli_query($conn, $sql);

	if(mysqli_num_rows($res) == 1) {
		$resRows = mysqli_fetch_assoc($res);
		$userCity = $resRows["city"];
		$sql = 'SELECT * FROM profiles WHERE city="' . $userCity . '" AND userid !=' . $uid . ';';
		$result = mysqli_query($conn, $sql);

		if(mysqli_num_rows($result) > 0) {
			while($row = mysqli_fetch_assoc($result)) {
				echo '<div class="inner-card"><p style="color: #000;"><b>' . $row["firstName"] . '</b><br>' . $row["bio"] . '</p><div><button class="t_right">Like</button><button class="t_left">Dislike</button></div></div>';
			}
		} else {
			echo '<div class="inner-card"><p style="color: #000;">There are currently no users in your area, sorry :(</p></div>';
		}
	}
}
?>
