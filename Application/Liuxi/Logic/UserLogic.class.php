<?php
namespace Liuxi\Logic;

use Liuxi\Model\UserModel;

class UserLogic extends UserModel
{
    protected $errors = array();

    public function getErrors()
    {
        return $this->errors;
    }

    public function getListByName($name)
    {
        //判断是否是字符串
        if (is_string($name) !== true)
        {
            $this->errors[] = "请输入字符串";
            return false;
        }

        //去空格
        $nameed = trim((string)$name," ");

        $map['name'] = $nameed;
        $status = $this->create($map,4);

        //判断是否为空
        if (!$status)
        {
            $this->errors[] = $this->getError();
            return false;
        }

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
        try
        {
            $datas = $this->select();
            //echo $this->getLastSql();
            return $datas;
        }
        catch (\Think\Exception $e)
        {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    public function deleteInfo($id)
    {
        $map['id'] = $id;
        $datas =$this->where($map)->delete();
        return $datas;
    }

    public function addList($list)
    {
        try
        {
            if($this->create($list))
            {
                $id = $this->add();
                return $id;
            }
            else
            {
                $this->errors[] = $this->getError();
                return false;
            }
        }
        catch(\Think\Exception $e)
        {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    public function saveList($list)
    {
        try
        {
            if ($this->create($list))
            {
                $id = $this->save();
                return $id;
            }
            else
            {
                $this->errors[] = $this->getError();
                return false;
            }
        }
        catch(\Think\Exception $e)
        {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }
}