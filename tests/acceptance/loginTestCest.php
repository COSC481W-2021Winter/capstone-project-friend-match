<?php

class loginTestCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
	 public function signInSuccessfully(AcceptanceTester $I)
    {
        $I->amOnPage('http://localhost/capstone/app/index.php');
        $I->fillField('username','davert');
        $I->fillField('password','qwerty');
		$I->see('Login');
        $I->click('Login');
		$I->see('Home');
    }
}