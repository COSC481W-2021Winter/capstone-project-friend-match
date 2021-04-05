<?php

if (isset($_POST['createMatch'])){
	$args = $_POST['createMatch'];
	createMatch($args[0], $args[1], $args[2]);
}

if (isset($_POST['uncreateMatch'])){
	$arg = $_POST['uncreateMatch'];
	uncreateMatch($arg[0]);
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

function getUser($conn, $uid){
	$sql = 'SELECT * FROM users WHERE userid = ?;';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('s', $uid);
	$stmt->execute();

	$result = $stmt->get_result();
	return $row = $result->fetch_assoc();
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

//update user table
function updateUsername($conn, $uid, $name, $pwd){
	$sql = "UPDATE users SET username = ?, password = ? WHERE userid = ?;";
	$stmt = $conn->prepare($sql);

	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

	$stmt->bind_param('ssi', $name, $hashedPwd, $uid);
	$stmt->execute();
	$stmt->close();
}

//returns true if user id has username
function verifyUsername($conn, $uid, $user){
	$sql = "SELECT * FROM users WHERE userid = ? and username = ?;";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('is', $uid, $user);
	$stmt->execute();
	$result = $stmt->get_result();
	return $result->num_rows == 1;
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

//update user's profile name
function updateProfileName($conn, $uid, $firstName, $lastName){
	$sql = 'UPDATE profiles SET firstName = ?, lastName = ? WHERE userid = ?;';
	$stmt = $conn->prepare($sql);

	$stmt->bind_param('ssi', $firstName, $lastName, $uid);
	$stmt->execute();
	$stmt->close();
}

// Returns user's profile
function getProfile($conn, $uid){
	$sql = 'SELECT * FROM profiles WHERE userid = ?;';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('i', $uid);
	$stmt->execute();
	$result = $stmt->get_result();
	return $row = $result->fetch_assoc();
	$stmt->close();
}

function getEligibleUsers($conn, $uid) {
	$sql = 'SELECT * FROM profiles WHERE userid NOT IN (SELECT likeid FROM matches WHERE userid="' . $uid . '") AND NOT userid="' . $uid . '" AND city IN (SELECT city FROM profiles WHERE userid="' . $uid . '");';
	$result = mysqli_query($conn, $sql);
	if($result && mysqli_num_rows($result) > 0) {
		echo "<script> const rows = []; </script>";
		while($row = mysqli_fetch_assoc($result)) {
			echo '<div class="inner-card"><img src="img/profilePictures/randy_derogatory.png" width="200" height="240"><p style="color: #000;"><b>' . $row["firstName"] . '</b><br>' . $row["bio"] . '</p><div><button class="swipe-button t_right">Like</button><button class="swipe-button t_left">Dislike</button></div></div>';
			echo '<script>rows.unshift(' . $row['userid']  . ')</script>';
		}
	} else {
		echo '<div class="inner-card"><p style="color: #000;">There are currently no users in your area, sorry :(</p></div>';
	}
}

//~~~~~~~~~~~~Matches Stuff~~~~~~~~~~~~

// Create match with user's id and other's id and if they like them.
function createMatch($uid, $peerid, $likeStatus) {
	require_once 'friend_sql.php';
	$sql = "INSERT INTO matches (userid, peerid, likeStatus) VALUES(?, ?, ?);";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('iii', $uid, $peerid, $likeStatus);
	$stmt->execute();
	$stmt->close();
}

// Remove match with user's id and other's id and if they don't like them anymore.
function uncreateMatch($matchid) {
	require_once 'friend_sql.php';
	$matchid=$_POST['uncreateMatch'][0];
	$sql = "UPDATE matches SET likeStatus='0' WHERE matchid=" . $matchid . ";";
	if(mysqli_query($conn, $sql)) {
		echo "all good";
	} else {
		echo mysqli_error($conn);
	}
}

// Return list of mutually liked users
// Mutually = user liked other and other liked user
function getMatches($conn, $uid){
	$sql = 'SELECT M1.peerid FROM matches M1, matches M2 WHERE M1.userid = ? && M1.peerid = M2.userid && M2.peerid = ?;';
	$stmt = $conn->prepare($sql);
	$stmt->bind_param('ii', $uid, $uid);
	$stmt->execute();
	$result = $stmt->get_result();
	return $result;
	$stmt->close();
}
function checkPublicId($conn, $publicid){
	$sql = "SELECT * FROM matches where peerid='$publicid';";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	if($resultCheck > 0){
		while($row = mysqli_fetch_array($result)){
			if($row['likeStatus'] == 0){
				header("Location: ../app/friends.php");
			}
		}
	}else{
		header("Location: ../app/friends.php");
	}

}
?>
