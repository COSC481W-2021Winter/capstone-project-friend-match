<?php
session_start();
if (!isset($_SESSION['uid']) || empty($_SESSION['uid']))
{
	header("Location: index.php?error=noyouhavetologin");
	exit();
}

require_once '../server/friend_sql.php';
require_once '../server/functions.php';
$uid = $_SESSION['uid'];
$profileRow = getProfile($conn, $uid);
echo "
	<script>
		const fn = '{$profileRow['firstName']}';
		const ln = '{$profileRow['lastName']}';
	</script>";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Your Account</title>
  <link rel="icon" href="img/Friend_Match_Logo.svg">
  <link rel="stylesheet" href="css/general.css">
  <link rel="stylesheet" href="css/account.css">
</head>
<body>
	<div class="container">
		<div>
			<span>First Name:</span>
			<p id="firstNameTag">Bob</p>
			<span>Last Name:</span>
			<p id="lastNameTag">Barker</p>
			<button onclick="ShowModalNames()">Edit Name</button>
		</div>
		<div>
			<!--<span>Username:</span>
			<p id="usernameTag">Test User</p>-->
			<button onclick="ShowModalUsername()">Change Username</button>
		</div>
		<div>
			<button onclick="ShowModalPassword()">Change Password</button>
		</div>
		<div>
			<a href="profile.php"><button class="button">Back</button></a>
		</div>
	</div>
	
	<!--Modal-->
	<div id="modal" class="modal">
		<div class="container">
			<span id='fieldsNotFilled'></span>
			<form action="../server/account_fun.php" method="post" onsubmit="return formCheck()">
			
			<div class="input_div">
				<input class='input'>
				<span id='confirmUsername'></span>
			</div>
			
			<div class="input_div">
				<input class='input'>
				<span id='pwdConfirm'></span>
			</div>
			
			<div class="input_div">
				<input class='input'>
			</div>
			
			<div class="row">
				<a onclick="HideModal()" class="button">Cancel</a>
				<button type="submit" id="submit">Confirm</button>
			</div>
			</form>
		</div>
	</div>
</body>
<script>
	const urlParams = new URLSearchParams(window.location.search);
	const modal = document.getElementById('modal');
	const inputs = document.getElementsByClassName('input');
	var requiredInputs = [];
	
	const pwdMatchSpan = document.getElementById('pwdConfirm');
	const requiredSpan = document.getElementById('fieldsNotFilled');
	const userSpan = document.getElementById('confirmUsername');
	
	const submitButton = document.getElementById('submit');
	const baseColor = inputs[0].style.borderColor;
	
	var confirmPwd = false;
	
	document.getElementById('firstNameTag').innerHTML = fn;
	document.getElementById('lastNameTag').innerHTML = ln;
	
	if(urlParams.has('error')){
		switch(urlParams.get('error')) {
			case 'usertaken':
				ShowModalUsername();
				userSpan.innerHTML = '*Username taken';
				userSpan.style.color = 'red';
				break;
			case 'incorrectpwduser':
				ShowModalUsername();
				requiredSpan.innerHTML = '*Incorrect Password';
				requiredSpan.style.color = 'red';
				break;
			case 'incorrectusername':
				ShowModalPassword();
				requiredSpan.innerHTML = '*Incorrect Username';
				requiredSpan.style.color = 'red';
				break;
			case 'incorrectpwdnames':
				ShowModalNames();
				requiredSpan.innerHTML = '*Incorrect Password';
				requiredSpan.style.color = 'red';
				break;
		}
	}
	
	function ShowModalUsername() {
		inputs[0].type = 'text';
		inputs[0].name = 'username';
		inputs[0].placeholder = 'New Username...';
		requiredInputs.push(inputs[0]);
		
		inputs[1].type = 'password';
		inputs[1].name = 'password';
		inputs[1].placeholder = 'Password...';
		requiredInputs.push(inputs[1]);
		
		
		inputs[2].type = 'password';
		inputs[2].name = 'none';
		inputs[2].placeholder = 'Username...';
		inputs[2].style.display = 'none';
		
		submitButton.name = 'submit-username';
		modal.style.display = "block";
	}
	
	function ShowModalPassword() {
		inputs[0].type = 'password';
		inputs[0].name = 'password';
		inputs[0].placeholder = 'New Password...';
		inputs[0].onkeyup = function(){checkPwd()};
		requiredInputs.push(inputs[0]);
		
		inputs[1].type = 'password';
		inputs[1].name = 'passwordConfirm';
		inputs[1].placeholder = 'Confirm Password...';
		inputs[1].onkeyup = function(){checkPwd()};
		requiredInputs.push(inputs[1]);
		
		inputs[2].type = 'password';
		inputs[2].name = 'username';
		inputs[2].placeholder = 'Username...';
		requiredInputs.push(inputs[2]);
		
		submitButton.name = 'submit-password';
		confirmPwd = true;
		modal.style.display = "block";
	}
	
	function ShowModalNames() {
		inputs[0].type = 'test';
		inputs[0].name = 'firstName';
		inputs[0].placeholder = 'New First Name...';
		requiredInputs.push(inputs[0]);
		
		inputs[1].type = 'test';
		inputs[1].name = 'lastName';
		inputs[1].placeholder = 'Confirm lastName...';
		requiredInputs.push(inputs[1]);
		
		inputs[2].type = 'password';
		inputs[2].name = 'password';
		inputs[2].placeholder = 'Password...';
		requiredInputs.push(inputs[2]);
		
		submitButton.name = 'submit-names';
		modal.style.display = "block";
	}
	
	function HideModal() {
		requiredInputs = [];
		confirmPwd = false;
		inputs[2].style.display = 'block';
		modal.style.display = "none";
		
		pwdMatchSpan.innerHTML = '';
		requiredSpan.innerHTML = '';
		userSpan.innerHTML = '';
		
		for(var i = 0; i < inputs.length; i++){
			inputs[i].style.borderColor = baseColor;
		}
	}
	
	function formCheck(){
		//check password confirmed
		var noError = checkPwd();
		
		//check for empty fields
		for( var i = 0; i < requiredInputs.length; i++){
			if(requiredInputs[i].value == ""){
				requiredInputs[i].style.borderColor = 'red';
				noError = false;
			}
		}
		if(!noError){
			requiredSpan.innerHTML = '*Please fill in all fields';
			requiredSpan.style.color = 'red';
		}
		return noError;
	}
	
	function checkPwd(){
		if(!confirmPwd){
			return true;
		}
		if(inputs[0].value == inputs[1].value && inputs[0].value != ''){
			pwdMatchSpan.innerHTML = '*matching';
			pwdMatchSpan.style.color = 'green';
			return true;
		}
		else{
			pwdMatchSpan.innerHTML = '*not matching';
			pwdMatchSpan.style.color = 'red';
			return false;
		}
	}
	
	function getSession(){
		$.ajax({
			url: '../server/functions.php',
			type: 'POST',
			data: {'getSession': [0]},
			success: function(data) {
				userData = data;
			}
		});
	}
</script>
</html>
