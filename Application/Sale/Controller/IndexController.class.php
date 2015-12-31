<?php
namespace Sale\Controller;

use Think\Controller;
use Sale\Model\SaleModel;
use Warehouse\Model\WarehouseModel;

class IndexController extends Controller
{
	public function indexAction()
	{
		$SaleM = new SaleModel();
        $sales = $SaleM->getLists();

        $SaleM->setSale($sales);

        $this->assign('M',$SaleM);

		$this->display();
	}

	public function addAction()
	{
		$SaleModel=new SaleModel();

        $this->assign('M',$SaleModel);
		
		$this->display();
	}

    public function saveAction()
    {
        //取销售信息
        $sale = I('post.');
         
        $SaleModel = new SaleModel();
        
        //存销售信息
        $SaleModel->addList($sale);
        //存库存信息
       
        $this->success("操作成功" , U('Sale/Index/index')); 
    }

    public function deleteAction()
    {
        $saleId = I('get.id');
        $SaleM = new SaleModel();
        $status = $SaleM->deleteInfo($saleId);
        if($status！==false)
        {
           $this->success("删除成功", U('Sale/Index/index?',I('get.p'))); 
        }
        else
        {
            $this->error("删除失败" , U('Sale/Index/index?',I('get.p')));
        }
    }

    public function editAction(){
        //获取用户ID
        $saleId = I('get.id');

        //取用户信息 getListById()
        $SaleM = new SaleModel();
        $sale = $SaleM->getListById($saleId);

        $SaleModel=new saleModel();
        $SaleModel->setSale($sale);

        $this->assign('M',$SaleModel);
        
        //显示 display('sale')
        $this->display('add'); 
    }
    public function updateAction(){
        //取用户信息
        $data = I('post.');

        //传给M层
        $SaleM = new SaleModel();
        $SaleM->saveList($data);

        //判断异常
        if(count($errors=$SaleM->getErrors())!==0)
        {
            //数组变字符串
            $error =implode('<br/>', $errors);
            
            
            //显示错误
             $this->error("添加失败，原因：".$error,U('Sale/Index/index?',I('get.p')));

             return false;
            
        }
            $this->success("操作成功" , U('Sale/Index/index?',I('get.')));
    }

}
