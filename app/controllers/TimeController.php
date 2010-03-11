<?php
class TimeController extends ApplicationController {
	function showAction()
	{
		$this->time = Time::getTime('H:i:s');
		$this->layout = 'default';
		$this->render('time/show');
	}
}