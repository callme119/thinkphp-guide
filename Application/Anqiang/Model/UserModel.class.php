<?php
namespace Anqiang\Model;

use User\Model\UserModel as UserM;

class UserModel extends UserM
{
	protected $_valicate = array(
		array('name','','用户名已存在',0,'unique',3),//始终验证用户名是否唯一
		array('repassword','password','两次密码输入不一致',0,'confirm',3),//验证“确认密码”是否正确
		array('email','email','邮箱格式不正确'),//验证邮箱
		);
}