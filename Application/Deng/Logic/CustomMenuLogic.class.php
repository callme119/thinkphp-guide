<?php
namespace Deng\Logic;

use Deng\Model\CustomMenuModel;

class CustomMenuLogic extends CustomMenuModel
{
	public function getErrors()
	{
		return $this->errors;
	}

	public function getListById($id)
	{
		$map['id'] = $id;
		$data = $this->where($map)->find();
		return $data;
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

		
		$map['title'] = $name;
		$data = $this->where($map)->find();
		return $data;
	}

	public function getLists($status=0)
	{
		try
		{
			$lists=$this->select();

			return $lists;
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
		$datas = $this->where($map)->delete();
		return $datas;
	}

	public function addList($list)
	{
		try{
			//将ptitle转换为pid
			$ptitle = $list['pid'];
			$list['pid'] = $this->getListByName($ptitle)['id'];

			if($this->create($list))
			{
				$data = $this->add();

				return $data;
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

	public function getTitles(){
		try 
		{
			$titles = array();
			$data = $this->getLists();
			foreach ($data as $key => $value) {
				$titles[] = $value['title'];
			}
			return $titles;
		}
		catch(\Think\Exception $e)
		{
			$this->errors[]=$e->getMessage();
			return false;
		}
	}
}