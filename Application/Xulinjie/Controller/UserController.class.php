<?php
namespace Xulinjie\Controller;

use Think\Controller;
use Xulinjie\Logic\UserLogic;

class UserController extends Controller
{
    // public function indexAction()
    // {
    //     $lists = array();
    //     $relists = array();
    //     $i = 0;

    //     do {
    //         $lists[] = rand(1, 1000);
    //     } while ( $i++ <= 20);

    //     echo "Source data is " . implode(",", $lists);
    //     echo "<br />";

    //     $QuickSortL = new XulinjieLogic();
    //     $lists = $QuickSortL->quickSort($lists);
    //     $lists2 = $QuickSortL->quick_sort($lists);
    //     echo "Sorted data is " . implode(",", $lists);
    //     echo "<br />";
    //     echo "Sorted data is " . implode(",", $lists2);
    //     echo "<br />";

    // }
    public function indexAction(){
        $UserL = new UserLogic();

        //获取列表
        $users = $UserL->getLists();

        //获取分页信息
        $page = $UserL -> getPageShow();

        // //判断$page是否大于0；
        // if((int)I('get.p')>0)
        // {
        //  $page=(int)I('get.p');
        // }
        // else{
        //  $page=1;
        // }
        //判断异常
        if(count($errors=$UserL->getErrors())!==0)
        {
            //数组变字符串
            $error = implode('<br/>', $errors);
             
            //显示错误
             $this->error("查找失败，原因：".$error,U('Home/Index/index'));

             return false;    
        }
        //传入分页信息
        $this->assign('page',$page);// 赋值分页输出
        //传入列表
        $this->assign('users',$users);
        
        //调用V层
        $this->display();
    }
    public function detailAction(){
        //取用户ID
        $userId = I('get.id');

        //抓取用户信息
        $UserL = new UserLogic();
        $user = $UserL->getListById($userId);

        //传值
        $this->assign('user',$user);

        $this->display();
    }
    public function addAction(){
        //显示 display
        $this->display();
    }
    public function saveAction(){
        //取用户信息
        $user = I('post.');

        //添加 add()
        $UserL = new UserLogic();
        $UserL->addList($user);

        //判断异常
        if(count($errors=$UserL->getErrors())!==0)
        {
            //数组变字符串
            $error =implode('<br/>', $errors);
            
            
            //显示错误
             $this->error("添加失败，原因：".$error,U('User/Index/index'));
            
        }
        $this->success("操作成功" , U('User/Index/index'));    
    }
    public function editAction(){
        //获取用户ID
        $userId = I('get.id');

        //取用户信息 getListById()
        $UserL = new UserLogic();
        $user = $UserL->getListById($userId);

        //传给前台
        $this->assign('user',$user);

        //显示 display('add')
        $this->display('add'); 
    }
    public function updateAction(){
        //取用户信息
        $data = I('post.');

        //传给M层
        $UserL = new UserLogic();
        $UserL->saveList($data);

        //判断异常
        if(count($errors=$UserL->getErrors())!==0)
        {
            //数组变字符串
            $error =implode('<br/>', $errors);
            
            
            //显示错误
             $this->error("添加失败，原因：".$error,U('User/Index/index'));

             return false;
            
        }
            $this->success("操作成功" , U('User/Index/index'));
    }
    public function deleteAction(){

        $userId = I('get.id');

        $UserL = new UserLogic();
        $status = $UserL->deleteInfo($userId);

        if($status！==false){
           $this->success("删除成功", U('User/Index/index')); 
        }
        else{
            $this->error("删除失败" , U('User/Index/index'));
        }
    }
}