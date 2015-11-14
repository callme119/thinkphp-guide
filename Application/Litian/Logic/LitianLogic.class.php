<?php
namespace Litian\Logic;

use Litian\Model\LitianModel;

class LitianLogic extends LitianModel
{
    //保护函数
    protected $errors = array();

    //错误信息
    public function getErrors(){
        return $this ->errors;
    }


    public function getListByName($name){
        //去空格
        $named = trim($name," ");

        //判断是否为空
        if ($named == ""){
            $this ->errors[]="用户名不能为空";
        }

        //判断是否是字符串
        else if(is_string($named)!==true){
            $this ->errors[]="请输入正确的用户名";
        }

        //判断是否为关键字
        else if($named=="yunzhi"){
            $this->errors[]="不能查找yunzhi关键字";
        }

        //函数
        $map['name'] = $named;
        $data = $this->where($map)->find();
        return $data;
    }

    //取编辑页
    public function getListById($id){
        $map['id']=$id;
        $data = $this->where($map)->find();
        return $data;
    }

    //取页面
    public function getAllLists(){
        $datas = $this->select();
        return $datas;
    }

    //删除
    public function deleteInfo($id){
        $map['id']=$id;
        $data= $this->where($map)->find();
        return $data;
    }
    //增加数据时验证
    public function addList($list){
        try{
            if($this->create($list))
            {
                $id=$this->add();
                return $id;
            }
            else{
                $this->errors[]=$this->getError();
                return false;
            }
        }
        catch(Think\Exception $e)
        {
            $this->errors[]=$e->getMessage();
            //getMessage()是PHP的一个捕获异常信息的方法
            return false;
        }
    }
    //快速排序函数
    public function QuickSort()
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
