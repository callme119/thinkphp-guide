<?php
namespace User\Controller;

use Think\Controller;
use Wjy\Model\UserModel;
use User\Logic\UserLogic;		//用户表
use User\Model\Index\indexModel;  

Class SampleController extends Controller
{
	public function indexAction()
	{
		//获取列表
        $UserM = new UserModel();
		$users = $UserM->getLists();
		echo $UserM->getLastSql();
		dump($users);

		

        $IndexModel = new indexModel();
     
        $IndexModel->setUsers($users);

        //传入列表
    	$this->assign('M',$IndexModel);
        
		$this->display();
	}

}
