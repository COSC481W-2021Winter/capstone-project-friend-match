<!DOCTYPE html>
<?php
	session_start();
	unset($_SESSION["uid"]);
	unset($_SESSION["userName"]);
	unset($_SESSION["password"]);
	unset($_SESSION["firstName"]);
	unset($_SESSION["lastName"]);
	unset($_SESSION["city"]);
	unset($_SESSION["description"]);
	unset($_SESSION["intrest"]);
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>logout</title>
	<head>
	
	<?php
	header("Location: http://localhost/capstone/app/index.php");
	?>
</html>
