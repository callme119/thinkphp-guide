<?php
namespace Account\Model\Index;

use Account\Model\AccountModel;

class IndexModel 
{
	protected $account=array();

	public function setAccount($account)
	{
		return $this->account=$account;
	}

	public function getAccount()
	{
		return $this->account;
	}
	public function getAccountMoney()
	{
		return $this->account['money'];
	}

}

