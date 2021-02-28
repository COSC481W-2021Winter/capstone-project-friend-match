<?php

class FirstCest
{
  public function frontpageWorks(AcceptanceTester $I)
  {
      $I->amOnPage('http://localhost/capstone/app/index.php');
      $I->see('Login');
  }
}

?>
