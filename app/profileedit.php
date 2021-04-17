<!DOCTYPE html>
<?php
	session_start();
	//if the session containing the user id is set and not empty make some variables for the user's information and match them to the database
	if(isset($_SESSION['uid']) && !empty($_SESSION['uid']))
	{
		require_once __DIR__ . '/../server/profile_fun.php';
		$db = mysqli_connect("localhost",isset($_SERVER["SQL_USERNAME"]) ? $_SERVER["SQL_USERNAME"] : "root",isset($_SERVER["SQL_PASSWORD"]) ? $_SERVER["SQL_PASSWORD"] : "","friend-match");
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
	else if(!isset($_SESSION['username']))
	{
		header("Location: ../app/index.php?error=noyouhavetologin");
		exit();
	}
	$qu = $_SERVER['QUERY_STRING'];
	// Turn off all error reporting
		error_reporting(0);
?>

<html lang="en">
	 <?php
		if ($_SESSION['bigTest'] == "doIt"){
		echo "<p id='ghost' style='visibility: hidden'> deadly</p>"; }
	?>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Editing Profile</title>
		<link rel="stylesheet" href="css/general.css">
		<!--<link rel="stylesheet" href="css/profed.css">-->
		<link rel="icon" href="img/Friend_Match_Logo.svg">
	</head>
	<body onload="changeDescription()">
		<div class="container">
		<div><!-- Image Div -->
			<?php
				$query = $_SERVER['QUERY_STRING'];
				if($query != "" && $_GET["tempimage"] == "1")
				{
					echo "<img src='img/temp_img/".$id."' alt='profilepic' id='pfpdisplay'></img>";
					$_SESSION['tempimage'] = "1";
				}
				else{
					$_SESSION['tempimage'] = "0";
					$image_directory = "img/profilePictures/";
					$filepath = $image_directory . $id;
					if(!file_exists($filepath)){
						$filepath=$image_directory."Default";
					}
					echo"<img src='".$filepath."' alt='profilepic' id='pfpdisplay'></img>";
				}
			?>
		<!--<img id="logo" src="img/Friend_Match_Logo.svg" because I might need it>-->
		</div>
			<!--Upload Picture-->
			<form action="../server/tempfileupload_fun.php" enctype="multipart/form-data" method="post">
				<div id="epPformdiv">
					<label for="image" class="button">
						Pick Image
					</label>
					<input type="file" name="image" id="image" class="file-upload" style="display:none" onchange="this.form.submit()">
					<?php
						$query = $_SERVER['QUERY_STRING'];
						if($query != "") {
							if($_GET["error"] == "invalidphoto") {
								//echo "<script>alert('Invalid Image Upload')</script>";
								echo "<p style='color:red;'>Invalid Image Upload</p>";
							}
						}
					 ?>

					 <!-- <input type="submit" value="Upload" name="SubmitImage"> <br/> -->
				</div>
			</form>
			<?php
				if($qu != "")
				{
					if($_GET["error"] == "emptyinput")
					{
						//echo "<script>alert('Please Enter Something Into Description and City');</script>";
						echo "<p style='color:red;'>Please Enter Something Into Description and City</p>";
					}
				}
			?>
			<form method="post" enctype="multipart/form-data" action="../server/profileedit_fun.php">
				<div id="epDIformdiv" style="margin-top:20px;">
					<!--Description&Interests&City-->
						<!--City-->
					<div id="citydiv">
						<label for="city">City:</label>
						<input type="text" id="citytext" name="citytext" style="width:20%"><br><br>
					</div>
					<!--Description-->
					<div class="eptextarea">
						<p>Enter Your Self Description:</p>
						<textarea id="desc" name="desc" rows="5" cols=""  style="width:90%"></textarea>
					</div>
					<!--Interests-->
					<div style="margin-top:10px">
						<div id="interestsdiv"  style="width:90%; text-align: initial;">
							<p>Please enter your interests without Special Characters:</p>
							<div class="inaline">
								<input type="text" id="addinterest" name="addinterests" style="width:30%"/>
								<input type="button" id="add" value="Add Interest" class="button"/>
							</div>
							<ul id="epul" style="padding: 5px;">
							</ul>
						</div>
					</div>
					<div>
						<input type="submit" name="submit2" value="Confirm" id="ICsubmit" class="button">
					</div>
				</div>
			</form>
		</div>
		<script>
			var x = document.getElementById("ghost").innerHTML;
			if (x.length > 0){
				document.getElementById("interestsdiv").setAttribute("hidden", true);
				document.getElementById("epPformdiv").setAttribute("hidden", true);
			}
		</script>
		<script>

			var interestsplit;
			//This is actually for putting in the description and city and probably the interests
			function changeDescription()
			{
				document.getElementById("desc").innerHTML= '<?php echo $description;?>';
				document.getElementById("citytext").value= '<?php echo $city;?>';
				var interests = '<?php echo $interests;?>';
				interestsplit = interests.split("_");
				for (var i = 0; i<interestsplit.length; i++)
				{
					if (interestsplit[i] != ""){
						var node = document.createElement('li');
						node.className="inaline";
						node.innerHTML='<input class="epcheckbox" style="margin-right:10px;" type="checkbox" id="'+interestsplit[i]+'" name="interests[]" value="'+interestsplit[i]+'" checked><label for="'+interestsplit[i]+'">'+interestsplit[i]+'</label><br>';
						document.getElementById('epul').appendChild(node);
					}
				}
			}
			//this is for adding interests
			document.getElementById("add").onclick = function()
			{
				//Getting previous interests
			
				var label = document.getElementById("addinterest").value;
				var node = document.createElement('li');
				node.className="inaline";
				label = label.replace(/[^A-Z0-9]+/gi, '');
				label = label.charAt(0).toUpperCase() + label.substr(1).toLowerCase();;
				if (label.length > 1 && !(interestsplit.includes(label))) { //if the string user inputted is greater than one, add it as an interest and interests don't already include it
					node.innerHTML='<input class="epcheckbox" style="margin-right:10px;" type="checkbox" id="'+label+'" name="interests[]" value="'+label+'" checked><label for="'+label+'">'+label+'</label><br>';
					document.getElementById('epul').appendChild(node);
				}
				document.getElementById('addinterest').value="";

				//Add label to previous interests
				interestsplit.push(label);
			}
		</script>
	</body>
	<?php
		unset($_SESSION['bigTest'])
	?>
</html>
