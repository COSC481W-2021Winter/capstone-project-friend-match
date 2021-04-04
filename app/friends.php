<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Friends</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/main.css"/>
    <link rel="stylesheet" href="css/nav.css"/>
	<link rel="stylesheet" href="css/general.css"/>
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
	<div style="width:50%; margin:auto;position:fixed;margin-top:-40%; position:fixed; ">
		<ul style="width:100%; list-style-type: none;">
			<button id="defaultB" onclick="revealDefault()">Like you | Haven't liked back</button>
			<button id="matchesB" onclick="revealLikeEach()">Like eachother</button>
			<button id="sharedInterestsB" onclick="revealSharedInt()">Shared interests</button>
			<button id="currentCityB" onclick="revealCurrentCity()" >Current City</button>
		</ul>
	</div>
    <h1>Friendos</h1>
    <h1>(If you have any)</h1>
    <div id="friendList"></div>
  </body>
    <script>
	function revealDefault(){
		document.getElementById("currentCity").style.display = "none"; 
		document.getElementById("sharedInt").style.display = "none"; 
		document.getElementById("likeEach").style.display = "none"; 
		document.getElementById("default").style.display = "inline";
	}
	function revealLikeEach(){
		document.getElementById("currentCity").style.display = "none"; 
		document.getElementById("sharedInt").style.display = "none"; 
		document.getElementById("likeEach").style.display = "inline"; 
		document.getElementById("default").style.display = "none";
	}
	function revealSharedInt(){
		document.getElementById("currentCity").style.display = "none"; 
		document.getElementById("sharedInt").style.display = "inline"; 
		document.getElementById("likeEach").style.display = "none"; 
		document.getElementById("default").style.display = "none";
	}
	function revealCurrentCity(){
		document.getElementById("currentCity").style.display = "inline"; 
		document.getElementById("sharedInt").style.display = "none"; 
		document.getElementById("likeEach").style.display = "none"; 
		document.getElementById("default").style.display = "none";
	} 
  </script> 
</html>

<?php
  session_start();
  //require_once __DIR__ . '/../server/profile_fun.php';
  require_once '../server/functions.php';
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
		echo "<div id='default' >"; 
    foreach ($result as $row) {
      $qry = $conn->prepare("SELECT * FROM profiles WHERE userid = ?");
      $qry->bind_param("s", $row["peerid"]);
      $qry->execute();
      $match = $qry->get_result()->fetch_assoc();

      $rtn = $conn->prepare("SELECT * FROM matches WHERE userid = ? AND peerid = ? AND matchid = ?");
      $rtn->bind_param("sss", $row["peerid"], $_SESSION["uid"], $row["matchid"]);
      $rtn->execute();
      echo "<div class=\"friendsCard\">";
	  echo "<a href='user.php?id={$row["peerid"]}'>";
      echo "<p>" . "Name: " . $match["firstName"] . " " . $match["lastName"] . "<br>";
      echo (($rtn->get_result()->num_rows == 1) ? "They Like You" : "They Haven't Liked Back") . "<br>";
      echo "</a><br>";
	  echo "<button id='dislike' onclick='unlikeUser(".$row['matchid'].")'>Dislike</button>" . "<br>";//a button to unlike another user
	  echo "</div>";
    }
	echo "</div>";
  }
 ?>
 <!--like eachother, matches -->
<?php 
	$stmt = $conn->prepare("SELECT * FROM matches WHERE userid = ? AND likeStatus = 1");
	$stmt->bind_param("s", $_SESSION["uid"]);
	$stmt->execute();
	$result = $stmt->get_result();
	
	if ($result->num_rows == 0) {
		echo "No matches here! Sad :(";
	} else {
		echo "<div id='likeEach' >";
		$stmt = $conn->prepare("SELECT * FROM matches WHERE userid = ? AND likeStatus = 1 OR peerid = ? AND likeStatus = 1");
		$stmt->bind_param("ss", $_SESSION["uid"],$_SESSION["uid"]);
		$stmt->execute();
		$result = $stmt->get_result();
		foreach ($result as $row) {
			$qry = $conn->prepare("SELECT * FROM matches WHERE ((userid = ? OR peerid = ?) and (userid = ? OR peerid = ?))and likeStatus = 1");
			$qry->bind_param("ssss", $_SESSION["uid"],$_SESSION["uid"],$row["peerid"],$row["peerid"]);
			$qry->execute();
			$match = $qry->get_result();

			if ($match->num_rows == 2  ){
				//might not need? leave for now, delete later if not needed.
				if (!($row["peerid"] == $_SESSION["uid"])) {
					$qry = $conn->prepare("SELECT * FROM profiles WHERE userid = ?");
					$qry->bind_param("s", $row["peerid"]);
					$qry->execute();
					$temp = $qry->get_result()->fetch_assoc();
					echo "<div class=\"friendsCard\">";
					echo "<p> You matched with </p>";
					echo "<p>" . "Name: " . $temp["firstName"] . " " . $temp["lastName"] . "<br>".$temp["city"]."<br>";
					echo "<button id='dislike' onclick='unlikeUser(".$row['matchid'].")'>Dislike</button>" . "<br>";//a button to unlike another user
					echo "</div>";
				}
			}
			

		}
		echo "If you want more, expand your interests!";
		echo "</div>"; 
	}
