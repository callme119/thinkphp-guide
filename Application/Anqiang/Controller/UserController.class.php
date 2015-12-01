<?php
namespace Anqiang\Controller;

use Think\Controller;
use Anqiang\Logic\UserLogic;

class UserController extends Controller
{
    //快速排序的使用
    // public function sortAction()
    // {
    //     $lists = array();
    //     $i = 0;

    //     do {
    //         $lists[] = rand(1, 1000);
    //     } while ( $i++ <= 20);

    //     echo "Source data is " . implode(",", $lists);
    //     echo "<br />";

    //     $QuickSortL = new UserLogic();
    //     $lists = $QuickSortL->quickSort($lists);
    //     dump($lists);

    //     echo "Sorted data is " . implode(",", $lists);
    //     echo "<br />";

    // }

    //用户管理
    public function indexAction()
    {
        $UserL=new UserLogic();//实例化
        //$Users=$UserL->getAllLists();//对象调用方法再赋给$Users
        $users=$UserL->getLists();

        $page=$UserL->getPageShow();
        //进行判断
        if(count($errors=$UserL->getErrors())!==0)
        {
            //数组变字符串
            $error=implode('<br/>',$errors);

            //显示错误
            $this->error("查找失败，原因:".$error,U('Anqiang/User/index'));
            
        }


        
        $this->assign('page',$page);//传入分页信息

        //传值
        $this->assign('users',$users);//将Users给模板

        //展示页面
        $this->display();
    }




    //个人详细信息
    public function detailAction()
    {
        $userId=I('get.id');

        $UserL=new UserLogic();
        $user=$UserL->getListById($userId);

        $this->assign('user',$user);//传参数

        //显示
        $this->display();
    }

    //添加用户
    public function addAction()
    {
        $userP=I('get.p');//传给C层页号
        $this->assign('p',$userP);//传给V层页号
        $this->display('edit');

    }

    //添加用户进行保存
    public function saveAction()
    {
        $user=I('post.');

        $UserL=new UserLogic();
        $UserL->addList($user);//调用新增L层addList方法
        

        if(count($errors=$UserL->getErrors())!==0)
        {
            $error=implode('<br/>',$errors);
            $this->error("添加失败，原因：".$error,U('Anqiang/User/index?p='.I('post.p')));
        }
        else
        {
            $this->success("添加成功",U('Anqiang/User/index?p='.I('post.p')));
        }
    }

    //编辑
    public function editAction()
    {

        $userId=I('get.id');
        $userP=I('get.p');//传给C页号
        

        $UserL=new UserLogic();
        $user =$UserL->getListById($userId);


        $this->assign('p',$userP);//传给V层页号
        $this->assign('user',$user);

        $this->display();
    }

    //编辑后保存更新
    public function updateAction()
    {
        //获得id
        $data=I('post.');
        //实例化
        $UserL=new UserLogic();
        $UserL->saveList($data);//新增L层saveList方法

        if(count($errors=$UserL->getErrors())!==0)
        {
            $error=implode('<br/>',$errors);
            

            $this->error("添加失败，原因：".$error,U('Anqiang/User/index?p='.I('post.p')));
            
        }
        else
        {   
            
            
            $this->success("操作成功",U('Anqiang/User/index?p='.I('post.p')));
        }
    }

    //删除用户信息
    public function deleteAction()
    {
        $userId=I('get.id');

        $UserL=new UserLogic();

        $status=$UserL->deleteInfo($userId);

        if($status!==false)
        {
            $this->success("删除成功",U('Anqiang/User/index?p='.$p));
        }
        else
        {
            $this->error("删除失败",U('Anqiang/User/index?p='.$p));
        }

    }
}
