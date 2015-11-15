<?php
namespace Anqiang\Logic;

use Anqiang\Model\UserModel;

class UserLogic extends UserModel
{
    //定义保护型数据
    protected $errors=array();

    //报错函数
    public function getErrors()
    {
    	return $this->errors;
    }
    //登陆时获取用户信息判断是否存在
    public function getListByName($name)
    {
    	$named=trim($name," ");

    	if($named=="")
    	{
    		$this->errors[]="请输入用户名";
    	}

    	else if(is_string($named)!==true)
    	{
    		$this->errors[]="请输入正确格式的用户名";
    	}

    	else if($named=="yunzhi")
    	{
    		$this->errors[]="yunzhi不可作为用户名";
    	}

    	$map['name']=$named;
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
    public function getAllLists()
    {
    	$datas=$this->select();
    	return $datas;
    }

    //删除函数
    public function deleteInfo($id)
    {
    	$map['id']=$id;
    	$datas=$this->where($map)->delete();
    	return $datas;
    }


     //增加数据时验证
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
                // return $id;
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



        public function quickSort($str)
    {
        //判断数组长度 0或1直接输出
        if(count($str)<1){
            return $str;
        }

        //数组长度大于1进行排序
        else{
            $k=$str[0];//选择基数
            $left_arr=array();//定义左数组
            $right_arr=array();//定义右数组

            //进行排序
            for($i=1;$i<count($str);$i++){
                if($str[$i]>$k){
                    $right_arr[]=$str[$i];//大于基数放右数组
                }
                else $left_arr[]=$str[$i];//否则放左数组
            }

            //分别调用 并返回值
            $left_arr=$this->QuickSort($left_arr);
            $right_arr=$this->QuickSort($right_arr);

            //合并数组
            return array_merge($left_arr,array($k),$right_arr);

        }
    }


}
