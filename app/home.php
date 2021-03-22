<!DOCTYPE html>
<?php
	session_start();
?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/general.css"/>
	<link rel="stylesheet" href="css/nav.css"/>
    <link rel="stylesheet" href="css/swipes.css"/>
    <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css"/>
    <script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
    <script src="js/jquery.ui.touch-punch.min.js"></script>
	<title>Home</title>
    <link rel="icon" href="img/Friend_Match_Logo.svg">
    <script>
      $(document).ready(function(){
        var swipe_left = 0;
        var swipe_right = 0;

        $(".inner-card").on("swipeleft", function(){
          swipe_left = swipe_left + 1;
          document.getElementById("left_swipes").innerHTML = swipe_left;
          $(this).hide();
        });

        $(".inner-card").on("swiperight", function(){
          swipe_right = swipe_right + 1;
          document.getElementById("right_swipes").innerHTML = swipe_right;
          $(this).hide();
        });

        $(".t_left").click(function(){
          swipe_left = swipe_left + 1;
          document.getElementById("left_swipes").innerHTML = swipe_left;
          $(this).parent().parent().hide();
        });

        $(".t_right").click(function(){
          swipe_right = swipe_right + 1;
          document.getElementById("right_swipes").innerHTML = swipe_right;
          $(this).parent().parent().hide();
        })

      })
    </script>
	
	<div>
		
		<ul class = "navBar">
			<a href="home.php" style="text-decoration:none;"><button class="NavBarB" onclick="Home()" id="Home" > Home</button></a>
			<a href="profile.php"  style="text-decoration:none;"><button class="NavBar" onclick="Profile()" id="Profile"> Profile</button></a>
			<a href="logout.php"  style="text-decoration:none;"><button class="NavBar" onclick="Logout()" id="Logout"> Logout</button></a>
		</ul>
	</div>
	<script>
	function Home(){
			var currentfile = window.location.pathname;
			//removes current file its at and grabs just directory
			var directory = currentfile.substring(0, currentfile.lastIndexOf('/'));
			window.location.pathname = directory+'/home.php';
		}
		function Profile(){
			var currentfile = window.location.pathname;
			//removes current file its at and grabs just directory
			var directory = currentfile.substring(0, currentfile.lastIndexOf('/'));
			window.location.pathname = directory+'/profile.php';
		}
		function Logout(){
			var currentfile = window.location.pathname;
			//removes current file its at and grabs just directory
			var directory = currentfile.substring(0, currentfile.lastIndexOf('/'));
			window.location.pathname = directory+'/logout.php';
		}
	</script>
	<a href="home.php"><img id="logo" src="img/Friend_Match_Logo.svg" alt="logo" height="80" class="navImg"></a> 	
  </head>

  <body>
    <!-- Cards -->
      <div class="outer-deck" id="deck">
        <!-- deck plays by "sandwich rules" (first div is bottom, like the bread) -->
        <div class="inner-end"><br>Number of Likes: <span id="right_swipes">0</span><p style="color: #000;">Number of Dislikes: <span id="left_swipes">0</span></div>
        <div class="inner-card"><p style="color: #000;"><b>Name0</b><br>Biography</p><div><button class="t_left">Like</button><button class="t_right">Dislike</button></div></div>
        <div class="inner-card"><p style="color: #000;"><b>Name1</b><br>Biography</p><div><button class="t_left">Like</button><button class="t_right">Dislike</button></div></div>
        <div class="inner-card"><p style="color: #000;"><b>Name2</b><br>Biography</p><div><button class="t_left">Like</button><button class="t_right">Dislike</button></div></div>
        <div class="inner-card"><p style="color: #000;"><b>Name3</b><br>Biography</p><div><button class="t_left">Like</button><button class="t_right">Dislike</button></div></div>
        <div class="inner-card"><p style="color: #000;"><b>Name4</b><br>Biography</p><div><button class="t_left">Like</button><button class="t_right">Dislike</button></div></div>
        <div class="inner-card"><p style="color: #000;"><b>Name5</b><br>Biography</p><div><button class="t_left">Like</button><button class="t_right">Dislike</button></div></div>
        <div class="inner-card"><p style="color: #000;"><b>Name6</b><br>Biography</p><div><button class="t_left">Like</button><button class="t_right">Dislike</button></div></div>
        <div class="inner-card"><p style="color: #000;"><b>Name7</b><br>Biography</p><div><button class="t_left">Like</button><button class="t_right">Dislike</button></div></div>
        <div class="inner-card"><p style="color: #000;"><b>Name8</b><br>Biography</p><div><button class="t_left">Like</button><button class="t_right">Dislike</button></div></div>
        <div class="inner-card"><p style="color: #000;"><b>Name9</b><br>Biography</p><div><button class="t_left">Like</button><button class="t_right">Dislike</button></div></div>
        <div class="inner-card"><p style="color: #000;"><b>Name10</b><br>Biography</p><div><button class="t_left">Like</button><button class="t_right">Dislike</button></div></div>
        <div class="inner-card"><p style="color: #000;"><b>Name11</b><br>Biography</p><div><button class="t_left">Like</button><button class="t_right">Dislike</button></div></div>
        <div class="inner-card"><p style="color: #000;"><b>Name12</b><br>Biography</p><div><button class="t_left">Like</button><button class="t_right">Dislike</button></div></div>
        <div class="inner-card"><p style="color: #000;"><b>Name13</b><br>Biography</p><div><button class="t_left">Like</button><button class="t_right">Dislike</button></div></div>
        <div class="inner-card"><p style="color: #000;"><b>Name14</b><br>Biography</p><div><button class="t_left">Like</button><button class="t_right">Dislike</button></div></div>
        <div class="inner-card"><p style="color: #000;"><b>Name15</b><br>Biography</p><div><button class="t_left">Like</button><button class="t_right">Dislike</button></div></div>
        <div class="inner-card"><p style="color: #000;"><b>Name16</b><br>Biography</p><div><button class="t_left">Like</button><button class="t_right">Dislike</button></div></div>
        <div class="inner-card"><p style="color: #000;"><b>Name17</b><br>Biography</p><div><button class="t_left">Like</button><button class="t_right">Dislike</button></div></div>
        <div class="inner-card"><p style="color: #000;"><b>Name18</b><br>Biography</p><div><button class="t_left">Like</button><button class="t_right">Dislike</button></div></div>
        <div class="inner-card"><p style="color: #000;"><b>Name19</b><br>Biography</p><div><button class="t_left">Like</button><button class="t_right">Dislike</button></div></div>
      </div>
      <button id="refresher" onClick="window.location.reload();">Refresh Page</button>
  </body>

</html>

