<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Editing Profile</title>
		<link rel="stylesheet" href="css/main.css">
		<style>
			.linedup
			{
				
			}
		</style>
	</head>
	<body>
		
		<?php
			session_start();
			
			//store image in session
			if (isset($_POST["image"]))
			{
				$_SESSION['picture'] = $_POST['image'];
				//echo "<img id='profpic' src='".$_POST["image"]."'>";
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
		
		<!--<img id="logo" src="img/Friend_Match_Logo.svg">-->
		
		<div class="container">
			<!--Upload Picture Form-->
			<form method="post" enctype="multipart/form-data" action=<?php echo ($_SERVER["PHP_SELF"]);?>>
				Select your image:
				<input type="file" name="image" id="image" accept="image/*">
				<input type="submit" value="Upload Image" name="submit">
			</form>

			<!--Description Form-->
			<form method="post" action="home.php">
				<p>Enter Your Self Description:</p>
				<textarea id="desc" name="desc" rows="5" cols="50"></textarea>
				<input type="submit" name="submit1" value="Submit">	
				<!--Interests and city-->
				<div style="width: 100%; display: table;">
					<div style="display: table-row; height: 100px;">
						<!--Interests-->
						<div  style="width: 50%; display: table-cell;">
							<p>Please select your interests</p>
							<div class="linedup">
								<input type="checkbox" id="inter1" name="inter1" value="eating">
								<label for="inter1">Eating</label><br>
							</div>
							<div class="linedup">
								<input type="checkbox" id="inter2" name="inter2" value="movies">
								<label for="inter2">Movies</label><br>
							</div>
							<div class="linedup">
								<input type="checkbox" id="inter3" name="inter3" value="books">
								<label for="inter3">Books</label><br><br>
							</div>
							<input type="submit" name="submit2" value="Submit">
						</div>
						<!--City-->
						<div  style="width: 50%; display: table-cell;">
							<label for="city">City:</label>
							<input type="text" id="city" name="city"><br><br>
						</div>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>
