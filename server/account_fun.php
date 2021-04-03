<?php
session_start();
if (!isset($_SESSION['uid']) || empty($_SESSION['uid']))
{
	header("Location: ../app/index.php?error=noyouhavetologin");
	exit();
}

require_once 'friend_sql.php';
require_once 'functions.php';
$uid = $_SESSION['uid'];
$userRow = getUser($conn, $uid);

if(isset($_POST['getSession'])){
	//$profileRow = getProfile($conn, $uid);
	echo "<script>
			myUsername={$userRow['username']};
			
			
			</script>";
}
//update username
else if (isset($_POST['submit-username'])){
	$user = $_POST['username'];
	$pwd = $_POST['password'];
	
	if(emptyInput($uid, $user, $pwd) != false){
		header("location: ../app/account.php?error=emptyinputuser");
		exit();
	}
	if(!password_verify($pwd, $userRow['password'])){
		header("location: ../app/account.php?error=incorrectpwduser");
		exit();
	}
	if(userExists($conn, $user) != false){
		header("location: ../app/account.php?error=usertaken");
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
		header("location: ../app/account.php?error=emptyinputpwd");
		exit();
	}
	if(!verifyUsername($conn,$uid, $user)){
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
		header("location: ../app/account.php?error=emptyinputnames");
		exit();
	}
	if(!password_verify($pwd, $userRow['password'])){
		header("location: ../app/account.php?error=incorrectpwdnames");
		exit();
	}
	updateProfileName($conn, $uid, $fname, $lname);
	header("location: ../app/account.php?error=success");
}
else {
	header("location: ../app/account.php?error=ohNo");
}
?>