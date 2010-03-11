<?php
class MoneyController extends ApplicationController
{
	function newAction()
	{
		$this->layout = 'default';
		$this->render('money/new');
	}
}