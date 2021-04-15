<?php
  if (!isset($_SESSION['uid']) || empty($_SESSION['uid']))
  {
    header("Location: ../app/index.php?error=noyouhavetologin");
    exit();
  }

 function defaultFilter(){
  $servername = "localhost";
  $username = "root";
  $password = isset($_SERVER["SQL_PASSWORD"]) ? $_SERVER["SQL_PASSWORD"] : "";
  $dbName = "friend-match";
  $conn = new mysqli($servername, $username, $password, $dbName);
  //Grabs user matches
  $stmt = $conn->prepare("SELECT * FROM matches WHERE userid = ? AND likeStatus = 1");
  $stmt->bind_param("s", $_SESSION["uid"]);
  $stmt->execute();
  $result = $stmt->get_result();
  echo "<div id='default' class = 'friendFilter'>";
  if($result->num_rows == 0) {
    echo "No Matches! Sad :(";
  }
  else {
		foreach ($result as $row) {
			$qry = $conn->prepare("SELECT * FROM matches WHERE ((userid = ? OR peerid = ?) and (userid = ? OR peerid = ?))and likeStatus = 1");
			$qry->bind_param("ssss", $_SESSION["uid"],$_SESSION["uid"],$row["peerid"],$row["peerid"]);
			$qry->execute();
			$match = $qry->get_result();

			if ($match->num_rows == 2){
				//might not need? leave for now, delete later if not needed.
				if (!($row["peerid"] == $_SESSION["uid"])) {
					$qry = $conn->prepare("SELECT * FROM profiles WHERE userid = ?");
					$qry->bind_param("s", $row["peerid"]);
					$qry->execute();
					$temp = $qry->get_result()->fetch_assoc();
					echo "<div class=\"friendsCard\">";
					echo "You like eachother!";
					echo "<a href='user.php?id={$row["peerid"]}'>";
					echo "<p>" . "Name: " . $temp["firstName"] . " " . $temp["lastName"] . "<br>";
					echo "</a><br>";
					echo "<button id='dislike' onclick='unlikeUser(".$row['matchid'].")'>Dislike</button>" . "<br>";//a button to unlike another user
					echo "</div>";
				}
			}
    }
    foreach ($result as $row) {
			$qry = $conn->prepare("SELECT * FROM matches WHERE ((userid = ? OR peerid = ?) and (userid = ? OR peerid = ?))and likeStatus = 1");
			$qry->bind_param("ssss", $_SESSION["uid"],$_SESSION["uid"],$row["peerid"],$row["peerid"]);
			$qry->execute();
			$match = $qry->get_result();

       if ($match->num_rows == 1){
					$qry = $conn->prepare("SELECT * FROM profiles WHERE userid = ?");
					if ($row["peerid"] == $_SESSION["uid"])
						$qry->bind_param("s", $row["userid"]);
					else
						$qry->bind_param("s", $row["peerid"]);
					$qry->execute();
					$temp = $qry->get_result()->fetch_assoc();
						echo "<div class=\"friendsCard\">";
						echo "They haven't liked back";
						echo "<a href='user.php?id={$row["peerid"]}'>";
						echo "<p>" . "Name: " . $temp["firstName"] . " " . $temp["lastName"] . "<br>";
						echo "</a><br>";
						echo "<button id='dislike' onclick='unlikeUser(".$row['matchid'].")'>Dislike</button>" . "<br>";//a button to unlike another user
						echo "</div>";
			}
		}
  }
  echo "</div>";
}

function likeEachother(){
	$servername = "localhost";
	$username = "root";
	$password = isset($_SERVER["SQL_PASSWORD"]) ? $_SERVER["SQL_PASSWORD"] : "";
	$dbName = "friend-match";
	$conn = new mysqli($servername, $username, $password, $dbName);
	$stmt = $conn->prepare("SELECT * FROM matches WHERE userid = ? AND likeStatus = 1");
	$stmt->bind_param("s", $_SESSION["uid"]);
	$stmt->execute();
	$result = $stmt->get_result();
	echo "<div id='likeEach' style='display:none;' class = 'friendFilter'>";
	if ($result->num_rows == 0) {
		echo "No matches here! Sad :(";
	} else {
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
	}
	echo "</div>";
}

function interests(){
	$servername = "localhost";
	$username = "root";
	$password = isset($_SERVER["SQL_PASSWORD"]) ? $_SERVER["SQL_PASSWORD"] : "";
	$dbName = "friend-match";
	$conn = new mysqli($servername, $username, $password, $dbName);

	$stmt = $conn->prepare("SELECT * FROM matches WHERE userid = ? AND likeStatus = 1");
	$stmt->bind_param("s", $_SESSION["uid"]);
	$stmt->execute();
	$result = $stmt->get_result();

	if($result->num_rows > 0) {
		$qry = $conn->prepare("SELECT * FROM profiles WHERE userid = ?");
		$qry->bind_param("s",$_SESSION["uid"]);
		$qry->execute();
		$uidprofile = $qry->get_result()->fetch_assoc();
		$uidinterests = explode("_",$uidprofile["interests"]);
		$uidinterests = array_map('strtolower',$uidinterests);

		echo "<div id='sharedInt' class = 'friendFilter'>";
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
}

function currCity(){
	$servername = "localhost";
	$username = "root";
	$password = isset($_SERVER["SQL_PASSWORD"]) ? $_SERVER["SQL_PASSWORD"] : "";
	$dbName = "friend-match";
	$conn = new mysqli($servername, $username, $password, $dbName);

	$qry = $conn->prepare("SELECT * FROM profiles WHERE userid = ?");
	$qry->bind_param("s", $_SESSION["uid"]);
	$qry->execute();
	$currUser = $qry->get_result()->fetch_assoc();

	$stmt = $conn->prepare("SELECT * FROM profiles WHERE city = ?");
	$stmt->bind_param("s", $currUser["city"]);
	$stmt->execute();
	$result = $stmt->get_result();
	echo "<div id='currentCity' class = 'friendFilter'>";

	if ($result->num_rows == 0) {
		echo "No friends in current city!";
	} else {
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
					$qry = $conn->prepare("SELECT * FROM profiles WHERE userid = ? and city = ?");
					$qry->bind_param("ss", $row["peerid"],$currUser["city"]);
					$qry->execute();
					$temp = $qry->get_result()->fetch_assoc();
					echo "<div class=\"friendsCard\">";
					echo "<p> Your city matches with </p>";
					echo "<p>" . "Name: " . $temp["firstName"] . " " . $temp["lastName"] . "<br>".$temp["city"]."<br>";
					echo "<button id='dislike' onclick='unlikeUser(".$row['matchid'].")'>Dislike</button>" . "<br>";//a button to unlike another user
					echo "</div>";
				}
			}
		}
	}
	echo "</div>";
}
?>
