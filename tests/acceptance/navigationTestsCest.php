<?php

class navigationTestsCest
{
  public function _before(AcceptanceTester $I)
  {}
  // tests

  //tests that user can signin
  public function navigationTest(AcceptanceTester $I)
  {
    $I->amOnPage('http://localhost/capstone/app/index.php');
    $I->fillField('username','testUser');
    $I->fillField('password','testPwd');
    $I->click('Login');

		//Start at home page
		$I->seeInCurrentUrl('home.php');
		$I->see('Home');
		$I->see('Profile');
		$I->see('Logout');

    //Home -> Home
    $I->click('Home');
    $I->seeInCurrentUrl('home.php');
    $I->see('Home');
    $I->see('Profile');
    $I->see('Logout');
    $I->seeInCurrentUrl('home.php');

    //Home -> Logout
    $I->click('Logout');
    $I->seeInCurrentUrl('logout.php');
    $I->see('Confirm Logout?');
    $I->see('No');
    $I->click('No');

		//Home -> Profile
		$I->click('Profile');
		$I->seeInCurrentUrl('profile.php');
		$I->see('Home');
		$I->see('Profile');
		$I->see('Logout');

    //Profile -> Profile
    $I->click('Profile');
    $I->seeInCurrentUrl('profile.php');
    $I->see('Home');
    $I->see('Profile');
    $I->see('Logout');

		//Profile -> Home
		$I->click('Home');
		$I->seeInCurrentUrl('home.php');
		$I->see('Home');
		$I->see('Profile');
		$I->see('Logout');

    //Profile -> Logout
    $I->click('Profile');
		$I->click('Logout');
		$I->seeInCurrentUrl('logout.php');
		$I->see('Confirm Logout?');
		$I->see('No');
		$I->click('No');

		//Logout
		$I->click('Logout');
		$I->see('Confirm Logout?');
		$I->see('No');
		$I->click('Confirm Logout?');
		$I->seeInCurrentUrl('index.php');
    }

}
