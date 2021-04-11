<?php

class displayProfileTestCest
{
    public function testProfileDisplay(AcceptanceTester $I)
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
  		$I->dontSee('profilepic'); // Checks to make sure alt doesn't show
    }
}
