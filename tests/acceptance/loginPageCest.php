<?php

class loginPageCest {

  public function successfulSignIn(AcceptanceTester $I) {
    $I->amOnPage('http://localhost/capstone/app/index.php');
    $I->fillField('username', 'testUser');
    $I->fillField('password', 'testPwd');
    $I->click('Login');
		$I->seeInCurrentUrl('home.php');
  }

  public function badCredentials(AcceptanceTester $I) {
    $I->amOnPage('http://localhost/capstone/app/index.php');
    $I->fillField('username', 'badUsername');
    $I->fillField('password', 'badPassword');
    $I->click('Login');
		$I->seeInCurrentUrl('index.php');
  }
}
