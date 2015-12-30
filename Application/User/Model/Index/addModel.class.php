<?php
namespace User\Model\Index;

class addModel
{
	protected $id = 0;
	protected $userName = "";
	protected $password = "";
	protected $user = array();

	public function setUser($user)
	{
		$this->user = $user;
	}

	public function getId()
	{
		return $this->user['id'];
		
	}
	public function getUserName()
	{
		return $this->user['name'];
	}
	public function getPassword()
	{
		return $this->user['password'];
	}
	public function getPhone()
	{
		return $this->user['phonenumber'];
	}
	public function getMail()
	{
		return $this->user['mailbox'];
	}
}
