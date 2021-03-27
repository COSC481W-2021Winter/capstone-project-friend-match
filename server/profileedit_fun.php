<?php
session_start();
require_once 'friend_sql.php';
require_once 'functions.php';

//This builds the image path: (directory, name, then extension).
$image_directory = __DIR__ . "/../app/img/profilePictures/";
$filepath = $image_directory . basename($_SESSION["uid"]);
$imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
$filepath = $filepath . "." . $imageFileType;

$uploadOk = 1;

if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

if ($_FILES["image"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}
echo $filepath . " " . $imageFileType;
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
  echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
  $uploadOk = 0;
}

if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
} else {
  if (move_uploaded_file($_FILES["image"]["tmp_name"], $filepath)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["image"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

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
	$holdArray = $inters;
	$_SESSION['interests'] = $inters;
}
//store post from input line. allows tests to work.
if (isset($_POST['addinterests']))
{
	$Rinterests = $_POST['addinterests'];
}

$hasid = !isset($_SESSION['uid']) || empty($_SESSION['uid']);

//creates user profile
if(isset($_SESSION['username']) && $hasid){
	$username = $_SESSION['username'];
	$password = $_SESSION['password'];
	$uid = createUser($conn, $username, $password);
	$_SESSION['uid'] = $uid;

	$first = $_SESSION['firstName'];
	$last = $_SESSION['lastName'];
	$city = $_SESSION['city'];
	$bio = $_SESSION['description'];
	$intrest = $_SESSION['interests'];

	if(emptyInput($first, $last, $city) != false){
		header("location: ../app/profileedit.php?error=emptyinput");
		exit();
	}

	createProfile($conn, $uid, $first, $last, $city, $bio, $intrest);
	header("location: ../app/profileedit.php?error=none");
}

//updates user profile
elseif(!$hasid) {
	$uid = $_SESSION['uid'];
	$bio = $_SESSION['description'];
	//original is one below, changed, should all still work normally.
	//$intrest = $_SESSION['interests'];
	$intrest = $holdArray."_".$Rinterests;
	$city = $_SESSION['city'];
	$pic = $_SESSION['picture'];

	if(emptyInput($uid, $bio) != false){
		header("location: ../app/profileedit.php?error=emptyinput");
		exit();
	}
	header("location: ../app/profileedit.php?error=none");
	updateProfile($conn, $uid, $city, $bio, $intrest, $pic);
}
else {
	header("location: ../app/SignUp.php?error=nosession");
}
?>
