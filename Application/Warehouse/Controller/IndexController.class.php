<?php
namespace Warehouse\Controller;

use Think\Controller;
use Warehouse\Model\WarehouseModel;

class IndexController extends Controller
{
	public function indexAction()
	{
		$WarehouseM = new WarehouseModel();
        $warehouses = $WarehouseM->getLists();

        $WarehouseM->setWarehouse($warehouses);
        // $WarehouseM->MoneyTotal0();

        $this->assign('M',$WarehouseM);

		$this->display();
	}
}

