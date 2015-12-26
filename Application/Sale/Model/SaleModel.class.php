<?php
namespace Sale\Model;

use Yunzhi\Model\YunzhiModel;

class SaleModel extends YunzhiModel
{
	protected $sale=array(); 

	public function setSale($sale)
	{
		//把$去掉,用的是当前类的对象的变量
		//$this是当前类的对象，对象也可以调用变量，调用变量的时候就可以去掉$
		$this->sale=$sale;  //把传入参数值付给了当前类所实例化的对象的变量（要不然就是一个普通的变量），这个与前台的M:getxxx对应，要不然就不能用那个方法传值。
	}
	
	public function getSale()
	{
		return $this->sale;
	}

	public function getListById($id)
    {
        $map['id']=$id;
        $data=$this->where($map)->find();
        return $data;
    }

}
	