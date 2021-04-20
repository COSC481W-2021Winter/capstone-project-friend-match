<?php
session_start();
require_once 'friend_sql.php';
require_once 'functions.php';

//This builds the temp image path: (directory, name, then extension).
if($_SESSION['tempimage'] == "1")
{
	echo "temp iamge is here\n";
	$image_directory = __DIR__ . "/../app/img/profilePictures/";
	echo ".$image_directory.\n";
	$temp_directory = __DIR__ . "/../app/img/temp_img/";
	echo ".$temp_directory.\n";
	$fileName = basename($_SESSION["uid"]);
	$filepath = $image_directory . $fileName;
	echo ".$filepath.\n";
	$tempfilepath = $temp_directory . $fileName;
	echo ".$tempfilepath.\n";
	if (rename($tempfilepath, $filepath) ){
		echo "success";
		$_SESSION['tempimage'] = "0";
	} else {
		echo "unable to move";
	}
}

//store description in session
if (isset($_POST['desc']))
{
	$_SESSION['description'] = $_POST['desc'];
}
if (isset($_POST['citytext']))
{
	$_SESSION['city'] = $_POST['citytext'];
}
//store interests in session
if (isset($_POST['interests']))
{
	$temp = $_POST['interests'];
	$inters = implode("_",$temp);
	$holdArray = $inters;
	$_SESSION['interests'] = $inters;
}
//store post from input line. allows tests to work.
if (isset($_POST['addinterests']))
{
	$Rinterests = $_POST['addinterests'];
}

$noid = !isset($_SESSION['uid']) || empty($_SESSION['uid']);

//creates user profile
if(isset($_SESSION['username']) && $noid){
	$username = $_SESSION['username'];
	$password = $_SESSION['password'];

	$first = $_SESSION['firstName'];
	$last = $_SESSION['lastName'];
	$city = $_SESSION['city'];
	$bio = $_SESSION['description'];
	$intrest = $_SESSION['interests'];

	if(emptyInput($first, $last, $city) != false){
		header("location: ../app/profileedit.php?error=emptyinput");
		exit();
	}

	$uid = createUser($conn, $username, $password);
	createProfile($conn, $uid, $first, $last, $city, $bio, $intrest);
	$_SESSION['uid'] = $uid;
	header("location: ../app/profileedit.php?error=none");
}

//updates user profile
elseif(!$noid) {
	$uid = $_SESSION['uid'];
	$bio = $_SESSION['description'];
	$intrest = $holdArray."_".$Rinterests;
	$city = $_SESSION['city'];
	$pic = $_SESSION['picture'];


	if(emptyInput($uid, $bio, $city) != false){
		header("location: ../app/profileedit.php?error=emptyinput");
		exit();
	}

	updateProfile($conn, $uid, $city, $bio, $intrest, $pic);
    header("location: ../app/profile.php");
}
else {
	header("location: ../app/SignUp.php?error=nosession");
}
?>
