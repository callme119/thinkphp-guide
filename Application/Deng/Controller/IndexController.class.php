<?php
namespace Deng\Controller;

use Think\Controller;
use Deng\Logic\wechatInterfaceapiLogic;
use Deng\Logic\wechatMenuapiLogic;
use Deng\Logic\CustomMenuLogic;
use Deng\Model\Index\IndexModel;
use Deng\Model\Index\addModel;

class IndexController extends Controller {
 
    //将后台数据替换前台菜单
    public function createMenuAction(){
        //获取access_token
        $appid = C("APPID");
        $appsecret = C("APPSECRET");
        $wechatInterface = new wechatInterfaceapiLogic();
        $access_token = $wechatInterface->getAccessToken($appid,$appsecret);

        //将数组重排成树
        $MenuL = new CustomMenuLogic();
        $lists = $MenuL->getLists();

        $tree = list_to_tree($lists,'id','pid','sub_button');
                
        $menus = array();
        $wechatMenu = new wechatMenuapiLogic();

        $wechatMenu->setAccessToken($access_token);
        $wechatMenu->deleteMenu();
        
        //将树转换成json格式的树
        $array = $wechatMenu->createJson($tree);
        
        //将数组转化成符合要求的json数据
        $json = my_json_encode('text',$array);
        $wechatMenu->createMenus($json);

    }

   //自定义菜单查询
   public function indexAction(){
   		  $MenuL = new CustomMenuLogic();

        //获取列表
        $menu = $MenuL->getLists();

        $MenuM = new IndexModel();
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

        $MenuM = new addModel();
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
   		$MenuM = new addModel();
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