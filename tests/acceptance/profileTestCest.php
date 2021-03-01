<?php

class profileTestCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    //testing login
    public function logIn(AcceptanceTester $I)
    {
      $I->amOnPage('http://localhost/capstone/app/index.php');
      $I->fillField('username', 'testUser');
      $I->fillField('password', 'testPwd');
      $I->click('Login');
      $I->see('Home');
      $I->see('Biography');
      $I->see('Profile');
      $I->click('Profile');
      $I->seeCurrentUrlEquals('/capstone/app/profile.php');

    }
    //testing to see if profile can be viewed
    public function viewProfile(AcceptanceTester $I){
      $I->amOnPage('http://localhost/capstone/app/profile.php');
      $I->seeElement('//img[@alt="profilepic"]');
      $I->see('City');
      $I->see('Edit');
      $I->click('Edit');
      $I->seeCurrentUrlEquals('/capstone/app/profileedit.php');
    }
}
