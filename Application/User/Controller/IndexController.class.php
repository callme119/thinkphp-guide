<?php
namespace User\Controller;
use Think\Controller;
use User\Logic\UserLogic;		//用户表
class IndexController extends Controller
{
    public function indexAction(){
        //取值
    	$UserL = new UserLogic();
    	$users = $UserL->getAllLists();

        //传值
    	$this->assign('users',$users);
        
    	//显示
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
        $this->display();
    }
    public function saveAction(){
        //取用户信息
        $user = I('post.');

        //传给M层
        $UserL = new UserLogic();
        $status = $UserL->add($user);
        //echo $this->getLastSql();
        
        //判断状态
        if ($status==true) {
            $this->success("操作成功" , U('User/Index/index'));
        }
        else{
            $this->error("添加失败" , U('User/Index/index'));
        }
    }
    public function editAction(){
        //获取用户ID
        $userId = I('get.id');

        //传给M
        $UserL = new UserLogic();
        $user = $UserL->getListById($userId);

        //传给前台
        $this->assign('user',$user);

        $this->display('add');
       
    }
    public function updateAction(){
        //取用户信息
        $data = I('post.');

        //传给M层
        $UserL = new UserLogic();
        $status = $UserL->save($data);
        //传值
        if ($status=true) {
            $this->success("操作成功",U('User/Index/index'));
        }
        else{
            $this->error("修改失败" , U('User/Index/index'));
        }
    }
    public function deleteAction(){

        $userId = I('get.id');

        $UserL = new UserLogic();
        $status = $UserL->deleteInfo($userId);

        if($status){
           $this->success("删除成功", U('User/Index/index')); 
        }
        else{
            $this->error("删除失败" , U('User/Index/index'));
        }
    }
}