<?php
namespace Post\Model\Index;

use Post\Model\Postmodel;

class indexModel 
{
	protected $posts=array();

	public function setPosts($posts)
	{
		$this->posts=$posts;
	}

	public function getPosts()
	{
		return $this->posts;
	}
}

