<?php
namespace Liuxi\Controller;
use Think\Controller;
use Liuxi\Logic\UserLogic;
use Weijingyun\Logic\UserLogic;
use Litian\Logic\UserLogic;
use Denghaoyang\Logic\UserLogic;
use Zhangjiahao\Logic\UserLogic;
use Anqiang\Logic\UserLogic;
use Xulinjie\Logic\UserLogic;
class UserController extends Controller
{
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

    public function indexAction()
    {
        //取值getAllLists()
        $UserL = new LiuxiLogic();
        $users = $UserL->getAllLists();
        
        //判断异常
        // if(count($errors=$UserL->getErrors())!==0)
        // {
        //     //数组变字符串
        //     $error =implode('<br/>', $errors);
             
        //     //显示错误
        //      $this->error("查找失败，原因：".$error,U('Home/Index/index'));

        //      return false;    
        // }
        
        //传值assign()
        $this->assign('users',$users);
        
        //显示display()
        $this->display();
    }
}

