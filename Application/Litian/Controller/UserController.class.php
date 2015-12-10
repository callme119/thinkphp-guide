<?php
namespace Litian\Controller;

use Think\Controller;
use Litian\Logic\UserLogic;
use Litian\Model\User\IndexModel;
use Yunzhi\Model\YunzhiModel as YunzhiM;

class UserController extends Controller
{
    public function indexAction(){
        //实例化
        $UserL = new UserLogic();
        // 获取所有信息列表
        $Users = $UserL->getAllLists();
        // 获取分页信息
        $page = $UserL -> getPageShow();
        // 判断异常
        if(count($errors=$UserL->getErrors())!==0){
            $error = implode("<br/>",$errors);
            // 显示错误信息
            $this->error("操作失败,原因".U('Litian\User\Index'));
            return false;
        }
        // 传入用户
        $IndexM = new IndexModel();
        $IndexM->setUsers($users);
        //传入分页信息
        $UserM = new YunzhiM();
        $users = $UserM->getLists();
        // 传入所有列表
        $this ->assign('M',$IndexM);

        //前台显示
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

        $this->display("edit");
    }
    public function saveAction(){
        //取用户信息
        $user=I('post.');
        // dump($user);
        // exit();
        //添加add
        $UserL= new UserLogic();
        $UserL-> addList($user);
        // dump($userL);
        //判断异常
        if(count($errors=$UserL->getErrors())!==0)
        {
            //将数组的值转化为字符串
            $error=implode('<br/>',"$errors");

            //显示错误
            $this->error("添加失败，原因：".$error,U('Litian/User/index?p='.I('get.p')));
        }
        else
        {
            $this->success("添加成功",U('Litian/User/index?p='.I('get.p')));
        }
    }
    public function editAction(){
        //取用户ID
        $UserId=I('get.id');
        //取用户信息
        $UserL = new UserLogic();
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
        $UserL = new UserLogic();
        $UserL->saveList($data);//调用PHP的save方法

        //判断异常
        if(count($errors=$UserL->getErrors())!== 0){
            //数组变字符串
            $error = implode('<br/>',$errors);
            //显示错误
            $this->error("操作失败，原因：".$error,U('Litian/User/index?p='.I('get.p')));
            return false;
        }
        else{
            $this->success("操作成功",U('Litian/User/index?p='.I('get.p')));
        }

    }
    public function deleteAction(){
        //取ID信息
        $userId = I('get.id');

        //调用M层方法
        $UserL = new UserLogic();
        $status = $UserL->deleteInfo($userId);
        // echo $status;
        // 判断状态
        if($status !==false){
           $this->success("删除成功", U('Litian/User/index?p='.I('get.p')));
        }
        else{
            $this->error("删除失败" , U('Litian/User/index?p='.I('get.p')));
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
