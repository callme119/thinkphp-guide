<?php
namespace Liuxi\Logic;

use Liuxi\Model\UserModel;

class UserLogic extends UserModel
{
    protected $errors = array();
    protected $totalCount;
    protected $pageSize;
    protected $pageShow;

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

    //取编辑页面
    public function getListById($id)
    {
        $map['id'] = $id;
        $data = $this->where($map)->find();
        return $data;
    }

    public function getLists($status)
    {
        try
        {
            //$datas = $this->select();
            if($status===0||$status===1)
            {
                $map[status] = $status;
            }

            //计算总条数
            $counts = $this->totalCount = $this->where($map)->count();
            //dump($totalCount);
            //exit;

            //读取配置项
            $pageSize = C('PAGE_SIZE');
            //实例化分页类，传入总记录数和每页显示的记录数
            $Page = new\Think\Page($counts,$pageSize);

            //设置分页样式
            $Page->setConfig('prev','上一页');
            $Page->setConfig('next','下一页');
            $Page->setConfig('theme','%HEADER% %UP_PAGE% %DOWN_PAGE%');

            $this->pageShow = $Page->show();

            //判断$p是否大于0；
            if((int)I('get.p')>0)
            {
                $p=(int)I('get.p');
            }
            else
            {
                $p=1;
            }
            $lists = $this->page($_GET['p'],$pagesize)->where($map)->select();

            return $lists;
        }
        catch (\Think\Exception $e)
        {
            $this->errors[] = $e->getMessage();
            return false;
        }
    }

    public function getPageShow()
    {
        return $this->pageShow;
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