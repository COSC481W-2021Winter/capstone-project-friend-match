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
		<span id='fieldsNotFilled'></span>
		<form id = "signUp">
		<div class="row">
			<div class="column">
				<div class="input_div">
					<label>First name:</label><br>
					<input type="text" id="firstName" name="field" placeholder="ex. Bob">
				</div>
			</div>
			<div class="column">
				<div class="input_div">
					<label>Last name:</label><br>
					<input type="text" id="lastName" name="field" placeholder="ex. Allen">
				</div>
			</div>
		</div>
		<div class="input_div">
			<label>Username:</label><br>
			<input type="text" id="username" name="field" onkeyup='checkUser();' placeholder="ex. BobAllen242">
			<span id='confirmUsername'></span>
		</div>
		<div class="input_div">
			<label>Password:</label><br>
			<input type="password" id="password" name="field" onkeyup='checkPassword();' placeholder="ex. qwerty">
		</div>
		<div class="input_div">
			<label>Confirm Password:</label><br>
			<input type="password" id="confirmPassword" name="field" onkeyup='checkPassword();' placeholder="ex. qwerty">
			<span id='confirmDifferent'></span>
		</div>
		</form>
		<script>
			var checkUser = function() {
				if(document.getElementById('username').value == 'JohnSmith'){
					document.getElementById('confirmUsername').innerHTML = '*Username taken';
					document.getElementById('confirmUsername').style.color = 'red';
				}
				else{
					document.getElementById('confirmUsername').innerHTML = '';
				}
			}
			
			var checkPassword = function(){
				if(document.getElementById('password').value == document.getElementById('confirmPassword').value){
					document.getElementById('confirmDifferent').innerHTML = '*matching';
					document.getElementById('confirmDifferent').style.color = 'green';
				}
				else{
					document.getElementById('confirmDifferent').innerHTML = '*not matching';
					document.getElementById('confirmDifferent').style.color = 'red';
				}
			}
		</script>
		
		<div class="row">
			<a href="index.php" class="button">Cancel</a>
			<a class="button" id="next" onClick="vaildateFilledIn()">Next</a>
		</div>
		
		<script>
			function vaildateFilledIn() {
				var arr = document.getElementsByName('field');
				var error = false;
				for( var i = 0; i < arr.length; i++){
					if(arr[i].value == ""){
						arr[i].style.borderColor = 'red';
						error = true
					}
				}
				
				if(error){
					document.getElementById('fieldsNotFilled').innerHTML = '*Please fill in all fields';
					document.getElementById('fieldsNotFilled').style.color = 'red';
				} 
				
				//if no errors, direct to profileedit
				else{
					var currentfile = window.location.pathname;
					//removes current file its at and grabs just directory
					var directory = currentfile.substring(0, currentfile.lastIndexOf('/'));
					window.location.pathname = directory+'/profileedit.php'
				}
				
			}
		</script>
    </div>
  </body>
</html>