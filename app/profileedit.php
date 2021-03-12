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
			<div id="epPformdiv">
				<form method="post" enctype="multipart/form-data" action="../server/profileedit_fun.php">
					<p>Select your image:</p>
					<input type="file" name="image" id="image">
					<input type="submit" value="Upload Image" name="submit">
				</form>
			<div>

			<div id="epDIformdiv">
				<!--Description&Interests Forms-->
				<form method="post" action="../server/profileedit_fun.php">
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
								<textarea id="interests" name="interests" rows="5" cols=""></textarea>
							</div>
							<!--City-->
							<div id="citydiv" style="width: 50%; display: table-cell;">
								<label for="city">City:</label>
								<input type="text" id="citytext" name="citytext" style="width:100%"><br><br>
								
							</div>
						</div>
					</div>
					<input type="submit" name="submit2" value="Done" id="ICsubmit" class="epbutton">
				</form>
			</div>
			<!--Done button
			<div id="buttondiv">
				<a href="../server/profileedit_fun.php">
					<button type="button" class="epbutton">Done</button>
				</a>
			</div>-->
		</div>
		<script>
			//This is actually for putting in the description and city and probably the interests
			function changeDescription()
			{
				document.getElementById("desc").innerHTML= '<?php echo $description;?>';
				document.getElementById("citytext").value= '<?php echo $city;?>';
				document.getElementById("interests").innerHTML= '<?php echo $interests;?>';
			}
			
		</script>
	</body>
</html>
