<?php
class VersionController extends ApplicationController {
	function showAction()
	{
		$this->version = Version::getVersion();
		$this->layout = 'default';
		$this->render('version/show');
	}
}