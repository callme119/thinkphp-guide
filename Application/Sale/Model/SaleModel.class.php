<?php
namespace Sale\Model;

use Yunzhi\Model\YunzhiModel;
use Warehouse\Model\WarehouseModel;
use Account\Model\AccountModel;

class SaleModel extends YunzhiModel
{
	protected $sale=array(); 
	protected $errors=array();

	public function getErrors()
	{
		return $this->errors;
	}

	public function setSale($sale)
	{
		//把$去掉,用的是当前类的对象的变量
		//$this是当前类的对象，对象也可以调用变量，调用变量的时候就可以去掉$
		//把传入参数值付给了当前类所实例化的对象的变量（要不然就是一个普通的变量），这个与前台的M:getxxx对应，要不然就不能用那个方法传值。
		$this->sale=$sale; 
	}
	
	public function getSale()
	{
		return $this->sale;
	}

	public function getSaleId()
	{
		return $this->sale['id'];
	}

	public function getSaleName()
	{
		return $this->sale['name'];
	}
	public function getSaleCount()
	{
		return $this->sale['count'];
	}
		public function getSaleSum_money()
	{
		return $this->sale['sum_money'];
	}
		public function getSaleDate()
	{
		return $this->sale['date'];
	}

		public function deleteInfo($id)
	{
		$map['id'] = $id;
		$datas=$this->where($map)->delete();
		return $datas;
	}		

	 public function getListById($id)
    {
        $map['id']=$id;
        $data=$this->where($map)->find();
        return $data;
    }

	public function addList($list)
	{
		try{
			
			if($this->create($list))
			{
				//存销售记录
				$id=$this->add();
				//存库存记录
				$WarehouseM = new WarehouseModel();
				$warehouse['count']=-$list['count'];
				$warehouse['date']=$list['date'];
				$currentId=$WarehouseM->addList($warehouse);
				//更新库存记录
				$warehouse['id']=$currentId;
        		$warehouseId=$warehouse['id']-1;
        		$warehouseLast=$WarehouseM->getListById((int)$warehouseId);
        		$warehouse['surplus']=$warehouseLast['surplus']+$warehouse['count'];
        		$WarehouseM->saveList($warehouse);
        		//存财务信息
				$accountM = new AccountModel();
				$array['money']=$list['sum_money'];
				$array['date']=$list['date'];
				$array['cost']=$list['count']*1;
				$array['profit']=$array['money']-$array['cost'];
				$accountM->addList($array);
				

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

	public function SaleMoneyTotal0()
	{	
		$sum=0;
		$map['status']=0;
		$datas=$this->where($map)->select();
		
		for ($i=0; $i < count($datas); $i++) { 
			$sum=$sum+$datas[$i]['sum_money'];
			# code...
		}
		
		return $sum;

	}

	public function SaleCountTotal0()
	{	
		$sum=0;
		$map['status']=0;
		$datas=$this->where($map)->select();
		
		for ($i=0; $i < count($datas); $i++) { 
			$sum=$sum+$datas[$i]['count'];
			# code...
		}
		
		return $sum;

	}

}





	