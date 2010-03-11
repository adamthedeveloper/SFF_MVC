<?php
class DateController extends ApplicationController {
	function showAction()
	{
		$this->date = Date::getDate('m/d/Y');
		$this->layout = 'default';
		$this->render('date/show');
	}
}