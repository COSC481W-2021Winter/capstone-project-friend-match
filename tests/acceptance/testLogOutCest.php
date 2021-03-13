<?php 

class testLogOutCest
{
    public function testLogOut(AcceptanceTester $I)
    {
		$I->amOnPage('http://localhost/capstone/app/index.php');
        $I->fillField('username','testUser');
        $I->fillField('password','testPwd');
		$I->see('Login');
        $I->click('Login');
		
		//tests logout
		$I->click('Logout');
		$I->see('Confirm Logout?');
		$I->see('No');
		$I->click('Confirm Logout?');
		$I->seeInCurrentUrl('index.php');

    }
}
