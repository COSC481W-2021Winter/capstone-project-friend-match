<?php

class profileEditCest
{
    public function _before(AcceptanceTester $I)
    {}

    // tests
    public function tryToTest(AcceptanceTester $I)
    {}

	public function logIn(AcceptanceTester $I)
    {
        $I->amOnPage('http://localhost/capstone/app/index.php');
        $I->fillField('username','x');
        $I->fillField('password','y');
        $I->click('Login');
        $I->see('Name19');
        $I->see('Biography');
    }
	
	public function accessProfile(AcceptanceTester $I)
    {
        $I->amOnPage('http://localhost/capstone/app/home.php');
        $I->click(' Profile');
        $I->see('Edit');
    }
	
	public function alterInfoDescription(AcceptanceTester $I)
    {
        $I->amOnPage('http://localhost/capstone/app/profileedit.php');
        $I->fillField('desc','x');
        $I->click('submit1');
    }
	public function alterInfoInterestsLocation(AcceptanceTester $I)
    {
        $I->amOnPage('http://localhost/capstone/app/profileedit.php');
		$I->checkOption('form input[name=inter1]');
		$I->checkOption('form input[name=inter2]');
		$I->checkOption('form input[name=inter3]');
		$I->checkOption('form input[name=inter4]');
		$I->checkOption('form input[name=inter5]');
		$I->checkOption('form input[name=inter6]');
		$I->checkOption('form input[name=inter7]');
		$I->checkOption('form input[name=inter8]');
		$I->checkOption('form input[name=inter9]');
		$I->fillField('citytext','x');
		$I->click('submit2');
    }
	public function uploadImage(AcceptanceTester $I)
    {
        $I->amOnPage('http://localhost/capstone/app/profileedit.php');
        $I->attachFile('input[name=image]','spider.jpg');
        $I->click('submit');
    }
}
