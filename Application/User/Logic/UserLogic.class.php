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
		echo $this->getLastSql();
		return $datas;
	}
	public function addInfo($user){
		 $status=parent::add($user);
		 return $status;
		}
	public function saveInfo($userId,$user){
		if($this->where('$userId')->save($user)){
			$res=true;
		}
		else
			{$res=false;}

		return $res;
	}
	 public function deleteInfo($id)
    {
        $map['id'] = $id;
        return $this->where($map)->delete();
    }
}