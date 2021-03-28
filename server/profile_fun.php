<?php
//dont need session start here cause its required on profile page already.
require_once 'friend_sql.php';
require_once 'functions.php';

$hasid = !isset($_SESSION["uid"]);
if(isset($_SESSION["username"]) && $hasid){
  $uid = $_SESSION["uid"];
  $first = $_SESSION["firstName"];
  $last = $_SESSION["lastName"];
  $city = $_SESSION["city"];
  $bio = $_SESSION["description"];
  $interest = $_SESSION["interests"];

  if(emptyInput($first, $last, $user, $pwd, $pwdRepeat) != false){
		header("location: ../app/profile.php?error=emptyinput");
		exit();
	}

}
$id = $_SESSION["uid"];
//grabs and displays the bio of logged in user
function getBio($conn, $id){
  $sql = "SELECT * FROM profiles WHERE userid='$id';";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);

  if($resultCheck > 0){
    while($row = mysqli_fetch_array($result)){
      echo $row['bio'] . "<br>";
    }
  }
}
//grabs and displays the interests of logged in user
function getInterests($conn, $id){
  $sql = "SELECT interests FROM profiles WHERE userid = '$id';";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);

  if($resultCheck > 0){
    while($row = mysqli_fetch_array($result)){
      $line = $row['interests'];
      $split = explode("_", $line);
      $length = sizeof($split);
      for($i=0;$i<=$length;$i++){
        echo "<option disabled>".$split[$i]."</option>"."<br>";
      }
    }
  }
}
//grabs and displays city of logged in user
function getCity($conn, $id){
  $sql = "SELECT * FROM profiles WHERE userid = '$id';";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);
  if($resultCheck > 0){
    while($row = mysqli_fetch_array($result)){
      echo $row['city'] . "<br>";
    }
  }
}
/*function displayProfilePic($conn, $id){
  $sql = "SELECT * FROM profiles WHERE userid='$id';";
  $result = mysqli_query($conn, $sql);
  $resultCheck = mysqli_num_rows($result);
  if($resultCheck > 0){

    while($row = mysqli_fetch_array($result)){
      $pid = $row['userid'];
      $sqlp = "SELECT photo FROM profile WHERE userid='$id';";
      $resultp = mysqli_query($conn, $sqlp);
      $resultpCheck = mysqli_num_rows($resultp);
      if($resultpCheck > 0){
        while($rowp = mysqli_fetch_array($resultp)){
          if($pid['status'] ==0){
            echo "<img src='img/randy.png'>";
          }else{
            echo "<img src='img/profilePictures/".$pid.".png'>";
          }
        }
      }

    }

  }
}*/

?>
