<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Friends</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="css/main.css"/>
    <link rel="stylesheet" href="css/nav.css"/>
	<link rel="stylesheet" href="css/general.css"/>
	<link rel="icon" href="img/Friend_Match_Logo.svg">
  </head>
  <body>
    <div style="width:100%;" >
    	<ul class = "navBarFF" id="navDiv">
    			<a href="home.php" style="text-decoration:none;"><button class="NavBarFF" id="butto"> Home</button></a>
    			<a href="profile.php" style="text-decoration:none;"><button class="NavBarFF"  id="butto2"> Profile</button></a>
				<a href="friends.php" style="text-decoration:none;"><button class="NavBarFF"  id="butto4"> Friends</button></a>
    			<a href="logout.php" style="text-decoration:none;"><button class="NavBarFF" id="butto3"> Logout</button></a>
    	</ul>
    </div>
	<div style="width:50%; position:fixed; margin-top:-39%; position:fixed; z-index:1;">
		<div style="width:100%; display:inline; ">
			<button id="defaultB" onclick="revealDefault()" class="buttonFilter">Like you | Haven't liked back</button>
			<button id="matchesB" onclick="revealLikeEach()" class="buttonFilter">Like eachother</button>
			<button id="sharedInterestsB" onclick="revealSharedInt()" class="buttonFilter">Shared interests</button>
			<button id="currentCityB" onclick="revealCurrentCity()" class="buttonFilter">Current City</button>
		</div>
	</div>
	<div style="position:relative;margin-top:-30%;">
		<h1>Friendos</h1>
		<h1>(If you have any)</h1>
	</div>
	<div id="contain" style="margin-left:45.5%;">
		<?php
			require_once '../server/friends_fun.php';
			defaultFilter();
			likeEachother();
			interests();
			currCity();
		?>
	</div>
  </body>
    <script>
	function revealDefault(){
		document.getElementById("currentCity").style.display = "none"; 
		document.getElementById("sharedInt").style.display = "none"; 
		document.getElementById("likeEach").style.display = "none"; 
		document.getElementById("default").style.display = "inline";
	}
	function revealLikeEach(){
		document.getElementById("currentCity").style.display = "none"; 
		document.getElementById("sharedInt").style.display = "none"; 
		document.getElementById("likeEach").style.display = "inline"; 
		document.getElementById("default").style.display = "none";
	}
	function revealSharedInt(){
		document.getElementById("currentCity").style.display = "none"; 
		document.getElementById("sharedInt").style.display = "inline"; 
		document.getElementById("likeEach").style.display = "none"; 
		document.getElementById("default").style.display = "none";
	}
	function revealCurrentCity(){
		document.getElementById("currentCity").style.display = "inline"; 
		document.getElementById("sharedInt").style.display = "none"; 
		document.getElementById("likeEach").style.display = "none"; 
		document.getElementById("default").style.display = "none";
	} 
  </script> 
</html>



<script> //sets all displays to not show except one when page runs.
	document.getElementById("currentCity").style.display = "none"; 
	document.getElementById("sharedInt").style.display = "none"; 
	document.getElementById("likeEach").style.display = "none"; 
	document.getElementById("default").style.display = "inline";
</script>

<script>
	//to a function for unliking other users
	function unlikeUser(matchid)
	{
		$.ajax({
			url: '../server/functions.php',
			type: 'POST',
			data: {'uncreateMatch': [matchid]},
			success: function(data) {
				console.log(data);
			}
		});
		window.location.reload();
	}
</script>
