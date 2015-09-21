<?php

include_once("first.php");

/*
 * 创建菜单的类
 */

class Createmenu extends First {

        function __construct() {
                
        }

        function create_menu() {
                $access_token = $this->get_token();
                $setMenuUrl = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=" . $access_token;
                $str = '{
    "button": [
        
        {
            "name": "活动",
            "sub_button": [
                {
                    "type": "view", 
                    "name": "高薪职位 私人订制", 
                    "url": "http://www.renrenlie.com/Home/Webchatcustomized/index",
                    "sub_button": [ ]
                },
                {
                    "type": "view", 
                    "name": "上传简历 坐等收钱", 
                    "url": "http://www.renrenlie.com/Home/Webchatnew/upresume_info", 
                    "sub_button": [ ]
                }, 
                 {
                    "type": "view", 
                    "name": "猎头/HR 玩法攻略", 
                    "url": "http://www.renrenlie.com/Home/Webchatnew/qa", 
                    "sub_button": [ ]
                }
            ]
        },
        {
            "name": "推荐",
            "sub_button": [
                {
                    "type": "view", 
                    "name": "最新职位", 
                    "url": "http://www.renrenlie.com/Home/Webchatnew/job_list",
                    "sub_button": [ ]
                },
                {
                    "type": "view", 
                    "name": "收藏职位",
                    "url": "http://www.renrenlie.com/Home/Webchatnew/fav_job",
                    "sub_button": [ ]
                },
                {
                    "type": "view", 
                    "name": "正在推荐", 
                    "url": "http://www.renrenlie.com/Home/Webchatnew/recommending",
                    "sub_button": [ ]
                },
                {
                    "type": "view", 
                    "name": "历史推荐",
                    "url": "http://www.renrenlie.com/Home/Webchatnew/recommended",
                    "sub_button": [ ]
                }
            ]
        },
        {
            "name": "人人猎", 
            "sub_button": [
               
                
                {
                    "type": "view", 
                    "name": "关于人人猎", 
                    "url": "http://www.renrenlie.com/Home/Webchatnew/about_us", 
                    "sub_button": [ ]
                }, 
                {
                    "type": "view", 
                    "name": "我的账户", 
                    "url": "http://www.renrenlie.com/Home/Webchatnew/my_account", 
                    "sub_button": [ ]
                }, 
                {
                    "type": "view", 
                    "name": "退出登录", 
                    "url": "http://www.renrenlie.com/Home/Webchatlogin/logout.html", 
                    "sub_button": [ ]
                }
            ]
        }
    ]
}
';
 $sub1 = '
          {
             "type": "view", 
             "name": "获取邀请码", 
             "url": "http://www.renrenlie.com/Home/Redpackagewx/get_code", 
             "sub_button": [ ]
          }, ';
 
                $re = $this->Post($str, $setMenuUrl);
                //$re = $this -> std_class_object_to_array(json_decode($re));
                var_dump($re);
                //return $reArr;
        }

        function get_token() {
                $appID = $this->appid;
                $appsercert = $this->secert;
                $getTokenUrl = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appID&secret=$appsercert";
                $content = file_get_contents($getTokenUrl);
                //$content = '{"access_token":"Z2wNW73g-Zna9w2FpuxTcTOUIsNICvzJf7VvE20DwcBFGrxJZdkxFKeKMoRt6yzG1_6ugKVxU7li4xS1n9Ussufshx-aRmUET4uDtAVBSiE","expires_in":7200}';
                $con = $this->std_class_object_to_array(json_decode($content));
                $access_token = $con['access_token'];
                return $access_token;
        }

        function std_class_object_to_array($stdclassobject) {
                $_array = is_object($stdclassobject) ? get_object_vars($stdclassobject) : $stdclassobject;
                foreach ($_array as $key => $value) {
                        $value = (is_array($value) || is_object($value)) ? $this->std_class_object_to_array($value) : $value;
                        $array[$key] = $value;
                }
                return $array;
        }

        function Post($curlPost, $url) {
                $curl = curl_init();
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_HEADER, false);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_NOBODY, true);
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $curlPost);
                $return_str = curl_exec($curl);
                curl_close($curl);
                return $return_str;
        }

}

$ob = new Createmenu();
$ob->create_menu();
