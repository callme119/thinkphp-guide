<?php
namespace Deng\Controller;

use Think\Controller;
use Deng\Logic\wechatInterfaceapiLogic;
use Deng\Logic\wechatMenuapiLogic;
use Deng\Logic\CustomMenuLogic;
use Deng\Model\CustomMenuModel;

class IndexController extends Controller {
   public function createMenu(){
   	//调用微信接口获取access_token等基本信息
		$appid = C("APPID");
		$appsecret = C("APPSECRET");
		$wechatInterface = new wechatInterfaceapiLogic();
		$access_token = $wechatInterface->getAccessToken($appid,$appsecret);

		//创建菜单
		$wechatMenu = new wechatMenuapiLogic();
		$wechatMenu->setAccessToken($access_token);
		$wechatMenu->createMenu();
   }

   //自定义菜单查询
   public function indexAction(){
   		$MenuL = new CustomMenuLogic();

        //获取列表
        $menu = $MenuL->getLists();

        $MenuM = new CustomMenuModel();
        $MenuM->setMenus($menu);

        //传入列表
    	$this->assign('M',$MenuM);
        
    	//调用V层
   		$this->display();
   }

   //自定义菜单修改
   public function editAction(){
   	 	//获取菜单ID
        $menuId = I('get.id');

        //取菜单信息，并且将pid换位上级菜单名称
        $MenuL = new CustomMenuLogic();
		$menu = $MenuL->getListById($menuId);
		$menu['pid'] = $MenuL->getListById($menu['pid'])['title'];

        $MenuM = new CustomMenuModel();
        $MenuM->setMenu($menu);

        //传入列表
    	$this->assign('M',$MenuM);

        //显示 display('add')
        $this->display('add'); 
   }

   //自定义菜单更新
   public function updateAction(){
   		 //取用户信息
        $data = I('post.');

        //传给M层
        $MenuL = new CustomMenuLogic();
        $MenuL->saveList($data);

        //判断异常
        if(count($errors=$MenuL->getErrors())!==0)
        {
            //数组变字符串
            $error =implode('<br/>', $errors);
            
            
            //显示错误
             $this->error("添加失败，原因：".$error,U('User/Index/index'));

             return false;
            
        }
            $this->success("操作成功" , U('User/Index/index'));
   }
   //自定义菜单添加
   public function addAction(){
   		$MenuL = new CustomMenuLogic();
   		$titles = $MenuL->getTitles();

        //传入列表
   		$MenuM = new CustomMenuModel();
   		$MenuM->setTitles($titles);
    	$this->assign('M',$MenuM);

   		//显示 display
        $this->display();
   }

   //自定义菜单保存
   public function saveAction(){
   		 //取用户信息
        $menu = I('post.');

        //添加 add()
        $MenuL = new CustomMenuLogic();
        $MenuL->addList($menu);

        //判断异常
        if(count($errors=$MenuL->getErrors())!==0)
        {
            //数组变字符串
            $error =implode('<br/>', $errors);
            
            
            //显示错误
            $this->error("添加失败，原因：".$error,U('User/Index/index'));
            
        }
        $this->success("操作成功" , U('index'));
   }

   //自定义菜单删除
   public function deleteAction(){
   		$menuId = I('get.id');

        $MenuL = new CustomMenuLogic();
        $status = $MenuL->deleteInfo($menuId);

        if($status！==false){
           $this->success("删除成功", U('index')); 
        }
        else{
            $this->error("删除失败" , U('index'));
        }
   }
}