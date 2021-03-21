<!DOCTYPE html>
<?php
	session_start();

	//if the session containing the user id is set and not empty make some variables for the user's information and match them to the database
	if(isset($_SESSION['uid']) && !empty($_SESSION['uid']))
	{
		$db = mysqli_connect("localhost","root","","friend-match");
		$query = "SELECT city, bio, interests FROM profiles WHERE userid='".$_SESSION['uid']."'";
		$result= mysqli_query($db,$query);
		$description;
		$interests;
		$city;
		if(mysqli_num_rows($result)>0)
		{
			while($row = mysqli_fetch_assoc($result))
			{
				$city=$row["city"];
				$description=$row["bio"];
				$interests=$row["interests"];
			}
		}
		else
		{
			$city="";
			$description="";
			$interests="";
		}
	}
	else{
		header("Location: ../app/index.php?error=noyouhavetologin");
		exit();
	}
?>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Editing Profile</title>
		<!--<link rel="stylesheet" href="css/main.css">-->
		<link rel="stylesheet" href="css/profed.css">
	</head>
	<body onload="changeDescription()">

		<!--Image div-->
		<div>
		<!--<img id="logo" src="img/Friend_Match_Logo.svg" because I might need it>-->
		</div>

		<div class="epcontainer">
			<!--Upload Picture Form-->
			<form method="post" enctype="multipart/form-data" action="../server/profileedit_fun.php">
			<div id="epPformdiv">
					<p>Select your image:</p>
					<input type="file" name="image" id="image">
			<div>

			<div id="epDIformdiv">
				<!--Description&Interests Forms-->
					<!--Description-->
					<div class="eptextarea">
						<p>Enter Your Self Description:</p>
						<textarea id="desc" name="desc" rows="5" cols=""></textarea>
					</div>
					<!--Interests and city-->
					<div id="ICTableEP" style="width: 100%; display: table;">
						<div style="display: table-row; height: 100px;">
							<!--Interests-->
							<div id="interestsdiv">
								<p>Please enter your interests:</p>
								<input type="text" id="addinterest" name="addinterests" style="width:100%"/>
								<input type="button" id="add" value="add interest"/>
								<ul id="epul">

								</ul>
							</div>
							<!--City-->
							<div id="citydiv" style="width: 50%; display: table-cell;">
								<label for="city">City:</label>
								<input type="text" id="citytext" name="citytext" style="width:100%"><br><br>

							</div>
						</div>
					</div>
					<input type="submit" name="submit2" value="Confirm" id="ICsubmit" class="epbutton">
			</div>
			</form>
			<!--Done button-->
			<div id="buttondiv">
				<a href="profile.php">
					<!--The php in here is for checking if the description and city have been input before letting the done button be used-->
					<button type="button" class="epbutton" <?php if(empty($_SESSION['description'])||empty($_SESSION['city'])) echo "title='Confirm a City and Description' disabled"; ?>>To Profile</button>
				</a>
			</div>
		</div>
		<script>
			//This is actually for putting in the description and city and probably the interests
			function changeDescription()
			{
				document.getElementById("desc").innerHTML= '<?php echo $description;?>';
				document.getElementById("citytext").value= '<?php echo $city;?>';
				var interests = '<?php echo $interests;?>';
				var interestsplit = interests.split("_");
				for (var i = 0; i<interestsplit.length; i++)
				{
					var node = document.createElement('li');
					node.innerHTML='<input class="epcheckbox" type="checkbox" id="'+interestsplit[i]+'" name="interests[]" value="'+interestsplit[i]+'" checked><label for="'+interestsplit[i]+'">'+interestsplit[i]+'</label><br>';
					document.getElementById('epul').appendChild(node);
				}
			}
			document.getElementById("add").onclick = function()
			{
				var label = document.getElementById("addinterest").value;
				var node = document.createElement('li');
				node.innerHTML='<input class="epcheckbox" type="checkbox" id="'+label+'" name="interests[]" value="'+label+'" checked><label for="'+label+'">'+label+'</label><br>';
				document.getElementById('epul').appendChild(node);
			}
		</script>
	</body>
</html>
