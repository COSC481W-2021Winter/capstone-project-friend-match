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
    $I->fillField('username','testUser');
    $I->fillField('password','testPwd');
    $I->click('Login');
    $I->see('Home');
    $I->click('Profile');
		$I->seeCurrentUrlEquals('/capstone/app/profile.php');
    $I->click('Edit');
		$I->seeCurrentUrlEquals('/capstone/app/profileedit.php');
    $I->attachFile('input[name=image]','spider.jpg');
    $I->fillField('desc','testBio');
    $I->fillField('citytext','testCity');
    $I->click('Confirm');
  }

	public function storeInDatabase(AcceptanceTester $I)
  {
    //Logs in as testUser
    $I->amOnPage('http://localhost/capstone/app/index.php');
    $I->fillField('username','testUser');
    $I->fillField('password','testPwd');
    $I->click('Login');
    $I->click('Profile');
    $I->see('testBio');
    //Edits text and checks profile page
    $I->click('Edit');
    $I->fillField('desc', 'testingProfileUpdate');
    $I->click('submit2');
    $I->amOnPage('http://localhost/capstone/app/profile.php');
    $I->see("testingProfileUpdate");
    //Returns value to normal
    $I->click('Edit');
    $I->fillField('desc', 'testBio');
	$I->fillField('#addinterest','testInterest');
	$I->fillField('citytext','testCity');
    $I->click('submit2');
    $I->amOnPage('http://localhost/capstone/app/profile.php');
  }
  
  public function testForceLogin(AcceptanceTester $I)
  {
	$I->amOnPage('http://localhost/capstone/app/profileedit.php');
	$I->seeInCurrentUrl('index.php');
  }
}
