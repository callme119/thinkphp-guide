<?php
namespace User\Model\Index;

// use Think\Model;
use User\Model\UserModel;
use UserPost\Model\UserPostModel;
use Post\Model\PostModel;
use UserPost\Model\UserPostViewModel;

class indexModel
{
	protected $pageShow="";
	protected $users=array();

	public function setPageShow($pageShow)
	{
		$this->pageShow=(string)$pageShow;
	}


	public function getPageShow()
	{
		$pageShow="<a href=".U('?p=2');
	}


	public function setUsers($users)
	{
		return $this->users=$users;
	}


	public function getUsers()
	{
		$UserM=new UserModel();
		$lists= $UserM->select();
		return $users;
	}


	public function getPostsByUserId($userId)
	{
		$postId=(int)$postId;
		$PostM=new PostModel();
		$list=$PostM->where("id=$postId")->find();
		return $list['name'];
	}
}