<?php
namespace Liuxi\Controller;
use Think\Controller;
use Liuxi\Logic\UserLogic;
class UserController extends Controller
{
    public function indexAction()
    {
        //取值getAllLists()
        $UserL = new UserLogic();
        $users = $UserL->getAllLists();
        
        //传值assign()
        $this->assign('users',$users);
        
        //显示display()
        $this->display();
    }

    public function detailAction()
    {//获取用户ID
        $userId = I('get.id');
        //取用户信息getListById()
        $UserL = new UserLogic();
        $user = $UserL->getListById($userId);
        //dump($user);
        //传值
        $this->assign('user',$user);
        $this->display();
    }

    public function addAction()
    {//显示display
        $this->display();
    }

    public function saveAction()
    {//取用户信息
        $user =I('post.');
        //添加add()
        $UserL = new UserLogic();
        $status = $UserL->add($user);//$status的值是id值
        //echo $this->getLastSql();
        
        //审判状态
        if ($status !== false)
        {
            $this->success("操作成功",U('Liuxi/User/index'));
        }
        else
        {
            $this->error("添加失败",U('Liuxi/User/index'));
        }
    }

    public function editAction()
    {//获取用户ID
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
    { //取用户信息
        $data = I('post.');
       //保存修改save()
        $UserL = new UserLogic();
        $UserL->save($data);
        //保存成功success()
        $this->success("操作成功",U('Liuxi/User/index'));
    }

    public function deleteAction()
    {//取id
        $userId= I('get.id');
       //删除deleteInfo($Id)
        $UserL = new UserLogic();
        $status = $UserL->deleteInfo($userId);
        //判断是否删除成功
        if($status !== false)
        {
            $this->success("删除成功",U('Liuxi/User/index'));
        }
        else
        {
            $this->error("删除失败",U('Liuxi/User/index'));
        }
    }

    // public function indexAction()
    // {
    //     $lists = array();
    //     $i = 0;

    //     do
    //     {
    //         $lists[] = rand(1, 1000);
    //     }
    //     while ( $i++ <= 20);

    //     echo "Source data is " . implode(",", $lists);
    //     echo "<br />";

    //     $QuickSortL = new LiuxiLogic();
    //     $lists = $QuickSortL->lxsort($lists);
    //     echo "Sorted data is " . implode(",", $lists);
    //     echo "<br />";
    // }
}


