<?php 

class displayProfileTestCest
{
    public function tryToTest(AcceptanceTester $I)
    {
		$I->amOnPage('http://localhost/capstone/app/index.php');
        $I->fillField('username','testUser');
        $I->fillField('password','testPwd');
		$I->see('Login');
        $I->click('Login');
    }
}
