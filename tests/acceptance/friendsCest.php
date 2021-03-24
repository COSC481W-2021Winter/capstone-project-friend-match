<?php

class friendsCest
{
	public function testFriendsListed(AcceptanceTester $I)
	{
		$I->amOnPage('http://localhost/capstone/app/index.php');
		$I->fillField('username','testUser');
		$I->fillField('password','testPwd');
		$I->click('Login');
		$I->amOnPage('http://localhost/capstone/app/friends.php');
		$I->see('Steve Jobs');
	}
}