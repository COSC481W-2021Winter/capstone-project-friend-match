<!DOCTYPE html>
<?php
session_start();
require_once __DIR__ . '/../server/profile_fun.php';
 ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/nav.css">


</head>
<div style="margin-top:-4%;margin-bottom:2%; width:100%;" >
	<ul class = "navBarPP" id="navDiv">
			<a href="home.php" style="text-decoration:none;"><button class="NavBarPP" id="butto"> Home</button></a>
			<a href="profile.php" style="text-decoration:none;"><button class="NavBarPP"  id="butto2"> Profile</button></a>
			<a href="logout.php" style="text-decoration:none;"><button class="NavBarPP" id="butto3"> Logout</button></a>
	</ul>
</div>

<script>
	document.getElementById("butto").style.height = "50px";
	document.getElementById("butto").style.fontSize = "125%";
	document.getElementById("butto2").style.fontSize = "125%";
	document.getElementById("butto3").style.fontSize = "125%";
</script>



<body>
  <div class="container">
    <img style="border-style: solid;" id="pfp" src="img/randy.png" alt="profilepic" width="400" height="500"></img>
  <div class="bio">
    <pre>
      <?php

      $sql = "SELECT * FROM profiles WHERE userid='$id';";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);

      if($resultCheck > 0){
        while($row = mysqli_fetch_array($result)){
          echo $row['bio'] . "<br>";

        }

      } ?>
    </pre>
  </div>
  <div style="display: table;">
  <div style="display: table-cell;">
    <form name="interests" method="POST" action="">
      <select name="hlist" size="7">
        <!--<?php
        $sql = "SELECT * FROM profiles WHERE userid = '27';";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck > 0){
          while($row = mysqli_fetch_array($result)){
            echo $row['interests'] . "<br>";

          }

        } ?>-->
        <option disabled><?php
        $sql = "SELECT * FROM profiles WHERE userid = '$id';";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        if($resultCheck > 0){
          while($row = mysqli_fetch_array($result)){
            echo $row['interests'] . "<br>";

          }

        } ?></option>
        <!--<option disabled>Knitting</option>
        <option disabled>Reading</option>
        <option disabled>Floating</option>
        <option disabled>Talking</option>
        <option disabled>Snowboarding</option>
        <option disabled>Tasting</option>
        <option disabled>Hiking</option>
        <option disabled>Breathing</option>
        <option disabled>Racing</option>
        <option disabled>Hammocking</option>
        <option disabled>Boxing</option>
        <option disabled>Contemporary Painting</option>
        <option disabled>Rock Climbing</option>-->
      </select>
    </form>
  </div>
    <div style="display: table-cell;">
    <p1>
      <?php
      $sql = "SELECT * FROM profiles WHERE userid = '$id';";
      $result = mysqli_query($conn, $sql);
      $resultCheck = mysqli_num_rows($result);

      if($resultCheck > 0){
        while($row = mysqli_fetch_array($result)){
          echo $row['city'] . "<br>";

        }

      } ?>
    </p1>
  </div>
  <div style="display: table-cell;">
    <a href="profileedit.php">
      <button class="button">Edit</button>
    </a>
  </div>
  </div>
</body>
</html>
