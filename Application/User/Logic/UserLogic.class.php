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
		if($name=="yunzhi"){
			$this->errors[] = "不能查找yunzhi关键字";
			return false;
		}

		if($name == ""){
			$this->errors[] ="不能为空";
			return false;
		}
		$map['name'] = $name;
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
        $where=$this->where($map);
        return $where->delete();
    }
}