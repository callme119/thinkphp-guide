<?php
namespace User\Model\Index;

use User\Model\UserModel;
use UserPost\Model\UserPostModel;
use Post\Model\PostModel;
use UserPost\Model\UserPostViewModel;

class indexModel
{
	protected $users = array();

	public function setUsers($users)
	{
		$this->users = $users;
	}

	public function getUsers()
	{
		
		return $this->users;
	}

	public function getPostsByUserId($userId)
	{
		$userId = (int)$userId;

		$UserPostViewM = new UserPostViewModel();
		$lists = $UserPostViewM->where("user_id = $userId")->select();
		 // echo $UserPostViewM->getLastSql();
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