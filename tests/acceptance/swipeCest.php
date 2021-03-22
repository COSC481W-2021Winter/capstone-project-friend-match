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
        $I->see('Seymour');
      //testing swiping / clicking, for browser-friendly experiences
        $I->click(['class' => 't_left']);
        $I->see('Ester');
        $I->see('Down to Clown');
        $I->click(['class' => 't_left']);
        $I->see('Josiah');
        $I->see('Not interested in pictures of Spiderman');
        $I->click(['class' => 't_left']);
        $I->see('Randolph');
        $I->see('Just moved here, hoping to make some new friends');
        $I->click(['class' => 't_left']);
        $I->see('Baby');
        $I->see('Named after a movie');
        $I->click(['class' => 't_left']);
        $I->see('Steve');
        $I->see('Steve Jobs, of Apple');
        $I->click(['class' => 't_left']);
        $I->see('Number of Likes:');
        $I->see('Number of Dislikes:');
      //testing refreshing page
        $I->click(['id' => 'refresher']);
        $I->see('Seymour');
        $I->see('Life is too short not to learn new things.');
  }
}


?>
