<?php
namespace Litian\Logic;

use Litian\Model\UserModel;

class UserLogic extends UserModel
{
   protected $errors = array();

    public function getErrors(){
        return $this ->errors;
    }


    public function getListByName($name)
        {      
        $named = trim($name," ");      
        if ($named == "")
        {
            $this ->errors[]="用户名不能为空";
        }
        else if(is_string($named)!==true)
        {
            $this ->errors[]="请输入正确的用户名";
        }  
        else if($named=="yunzhi")
        {
            $this->errors[]="不能查找yunzhi关键字";
        }
        $map['name'] = $named;
        $data = $this->where($map)->find();
        return $data;
    }
    public function getListById($id){
        $map['id']=$id;
        $data = $this->where($map)->find();
        return $data;
    }
    protected $totalCount;
    protected $pageSize;
    protected $pageShow;
    public function getAllLists($status){
        try{
            if($status === 0 || $status === 1){
                $map[]=$status;
            }
            $counts = $this->totalCount = $this->where($map)->count();

            $pageSize = C('PAGE_SIZE');
            $Page = new \Think\Page($counts,$pageSize);            
            $Page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;每页<b>'.$pageSize.'</b>条&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
            $Page->setConfig('prev','上一页');
            $Page->setConfig('next','下一页');
            $Page->setConfig('last','末页');
            $Page->setConfig('first','首页');
            $Page->setConfig('theme','%FIRST% %UP_PAGE%  %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
            $p = (int)I('get.p')?(int)I('get.p'):1;
            $lists = $this->page($p,$pageSize)->select();
            // 调用show方法
            $this->pageShow = $Page->show();
            return $lists;
        }
        catch(\Think\Exception $e){
            $this->errors[] = $e->getErrors();
            return false;
        }

    }
    public function getPageShow(){
        return $this->pageShow;
    }
    public function deleteInfo($id){
        $map['id'] = $id;
        $datas = $this->where($map)->delete();
        return $datas;
    }
    public function addList($list){
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
    public function saveList(){
        try{
            if($this->create($list))
            {
                $id=$this->save();             
            }
            else
            {
                $this->errors[] = $this->getErrors();
                return false;
            }
        }
        catch(\Think\Exception $e)
        {
            $this->errors[] = $e->getErrors();
            return false;
       
         }
}
