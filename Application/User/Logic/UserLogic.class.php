<?php
namespace User\Logic;
use User\Model\UserModel;		//
class UserLogic extends UserModel
{
	public function getListByName($name)
	{
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
}