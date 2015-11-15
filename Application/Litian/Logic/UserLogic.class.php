<?php
namespace Litian\Logic;

use Litian\Model\UserModel;

class UserLogic extends UserModel
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
    // 定义私有变量
    protected $totalCount;
    protected $pageSize;
    protected $pageShow;
    //取页面
    public function getAllLists($status){
        try{
            if($status === 0 || $status === 1){
                $map[]=$status;
            }

            // 计算总条数
            $counts = $this->totalCount = $this->where($map)->count();

            // 读取配置信息
            $pageSize = C('PAGE_SIZE');

            // 实例化page类
            $Page = new \Think\Page($counts,$pageSize);
            // 分页 对象要大写
            $Page->setConfig('header','<li class="rows">共<b>%TOTAL_ROW%</b>条记录&nbsp;&nbsp;每页<b>%LIST_ROW%</b>条&nbsp;&nbsp;第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</li>');
            $Page->setConfig('prev','上一页');
            $Page->setConfig('next','下一页');
            $Page->setConfig('last','末页');
            $Page->setConfig('first','首页');
            $Page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');

            //比目运算 判断是否大于0
            $p = (int)I('get.p')?(int)I('get.p'):1;//变量p
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
    // pageshow方法
    public function getPageShow(){
        return $this->pageShow;
    }
    //删除
    public function deleteInfo($id){
        $map['id'] = $id;
        $datas = $this->where($map)->delete();
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
