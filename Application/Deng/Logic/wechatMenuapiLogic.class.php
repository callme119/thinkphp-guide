<?php
namespace Deng\Logic;

use Deng\Controller\IndexController;

class wechatMenuapiLogic extends IndexController {
	 private $access_token;
    
    public function setAccessToken($access_token){
    	$this->access_token = $access_token;
    }

    public function createMenus($json){        
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

        $json = '{'."\"button\":".$json.'}';
        var_dump($json);

        $url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=".$this->access_token;
        $result = $this->https_request($url, $json);
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

    public function deleteMenu(){
        $url = "https://api.weixin.qq.com/cgi-bin/menu/delete?access_token=".$this->access_token;
        $result = $this->https_request($url, $json);
        var_dump($result);
    }

    public function createJson($tree){
        
        $menus = array();
        foreach ($tree as $key => $value){
            //判断value是否含有子项数组2
            if(array_key_exists('sub_button',$value)){
                $menus[$key]['name'] = $value['name'];

                //重新排序根数组
                $child_meus = array();
                foreach ($value['sub_button'] as $k => $val) {
                  if ($val['type'] == 'click') {
                    $child_meus[$k]['type'] = $val['type'];
                    $child_meus[$k]['name'] = $val['name'];
                    $child_meus[$k]['key'] = $val['keyword'];
                  } else {
                    $child_meus[$k]['type'] = $val['type'];
                    $child_meus[$k]['name'] = $val['name'];
                    $child_meus[$k]['url'] = $val['url'];
                  }  
                }
               
                $menus[$key]['sub_button'] = $child_meus;
            }else{
              //判断是否为click类型
              if ($value['type'] == 'click') {
                $menus[$key]['type'] = $value['type'];
                $menus[$key]['name'] = $value['name'];
                $menus[$key]['key'] = $value['keyword'];
              }else{
                $menus[$key]['type'] = $value['type'];
                $menus[$key]['name'] = $value['name'];
                $menus[$key]['url'] = $value['url'];
              }       
            }
        }
        return $menus;
    }
}