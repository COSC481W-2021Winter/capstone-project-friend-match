<!DOCTYPE html>
<?php
	session_start();
	unset($_SESSION["uid"]);
	unset($_SESSION["password"]);
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
