<?php
namespace User\Model;
use Think\Model;
class UserModel extends Model
{
	//自动验证
	protected $_validate = array(
     array('name','','Account name already exists！',0,'unique',1),
      // 在新增的时候验证name字段是否唯一
   
     array('repassword','password','Incorrect password confirmation',0,'confirm'), 
     // 验证确认密码是否和密码一致
 
     array('email','email','Mailbox format is not correct',0,''), 
     // 验证邮箱格式是否正确
   );	           
}