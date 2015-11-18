<?php
namespace Zhangjiahao\Controller;

use Think\Controller;
use Zhangjiahao\Logic\UserLogic

class UserController extends Controller
{
   public function indexAction()
   {
   	$UserL = new UserLogic();
   	$Users = UserL->getAllLists();
    $Page = $UserL->getPageShow();
    if(count($errors = $UserL->gerErrors())!==0)
    {
    	$errors = implode("</br>",$errors);
    	$this->error("操作失败，原因是".U('Zhangjiahao\User\Index'));
    	return false;
    }
    $this->assign('page',"$Page");
    $this->assign('users',"$Users");
    $this->display();
   } 
   public function addAction()
   {
   	$this->display("edit");
   }
   public function saveAction()
   {
   	$user = I('post.');
   	$UserL = new UserLogic();
   	$UserL -> addlist()
   }
   if(count($errors=$UserL->getErrors())!==0)
   {
   	$error = implpde("</br>","$errors");
   	$this -> error("添加失败，原因是".$errors,U('Zhangjiahao/User/index?p='.I('get.p')));
   }
   else
   	{
        $this->success("添加成功",U('Zhangjiahao/User/index?p='.I('get.p')));
    }
  }

   public function editAction(){
       $UserId=I('get.id');     
        $UserL = new UserLogic();
        $user = $UserL->getListById($UserId);
        $this->assign('user',$user);
        $this->display('edit');
    }
    public function updateAction()
    {
        $data = I('post.id');
        $UserL = new UserLogic();
        $UserL->saveList($data);
        if(count($errors=$UserL->getErrors())!== 0)
        {
            $error = implode('<br/>',$errors);
           $this->error("操作失败，原因：".$error,U('Zhangjiahao/User/index?p='.I('get.p')));
            return false;
        }
        else
        {
            $this->success("操作成功",U('Zhangjiahao/User/index?p='.I('get.p')));
        }

    }
    public function deleteAction()
    {
        $userId = I('get.id');
        $UserL = new UserLogic();
        $status = $UserL->deleteInfo($userId);
        if($status !==false)
        {
           $this->success("删除成功", U('Zhangjiahao/User/index?p='.I('get.p')));
        }
        else
        {
            $this->error("删除失败" , U('Zhangjiahao/User/index?p='.I('get.p')));
        }
    }
 }