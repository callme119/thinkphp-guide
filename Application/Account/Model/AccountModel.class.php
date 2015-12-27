<?php
namespace Account\Model;

use Yunzhi\Model\YunzhiModel;

class AccountModel extends YunzhiModel{
	
	protected  $errors = array();
	protected  $account=array();
	protected  $sum=0;
	protected  $id=0;


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
	public function getAccount()
	{
		return $this->account;
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
	public function saveList($list){
		try{
			if($this->create($list))
			{
				dump($list);
				$id=$this->save();
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
	public function getAccountMoney()
	{
		return $this->account['money'];
	}
	public function getAccountDate()
	{
		return $this->account['date'];
	}
	public function getAccountProfit()
	{
		return $this->account['profit'];
	}
	public function MoneyTotal0()
	{	
		$sum=0;
		$map['status']=0;
		$datas=$this->where($map)->select();
		
		for ($i=0; $i < count($datas); $i++) { 
			$sum=$sum+$datas[$i]['money'];
			# code...
		}
		
		return $sum;

	}

	public function deleteInfo($id)
	{
		$map['id'] = $id;
		$datas=$this->where($map)->delete();
		return $datas;
	}
	// public function getTotal0()
	// {
	// 	return $this->sum;
	// }
}