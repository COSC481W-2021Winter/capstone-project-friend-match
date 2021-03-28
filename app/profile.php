<!DOCTYPE html>
<?php
session_start();

if (!isset($_SESSION['uid']) || empty($_SESSION['uid']))
{
	header("Location: ../app/index.php?error=noyouhavetologin");
	exit();
}
require_once __DIR__ . '/../server/profile_fun.php';
 ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="css/general.css">
	<link rel="stylesheet" type="text/css" href="css/nav.css">
    <link rel="icon" href="img/Friend_Match_Logo.svg">
	<div style="margin-bottom:2%; width:100%;" >
		<ul class = "navBarPP" id="navDiv">
				<a href="home.php" style="text-decoration:none;"><button class="NavBarPP" id="butto"> Home</button></a>
				<a href="profile.php" style="text-decoration:none;"><button class="NavBarPP"  id="butto2"> Profile</button></a>
				<a href="friends.php" style="text-decoration:none;"><button class="NavBarPP"  id="butto4"> Friends</button></a>
				<a href="logout.php" style="text-decoration:none;"><button class="NavBarPP" id="butto3"> Logout</button></a>
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
  <div class="container">
		<?php
		echo "<img src='img/profilePictures/".$id."' alt='profilepic'></img>";
		 ?>
  <div class="bio">
    <pre>
      <?php getBio($conn, $id); ?>
    </pre>
  </div>
  <div style="display: table;">
  <div style="display: table-row;">
    <form name="interests" method="POST" action="">
      <select name="hlist" size="7">
        <?php getInterests($conn, $id); ?>
      </select>
    </form>
  </div>
    <div style="display: table-row;">
    <p1>
      <?php getCity($conn, $id); ?>
    </p1>
  </div>
  <div style="display: table-row;">
    <a href="profileedit.php">
      <button class="button">Edit</button>
    </a>
  </div>
  </div>
</body>
</html>
