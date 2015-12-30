<?php
namespace Department\Model\Index;

use Department\Model\DepartmentModel;

class IndexModel 
{
	protected $departments=array();

	public function setDepartments($departments)
	{
		$this->departments=$departments;
	}

	public function getDepartments()
	{
		return $this->departments;
	}
}

