<?php
class IndexController extends ApplicationController {
	function indexAction()
	{
		$this->layout = 'default';
		$this->render('index/index');
	}
}