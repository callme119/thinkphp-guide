<?php
namespace Home\Controller;
use Think\Controller;
use User\Logic\UserLogic;		//
class IndexController extends Controller
{
	public function index1Action()
	{
		//判断用户是否登陆
		$userId = I('session.userId');
		if($userId == '')
		{
			$this->success("请登录",U('Login/Index/index'));
			exit();
		}
		
		//取用户信息
		$UserL = new UserLogic();
		$user = $UserL->getListById($userId);
		
		//传值 
		$this->assign("user",$user);



		$this->display();
	}
	public function indexaAction()
	{
		//判断用户是否登陆
		$userId = I('session.userId');
		if($userId == '')
		{
			$this->success("请登录",U('Login/Index/index'));
			exit();
		}
		
		//取用户信息
		$UserL = new UserLogic();
		$user = $UserL->getListById($userId);
		
		//传值 
		$this->assign("user",$user);


		$this->display();
	}
		public function indexbAction()
	{
		//判断用户是否登陆
		$userId = I('session.userId');
		if($userId == '')
		{
			$this->success("请登录",U('Login/Index/index'));
			exit();
		}
		
		//取用户信息
		$UserL = new UserLogic();
		$user = $UserL->getListById($userId);
		
		//传值 
		$this->assign("user",$user);


		$this->display();
	}
		public function indexcAction()
	{
		//判断用户是否登陆
		$userId = I('session.userId');
		if($userId == '')
		{
			$this->success("请登录",U('Login/Index/index'));
			exit();
		}
		
		//取用户信息
		$UserL = new UserLogic();
		$user = $UserL->getListById($userId);
		
		//传值 
		$this->assign("user",$user);


		$this->display();
	}
		public function indexdAction()
	{
		//判断用户是否登陆
		$userId = I('session.userId');
		if($userId == '')
		{
			$this->success("请登录",U('Login/Index/index'));
			exit();
		}
		
		//取用户信息
		$UserL = new UserLogic();
		$user = $UserL->getListById($userId);
		
		//传值 
		$this->assign("user",$user);


		$this->display();
	}
}