<?php
namespace Account\Model\Index;

// use Account\Model\AccountModel;
 
class AddModel{
	protected $id=0;
	protected $accountMoney="";
	protected $account=array();

	public function setAccount($account)
	{
		$this->account=$account;
	}

	public function getAccountId()
	{
		return $this->account['id'];
	}

	public function getAccountMoney()
	{
		return $this->account['name'];
	}

}