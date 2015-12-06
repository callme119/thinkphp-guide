<?php
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


	if(version_compare(PHP_VERSION,'5.3.0','<'))  die('require PHP > 5.3.0 !');

	define('APP_DEBUG',true);

//define('BIND_MODULE','Login');


// 定义应用目录
	define('APP_PATH','./../Application/');

	define('RUNTIME_PATH','./../Runtime/');
// 引入ThinkPHP入口文件
	require './../ThinkPHP/ThinkPHP.php';