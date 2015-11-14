<?php
namespace Xulinjie\Logic;

use Xulinjie\Model\XulinjieModel;

class XulinjieLogic extends XulinjieModel
{
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