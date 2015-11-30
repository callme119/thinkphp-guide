<?php
namespace Liuxi\Controller;

use Think\Controller;

use Liuxi\Logic\UserLogic;

class UserController extends Controller
{
    public function indexAction()
    {
              //获取列表
        $UserL = new UserLogic();
        $users = $UserL->getLists();
        //获取分页信息
        //dump($users);
        $page = $UserL->getPageShow();

        if (count ($error = $UserL->getErrors())!==0)
        {
            //数组变字符串
            $error = implode('<br/>',$errors);

            //显示错误
            $this->error("查找失败，原因：".$error,U('Home/Index/index'));
            return false;
        }

        //传入分页信息
        $this->assign('page',$page);//赋值分页输出

        //传入列表
        $this->assign('users',$users);

        //调用v层
        $this->display();
    }

    public function detailAction()
    {
        //获取用户ID
        $userId = I('get.id');
        //取用户信息getListById()
        $UserL = new UserLogic();
        $user = $UserL->getListById($userId);
        
        //传值
        $this->assign('user',$user);
        $this->display();
    }

    public function addAction()
    {
        //显示display
        $this->display();
    }

    public function saveAction()
    {
        //取用户信息
        $user =I('post.');
        //添加add()
        $UserL = new UserLogic();
        $UserL->addList($user);

        //echo $this->getlastsql();

        //判断异常
        if(count($errors = $UserL->getErrors())!==0)
        {
            //dump($errors);
            //exit();
            //数组变字符串
            $error = implode('<br/>',$errors);

            //显示错误
            $this->error("添加失败，原因：".$error,U('Liuxi/User/index?p ='.I('get.p')));
        }
        else
        {
            $this->success("操作成功",U('Liuxi/User/index?p ='.I('get.p')));
        }
    }

    public function editAction()
    {
        //获取用户ID
        $userId = I('get.id');
        //取用户信息getListById()
        $UserL = new UserLogic();
        $user = $UserL->getListById($userId);
        //传给前台
        $this->assign('user',$user);
        //显示display('add')
        $this->display('add');
    }

    public function updateAction()
    {
        //取用户信息
        $data = I('post.');
        //保存修改save()
        $UserL = new UserLogic();
        $UserL->saveList($data);

        //判断异常
        if(count($errors = $UserL->getErrors())!==0)
        {
            //数组变字符串
            $error = implode('<br/>',$errors);

            //显示错误
            $this->error("添加失败，原因：".$error,U('Liuxi/User/index?p='.I('get.p')));
        }
        else
        {
            //保存成功success()
            $this->success("操作成功",U('Liuxi/User/index?p='.I('get.p')));
        }
    }

    public function deleteAction()
    {
        //取id
        $userId= I('get.id');
        //删除deleteInfo($Id)
        $UserL = new UserLogic();
        $status = $UserL->deleteInfo($userId);
        //判断是否删除成功
        if($status!==false)
        {
            $this->success("删除成功",U('Liuxi/User/index?p='.I('get.p')));
        }
        else
        {
            $this->error("删除失败",U('Liuxi/User/index?p='.I('get.p')));
        }
    }
}


