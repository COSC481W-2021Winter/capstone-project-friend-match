<?php

class loginPageCest {

  public function successfulSignIn(AcceptanceTester $I) {
    $I->amOnPage('http://localhost/capstone/app/index.php');
    $I->fillField('username', 'testUser');
    $I->fillField('password', 'testPwd');
    $I->click('Login');
    $I->see('Home');
  }

  public function badCredentials(AcceptanceTester $I) {
    $I->amOnPage('http://localhost/capstone/app/index.php');
    $I->fillField('username', 'badUsername');
    $I->fillField('password', 'badPassword');
    $I->click('Login');
    $I->see('Login');
  }
}
