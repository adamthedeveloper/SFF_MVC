<?php
class EmployeesController extends ApplicationController
{
	var $perPage = 10;
	var $offset = 0;
	var $currentPage = 1;
	function ajaxAction()
	{
		
		if ($this->params['p'] && $this->params['p']!='' && is_numeric($this->params['p']))
		{
			$this->currentPage = $this->params['p'];
			$this->offset = ($this->currentPage*$this->perPage)-$this->perPage;
		}
		
		$q = $this->createQuery();
						
		$this->employees = $q->execute(array(), Doctrine_Core::HYDRATE_RECORD);
		$this->render('employees/ajax');
	}
	
	function showAction()
	{
		$q = $this->createQuery();
		$this->totalRecords = $q->count();
		if (!$this->params['p'] || $this->params['p']=='')
		{
			$this->params['p'] = 1;
		}
		$this->layout = 'default';
		$this->render('employees/show');
	}
	
	function createQuery()
	{
		return Doctrine_Query::create()
				->from('employee')
				->limit($this->perPage)
				->offset($this->offset);
	}
	
}