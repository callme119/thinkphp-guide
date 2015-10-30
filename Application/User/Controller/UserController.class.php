<?php
namespace User\Controller;
use Think\Controller;
use User\Logic\UserLogic;		//用户表
class IndexController extends Controller
{
    public function indexAction(){
    	$UserL = new UserLogic();
    	$users = $UserL->getAllLists();

    	$this->assign('users',$users);
    	
   		$this->display();
    }
}