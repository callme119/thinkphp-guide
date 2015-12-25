<?php
namespace Warehouse\Model;

use Yunzhi\Model\YunzhiModel;

class WarehouseModel extends YunzhiModel
{
	protected $warehouse=array(); 

	public function setWarehouse($warehouse)
	{
		$this->warehouse=$warehouse;
	}
	public function getWarehouse()
	{
		return $this->warehouse;
	}
}
	