<?php
namespace Zhangjiahao\Model;

use User\Model\UserModel as UserM;

class UserModel extends UserM
{
    protected $_validate = array(
     array('name','','Account name already exists！',0,'unique',1),
       array('repassword','password','Incorrect password confirmation',0,'confirm'),
     array('email','email','Mailbox format is not correct',0,''),    
   );
   protected $_auto = array (
         array('status','1'),  
         array('create_time','time',1,'function'),
         array('update_time','time',3,'function'),
     );
}
