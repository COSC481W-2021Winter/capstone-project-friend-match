<!DOCTYPE html>
<?php
	session_start();

	if (!isset($_SESSION['uid']) || empty($_SESSION['uid']))
	{
		header("Location: ../app/index.php?error=noyouhavetologin");
		exit();
	}
	require_once '../server/friend_sql.php';
	require_once '../server/functions.php';
	echo "<script> const uid = {$_SESSION['uid']}; </script>";
?>
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/general.css"/>
	  <link rel="stylesheet" href="css/nav.css"/>
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
					SwipeLeft(swipe_left + swipe_right);
          swipe_left = swipe_left + 1;
          document.getElementById("left_swipes").innerHTML = swipe_left;
          $(this).hide();
        });

        $(".inner-card").on("swiperight", function(){
		  		SwipeRight(swipe_left + swipe_right);
          swipe_right = swipe_right + 1;
          document.getElementById("right_swipes").innerHTML = swipe_right;
          $(this).hide();
        });

        $(".t_left").click(function(){
					SwipeLeft(swipe_left + swipe_right);
          swipe_left = swipe_left + 1;
          document.getElementById("left_swipes").innerHTML = swipe_left;
          $(this).parent().parent().hide();
        });

        $(".t_right").click(function(){
		  		SwipeRight(swipe_left + swipe_right);
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
			<a href="friends.php" style="text-decoration:none;"><button class="NavBar" onclick="Friends()" id="Friends"> Friends</button></a>
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
		function Friends(){
			var currentfile = window.location.pathname;
			//removes current file its at and grabs just directory
			var directory = currentfile.substring(0, currentfile.lastIndexOf('/'));
			window.location.pathname = directory+'/friends.php';
		}
	</script>
	<a href="home.php"><img id="logo" src="img/Friend_Match_Logo.svg" alt="logo" height="80" class="navImg"></a>
  </head>

  <body>
    <!-- Cards -->
      <div class="outer-deck" id="deck">
        <!-- deck plays by "sandwich rules" (first div is bottom, like the bread) -->
        <div class="inner-end"><br><p style="color: #000;">Number of Likes: <span id="right_swipes">0</span>Number of Dislikes: <span id="left_swipes">0</span></p></div>
        <?php
				getEligibleUsers($conn, $_SESSION["uid"]);
				?>
			</div>
  </body>

	<script>
	function SwipeRight(currentId){
		$.ajax({
			url: '../server/functions.php',
			type: 'POST',
			data: {'createMatch': [uid, rows[currentId], 1]},
			success: function(data) {
				console.log(data);
			}
		});
	}

	function SwipeLeft(currentId){
		$.ajax({
			url: '../server/functions.php',
			type: 'POST',
			data: {'createMatch': [uid, rows[currentId], 0]},
			success: function(data) {
				console.log(data);
			}
		});
	}
	</script>
</html>
