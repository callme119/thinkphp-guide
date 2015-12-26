<?php
namespace Sale\Controller;

use Think\Controller;
use Sale\Model\SaleModel;

class IndexController extends Controller
{
	public function indexAction()
	{
		$SaleM = new SaleModel();
        $sales = $SaleM->getLists();

        $SaleM->setSale($sales);
        // $SaleM->MoneyTotal0();

        $this->assign('M',$SaleM);

		$this->display();
	}

	public function addAction()
	{
		$AddModel=new addModel();

        $this->assign('M',$AddModel);
		
		$this->display();
	}

	public function editAction()
    {

        $userId=I('get.id');
        $userP=I('get.p');//传给C页号
        

        $UserM = new UserModel();
        $user =$UserM->getListById($userId);


        $this->assign('p',$userP);//传给V层页号
        $this->assign('user',$user);

        $this->display();
    }
}
