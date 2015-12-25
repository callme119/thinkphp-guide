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
	public function addAction(){
        //显示 display
        $WarehouseModel=new WarehouseModel();
        $this->assign('M',$WarehouseModel);
        $this->display('edit');
    }  
    public function saveAction(){
        //取用户信息

        $warehouse = I('post.');
         
        $WarehouseModel = new WarehouseModel();
        
        //添加 add()
        $WarehouseModel->addList($warehouse);

        //判断异常
        if(count($errors=$WarehouseModel->getErrors())!==0)
        {
            //数组变字符串
            $error =implode('<br/>', $errors);
            
            
            //显示错误
             $this->error("添加失败，原因：".$error,U('Warehouse/Index/index'),100);
            
        }
        $this->success("操作成功" , U('Warehouse/Index/index'));    
    }
    public function editAction(){
        //获取用户ID
        $accountId=I('get.id');

        //取用户信息 getListById()
        
        $AccountM=new AccountModel();
        $account=$AccountM->getListbyId($accountId);
       
        $AccountM->setAccount($account);
        
        //传给前台
        $this->assign('M',$AccountM);
        
        //显示 display('add')
        $this->display(); 
    }
    public function updateAction(){
        //取用户信息
        $data = I('post.');

        //传给M层
        $AccountM = new AccountModel();
        $AccountM->saveList($data);

        //判断异常
        if(count($errors=$AccountM->getErrors())!==0)
        {
            //数组变字符串
            $error =implode('<br/>', $errors);
            
            
            //显示错误
             $this->error("添加失败，原因：".$error,U('Warehouse/Index/index?',I('get.p')));

             return false;
            
        }
            $this->success("操作成功" , U('Warehouse/Index/index?',I('get.')));
    }
    public function deleteAction(){

        $userId = I('get.id');

        $AccountM = new AccountModel();
        $status = $AccountM->deleteInfo($userId);

        if($status！==false){
           $this->success("删除成功", U('Warehouse/Index/index?',I('get.p'))); 
        }
        else{
            $this->error("删除失败" , U('Warehouse/Index/index?',I('get.p')));
        }
    }
}

