<?php
session_start();
require_once 'friend_sql.php';
require_once 'functions.php';

$image_directory = __DIR__ . "/../app/img/temp_img/";
$fileName = basename($_SESSION["uid"]);
$imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
$filepath = $image_directory . $fileName;
$id = $_SESSION["uid"];
$uploadOk = 1;

echo "hello";
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

if ($_FILES["image"]["size"] > 1000000) {
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

  if (file_exists($filepath))
  {
	  unlink($filepath);
  }
  if (move_uploaded_file($_FILES["image"]["tmp_name"], $filepath)) {
    $_SESSION['picture'] = $fileName;
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

header("location: ../app/profileedit.php?tempimage=1");
?>