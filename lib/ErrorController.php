<?php
class ErrorController extends ApplicationController
{
	function notfoundAction()
	{
		$this->layout = 'default';
		$this->render('error/404');
	}
}