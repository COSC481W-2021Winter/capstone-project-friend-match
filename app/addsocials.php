<!DOCTYPE html>
<?php
	session_start();
  include "../server/friend_sql.php";
  include "../server/functions.php";
	//if the session containing the user id is set and not empty make some variables for the user's information and match them to the database
	if(isset($_SESSION['uid']) && !empty($_SESSION['uid']) && !isset($_POST["new_fb"]))
	{
		$socials = getSocials($conn, $_SESSION["uid"]);
		$fb = is_null($socials["facebook"])?"":$socials["facebook"];
		$tw = is_null($socials["twitter"])?"":$socials["twitter"];
		$sc = is_null($socials["snapchat"])?"":$socials["snapchat"];
		$ig = is_null($socials["instagram"])?"":$socials["instagram"];
		$li = is_null($socials["linkedin"])?"":$socials["linkedin"];
		$dc = is_null($socials["discord"])?"":$socials["discord"];

		$uid = $_SESSION["uid"];

	}
	else if(!isset($_SESSION['username']) && !isset($_POST["new_fb"]))
	{
		header("Location: ../app/index.php?error=noyouhavetologin");
		exit();
	}

	if(isset($_POST["uid"])) {
		$uid = $_POST["uid"];
		$fb = $_POST["new_fb"];
		$tw = $_POST["new_tw"];
		$sc = $_POST["new_sc"];
		$ig = $_POST["new_ig"];
		$li = $_POST["new_li"];
		$dc = $_POST["new_dc"];

		updateSocials($conn, $uid, $fb, $tw, $sc, $ig, $li, $dc);

		// $socials = getSocials($conn, $_SESSION["uid"]);
		// $fb = is_null($socials["facebook"])?"":$socials["facebook"];
		// $tw = is_null($socials["twitter"])?"":$socials["twitter"];
		// $sc = is_null($socials["snapchat"])?"":$socials["snapchat"];
		// $ig = is_null($socials["instagram"])?"":$socials["instagram"];
		// $li = is_null($socials["linkedin"])?"":$socials["linkedin"];
		// $dc = is_null($socials["discord"])?"":$socials["discord"];

		header("Location: profile.php");

	}
	// Turn off all error reporting
		error_reporting(0);
?>

<html lang="en">
	 <?php
		if ($_SESSION['bigTest'] == "doIt"){
		echo "<p id='ghost' style='visibility: hidden'> deadly</p>"; }
	?>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Editing Profile</title>
		<link rel="stylesheet" href="css/general.css">
		<!--<link rel="stylesheet" href="css/profed.css">-->
		<link rel="icon" href="img/Friend_Match_Logo.svg">
	</head>
	<body>
    <div class="container">
      <h3>Link Social Media Accounts:</h3>
      <form method="POST">
				<input type="hidden" id="uid" name="uid" value="<?=$uid?>">
        <label for="new_fb">Facebook:</label>
        <input type="text" id="new_fb" name="new_fb" style="width:100%" value="<?=$fb?>"><br><br>
        <label for="new_tw">Twitter:</label>
        <input type="text" id="new_tw" name="new_tw" style="width:100%" value="<?=$tw?>"><br><br>
        <label for="new_sc">Snapchat:</label>
        <input type="text" id="new_sc" name="new_sc" style="width:100%" value="<?=$sc?>"><br><br>
        <label for="new_ig">Instagram:</label>
        <input type="text" id="new_ig" name="new_ig" style="width:100%" value="<?=$ig?>"><br><br>
        <label for="new_li">LinkedIn:</label>
        <input type="text" id="new_li" name="new_li" style="width:100%" value="<?=$li?>"><br><br>
        <label for="new_dc">Discord:</label>
        <input type="text" id="new_dc" name="new_dc" style="width:100%" value="<?=$dc?>"><br><br>
        <input type="submit" name="submit2" value="Confirm" id="asSubmit" class="button">
      </form>
			<a href="profile.php">
				<button class="button">Back</button>
			</a>
    </div>
	</body>
	<?php
		unset($_SESSION['bigTest'])
	?>
</html>
