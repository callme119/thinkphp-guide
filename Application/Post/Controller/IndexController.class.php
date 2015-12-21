<?php
namespace Post\Controller;

use Think\Controller;
use Post\Model\Index\IndexModel;
use Post\Model\Index\AddPostModel;
use Post\Model\PostModel;


class IndexController extends Controller{
	public function indexAction(){

		//获取列表
        $PostM = new PostModel();
        $posts = $PostM->getLists();
        dump($posts);

        $IndexModel=new indexModel();

        $IndexModel->setPosts($posts);

        $this->assign('M',$IndexModel);


		$this->display();
	}
        public function addAction(){
                $AddModel=new AddPostModel();
                $this->assign('M',$AddModel);
                $this->display();

        }


}