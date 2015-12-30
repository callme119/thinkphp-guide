<?php
namespace Department\Model;

use Yunzhi\Model\YunzhiModel;

class PostModel extends YunzhiModel{

	protected $id=0;
	protected $departmentName="";
	protected $department=array();

	public function setDepartment($department)
	{
		$this->department=$department;
	}

	public function getDepartmentId()
	{
		return $this->department['id'];
	}

	public function getDepartmentName()
	{
		return $this->department['name'];
	}
	
}