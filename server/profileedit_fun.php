<?php
session_start();
require_once 'friend_sql.php';
require_once 'functions.php';

//store description in session
if (isset($_POST['desc']))
{
	$_SESSION['description'] = $_POST['desc'];
}
//store image in session
if (isset($_POST['image']))
{
	$_SESSION['picture'] = $_POST['image'];
}
//store city in session
if (isset($_POST['citytext']))
{
	$_SESSION['city'] = $_POST['citytext'];
}
//store interests in session
if (isset($_POST['interests']))
{
	$temp = $_POST['interests'];
	$inters = implode("_",$temp);
	$_SESSION['interests'] = $inters;
}


$hasid = !isset($_SESSION["uid"]) || empty($_SESSION["uid"]);

if(isset($_SESSION["username"]) && $hasid){
	$uid = createUser($conn, $_SESSION["username"], $_SESSION["password"]);
	$_SESSION["uid"] = $uid;
	$first = $_SESSION["firstName"];
	$last = $_SESSION["lastName"];
	$city = $_SESSION["city"];
	$bio = $_SESSION["description"];
	$intrest = $_SESSION['interests'];
	
	if(emptyInputSignup($first, $last, $city) != false){
		header("location: ../app/profileedit.php?error=emptyinput");
		exit();
	}
	
	createProfile($conn, $uid, $first, $last, $city, $bio, $intrest);
	header("location: ../app/home.php?error=none");
}
elseif($hasid) {
	$uid = $_SESSION["uid"];
	$bio = $_SESSION["description"];
	$intrest = "";
	
	if(emptyInputSignup($uid, $bio) != false){
		header("location: ../app/profileedit.php?error=emptyinput");
		exit();
	}
	
	header("location: ../app/home.php?error=none");
	updateProfile($conn, $uid, $city, $bio, $intrest);
}
else {
	header("location: ../app/SignUp.php?error=nosession");
}
?>