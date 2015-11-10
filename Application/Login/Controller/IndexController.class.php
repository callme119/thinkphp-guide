<?php
namespace Login\Controller;
use Think\Controller;
use User\Logic\UserLogic;		//用户表
class IndexController extends Controller {
    public function indexAction(){
   		$this->display();
    }

    public function loginAction()
    {
    	//取用户名
    	$userName = I('post.name');

    	//抓取用户名
    	$UserL = new UserLogic();
    	$user = $UserL->getListByName($userName);

        //判断用户名是否合法
        if($user===false){
            $errors = $UserL->getErrors();
            $this->error("操作错误".'<br/>'.implode('<br/>', $errors));
            //数组变字符串 implode()
        }

    	//判断是否有些用户
    	if($user == null)
    	{
    		echo "the username is not ";
    		exit();
    	}
    	//取用户传入密码
    	$userPassword = I('post.password');

    	//判断密码正确性
    	if($userPassword != $user['password'])
    	{
    		echo "wrong password";
    		exit();
    	}

    	//seesion userId
    	session('userId',$user['id']);  

    	//跳转至首页
    	$this->success("操作成功" , U('Home/Index/index'));
    }

    public function logoutAction()
    {
    	session('userId',null); // 删除name
    	$this->success("注销成功",U('Login/Index/index'));
    }
}