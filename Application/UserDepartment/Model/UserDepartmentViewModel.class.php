<?php 
namespace UserDepartment\Model;

use Think\Model\ViewModel;

class UserDepartmentViewModel extends ViewModel
{
	public $viewFields=array(
		'UserDepartment'=>array('id','user_id','Department_id'),
		'User'=>array('name'=>"user_name",'_on'=>'UserDepartment.user_id=User.id'),
		'Department'=>array('name'=>"department_name",'_on'=>'UserDepartment.department_id=Department.id'),
		);
}