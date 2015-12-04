<?php
namespace User\Model\Index;

use Think\Model;
class addModel
{
	protected $id=0;
	protected $userName="";
	protected $password="";
	protected $user=array();

	public function setUser($user)
	{
		$this->user=$user;
	}
	public function getId()
	{
		return $this->user['id'];
	}
	public function getUserName()
	{
		return $this->user['username'];
	}
	public function getPassword()
	{
		return $this->user['password'];
	}
}