<?php
namespace User\Controller;

use Think\Controller;
use User\Logic\UserLogic;       //用户表
use User\Model\Index\indexModel;        //
use User\Model\Index\addModel;
use User\Model\Index\detailModel;     

class IndexController extends Controller
{
    public function indexAction(){      

        //获取列表
        $UserL = new UserLogic();
        $users = $UserL->getLists();
        
        //获取分页信息
        $page = $UserL->getPageShow();
        dump($page);
        
        //判断异常
        if(count($errors=$UserL->getErrors())!==0)
        {
            //数组变字符串
            $error = implode('<br/>', $errors);
             
            //显示错误
             $this->error("查找失败，原因：".$error,U('Home/Index/index'));

             return false;
        }

        $IndexModel = new indexModel();
        $IndexModel->setPageShow($page);
        $IndexModel->setUsers($users);
        // dump($IndexModel);
        //传入列表
        $this->assign('M',$IndexModel);
        
        //调用V层
        $this->display();
    }
    public function detailAction(){
        //取用户ID
        $userId = I('get.id');

        //抓取用户信息
        $UserL = new UserLogic();
        $user = $UserL->getListById($userId);

        $DetailModel=new detailModel();
        $DetailModel->setUser($user);


        //传值
        $this->assign('M',$DetailModel);

        $this->display();
    }
    public function addAction(){
        //显示 display
        $AddModel=new addModel();
        $this->assign('M',$AddModel);
        $this->display();
    }
    public function saveAction(){
        //取用户信息
        $user = I('post.');

        //添加 add()
        $UserL = new UserLogic();
        $UserL->addList($user);

        //判断异常
        if(count($errors=$UserL->getErrors())!==0)
        {
            //数组变字符串
            $error =implode('<br/>', $errors);
            
            
            //显示错误
             $this->error("添加失败，原因：".$error,U('User/Index/index?p='.I('get.p')));
            
        }
        $this->success("操作成功" , U('User/Index/index?p='.I('get.p')));    
    }
    public function editAction(){
        //获取用户ID
        $userId = I('get.id');

        //取用户信息 getListById()
        $UserL = new UserLogic();
        $user = $UserL->getListById($userId);

        $AddModel=new addModel();
        $AddModel->setUser($user);
        dump($AddModel);
        //传给前台
        $this->assign('M',$AddModel);
        
        //显示 display('add')
        $this->display('add'); 
    }
    public function updateAction(){
        //取用户信息
        $data = I('post.');

        //传给M层
        $UserL = new UserLogic();
        $UserL->saveList($data);

        //判断异常
        if(count($errors=$UserL->getErrors())!==0)
        {
            //数组变字符串
            $error =implode('<br/>', $errors);
            
            
            //显示错误
             $this->error("添加失败，原因：".$error,U('User/Index/index?p='.I('get.p')));

             return false;
            
        }
            $this->success("操作成功" , U('User/Index/index?p=', I('get.')));
    }
    public function deleteAction(){

        $userId = I('get.id');

        $UserL = new UserLogic();
        $status = $UserL->deleteInfo($userId);

        if($status！==false){
           $this->success("删除成功", U('User/Index/index?p='.I('get.p'))); 
        }
        else{
            $this->error("删除失败" , U('User/Index/index?p='.I('get.p')));
        }
    }
}