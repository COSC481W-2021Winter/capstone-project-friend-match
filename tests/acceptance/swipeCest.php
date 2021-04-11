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
        $I->seeInCurrentUrl('home.php');
        //testing swiping / clicking, for browser-friendly experiences

        /*
        * NOTE:
        * The following test is entirely dependant on the results of an sql
        * query, one that has varying results. The program is structured in
        * such a way that the page being built has the possibility of looking
        * different each time it runs. Sometimes is won't show any swipable
        * cards at all. If you are running into issure, just ensure the
        * database access and friend matching features both operate as expected
        * before attempting to debug this.
        *
        * TL;DR This is currently impossible to construct a consistent test
        * case for. Hours wasted trying to anyways: 3.5
        */

        /*
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
        */
  }
}


?>
