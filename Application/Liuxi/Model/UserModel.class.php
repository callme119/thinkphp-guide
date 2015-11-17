<?php
namespace Liuxi\Model;

use User\Model\UserModel as UserM;

class UserModel extends UserM
{
	//自动验证
	protected $_validate = array(
        array('name','','Account name already exists!',0,'unique',1),
        //在新增的时候验证name字段是否唯一

	    //array('value',array(1,2,3),'值的范围不正确！',2,'in'),
	    //当值不为空的时候判断是否在一个范围内

	    array('repassword','password','Incorrect password confirmation',0,'confirm'),
        //验证确认密码是否和密码一致
        
	    //array('password','checkPwd','密码格式不正确',0,'function'),
	    //自定义函数验证密码格式

	    array('email','email','Mailbox format is not correct',0,''),
	    //验证邮箱格式是否正确
	);
	// protected $_auto = array(
	// 	array ('status','1'),
	// 	// 新增的时候把status字段设置为1

	// 	array ('create_time','time',1,'function'),
	// 	//对createtime字段在新增的时候自动写入时间戳

	// 	array ('update_time','time',3,'function'),
	// 	//对updatetime字段在更新的时候写入当前时间戳
	// );
}