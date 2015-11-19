<?php
namespace Anqiang\Logic;

use Anqiang\Model\UserModel;

class UserLogic extends UserModel
{
    //定义保护型数据
    protected $errors=array();
   // protected $totalCount=0;
   // protected $pagesize=0;
    protected $pageShow=0;

    //报错函数
    public function getErrors()
    {
        return $this->errors;
    }
    //登陆时获取用户信息判断是否存在
    public function getListByName($name)
    {
        $name=trim($name," ");

        if($name=="")
        {
            $this->errors[]="请输入用户名";
            return false;
        }

        if(is_string($name)!==true)
        {
            $this->errors[]="请输入正确格式（字符串类型）的用户名";
            return false;
        }

        if($name=="yunzhi")
        {
            $this->errors[]="yunzhi不可作为用户名";
            return false;
        }

        $map['name']=$name;
        $data=$this->where($map)->find();
        return $data;
    }

    //通过id查找信息
    public function getListById($id)
    {
        $map['id']=$id;
        $data=$this->where($map)->find();
        return $data;
    }

    //取所有信息
    // public function getAllLists()
    // {
    //  $datas=$this->select();
    //  return $datas;
        
    // }

    public function getLists($status=0)
    {
        try
        {
            if($status==0||$status==1)
            {
                $map[status]=$status;
            }
            //去空格
            $keywords=trim(I('get.keywords'));
            //判断是否为空
            if($keywords!=="")
            {
                $map['name']=array('like','%'.$keywords.'%');
            }

            //计算总条数
            $totalCount=$this->where($map)->count();

            //读取配置项
            $pagesize=C('PAGE_SIZE');//如何读取？

            //实例化分页类 传入总记录数和每页显示的记录数
            $Page = new \Think\Page($totalCount,$pagesize);


            //设置分页样式
            $Page->setConfig('prev','上一页');
            $Page->setConfig('next','下一页');
            $Page->setConfig('theme','%HEADER% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE%');

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
            
            $lists=$this->page($_GET['p'],$pagesize)->where($map)->select();

            return $lists;
        }
        catch(\Think\Exception $e)
        {
            $this->errors[]=$e->getMessage();
            return false;
        }
    }

    public function getPageShow()
    {
        return $this->pageShow;
    }

    //删除函数
    public function deleteInfo($id)
    {
        $map['id']=$id;
        $datas=$this->where($map)->delete();
        return $datas;
    }


     //增加数据时验证
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



    // public function quickSort($str)
    // {
    //     //判断数组长度 0或1直接输出
    //     if(count($str)<1){
    //         return $str;
    //     }

    //     //数组长度大于1进行排序
    //     else{
    //         $k=$str[0];//选择基数
    //         $left_arr=array();//定义左数组
    //         $right_arr=array();//定义右数组

    //         //进行排序
    //         for($i=1;$i<count($str);$i++){
    //             if($str[$i]>$k){
    //                 $right_arr[]=$str[$i];//大于基数放右数组
    //             }
    //             else $left_arr[]=$str[$i];//否则放左数组
    //         }

    //         //分别调用 并返回值
    //         $left_arr=$this->QuickSort($left_arr);
    //         $right_arr=$this->QuickSort($right_arr);

    //         //合并数组
    //         return array_merge($left_arr,array($k),$right_arr);

    //     }
    // }


}
