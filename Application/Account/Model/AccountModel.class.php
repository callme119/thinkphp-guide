<?php
namespace Account\Model;

use Yunzhi\Model\YunzhiModel;

class AccountModel extends YunzhiModel{
	
	protected  $errors = array();
	protected  $account=array();
	
	public function getErrors()
	{
		return $this->errors;
	}
	public function setAccount($account)
	{
		$this->account=$account;
	}
	public function getAccountId()
	{
		return $this->account['id'];
	}

	public function addList($list)
	{
		try{
			dump($this->create($list));
			if($this->create($list))
			{
				$id=$this->add();
				return $id;
			}
			else
			{
				$this->errors[]=$this->getError();
				return false;
			}
		}
		catch(\Think\Exception $e)
		{
			$this->errors[]=$e->getMessage();
			return false;
		}
	}
	public function total()
	{

	}
}