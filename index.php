<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// weixin应用入口文件
//初始化消息回复
$wechatObj = new wechatCallbackapiLogic();

if (isset($_GET['echostr'])) {
	$wechatObj->valid();
}else{
	echo "hello";
}

class wechatCallbackapiLogic {
	//初始化
	public function valid()
	{
		$echoStr = $_GET['echostr'];
		if($this->checkSignature()){
			echo $echoStr;
			exit();
		}
	}

    //教研签名
	private function checkSignature()
	{
		$signature = $_GET['signature'];
		$timestamp = $_GET['timestamp'];
		$nonce = $_GET['nonce'];

		$token = "yunzhi";
		$tmpArr =  array($token, $timestamp,$nonce);
		sort($tmpArr);
		$tmpStr = implode($tmpArr);
		$tmpStr = sha1($tmpStr);

		if( $tmpStr == $signature){
			return true;
		}else{
			return false;
		}
	}
// 检测PHP环境
if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

// 开启调试模式 建议开发阶段开启 部署阶段注释或者设为false
define('APP_DEBUG',True);

// 定义应用目录
define('APP_PATH','./Application/');

// 引入ThinkPHP入口文件
require './ThinkPHP/ThinkPHP.php';

// 亲^_^ 后面不需要任何代码了 就是如此简单