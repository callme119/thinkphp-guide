<?php
namespace Xulinjie\Logic;

use Xulinjie\Model\UserModel;

class UserLogic extends UserModel
{
    protected $totalCount = 0;
    protected $pagesize = 0;
    protected $pageShow = 0;
    protected  $errors = array();
    public function getErrors()
    {
        return $this->errors;
    }

    public function getListByName($name)
    {
        //判断是否是字符串
        if (is_string($name)!==true) {
            $this->errors[] = "传入变量类型非string";
            return false;
        }

        //去空格
        $nameed=trim((string)$name, " ");

        
        $map['name'] = $nameed;
        $status=$this->create($map,4);

        //判断状态
        if(!status)
        {
            $this->errors[]=$this->getError();
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

    public function getLists($status=0)
    {
        try{
            if($status===0 || $status===1)
            {
                $map[status] = $status;
            }    
        
        //计算总条数
            $this->totalCount = $this->where($map)->count();

            //读取配置项
            $pagesize = C('PAGE_SIZE');

            // 实例化分页类 传入总记录数和每页显示的记录数
            $Page = new \Think\Page($this->totalCount,$pagesize);
            $this->pageShow = $Page->show();
            $lists = $this->page($_GET['p'],$pagesize)->select();
        
        //echo $this->getLastSql();
          return $lists;
        }
        catch(\Think\Exception $e)
        {
            $this->errors[]=$e->getMessage();
            return false;
        }

    }
    public function getPageShow(){
        return $this->pageShow;
    }
     public function deleteInfo($id)
    {
        $map['id'] = $id;
        $datas=$this->where($map)->delete();
        return $datas;
    }
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
    public function quickSort($lists,$relists=array())
    {
        $length = count($lists);
        $count = count($relists);
        if($length <= 1)
        {
            array_splice($relists,$count,0,$lists[0]);
             return $relists;
        }
        $min = $lists[0];
        for($i=1; $i<$length; $i++)  
        {   
            if($min >= $lists[$i]) 
            {
                $min = $lists[$i];
                $j = $i;
            }
        }
        array_splice($lists, $j, 1);        
        array_splice($relists,$count,0,$min);       
        $relists = $this->quickSort($lists,$relists);
        return $relists;        
    }
    public function quick_sort($test) 
        {
            //先判断是否需要继续进行
            $length = count($test);
            if($length <= 1)
            {
                return $test;
            }
            //如果没有返回，说明数组内的元素个数 多余1个，需要排序
            //选择一个标尺
            //选择第一个元素
            $base_num = $test[0];
            //遍历 除了标尺外的所有元素，按照大小关系放入两个数组内
            //初始化两个数组
            $left_array = array();//小于标尺的
            $right_array = array();//大于标尺的
            for($i=1; $i<$length; $i++)  
            {
                
                
                if($base_num > $test[$i]) 
                {//放入左边数组
                    $left_array[] = $test[$i];
                }
                else 
                { //放入右边
                    $right_array[] = $test[$i];
                } 
            }
            //再分别对 左边 和 右边的数组进行相同的排序处理方式
            //递归调用这个函数,并记录结果
            $left_array = $this-> quick_sort($left_array);
            $right_array =$this-> quick_sort($right_array);
           
            //合并左边 标尺 右边
            return array_merge($left_array, array($base_num), $right_array);
        }

}