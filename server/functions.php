<?php

if (isset($_POST['createMatch'])){
	$args = $_POST['createMatch'];
	createMatch($args[0], $args[1]);
}

// Return true if any of the parameters are empty
function emptyInput(...$params){
	$rtn = false;
	foreach ($params as $param){
		if(empty($param)){
			$rtn = true;
		}
	}
	return $rtn;
}

// Returns true if parameters don't match
function pwdMatch($pwd, $pwdRepeat){
	return $pwd != $pwdRepeat;
}

//~~~~~~~~~~~~User Table~~~~~~~~~~~~

/*
* Return false if user does not exists
* Return user if user exsits
*/
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

// Add user to table and return its id
function createUser($conn, $name, $pwd){
	$sql = "INSERT INTO users (username, password) VALUES(?, ?);";
	$stmt = $conn->prepare($sql);

	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

	$stmt->bind_param('ss', $name, $hashedPwd);
	$stmt->execute();

	return mysqli_insert_id($conn);
	$stmt->close();
}


// Get a users Id
function getUserId($conn,$user) {
	$inbetween = userExists($conn, $user);
	return $inbetween['userid'];
}

//~~~~~~~~~~~~Profile Table~~~~~~~~~~~~

// Add profile to table
function createProfile($conn, $uid, $fname, $lname, $city, $bio, $interest){
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

// Returns user's profile
function getProfile($conn, $uid){
	$sql = 'SELECT * FROM profiles WHERE userid = ?;';

	$stmt = $conn->prepare($sql);

	$stmt->bind_param('i', $uid);
	$stmt->execute();

	$result = $stmt->get_result();
	return $result;
	$stmt->close();
}

function getEligibleUsers($conn, $uid) {
	//Grab the city of the active user
	$sql = 'SELECT city FROM profiles WHERE userid= ?;';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('i', $uid);
	$stmt->execute();
	$cityRes = $stmt->get_result();
	$userCity = $cityRes->fetch_assoc();

	//If there is a valid user city, find all potential users in the same city and
	//	generate cards for them.
	if($userCity) {
		$new_sql = 'SELECT * FROM profiles WHERE city=? AND userid !=?;';
		$new_stmt = $conn->prepare($new_sql);

		$new_stmt->bind_param('si', $userCity["city"], $uid);
		$new_stmt->execute();

		$result = $new_stmt->get_result();

		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo '<div class="inner-card"><p style="color: #000;"><b>' . $row["firstName"] . '</b><br>' . $row["bio"] . '</p><div><button class="t_right">Like</button><button class="t_left">Dislike</button></div></div>';
			}
		} else {
			//If there's no users, provide an error indicator
			echo '<div class="inner-card"><p style="color: #000;">There are currently no users in your area, sorry :(</p></div>';
		}
	} else {
		//If the city is an invalid one, provide an error indicator
		echo '<div class="inner-card"><p style="color: #000;">Are you sure you entered a city?</p></div>';
	}
}

//~~~~~~~~~~~~Matches Stuff~~~~~~~~~~~~

// Create match with user's id and other's id
function createMatch($uid, $likeid){
	require_once 'friend_sql.php';
	$sql = "INSERT INTO matches (userid, likeid) VALUES(?, ?);";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('ii', $uid, $likeid);
	$stmt->execute();
	$stmt->close();
}

// Return list of mutually liked users
// Mutually = user liked other and other liked user
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
