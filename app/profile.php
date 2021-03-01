<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/nav.css">


</head>
<div style="margin-top:-7%; margin-bottom:16%; width:100%;" > 
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
    <img style="border-style: solid;" id="pfp" src="\capstone-project-friend-match\randy.png" alt="profilepic"></img>
  <div class="bio">
    <pre>
        BLURB ABOUT THE PERSON BLURB ABOUT THE PERSON
        BLURB ABOUT THE PERSON BLURB ABOUT THE PERSON
        BLURB ABOUT THE PERSON BLURB ABOUT THE PERSON
        BLURB ABOUT THE PERSON BLURB ABOUT THE PERSON
    </pre>
  </div>
  <div style="display: table;">
  <div style="display: table-cell;">
    <form name="hobbies" method="" action="">
      <select name="hlist" size="7">
        <option disabled>Walking</option>
        <option disabled>Knitting</option>
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
        <option disabled>Rock Climbing</option>
      </select>
    </form>
  </div>
    <div style="display: table-cell;">
    <p1 class="bio">
      City: Evergreen
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
