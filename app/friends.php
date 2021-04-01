<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Friends</title>
    <link rel="stylesheet" href="css/main.css"/>
    <link rel="stylesheet" href="css/nav.css"/>
	<link rel="icon" href="img/Friend_Match_Logo.svg">
  </head>
  <body>
    <div style="width:100%;" >
    	<ul class = "navBarFF" id="navDiv">
    			<a href="home.php" style="text-decoration:none;"><button class="NavBarFF" id="butto"> Home</button></a>
    			<a href="profile.php" style="text-decoration:none;"><button class="NavBarFF"  id="butto2"> Profile</button></a>
				  <a href="friends.php" style="text-decoration:none;"><button class="NavBarFF"  id="butto4"> Friends</button></a>
    			<a href="logout.php" style="text-decoration:none;"><button class="NavBarFF" id="butto3"> Logout</button></a>
    	</ul>
    </div>
    <h1>Friendos</h1>
    <h1>(If you have any)</h1>
    <div id="friendList"></div>
  </body>
</html>

<?php
  session_start();
  //require_once __DIR__ . '/../server/profile_fun.php';
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbName = "friend-match";
  $conn = new mysqli($servername, $username, $password, $dbName);

  if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
  }

  //Grabs user matches
  $stmt = $conn->prepare("SELECT * FROM matches WHERE userid = ? AND likeStatus = 1");
  $stmt->bind_param("s", $_SESSION["uid"]);
  $stmt->execute();
  $result = $stmt->get_result();

  if($result->num_rows == 0) {
    echo "No Matches! Sad :(";
  } else {
    foreach ($result as $row) {
      $qry = $conn->prepare("SELECT * FROM profiles WHERE userid = ?");
      $qry->bind_param("s", $row["likeid"]);
      $qry->execute();
      $match = $qry->get_result()->fetch_assoc();

      $rtn = $conn->prepare("SELECT * FROM matches WHERE userid = ? AND likeid = ?");
      $rtn->bind_param("ss", $row["likeid"], $_SESSION["uid"]);
      $rtn->execute();
      echo "<div class=\"friendsCard\">";
      echo "<p>" . "Name: " . $match["firstName"] . " " . $match["lastName"] . "<br>";
      echo (($rtn->get_result()->num_rows == 1) ? "They Like You" : "They Haven't Liked Back") . "<br>";
      echo "</div>";
    }
  }
 ?>
