<?php

class SignUpCest
{
    public function _before(AcceptanceTester $I)
    {
    }

	 public function signInSuccessfully(AcceptanceTester $I)
    {
        $I->amOnPage('http://localhost/capstone/app/SignUp.php');
        $I->fillField('username','davert');
        $I->fillField('password','qwerty');
        $I->click('Login');
        $I->see('Name19');
        $I->see('Biography');
    }
	
	public function enterInformationTest(AcceptanceTester $I)
	{
		
	}
	
	public function duplicateUsernameTest(AcceptanceTester $I)
	{
		
	}
	
	public function passwordConfirmTest(AcceptanceTester $I)
	{
		
	}
	
	public function requiredIndormationTest (AcceptanceTester $I)
	{
		
	}
	
	public function uploadIamgeTest(AcceptanceTester $I)
	{
		
	}
	
	public function storeInformationTest(AcceptanceTester $I)
	{
		
	}
}