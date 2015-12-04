<?php
namespace User\Model\Index;

use User\Model\UserModel;
use UserPost\Model\UserPostModel;
use Post\Model\PostModel;
use UserPost\Model\UserPostViewModel;

class indexModel
{
	protected $pageShow = ""; 
	protected $users = array();
	public function setPageShow($pageShow)
	{
		$this->pageShow = (string)$pageShow;
	}

	public function getPageShow()
	{
		$pageShow = "<a href=" . U('?p=2');
	}

	public function setUsers($users)
	{
		$this->users = $users;
	}

	public function getUsers()
	{
		$UserM = new UserModel();
		$lists = $UserM->select();
		return $lists;
	}

	public function getPostsByUserId($userId)
	{
		$userId = (int)$userId;

		$UserPostViewM = new UserPostViewModel();
		$lists = $UserPostViewM->where("user_id = $userId")->select();
		// echo $UserPostM->getLastSql();
		return $lists;
	}

	public function getNameByPostId($postId)
	{
		$postId = (int)$postId;

		$PostM = new PostModel();
		$list = $PostM->where("id = $postId")->find();
		return $list['name'];
	}
}