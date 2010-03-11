<?php
class Mvc {
	var $params;
	
	var $action;
	
	var $controller;
	
	function __construct($controller, $action, $params)
	{
		$this->params = $params;
		
		$this->action = $action;
		
		$this->controller = $controller;
		
	}
	
	function run()
	{
		$controller = new $this->controller;
		$controller->params = $this->params;
		$action = $this->action;
		$controller->$action();
	}
}
