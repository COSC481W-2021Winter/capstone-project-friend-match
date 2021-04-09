<?php

class homeCest
{
    public function testForceLogin(AcceptanceTester $I)
    {
		//profile page test
		$I->amOnPage('http://localhost/capstone/app/profile.php');
		$I->seeInCurrentUrl('index.php');

		//profile edit page test
		$I->amOnPage('http://localhost/capstone/app/profileedit.php');
		$I->seeInCurrentUrl('index.php');

		//home page test
		$I->amOnPage('http://localhost/capstone/app/home.php');
		$I->seeInCurrentUrl('index.php');

    //friends page test
    $I->amOnPage('http://localhost/capstone/app/friends.php');
		$I->seeInCurrentUrl('index.php');
	}
}
