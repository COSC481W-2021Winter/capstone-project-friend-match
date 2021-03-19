<?php
if (!isset($_SESSION['uid']) || empty($_SESSION['uid']))
{
	header("Location: ../app/index.php?error=noyouhavetologin");
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Your Account</title>
  <link rel="stylesheet" href="css/main.css">
</head>
<body>
  
</body>


</html>
