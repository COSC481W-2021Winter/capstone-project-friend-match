<?php

class SignUpCest
{
    public function _before(AcceptanceTester $I)
    {
    }
	
	public function enterInformationTest(AcceptanceTester $I)
	{
		//new username
		$I->amOnPage('http://localhost/capstone/app/SignUp.php');
		$I->fillField('firstName','a');
		$I->fillField('lastName','a');
		$I->fillField('username','bjhkl');
		$I->fillField('password','a');
		$I->fillField('passwordRepeat','a');
        $I->click('submit');
		try{
			$I->seeInCurrentUrl('profileedit.php');
		} catch (Exception $e){
			$I->seeInCurrentUrl('signup_fun.php');
			$I->seeInCurrentUrl('profileedit.php');
		}
	}
	
	public function duplicateUsernameTest(AcceptanceTester $I)
	{
		
		//already used username
		$I->amOnPage('http://localhost/capstone/app/SignUp.php');
		$I->fillField('firstName','a');
		$I->fillField('lastName','a');
		$I->fillField('username','testUser');
		$I->fillField('password','a');
		$I->fillField('passwordRepeat','a');
        $I->click('submit');
		try{
			$I->seeInCurrentUrl('SignUp.php?error=usertaken');
		} catch (Exception $e){
			$I->seeInCurrentUrl('signup_fun.php');
			$I->seeInCurrentUrl('SignUp.php?error=usertaken');
		}
	}
	
	public function passwordConfirmTest(AcceptanceTester $I)
	{		
		//different password
		$I->amOnPage('http://localhost/capstone/app/SignUp.php');
		$I->fillField('firstName','c');
		$I->fillField('lastName','c');
		$I->fillField('username','cjhkl');
		$I->fillField('password','c');
		$I->fillField('passwordRepeat','b');
        $I->click('submit');
		try{
			$I->seeInCurrentUrl('SignUp.php?error=pwdnotmatch');
		} catch (Exception $e){
			$I->seeInCurrentUrl('signup_fun.php');
			$I->seeInCurrentUrl('SignUp.php?error=pwdnotmatch');
		}
	}
	
	public function requiredInformationTest (AcceptanceTester $I)
	{
		//missinginformation
		$I->amOnPage('http://localhost/capstone/app/SignUp.php');
		$I->fillField('firstName','c');
        $I->click('submit');
		try{
			$I->seeInCurrentUrl('SignUp.php?error=emptyinput');
		} catch (Exception $e){
			$I->seeInCurrentUrl('signup_fun.php');
			$I->seeInCurrentUrl('SignUp.php?error=emptyinput');
		}
	}
	
	public function skipSignUpPageTest(AcceptanceTester $I){
		$I->amOnPage('http://localhost/capstone/app/profileedit.php');
        //$I->click('submit');
		//$I->seeInCurrentUrl('http://localhost/capstone/app/SignUp.php?error=nosession');
	}
	
	public function storeInformationTest(AcceptanceTester $I)
	{
		
	}
}