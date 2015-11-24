<?php
namespace Anqiang\Model;

use User\Model\UserModel as UserM;

class UserModel extends UserM
{
	protected $_validate = array(
     array('name','','此用户名已存在',1,'unique'),// 在新增的时候验证name字段是否唯一

     array('name','require','用户名必填',1),

     array('name','yunzhi','用户名不能为云智',1,'notequal'),

     array('password','require','密码必填',1),
   
     array('repassword','password','两次密码输入不一致',0,'confirm'), // 验证确认密码是否和密码一致
 
     //array('email','email','邮箱格式不正确',0,'regex'), // 验证邮箱格式是否正确。。。规则怎么定义？
   );

		protected $_auto = array(
			array('update_time','time',2,'function'),
			array('create_time','time',1,'function'),
			array('state','1'),
			);
}