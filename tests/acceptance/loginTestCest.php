<?php 

class loginTestCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
    }
	
	 public function signInSuccessfully(AcceptanceTester $I)
    {
        $I->amOnPage('http://localhost/cosc481/mainProj/app/index.html');
        $I->fillField('username','davert');
        $I->fillField('password','qwerty');
        $I->click('Login');
        $I->see('Name19');
		$I->see('Biography'); 
    }
}
