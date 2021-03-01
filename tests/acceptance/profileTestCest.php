<?php

class profileTestCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    //testing login
    public function logIn(AcceptanceTester $I)
    {
      $I->amOnPage('http//localhost/capstone/app/index.php');
      $I->fillField('userName', 'testUser');
      $I->fillField('password', 'testPwd');
      $I->click('Login');
      $I->see('Home');
      $I->see('Biography');
      $I->see('Profile');
      $I->click('Profile');
      $I->seeCurrentUrlEquals('http//localhost/capstone/app/profile.php');

    }
    //testing to see if profile can be viewed
    public function viewProfile(AcceptanceTester $I){
      $I->amOnPage('http//localhost/capstone/app/profile.php');
      $I->see('profilepic');
      $I->see('bio');
      $I->see('interests');
      $I->see('City');
      $I->see('Edit');
      $I->click('Edit');
      $I->seeCurrentUrlEquals('http//localhost/capstone/app/profileedit.php');
    }
}
