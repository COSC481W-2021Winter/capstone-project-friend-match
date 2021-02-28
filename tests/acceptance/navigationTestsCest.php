<?php 

class navigationTestsCest
{
    public function _before(AcceptanceTester $I)
    {
    }

    // tests
	
	//tests that user can signin
    public function SignInTest(AcceptanceTester $I)
    {
		$I->amOnPage('http://localhost/capstone/app/index.php');
        $I->fillField('username','davert');
        $I->fillField('password','qwerty');
		$I->see('Login');
        $I->click('Login');
		$I->see('Name19');
		$I->see('Biography');
		
		//should be on home page
		$I->seeCurrentUrlEquals('/capstone/app/home.php');	
		$I->see('Home');
		$I->see('Profile');
		$I->see('Logout');
		
		//test to go to profile page from home page
		$I->click('Profile');
		$I->seeCurrentUrlEquals('/capstone/app/profile.php');	
		$I->see('Home');
		$I->see('Profile');
		$I->see('Logout');
		$I->see('BLURB ABOUT THE PERSON');
		$I->see('Edit');
		
		//test to go to home page from profile page
		$I->click('Home');
		$I->seeCurrentUrlEquals('/capstone/app/home.php');	
		$I->see('Home');
		$I->see('Profile');
		$I->see('Logout');
		$I->see('Name19');
		$I->see('Biography');
		
		//Test home page --> home page
		$I->click('Home');
		$I->seeCurrentUrlEquals('/capstone/app/home.php');	
		$I->see('Home');
		$I->see('Profile');
		$I->see('Logout');
		$I->see('Name19');
		$I->see('Biography');
		
		//Test profile page --> profile page
		$I->click('Profile');
		$I->click('Profile');
		$I->seeCurrentUrlEquals('/capstone/app/profile.php');	
		$I->see('Home');
		$I->see('Profile');
		$I->see('Logout');
		$I->see('BLURB ABOUT THE PERSON');
		$I->see('Edit');
		
		//test profile --> logout page
		$I->click('Logout');
		$I->seeCurrentUrlEquals('/capstone/app/logout.php');	
		$I->see('Confirm Logout?');
		$I->see('No');
		$I->click('No');
		
		//test home --> logout page
		$I->click('Logout');
		$I->seeCurrentUrlEquals('/capstone/app/logout.php');	
		$I->see('Confirm Logout?');
		$I->see('No');
		$I->click('No');
		
		//tests logout
		$I->click('Logout');
		$I->see('Confirm Logout?');
		$I->see('No');
		$I->click('Confirm Logout?');
		$I->seeCurrentUrlEquals('/capstone/app/index.php');	
		
		//checks to make sure user is loggedout
		
    }
	
	

}







