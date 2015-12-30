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

    	//判断是否有此用户
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
        
       
        if($user['level']==1||$user['level']==2)
    	   {$this->success("操作成功" , U('Home/Index/index?a=1'));}
        else    
        {
            if($user['dep_id']==1)
            $this->success("操作成功",U('Home/Index/indexa?a=1'));
            if($user['dep_id']==2)
            $this->success("操作成功",U('Home/Index/indexb?a=2'));
            if($user['dep_id']==3)
            $this->success("操作成功",U('Home/Index/indexc?a=3'));
            if($user['dep_id']==4)
            $this->success("操作成功",U('Home/Index/indexd?a=4'));
        }

       
    }

    public function logoutAction()
    {
    	session('userId',null); // 删除name
    	$this->success("注销成功",U('Login/Index/index'));
    }
}