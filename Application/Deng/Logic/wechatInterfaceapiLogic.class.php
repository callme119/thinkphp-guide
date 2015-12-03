<?php
namespace Admin\Logic;

use Admin\Controller\IndexController;

class wechatInterfaceapiLogic extends IndexController {
	 public function getAccessToken($appid, $appsecret){

        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$appsecret;

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        $jsoninfo = json_decode($output, true);
        return $jsoninfo['access_token'];
    }
}