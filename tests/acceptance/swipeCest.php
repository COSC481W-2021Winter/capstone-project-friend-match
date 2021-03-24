<?php

class swipeCest
{
  public function swipeOnProfiles(AcceptanceTester $I)
  {
      //testing login
        $I->amOnPage('http://localhost/capstone/app/index.php');
        $I->fillField('username','testUser');
        $I->fillField('password','testPwd');
        $I->click('Login');
        $I->see('Home');
        $I->see('zzzz');
        $I->click(['class' => 't_left']);
		$I->see('Seymour');
        $I->click(['class' => 't_left']);
  }
}


?>
