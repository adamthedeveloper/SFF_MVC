<?php
class MasterController {
	var $params;
	var $layout;
	var $script;
	var $vars = array();
	
	function __set($name, $value)
	{
		$this->$name = $value;
	}
	
	function render($script)
	{
		$rootPath = dirname(__FILE__);
		$fileName = $rootPath . '/../app/views/scripts/' . $script . '.phtml';
		if (!$this->layout)
		{
			require_once($fileName);
		} else {
			$layoutPath = $rootPath . '/../app/views/layouts/' . $this->layout . '.phtml';
			$yield = $this->get_include_contents($fileName);
			if ($yield) {
				require_once($layoutPath);
			} else {
				die("No layout found at " . $layoutPath);
			}
		}
	}
	
	function get_include_contents($filename) 
	{
	    if (is_file($filename)) 
	    {
	        ob_start();
	        include $filename;
	        $contents = ob_get_contents();
	        ob_end_clean();
	        return $contents;
	    }
	    return false;
	}
	
	function renderPartial($filename)
	{
		return $this->get_include_contents(dirname(__FILE__) . '/../app/views/scripts/' . $filename . '.phtml');
	}
}
