<?php
$I = new AcceptanceTester($scenario);
$I->wantTo('Create a Node');
$I->loginWithRole('administrator');
$I->amOnPage('/node/add/page');
$I->fillTextField(\Codeception\Util\Drupal\FormField::title(), 'some node');
$I->fillWysiwygEditor(\Codeception\Util\Drupal\FormField::field_text_formatted(), 'some text');
$I->clickOn(\Codeception\Util\Drupal\FormField::submit());
