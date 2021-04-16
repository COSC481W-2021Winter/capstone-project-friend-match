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
	<link rel="stylesheet" href="css/nav.css">
    <link rel="icon" href="img/Friend_Match_Logo.svg">
	<div style="width:100%;" >
		<ul class = "navBarPP" id="navDiv">
				<a href="home.php" style="text-decoration:none;"><button class="navBarGen" id="butto"> Home</button></a>
				<a href="profile.php" style="text-decoration:none;"><button class="navBarGen"  id="butto2"> Profile</button></a>
				<a href="friends.php" style="text-decoration:none;"><button class="navBarGen"  id="butto4"> Friends</button></a>
				<a href="logout.php" style="text-decoration:none;"><button class="navBarGen" id="butto3"> Logout</button></a>
		</ul>
	</div>
</head>
<body>
  <div class="container">
		<?php
		echo "<img src='img/profilePictures/".$id."' alt='profilepic' id='pfp'></img>";
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
	<br/>
	<div style="display: table-row;">
		<div style="display: table;">
			<div style="display: table-row;">Social Media:</div>
				<?php
				// all of the @ signs are warning suppressions, they're there to prevent the app from
				//	printing off WARNING: TRYING TO ACCESS ARRAY OFFSET ON VALUE OF TYPE NULL every time
				//	we try to read the socials if they don't exist

				// it's the only way i could find to do it without just blocking error reporting for the
				//	whole page

					$user = getSocials($conn, $id);
					if(@$user["facebook"] && !is_null(@$user["facebook"])) {
						echo "<div style='display: table-row;'>Facebook: " . $user["facebook"] . "</div>";
					}
					if(@$user["twitter"] && !is_null(@$user["twitter"])) {
						echo "<div style='display: table-row;'>Twitter: " . $user["twitter"] . "</div>";
					}
					if(@$user["snapchat"] && !is_null(@$user["snapchat"])) {
						echo "<div style='display: table-row;'>Snapchat: " . $user["snapchat"] . "</div>";
					}
					if(@$user["instagram"] && !is_null(@$user["instagram"])) {
						echo "<div style='display: table-row;'>Instagram: " . $user["instagram"] . "</div>";
					}
					if(@$user["linkedin"] && !is_null(@$user["linkedin"])) {
						echo "<div style='display: table-row;'>LinkedIn: " . $user["linkedin"] . "</div>";
					}
					if(@$user["discord"] && !is_null(@$user["discord"])) {
						echo "<div style='display: table-row;'>Discord: " . $user["discord"] . "</div>";
					}
					if(is_null(@$user["facebook"]) && is_null(@$user["twitter"]) && is_null(@$user["snapchat"]) && is_null(@$user["instagram"]) && is_null(@$user["linkedin"]) && is_null(@$user["discord"])) {
						echo "<div style='display: table-row;'>You have no social media accounts linked</div>";
					}
				?>
		</div>
	</div>
  <div style="display: table-row;">
    <a href="profileedit.php">
      <button class="button">Edit</button>
    </a>
		<a href="account.php">
      <button class="button">Account</button>
    </a>
		<a href="addsocials.php">
      <button class="button">Add Socials</button>
    </a>
  </div>
  </div>
</body>
</html>
