<?php
session_start();
if (!isset($_SESSION['uid']) || empty($_SESSION['uid']))
{
	header("Location: ../app/index.php?error=noyouhavetologin");
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Your Account</title>
  <link rel="icon" href="img/Friend_Match_Logo.svg">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/account.css">
</head>
<body>
	<div class="friendsCard">
		<span>Username:</span>
		<p id="username">Test User</p>
		<button onclick="ShowModalUsername()">Edit</button>
	</div>
	<div class="friendsCard">
		<span>First Name:</span>
		<p id="firstName">Bob</p>
		<span>Last Name:</span>
		<p id="lastName">Barker</p>
		<button onclick="ShowModalName()">Edit</button>
	</div>
	<div class="friendsCard">
		<button onclick="ShowModalPassword()">Change Password</button>
	</div>
	
	<!--Usename Modal-->
	<div id="modalUsername" class="modal">
		<div class="modal-content">
			<span id='fieldsNotFilled1'></span>
			<form action="../server/account_fun.php" method="post" onsubmit="return NotEmpty('1')">
			<div class="input_div">
				<input type="text" class="required1" name="username" placeholder="New Username...">
				<span id='confirmUsername1'></span>
			</div>
			<div class="input_div">
				<input type="password" class="required1" name="password" placeholder="Password...">
			</div>
			<div class="row">
				<a onclick="CloseModals('1')" class="button">Cancel</a>
				<button type="submit" name="submit-username">Confirm</button>
			</div>
			</form>
		</div>
	</div>	
	
	<!--Password Modal-->
	<div id="modalPassword" class="modal">
		<div class="modal-content">
			<span id='fieldsNotFilled2'></span>
			<form action="../server/account_fun.php" method="post" onsubmit="return NotEmpty('2') && MatchingPwd()">
			<div class="input_div">
				<input type="password" class="required2" name="password" placeholder="New Password..." onkeyup="MatchingPwd()">
			</div>
			<div class="input_div">
				<input type="password" class="required2" name="passwordRepeat" placeholder="Repeat password..." onkeyup="MatchingPwd()">
				<span id='pwdConfirm2'></span>
			</div>
			<div class="input_div">
				<input type="text" class="required2" name="username" placeholder="Username...">
			</div>
			<div class="row">
				<a onclick="CloseModals('2')" class="button">Cancel</a>
				<button type="submit" name="submit-password">Confirm</button>
			</div>
			</form>
		</div>
	</div>
	
	<!--Name Modal-->
	<div id="modalName" class="modal">
		<div class="modal-content">
			<span id='fieldsNotFilled3'></span>
			<form action="../server/account_fun.php" method="post" onsubmit="return NotEmpty('3')">
			<div class="input_div">
				<input type="text" class="required3" name="firstName" placeholder="New First Name...">
			</div>
			<div class="input_div">
				<input type="text" class="required3" name="lastName" placeholder="New Last Name...">
			</div>
			<div class="input_div">
				<input type="password" class="required3" name="password" placeholder="Password...">
			</div>
			<div class="row">
				<a onclick="CloseModals('3')" class="button">Cancel</a>
				<button type="submit" name="submit-names">Confirm</button>
			</div>
			</form>
		</div>
	</div>
</body>
<script>
	const modalUsername = document.getElementById("modalUsername");
	const modalPassword = document.getElementById("modalPassword");
	const modalName = document.getElementById("modalName");
	
	const pwds = document.getElementsByClassName('required2');
	const pwdMatchSpan = document.getElementById('pwdConfirm2');
	const baseColor = document.getElementsByClassName('required1')[0].style.borderColor;
	
	function ShowModalUsername() {
		modalUsername.style.display = "block";
	}
	
	function ShowModalName() {
		modalName.style.display = "block";
	}
	
	function ShowModalPassword() {
		modalPassword.style.display = "block";
	}
	
	function CloseModals(num) {
		modalUsername.style.display = "none";
		modalName.style.display = "none";
		modalPassword.style.display = "none";
		
		requiredFields = document.getElementsByClassName('required' + num);
		requiredSpan = document.getElementById('fieldsNotFilled' + num);
		for (var i = 0; i < requiredFields.length; i++){
			requiredFields[i].style.borderColor = baseColor;
		}
		requiredSpan.innerHTML = '';
		pwdMatchSpan.innerHTML = '';
	}
	
	function NotEmpty(num){
		var noError = true;
		requiredFields = document.getElementsByClassName('required' + num);
		requiredSpan = document.getElementById('fieldsNotFilled' + num);
		
		for( var i = 0; i < requiredFields.length; i++){
			if(requiredFields[i].value == ""){
				requiredFields[i].style.borderColor = 'red';
				noError = false;
			}
		}
		if(!noError){
			requiredSpan.innerHTML = '*Please fill in all fields';
			requiredSpan.style.color = 'red';
		}
		return noError;
	}
	
	function MatchingPwd(){
		if(pwds[0].value == pwds[1].value){
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
</script>
</html>
