<?php

class storeUserInformationCest
{
    public function testStorage(AcceptanceTester $I)
    {
		$I->amOnPage('http://localhost/capstone/app/index.php');
        $I->fillField('username','testUser');
        $I->fillField('password','testPwd');
		$I->see('Login');
        $I->click('Login');

		$I->see('Profile');
        $I->click('Profile');
		$I->see('testBio');
		$I->see('testCity');
		$I->see('testInterest');
		$I->see('Edit');
		$I->click('Edit');

		$I->seeInCurrentUrl('profileedit.php');
		$I->fillField('desc','testFieldDescription Is used here');
		$I->fillField('#citytext','New Donk City');
		$I->fillField('#addinterest','Knitting');
		//$I->click('#add');
		$I->click('submit2');
    $I->click('To Profile');
		//$I->click('To Profile');

		$I->see('testFieldDescription Is used here');
		$I->see('New Donk City');
		$I->see('Knitting');
		$I->click('Edit');

		$I->fillField('desc','testBio');
		//remove interest Knitting
		//$I->uncheckOption('#notify');
		//^ doesn't work, bring up issue with JS
		$I->fillField('#addinterest','testInterest');
		$I->fillField('citytext','testCity');
		$I->click('submit2');
		$I->click('To Profile');
		$I->see('testBio');
		$I->see('testCity');
		$I->see('testInterest');

    }
}
