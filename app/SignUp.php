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
		<form action="../server/signup_fun.php" method="post" onsubmit="return formCheck()">
			<div class="row">
				<div class="column">
					<div class="input_div">
						<input type="text" class="required" name="firstName" placeholder="First name...">
					</div>
				</div>
				<div class="column">
					<div class="input_div">
						<input type="text" class="required" name="lastName" placeholder="Last name...">
					</div>
				</div>
			</div>
			<div class="input_div">
				<input type="text" class="required" name="username" placeholder="Username...">
				<span id='confirmUsername'></span>
			</div>
			<div class="input_div">
				<input type="password" class="required" name="password" placeholder="Password..." onkeyup="checkPwd()">
			</div>
			<div class="input_div">
				<input type="password" class="required" name="passwordRepeat" placeholder="Repeat password..." onkeyup="checkPwd()">
				<span id='pwdConfirm'></span>
			</div>
			<div class="row">
				<a href="index.php" class="button">Cancel</a>
				<button type="submit" name="submit">Next</button>
			</div>
		</form>
    </div>
  </body>
  <script>
	const queryString = window.location.search;
	const urlParams = new URLSearchParams(queryString);
	
	const requiredFields = document.getElementsByClassName('required');
	const pwdMatchSpan = document.getElementById('pwdConfirm')
	const requiredSpan = document.getElementById('fieldsNotFilled')
	
	if(urlParams.has('error')){
	
		if(urlParams.get('error') == 'emptyinput'){
			
			console.log(urlParams.get('error'));
		}
		if(urlParams.get('error') == 'pwdnotmatch'){
			pwdMatchSpan.innerHTML = '*not matching';
			pwdMatchSpan.style.color = 'red';
		}
		if(urlParams.get('error') == 'usertaken'){
			document.getElementById('confirmUsername').innerHTML = '*Username taken';
			document.getElementById('confirmUsername').style.color = 'red';
		}
	}
	
	function formCheck(){
		var noError = checkPwd();
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
	
	function checkPwd(){
		if(requiredFields[3].value == requiredFields[4].value){
			pwdMatchSpan.innerHTML = '*matching';
			pwdMatchSpan.style.color = 'green';
			return true;
		}
		else{
			pwdMatchSpan.innerHTML = '*not matching';
			pwdMatchSpan.style.color = 'red';
			return fasle;
		}
	}
  </script>
</html>