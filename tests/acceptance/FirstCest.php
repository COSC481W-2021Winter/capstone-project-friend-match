<?php

class FIrstCest
{
  public function frontpageWorks(AcceptanceTester $I)
  {
      $I->amOnPage('/');
      $I->see('Login');
  }
}
