<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Friends</title>
    <link rel="stylesheet" href="css/main.css"/>
    <link rel="stylesheet" href="css/nav.css"/>
  </head>
  <body>
    <div style="margin-top:-0%;margin-bottom:2%; width:100%;" >
    	<ul class = "navBarPP" id="navDiv">
    			<a href="home.php" style="text-decoration:none;"><button class="NavBarPP" id="butto"> Home</button></a>
    			<a href="profile.php" style="text-decoration:none;"><button class="NavBarPP"  id="butto2"> Profile</button></a>
    			<a href="logout.php" style="text-decoration:none;"><button class="NavBarPP" id="butto3"> Logout</button></a>
    	</ul>
    </div>
    <h1>Friendos</h1>
    <h1>(If you have any)</h1>
    <div id="friendList"></div>
  </body>
</html>

<?php
  session_start();
  require_once __DIR__ . '/../server/profile_fun.php';
 ?>
