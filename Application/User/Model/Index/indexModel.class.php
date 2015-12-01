<?php
namespace User\Model\Index;

class indexModel
{
	protected $pageShow = ""; //xxxxx
	protected $users = array();//xxxxxx
	public function setPageShow($pageShow)
	{
		$this->pageShow = (string)$pageShow;
	}

	public function getPageShow()
	{
		$pageShow = "<a href=" . U('?p=2')>
	}

	public function setUsers($users)
	{
		$this->users = $users;
	}

	public function getUsers()
	{
		$users[] = array('id'=>1, "name"=>"zhangsan");
		$users[] = array('id'=>2, "name"=>"zhangsan");
		$users[] = array('id'=>3, "name"=>"zhangsan");
		$users[] = array('id'=>4, "name"=>"zhangsan");
		return $users;
	}

	public function getPostsByUserId($userId)
	{

	}
}