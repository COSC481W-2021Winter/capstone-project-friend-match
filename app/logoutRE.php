<!DOCTYPE html>
<?php
	session_start();
	unset($_SESSION["uid"]);
	unset($_SESSION["username"]);
	unset($_SESSION["password"]);
	unset($_SESSION["firstName"]);
	unset($_SESSION["lastName"]);
	unset($_SESSION["city"]);
	unset($_SESSION["description"]);
	unset($_SESSION["interest"]);
	unset($_SESSION["bigTest"]);
	session_destroy();
?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>logout</title>
	<head>

	<?php
	header("Location: index.php");
	?>
</html>
