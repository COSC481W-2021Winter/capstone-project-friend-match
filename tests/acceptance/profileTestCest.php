<?php

class profileTestCest
{
  public function _before(AcceptanceTester $I)
  {
  }

  //testing login
  public function viewProfile(AcceptanceTester $I)
  {
    $I->amOnPage('http://localhost/capstone/app/index.php');
    $I->fillField('username', 'testUser');
    $I->fillField('password', 'testPwd');
    $I->click('Login');
    $I->see('Home');
    $I->click('Profile');
    $I->seeInCurrentUrl('profile.php');
    $I->seeElement('//img[@alt="profilepic"]');
    $I->see('testBio');
    $I->see('Edit');
    $I->click('Edit');
    $I->seeCurrentUrlEquals('/capstone/app/profileedit.php');
  }


  public function testForceLogin(AcceptanceTester $I)
  {
    $I->amOnPage('http://localhost/capstone/app/profile.php');
  	$I->seeInCurrentUrl('index.php');
  }
}
