<?php
namespace User\Logic;
use User\Model\UserModel;
class UserLogic extends UserModel
{
	protected  $errors = array();
	public function getErrors()
	{
		return $this->errors;
	}

	public function getListByName($name)
	{
		//去空格
		$nameed=trim($name, " ");

		//判断是否为空
		if($nameed == ""){
			$this->errors[] ="不能为空";
			return false;
		}

		//判断是否是字符串
		else if (is_string($nameed)!==true) {
			$this->errors[] = "请输入字符串";
			return false;
		}

		//判断是否是关键字
		else if($nameed=="yunzhi"){
			$this->errors[] = "不能查找yunzhi关键字";
			return false;
		}
		
		$map['name'] = $nameed;
		$data = $this->where($map)->find();
		return $data;
	}

	public function getListById($id)
	{
		$map['id'] = $id;
		$data = $this->where($map)->find();
		return $data;
	}

	public function getAllLists()
	{
		$datas = $this->select();
		//echo $this->getLastSql();
		return $datas;
	}
	 public function deleteInfo($id)
    {
        $map['id'] = $id;
        $datas=$this->where($map)->delete();
        return $datas;
    }
}