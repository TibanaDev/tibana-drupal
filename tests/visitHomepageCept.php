<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('See the homepage');
$I->amOnPage("/");
$I->seeInTitle(getenv('CLIENT_NAME'));
