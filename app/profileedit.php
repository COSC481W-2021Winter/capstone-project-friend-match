<!DOCTYPE html>
<?php session_start();?>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Editing Profile</title>
		<!--<link rel="stylesheet" href="css/main.css">-->
		<link rel="stylesheet" href="css/profed.css">
	</head>
	<body>
		
		
		
		<script>
			function descr
			{
				
			}
		</script>
		
		<!--Image div-->
		<div>
		<!--<img id="logo" src="img/Friend_Match_Logo.svg" because I might need it>-->
		</div>
		
		<div class="epcontainer">
			<!--Upload Picture Form-->
			<div id="epPformdiv">
				<form method="post" enctype="multipart/form-data" action="http://localhost/capstone/server/profileedit_fun.php">
					<p>Select your image:</p>
					<input type="file" name="image" id="image" accept="image/*">
					<input type="submit" value="Upload Image" name="submit">
				</form>
			<div>

			<div id="epDIformdiv">
				<!--Description&Interests Forms-->
				<form method="post" action="http://localhost/capstone/server/profileedit_fun.php">
					<!--Description-->
					<div class="eptextarea">
						<p>Enter Your Self Description:</p>
						<textarea id="desc" name="desc" rows="5" cols=""></textarea>
						<input type="submit" name="submit1" value="Submit" class="epbutton">
					</div>
					<!--Interests and city-->
					<div id="ICTableEP" style="width: 100%; display: table;">
						<div style="display: table-row; height: 100px;">
							<!--Interests-->
							<div id="interestsdiv">
								<label>Please select your interests</label>
								<ul id="epul">
									<li>
										<input class="epcheckbox" type="checkbox" id="inter1" name="interests[]" value="Walking">
										<label for="inter1">Walking</label><br>
									</li>
									<li>
										<input class="epcheckbox" type="checkbox" id="inter2" name="interests[]" value="Knitting">
										<label for="inter2">Knitting</label><br>
									</li>
									<li>
										<input class="epcheckbox" type="checkbox" id="inter3" name="interests[]" value="Reading">
										<label for="inter3">Reading</label><br>
									</li>
									<li>
										<input class="epcheckbox" type="checkbox" id="inter4" name="interests[]" value="Eating">
										<label for="inter4">Eating</label><br>
									</li>
									<li>
										<input class="epcheckbox" type="checkbox" id="inter5" name="interests[]" value="Snowboarding">
										<label for="inter5">Snowboarding</label><br>
									</li>
									<li>
										<input class="epcheckbox" type="checkbox" id="inter6" name="interests[]" value="Hiking">
										<label for="inter6">Hiking</label><br>
									</li>
									<li>
										<input class="epcheckbox" type="checkbox" id="inter7" name="interests[]" value="Boxing">
										<label for="inter7">Boxing</label><br>
									</li>
									<li>
										<input class="epcheckbox" type="checkbox" id="inter8" name="interests[]" value="Movies">
										<label for="inter8">Movies</label><br>
									</li>
									<li>
										<input class="epcheckbox" type="checkbox" id="inter9" name="interests[]" value="Art">
										<label for="inter9">Art</label><br><br>
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
				<a href="../server/profileedit_fun.php">
					<button type="button" class="epbutton">Done</button>
				</a>
			</div>
		</div>
	</body>
</html>
