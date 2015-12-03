<?php
namespace Admin\Logic;

use Admin\Controller\IndexController;

class wechatMenuapiLogic extends IndexController {
	 private $access_token;
    
    public function setAccessToken($access_token){
    	$this->access_token = $access_token;
    }

    public function createMenu(){        
        $jsonmenu = 
        '{
     "button":[
     {	
          "type":"click",
          "name":"我要住店",
          "key":"hotel"
      },
      {	
          "type":"click",
          "name":"我要旅游",
          "key":"tour"
      },
      {
           "name":"看这里",
           "sub_button":[
           {	
               "type":"click",
               "name":"客房环境",
               "key" : "environment"
            },
            {
              "type":"click",
               "name":"酒店介绍",
               "key" : "description"
            },
            {
               "type":"view",
               "name":"一键导航",
               "url":"https://www.baidu.com"
            },
            {
               "type":"view",
               "name":"全景360",
               "url":"https://www.baidu.com"
            }]
      	 }]
 		}';
        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$this->access_token;
        echo "hello";
        $result = $this->https_request($url, $jsonmenu);
        var_dump($result);
        
    }
    
    private function https_request($url,$data = null){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if(!empty($data)){
        	curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
}