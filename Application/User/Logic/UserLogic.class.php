<?php
namespace User\Logic;
use User\Model\UserModel;
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

	public function getAllLists()
	{
		$datas = $this->select();
		//echo $this->getLastSql();
		return $datas;
	}
	public function add(){
		$data[name] = I('post.name');
		$data[password] = I('post.password');
			return $this->add($data);
		}
	public function save($userId,$user){
		if($this->where('$userId')->save($user)){
			$res=true;
		}
		else
			{$res=false;}

		return $res;
	}
}