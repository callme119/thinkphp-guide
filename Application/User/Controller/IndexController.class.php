<?php
namespace User\Controller;
use Think\Controller;
use User\Logic\UserLogic;		//用户表
class IndexController extends Controller
{
    public function indexAction(){
        //取值getAllLists()
    	$UserL = new UserLogic();
    	$users = $UserL->getAllLists();
        
        //传值assign()
    	$this->assign('users',$users);
        
    	//显示display()
   		$this->display();
    }
    public function detailAction(){
    	//取用户ID
    	$userId = I('get.id');

    	//抓取用户信息
    	$UserL = new UserLogic();
    	$user = $UserL->getListById($userId);

        //传值
        $this->assign('user',$user);

    	$this->display();
    }
    public function addAction(){
        //显示 display
        $this->display();
    }
    public function saveAction(){
        //取用户信息
        $user = I('post.');

        //添加 add()
        $UserL = new UserLogic();
        $status = $UserL->add($user);//$status的值是id值

        //echo $this->getLastSql();
        
        //判断状态
        if ($status！==false) {
            $this->success("操作成功" , U('User/Index/index'));
        }
        else{
            $this->error("添加失败" , U('User/Index/index'));
        }
    }
    public function editAction(){
        //获取用户ID
        $userId = I('get.id');

        //取用户信息 getListById()
        $UserL = new UserLogic();
        $user = $UserL->getListById($userId);

        //传给前台
        $this->assign('user',$user);

        //显示 display('add')
        $this->display('add'); 
    }
    public function updateAction(){
        //取用户信息
        $data = I('post.');

        //传给M层
        $UserL = new UserLogic();
        $UserL->save($data);
        $this->success("操作成功",U('User/Index/index'));
    }
    public function deleteAction(){

        $userId = I('get.id');

        $UserL = new UserLogic();
        $status = $UserL->deleteInfo($userId);

        if($status！==false){
           $this->success("删除成功", U('User/Index/index')); 
        }
        else{
            $this->error("删除失败" , U('User/Index/index'));
        }
    }
}