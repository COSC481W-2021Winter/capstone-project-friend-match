<?php

class swipeCest
{
  public function swipeOnProfiles(AcceptanceTester $I)
  {
      //testing login
        $I->amOnPage('http://localhost/capstone/app/index.php');
        $I->fillField('username','davert');
        $I->fillField('password','qwerty');
        $I->click('Login');
        $I->see('Name19');
        $I->see('Biography');
      //testing swiping / clicking, for browser-friendly experiences
        $I->click(['class' => 't_left']);
        $I->see('Name18');
        $I->see('Biography');
        $I->click(['class' => 't_left']);
        $I->see('Name17');
        $I->see('Biography');
        $I->click(['class' => 't_left']);
        $I->see('Name16');
        $I->see('Biography');
        $I->click(['class' => 't_left']);
        $I->see('Name15');
        $I->see('Biography');
        $I->click(['class' => 't_left']);
        $I->see('Name14');
        $I->see('Biography');
        $I->click(['class' => 't_left']);
        $I->see('Name13');
        $I->see('Biography');
        $I->click(['class' => 't_left']);
        $I->see('Name12');
        $I->see('Biography');
        $I->click(['class' => 't_left']);
        $I->see('Name11');
        $I->see('Biography');
        $I->click(['class' => 't_left']);
        $I->see('Name10');
        $I->see('Biography');
        $I->click(['class' => 't_left']);
        $I->see('Name9');
        $I->see('Biography');
        $I->click(['class' => 't_left']);
        $I->see('Name8');
        $I->see('Biography');
        $I->click(['class' => 't_left']);
        $I->see('Name7');
        $I->see('Biography');
        $I->click(['class' => 't_left']);
        $I->see('Name6');
        $I->see('Biography');
        $I->click(['class' => 't_left']);
        $I->see('Name5');
        $I->see('Biography');
        $I->click(['class' => 't_left']);
        $I->see('Name4');
        $I->see('Biography');
        $I->click(['class' => 't_left']);
        $I->see('Name3');
        $I->see('Biography');
        $I->click(['class' => 't_left']);
        $I->see('Name2');
        $I->see('Biography');
        $I->click(['class' => 't_left']);
        $I->see('Name1');
        $I->see('Biography');
        $I->click(['class' => 't_left']);
        $I->see('Name0');
        $I->see('Biography');
        $I->click(['class' => 't_left']);
        $I->see('Number of Likes:');
        $I->see('Number of Dislikes:');
      //testing refreshing page
        $I->click(['id' => 'refresher']);
        $I->see('Name19');
        $I->see('Biography');
  }
}


?>
