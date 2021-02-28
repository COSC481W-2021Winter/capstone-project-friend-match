<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <link rel="stylesheet" href="css/main.css">
</head>
  <body>
    <img id="logo" src="img/Friend_Match_Logo.svg" alt="logo">
    <div class="container">
      <form action="login.php" method="post">
        <input type="text" id="username" name="username" placeholder="Username">
        <input type="password" id="password" name="password" placeholder="Password">
        <button class="button" type="submit" id="login-button" value="Submit">Login</button>
      </form>
      <p>Don't have an account?</p>
      <a href="SignUp.php" class="button">Sign Up</a>
    </div>
  </body>
</html>

<?php
  $query = $_SERVER['QUERY_STRING'];
  if($query != "") {
    if($_GET["error"] == "invalid") {
      echo "Invalid Credentials";
    }
  }
 ?>
