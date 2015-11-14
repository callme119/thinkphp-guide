<?php
namespace Litian\Controller;

use Think\Controller;
use Litian\Logic\LitianLogic;

class IndexController extends Controller
{
    public function indexAction(){
        //取值
        $UserL = new LitianLogic();
        $Users =$UserL->getAllLists();

        //传值
        $this ->assign('users',$Users);

        //前台显示
        $this->display();
    }
    public function detailAction(){
        //取用户ID
        $userId = I('get.id');

        //抓取用户信息
        $UserL = new LitianLogic();
        $user = $UserL->getListById($userId);

        //传值
        $this->assign('user',$user);

        $this->display();
    }
    public function addAction(){

        $this->display();
    }
    public function saveAction(){
        //取用户信息
        $user=I('post.');

        //添加add
        $UserL= new LitianLogic();
        $UserL= addList($user);

        //判断异常
        if(count($errors=$UserL->getErrors())!==0)
        {
            //将数组的值转化为字符串
            $error=implode('<br/>',"$errors");

            //显示错误
            $this->error("添加失败，原因：".$error,U('Litian/Index/index'));
        }
        else
        {
            $this->success("添加成功",U('Litian/Index/index'));
        }
    }
    public function editAction(){
        //取用户ID
        $UserId=I('get.id');
        //取用户信息
        $UserL = new LitianLogic();
        $user = $UserL->getListById($UserId);
        //dump($user)
        //传值
        $this->assign('user',$user);

        //显示页面
        $this->display('edit');
    }
    public function updateAction(){
        //取用户信息
        $data = I('post.id');

        //传给M层
        $UserL = new LitianLogic();
        $UserL->saveList($data);//调用PHP的save方法

        //判断异常
        if(count($errors=$UserL->getErrors())!== 0){
            //数组变字符串
            $error = implode('<br/>',$errors);
            //显示错误
            $this->error("添加失败，原因：".$error,U('Litian/Index/index'));
            return false;
        }
        else{
            $this->success("操作成功",U('Litian/Index/index'));
        }

    }
    public function deleteAction(){
        //取ID信息
        $userId = I('get.id');

        //调用M层方法
        $UserL = new LitianLogic();
        $status = $UserL->deleteInfo($userId);

        //判断状态
        if($status !==false){
           $this->success("删除成功", U('Litian/Index/index'));
        }
        else{
            $this->error("删除失败" , U('Litian/Index/index'));
        }
    }
    // public function indexAction()
    // {
    //     $lists = array();
    //     $i = 0;

    //     do {
    //         $lists[] = rand(1, 1000);
    //     } while ( $i++ <= 20);

    //     echo "Source data is " . implode(",", $lists);
    //     echo "<br />";

    //     $QuickSortL = new LitianLogic();
    //     $lists = $QuickSortL->QuickSort($lists);

    //     echo "Sorted data is " . implode(",", $lists);
    //     echo "<br />";

    // }
}
