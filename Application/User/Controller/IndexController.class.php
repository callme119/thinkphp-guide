<?php
namespace User\Controller;
use Think\Controller;
use User\Logic\UserLogic;		//用户表
class IndexController extends Controller
{
    public function indexAction(){
    	$UserL = new UserLogic();
    	$users = $UserL->getAllLists();
        $users = $this->_addurl($users,"_url");

    	$this->assign('users',$users);
    	
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
    public function saveAction(){
        //取用户信息
        //传给M层
        $UserL = new UserLogic();
        $status = $UserL->add();
        dump($status);
        exit();
        if ($status==true) {
            $this->sussess("操作成功",U('User/Index/index'));
        }
        else{
            $this->error("添加失败");
        }
    }
    public function updateAction(){
        //取用户ID
        $userId = I('post.id');
        //取用户信息
        $user = I('post.');
        dump($user);
        //传给M层
        $UserL = new UserLogic();
        $status = $UserL->save($userId,$user);
        if ($status=true) {
            $this->sussess("操作成功",U('User/Index/index'));
        }
        else{
            $this->error("添加失败");
        }
    }
    public function deleteAction(){
        $id = I('get.id');
        $UserL = new UserLogic();
        $status = $UserL->delete($userId);
        if($status){
           $this->success('删除成功', U('User/Index/index')); 
        }
    }
    /**
     * 添加url信息
     * @param  [type] 要添加的数组
     * @param  [type] 要填写的下标名
     * @return [type] 拼接好url信息的数组
     */
    private function _addurl($array,$string){
        $data = $array;
        foreach ($data as $key => $value) {
            $data[$key][$string] = array(
                'edit'=>U('edit?id='.$value['id']),
                'delete'=>U('delete?id='.$value['id']),
                'detail'=>U('detail?id='.$value['id']),
                );
        }
        return $data;
    }
}