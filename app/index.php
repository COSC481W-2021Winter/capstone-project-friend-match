<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="css/general.css">
  <title>Sign in</title>
  <link rel="icon" href="img/Friend_Match_Logo.svg">
</head>
  <body class="login">
    <div class="container" style="background-color: #ffde17;">
	  <?php
		$query = $_SERVER['QUERY_STRING'];
		//errors visible to users
		if($query != "") {
			if($_GET["error"] == "invalid") {
			  echo "<p style='color:red;'>Invalid Credentials</p>";
			}
		}
		if($query != "") 
		{
			if($_GET["error"] == "noyouhavetologin")
			{
				echo "<p style='color:red;'>You're Not Logged In, Please Login or Create an Account</p>";
			}
		}
	  ?>
	  <img id="logo" src="img/Friend_Match_Logo.svg" alt="logo">
      <form action="login.php" method="post" >
        <input type="text" id="username" name="username" placeholder="Username" style="border-color: #E9F1F7">
        <input type="password" id="password" name="password" placeholder="Password" style="border-color: #E9F1F7">
        <button class="button" type="submit" name="submit" id="login-button" value="Submit">Login</button>
      </form>
      <p>Don't have an account?</p>
      <a href="SignUp.php" class="button">Sign Up</a>
    </div>
  </body>
</html>


