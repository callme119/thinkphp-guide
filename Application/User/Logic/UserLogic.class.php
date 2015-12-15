<?php
namespace User\Logic;

use User\Model\UserModel;

class UserLogic extends UserModel
{
	protected $pageShow = 0;
	protected  $errors = array();

	public function getErrors()
	{
		return $this->errors;
	}

	public function getListByName($name)
	{
		//判断是否是字符串
		if (is_string($name)!==true) {
			$this->errors[] = "传入变量类型非string";
			return false;
		}

		//去空格
		$name=trim((string)$name, " ");

		
		$map['name'] = $name;
		$status=$this->create($map,4);

		//判断状态
		if (!$status)
		{
			$this->errors[]=$this->getError();
			return false;
		}

		$data = $this->where($map)->find();
		return $data;
	}

	
	public function deleteInfo($id)
	{
		$map['id'] = $id;
		$datas=$this->where($map)->delete();
		return $datas;
	}
	public function addList($list)
	{
		try{
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
}