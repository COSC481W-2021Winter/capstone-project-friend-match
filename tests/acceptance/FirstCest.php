<?php

class FirstCest
{
  public function frontpageWorks(AcceptanceTester $I)
  {
      $I->amOnPage('/');
      $I->see('Login');
  }
}
