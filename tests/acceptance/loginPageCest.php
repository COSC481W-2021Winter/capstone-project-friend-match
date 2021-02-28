<?php

class loginPageCest {

  public function successfulSignIn(AcceptanceTester $I) {
    $I->amOnPage('http://localhost/capstone/app/index.php');
    $I->fillField('username', 'Jeff');
    $I->fillField('password', 'password123');
    $I->click('Login');
    $I->amOnPage('http://localhost/capstone/app/home.php');
  }

  public function badCredentials(AcceptanceTester $I) {
    $I->amOnPage('http://localhost/capstone/app/index.php');
    $I->fillField('username', 'badUsername');
    $I->fillField('password', 'badPassword');
    $I->click('Login');
    $I->amOnPage('http://localhost/capstone/app/index.php');
  }
}
