<?php
namespace Post\Model\Index;

use Post\Model\PostModel;

class AddPostModel
{
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