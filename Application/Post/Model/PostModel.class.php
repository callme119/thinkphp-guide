<?php
namespace Post\Model;

use Yunzhi\Model\YunzhiModel;

class PostModel extends YunzhiModel{

	protected $id=0;
	protected $postName="";
	protected $post=array();

	public function setPost($post)
	{
		$this->post=$post;
	}

	public function getPostId()
	{
		return $this->post['id'];
	}

	public function getPostName()
	{
		return $this->post['name'];
	}
	
}