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

        $IndexModel=new indexModel();

        $IndexModel->setAccount($accounts);

        $this->assign('M',$IndexModel);


		$this->display();
	}
    public function addAction(){
        //显示 display
        $AddModel=new AddModel();
        $this->assign('M',$AddModel);
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
             $this->error("添加失败，原因：".$error,U('Account/Index/index'),100);
            
        }
        $this->success("操作成功" , U('Account/Index/index'));    
    }

}