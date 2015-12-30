<?php
namespace Department\Controller;

use Think\Controller;
use Department\Model\Index\IndexModel;
use Department\Model\DepartmentModel;

class IndexController extends Controller{
	public function indexAction(){

		//获取列表
        $DepartmentModel = new DepartmentModel();
        $departments = $DepartmentModel->getLists();
        
        $IndexModel=new indexModel();

        $IndexModel->setDepartments($departments);

        $this->assign('M',$IndexModel);


		$this->display();
	}
        public function addAction(){
                $DepartmentModel=new DepartmentModel();
                $this->assign('M',$DepartmentModel);
                $this->display();
        }


}