<?php 
namespace UserPost\Model;

use Think\Model\ViewModel;

class UserPostViewModel extends ViewModel
{
	public $viewFields=array(
		'UserPost'=>array('id','user_id','post_id'),
		'User'=>array('name'=>"user_name",'_on'=>'UserPost.user_id=User.id'),
		'Post'=>array('name'=>"post_name",'_on'=>'UserPost.post_id=Post,id'),

		);
}

 ?>