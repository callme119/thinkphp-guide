<?php
namespace User\Controller;

use Think\Controller;
use Wjy\Model\UserModel;

Class SampleController extends Controller
{
	public function indexAction()
	{
		$UserM = new UserModel();
		$users = $UserM->getLists();
		dump($users);
		$this->display();
	}

}
