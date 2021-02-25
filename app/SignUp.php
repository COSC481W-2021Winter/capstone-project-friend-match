<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Friend Match-Sign Up</title>
  <link rel="stylesheet" href="css/signUp.css">
</head>
  <body>
    <div class="container">
		<form action="../server/signup_fun.php" method="post">
			<div class="row">
				<div class="column">
					<div class="input_div">
						<input type="text" name="firstName" placeholder="First name...">
					</div>
				</div>
				<div class="column">
					<div class="input_div">
						<input type="text" name="lastName" placeholder="Last name...">
					</div>
				</div>
			</div>
			<div class="input_div">
				<input type="text" name="username" placeholder="Username...">
				<span id='confirmUsername'></span>
			</div>
			<div class="input_div">
				<input type="password" name="password" placeholder="Password...">
			</div>
			<div class="input_div">
				<input type="password" name="passwordRepeat" placeholder="Repeat password...">
				<span id='confirmDifferent'></span>
			</div>
			<div class="row">
				<a href="index.php" class="button">Cancel</a>
				<button type="submit" name="submit">Next</button>
			</div>
		</form>
    </div>
  </body>
</html>