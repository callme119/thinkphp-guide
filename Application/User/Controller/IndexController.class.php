<?php
namespace User\Controller;

use Think\Controller;
use User\Logic\UserLogic;       //用户表
use User\Model\Index\indexModel;        //
use User\Model\Index\addModel;
use User\Model\Index\detailModel;    
use UserPost\Model\UserPostModel; 
use UserDepartment\Model\UserDepartmentModel;

class IndexController extends Controller
{
    public function indexAction(){      

        //获取列表
        $UserL = new UserLogic();
        $users = $UserL->getLists();
        
        //判断异常
        if(count($errors=$UserL->getErrors())!==0)
        {
            //数组变字符串
            $error = implode('<br/>', $errors);
             
            //显示错误
             $this->error("查找失败，原因：".$error,U('Home/Index/index'));

             return false;
        }

        $IndexModel = new indexModel();
        
        $IndexModel->setUsers($users);
        // dump($users);
        //传入列表
        $this->assign('M',$IndexModel);
        
        //调用V层
        $this->display();
    }
    public function detailAction(){
        //取用户ID
        $userId = I('get.id');

        //抓取用户信息
        $UserL = new UserLogic();
        $user = $UserL->getListById($userId);

        $DetailModel=new detailModel();
        $DetailModel->setUser($user);


        //传值
        $this->assign('M',$DetailModel);

        $this->display();
    }
    public function addAction(){
        //显示 display
        $AddModel=new addModel();
        $this->assign('M',$AddModel);
        $this->display();
    }
    public function saveAction(){
        //取用户信息
        $user = I('post.');
        
        //添加用户信息
        $UserL = new UserLogic();
        $currentId=$UserL->addList($user);

        //添加用户岗位
        $UserPostModel= new UserPostModel();
        $userpost['user_id']=$currentId;
        $userpost['post_id']=$user['level'];
        $UserPostModel->addList($userpost);

        //添加用户部门
        $UserDepartmentModel=new UserDepartmentModel();
        $userdepartment['user_id']=$currentId;
        $userdepartment['department_id']=$user['dep_id'];
        $UserDepartmentModel->addList($userdepartment);


        //判断异常
        if(count($errors=$UserL->getErrors())!==0)
        {
            //数组变字符串
            $error =implode('<br/>', $errors);
            
            
            //显示错误
             $this->error("添加失败，原因：".$error,U('User/Index/index?',I('get.p')));
            
        }
        $this->success("操作成功" , U('User/Index/index?',I('get.p')));    
    }
    public function editAction(){
        //获取用户ID
        $userId = I('get.id');

        //取用户信息 getListById()
        $UserL = new UserLogic();
        $user = $UserL->getListById($userId);

        $AddModel=new addModel();
        $AddModel->setUser($user);
        
        //传给前台
        $this->assign('M',$AddModel);
        
        //显示 display('add')
        $this->display('add'); 
    }
    public function updateAction(){

        //取用户信息
        $data = I('post.');
        
        //更新用户信息
        $UserL = new UserLogic();
        $currentId=$UserL->saveList($data);

        //更新用户岗位信息
        $UserPostModel= new UserPostModel();
        $map['user_id'] = I('get.id');
        $userpost = $UserPostModel->where($map)->find();
        $userpost['post_id'] = $data['level'];
        $UserPostModel->saveList($userpost);


        //更新用户部门信息
        $UserDepartmentModel=new UserDepartmentModel();
        $map['user_id']=I('get.id');
        $userdepartment=$UserDepartmentModel->where($map)->find();
        $userdepartment['department_id']=$data['dep_id'];
        $UserDepartmentModel->saveList($userdepartment);

        //判断异常
        if(count($errors=$UserL->getErrors())!==0)
        {
            //数组变字符串
            $error =implode('<br/>', $errors);
            
            
            //显示错误
             $this->error("添加失败，原因：".$error,U('User/Index/index?',I('get.p')));

             return false;
            
        }
            $this->success("操作成功" , U('User/Index/index?',I('get.')),2);
    }
    public function deleteAction(){

        $userId = I('get.id');

        $UserL = new UserLogic();
        $status = $UserL->deleteInfo($userId);

        if($status！==false){
           $this->success("删除成功", U('User/Index/index?',I('get.p'))); 
        }
        else{
            $this->error("删除失败" , U('User/Index/index?',I('get.p')));
        }
    }
}