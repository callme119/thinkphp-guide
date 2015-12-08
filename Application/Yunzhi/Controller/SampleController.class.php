<?php
namespace Yunzhi\Controller;

use Think\Controller;
use Yunzhi\Model\UserModel;

Class SampleController extends Controller
{
	public function indexAction()
	{
		$UserM = new UserModel();
		//$users = $UserM->getLists();
		dump($users);
		$this->display();
	}

}
