<?php
namespace QuickSort\Logic;
use Think\Model\LitianModel;
class LitianLogic extends LitianModel
{
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