?>
<!--shared interests -->
<?php 
	
	$stmt = $conn->prepare("SELECT * FROM matches WHERE userid = ? AND likeStatus = 1");
	$stmt->bind_param("s", $_SESSION["uid"]);
	$stmt->execute();
	$result = $stmt->get_result();

	if($result->num_rows == 0) {
		echo "No Matches! Sad :(";
	} else {
		$qry = $conn->prepare("SELECT * FROM profiles WHERE userid = ?");
		$qry->bind_param("s",$_SESSION["uid"]);
		$qry->execute();
		$uidprofile = $qry->get_result()->fetch_assoc();
		$uidinterests = explode("_",$uidprofile["interests"]);
		$uidinterests = array_map('strtolower',$uidinterests);
		
		echo "<div id='sharedInt' >"; 
		foreach ($result as $row) {
			$qry = $conn->prepare("SELECT * FROM profiles WHERE userid = ?");
			$qry->bind_param("s", $row["peerid"]);
			$qry->execute();
			$match = $qry->get_result()->fetch_assoc();
			
			$qry = $conn->prepare("SELECT * FROM profiles WHERE userid = ?");
			$qry->bind_param("s",$row["peerid"]);
			$qry->execute();
			$peeridProf = $qry->get_result()->fetch_assoc();
			$friendInterests = array();
			$friendInterests = explode("_",$peeridProf["interests"]);
			$friendInterests = array_map('strtolower',$friendInterests);
			$holdingArray = array();
			foreach($uidinterests as $interests){	
				if (in_array($interests,$friendInterests)){
					if ($interests != "")
						array_push($holdingArray,$interests);
				}
			}
			if (count($holdingArray) >= 1){
				$rtn = $conn->prepare("SELECT * FROM matches WHERE userid = ? AND peerid = ?");
				$rtn->bind_param("ss", $row["peerid"], $_SESSION["uid"]);
				$rtn->execute();
				echo "<div class=\"friendsCard\">";
				echo "<p>" . "Name: " . $match["firstName"] . " " . $match["lastName"] . "<br>";
				echo (($rtn->get_result()->num_rows == 1) ? "They Like You" : "They Haven't Liked Back") . "<br>";
				$x = 0;
				echo "<b>Interests in common</b> <br>";
				foreach ($holdingArray as $interests2){
					if ($interests2 != ""){
						echo "$interests2, ";
						$x += 1;
						if ($x % 2 == 0)
							echo "<br>";
					}
				}
				echo "<button id='dislike' onclick='unlikeUser(".$row['matchid'].")'>Dislike</button>" . "<br>";//a button to unlike another user
			echo "</div>";
			}
		}
		echo "</div>";
  }
?>
<!--current city -->
<?php 
	
	$stmt = $conn->prepare("SELECT * FROM matches WHERE userid = ? AND likeStatus = 1");
	$stmt->bind_param("s", $_SESSION["uid"]);
	$stmt->execute();
	$result = $stmt->get_result();

	if($result->num_rows == 0) {
		echo "No Matches! Sad :(";
	} else {
		$qry = $conn->prepare("SELECT * FROM profiles WHERE userid = ?");
		$qry->bind_param("s",$_SESSION["uid"]);
		$qry->execute();
		$uidprofile = $qry->get_result()->fetch_assoc();

		echo "<div id='currentCity'>"; 
		foreach ($result as $row) {
		$qry = $conn->prepare("SELECT * FROM profiles WHERE userid = ? AND city = ?");
		$qry->bind_param("ss", $row["peerid"],$uidprofile["city"]);
		$qry->execute();
		$match = $qry->get_result()->fetch_assoc();
		//add uid city 
		$rtn = $conn->prepare("SELECT * FROM matches WHERE userid = ? AND peerid = ?");
		$rtn->bind_param("ss", $row["peerid"], $_SESSION["uid"]);
		$rtn->execute();
		echo "<div class=\"friendsCard\">";
		echo "<p>" . "Name: " . $match["firstName"] . " " . $match["lastName"] . "<br>";
		echo (($rtn->get_result()->num_rows == 1) ? "They Like You" : "They Haven't Liked Back") . "<br>";
		echo $uidprofile["city"];
		echo "<br><button id='dislike' onclick='unlikeUser(".$row['matchid'].")'>Dislike</button>" . "<br>";//a button to unlike another user
		echo "</div>";
		}
		echo "</div>";
  }
?>

<script> //sets all displays to not show except one when page runs.
	document.getElementById("currentCity").style.display = "none"; 
	document.getElementById("sharedInt").style.display = "none"; 
	document.getElementById("likeEach").style.display = "none"; 
	document.getElementById("default").style.display = "inline";
</script>

<script>
	//to a function for unliking other users
	function unlikeUser(matchid)
	{
		$.ajax({
			url: '../server/functions.php',
			type: 'POST',
			data: {'uncreateMatch': [matchid]},
			success: function(data) {
				console.log(data);
			}
		});
		window.location.reload();
	}
</script>
