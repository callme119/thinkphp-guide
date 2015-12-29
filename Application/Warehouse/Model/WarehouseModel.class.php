<?php
namespace Warehouse\Model;

use Yunzhi\Model\YunzhiModel;

class WarehouseModel extends YunzhiModel
{
	protected $warehouse=array(); 
	protected  $errors = array();

	public function getErrors()
	{
		return $this->errors;
	}

	public function setWarehouse($warehouse)
	{
		$this->warehouse=$warehouse;
	}
	public function getWarehouse()
	{
		return $this->warehouse;
	}
	public function getDate()
	{
		return $this->warehouse['date'];
	}
	public function getChange()
	{
		return $this->warehouse['change'];
	}
		public function getSurplus()
	{
		return $this->warehouse['surplus'];
	}
    public function getListById($id)
    {
        $map['id']=$id;
        $data=$this->where($map)->find();
        return $data;
    }
	// public function getLastListById($id)
	// {
	// 	$map['id']=(int)($id-1);
	// 	$list=$this->where($map)->find();
	// 	return $list;
	// }
	public function getId()
	{
		return $this->warehouse['id'];
	}
	public function addList($list)
	{
		try{
			// dump($this->create($list));
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
		public function deleteInfo($id)
	{
		$map['id'] = $id;
		$datas=$this->where($map)->delete();
		return $datas;
	}
}
	