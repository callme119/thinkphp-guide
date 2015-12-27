<?php
namespace Account\Controller;

use Think\Controller;
use Account\Model\AccountModel;
use Account\Model\Index\IndexModel;
use Account\Model\Index\AddModel;
  

class IndexController extends Controller
{
    public function indexAction(){      

        //获取列表

        $AccountM = new AccountModel();
        $accounts = $AccountM->getLists();

        $AccountM->setAccount($accounts);
        $AccountM->MoneyTotal0();

        $this->assign('M',$AccountM);

		$this->display();
	}
    public function addAction(){
        //显示 display
        $AccountModel=new AccountModel();
        $this->assign('M',$AccountModel);
        $this->display('edit');
    }  
    public function saveAction(){
        //取用户信息

        $account = I('post.');
         
        $AccountModel = new AccountModel();
        
        //添加 add()
        $AccountModel->addList($account);

        //判断异常
        if(count($errors=$AccountModel->getErrors())!==0)
        {
            //数组变字符串
            $error =implode('<br/>', $errors);
            
            
            //显示错误
             $this->error("添加失败，原因：".$error,U('Account/Index/index'));
            
        }
        $this->success("操作成功" , U('Account/Index/index'));    
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
             $this->error("添加失败，原因：".$error,U('Account/Index/index?',I('get.p')));

             return false;
            
        }
            $this->success("操作成功" , U('Account/Index/index?',I('get.')));
    }
    public function deleteAction(){

        $userId = I('get.id');

        $AccountM = new AccountModel();
        $status = $AccountM->deleteInfo($userId);

        if($status！==false){
           $this->success("删除成功", U('Account/Index/index?',I('get.p'))); 
        }
        else{
            $this->error("删除失败" , U('Account/Index/index?',I('get.p')));
        }
    }

}