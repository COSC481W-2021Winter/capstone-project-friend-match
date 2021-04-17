<!DOCTYPE html>
<?php
session_start();

if (!isset($_SESSION['uid']) || empty($_SESSION['uid']))
{
	header("Location: ../app/index.php?error=noyouhavetologin");
	exit();
}
if (isset($_GET['id'])){
  $publicid = $_GET['id'];
}else{
  header("Location: ../app/friends.php");
}

require_once __DIR__ . '/../server/profile_fun.php';

checkPublicId($conn, $publicid);

if(isset($_POST["reason"])) {

	reportUser($conn, $_SESSION["uid"], $_GET["id"], $_POST["reason"]);
	unmatchUsers($conn, $_SESSION["uid"], $_GET["id"]);

}
 ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report User</title>
    <link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="css/general.css">
	<link rel="stylesheet" type="text/css" href="css/nav.css">
    <link rel="icon" href="img/Friend_Match_Logo.svg">
		<div style="margin-bottom:2%; width:100%;" >
		<ul class = "navBarPP" id="navDiv">
				<a href="home.php" style="text-decoration:none;"><button class="navBarGen" id="butto"> Home</button></a>
				<a href="profile.php" style="text-decoration:none;"><button class="navBarGen"  id="butto2"> Profile</button></a>
				<a href="friends.php" style="text-decoration:none;"><button class="navBarGen"  id="butto4"> Friends</button></a>
				<a href="logout.php" style="text-decoration:none;"><button class="navBarGen" id="butto3"> Logout</button></a>
		</ul>
	</div>
	<script>
		document.getElementById("butto").style.height = "50px";
		document.getElementById("butto2").style.height = "50px";
		document.getElementById("butto3").style.height = "50px";
		document.getElementById("butto4").style.height = "50px";
		document.getElementById("butto").style.fontSize = "125%";
		document.getElementById("butto2").style.fontSize = "125%";

		document.getElementById("butto3").style.fontSize = "125%";

		document.getElementById("butto3").style.fontSize = "125%";
		document.getElementById("butto4").style.fontSize = "125%";

	</script>

</head>
<body>
  <div class="back-container">
  <div style="display: table;">
    <div style="display: table-row;">
      <h2>Report User</h2>
    </div>
    <div style="display: table-row;">
			<?php
			if(isset($_POST["reason"])) {
				echo "<p>User has been reported successfully</p><!--";
			}
			?>
      <form method="POST">
				<div class="eptextarea">
					<p>Please provide additional reasoning:</p>
					<textarea id="reason" name="reason" rows="5" cols=""  style="width:90%"></textarea>
				</div>
				<input type="submit" name="submit2" value="Confirm" id="asSubmit" class="button">
      </form>
			<?php
			if(isset($_POST["reason"])) {
				echo "-->";
			}
			?>
			<a href="user.php?id=<?=$_GET['id']?>">
				<button class="button">Back</button>
			</a>
    </div>
  </div>
</body>
</html>
