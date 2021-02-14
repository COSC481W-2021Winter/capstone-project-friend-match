<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Editing Profile</title>
		<!--<link rel="stylesheet" href="css/main.css">-->
		<link rel="stylesheet" href="css/profed.css">
	</head>
	<body>
		
		<?php
			session_start();
			
			//store image in session
			if (isset($_POST["image"]))
			{
				$_SESSION['picture'] = $_POST['image'];
				//
			}
			//store description in session
			if (isset($_POST["desc"]))
			{
				$_SESSION['description'] = $_POST['desc'];
			}
		?>
		
		<script>
			function descr
			{
				
			}
		</script>
		
		<!--Image div-->
		<div>
		<!--<img id="logo" src="img/Friend_Match_Logo.svg" because I might need it>-->
			<?php
				if (isset($_SESSION['picture']))
				{
					echo "<img id='profpic' src='".$_SESSION['picture']."'>";
				}
			?>
		</div>
		
		<div class="epcontainer">
			<!--Upload Picture Form-->
			<div id="epPformdiv">
				<form method="post" enctype="multipart/form-data" action=<?php echo ($_SERVER["PHP_SELF"]);?>>
					<p>Select your image:</p>
					<input type="file" name="image" id="image" accept="image/*">
					<input type="submit" value="Upload Image" name="submit">
				</form>
			<div>

			<div id="epDIformdiv">
				<!--Description&Interests Forms-->
				<form method="post" action=<?php echo ($_SERVER["PHP_SELF"]);?>>
					<!--Description-->
					<div class="eptextarea">
						<p>Enter Your Self Description:</p>
						<textarea id="desc" name="desc" rows="5" cols=""></textarea>
						<input type="submit" name="submit1" value="Submit" class="epbutton">
					</div>
				</form>
				<form method="post" action=<?php echo ($_SERVER["PHP_SELF"]);?>>
					<!--Interests and city-->
					<div id="ICTableEP" style="width: 100%; display: table;">
						<div style="display: table-row; height: 100px;">
							<!--Interests-->
							<div id="interestsdiv">
								<label>Please select your interests</label>
								<ul id="epul">
									<li>
										<input class="epcheckbox" type="checkbox" id="inter1" name="inter1" value="eating">
										<label for="inter1">Food</label><br>
									</li>
									<li>
										<input class="epcheckbox" type="checkbox" id="inter2" name="inter2" value="movies">
										<label for="inter2">Movies</label><br>
									</li>
									<li>
										<input class="epcheckbox" type="checkbox" id="inter3" name="inter3" value="books">
										<label for="inter3">Books</label><br>
									</li>
									<li>
										<input class="epcheckbox" type="checkbox" id="inter4" name="inter4" value="eating">
										<label for="inter4">Food</label><br>
									</li>
									<li>
										<input class="epcheckbox" type="checkbox" id="inter5" name="inter5" value="movies">
										<label for="inter5">Movies</label><br>
									</li>
									<li>
										<input class="epcheckbox" type="checkbox" id="inter6" name="inter6" value="books">
										<label for="inter6">Books</label><br>
									</li>
									<li>
										<input class="epcheckbox" type="checkbox" id="inter7" name="inter7" value="eating">
										<label for="inter7">Food</label><br>
									</li>
									<li>
										<input class="epcheckbox" type="checkbox" id="inter8" name="inter8" value="movies">
										<label for="inter8">Movies</label><br>
									</li>
									<li>
										<input class="epcheckbox" type="checkbox" id="inter9" name="inter9" value="books">
										<label for="inter9">Books</label><br><br>
									</li>
								</ul>
							</div>
							<!--City-->
							<div id="citydiv" style="width: 50%; display: table-cell;">
								<label for="city">City:</label>
								<input type="text" id="citytext" name="citytext" style="width:100%"><br><br>
								<input type="submit" name="submit2" value="Submit" id="ICsubmit" class="epbutton">
							</div>
							
						</div>
					</div>
				</form>
			</div>
			
			<!--Done button-->
			<div id="buttondiv">
				<a href="profile.html">
					<button type="button" class="epbutton">Done</button>
				</a>
			</div>
		</div>
	</body>
</html>
