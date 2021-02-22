<?php

class loginPageCest
{

	 public function signInSuccess(AcceptanceTester $I)
    {
        $I->amOnPage('http://localhost/capstone/app/index.php');
        $I->fillField('username','goodUsername');
        $I->fillField('password','goodPassword');
        $I->click('Login');
        $I->see('Name19');
        $I->see('Biography');
    }

    public function signInFail(AcceptanceTester $I)
     {
         $I->amOnPage('http://localhost/capstone/app/index.php');
         $I->fillField('username','badUsername');
         $I->fillField('password','badPassword');
         $I->click('Login');
         $I->see('Name19');
         $I->see('Biography');
     }

}
