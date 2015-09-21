<?php

namespace Home\Controller;

use Think\Controller;

/*
 * 开放平台获取用户基本信息（unionid）
 */

class SunyuetestController extends Controller {

        private $appid = "wxf2310b20ba7d362c"; //pc开放平台appid
        private $appsecert = "43396c539e07fd12aa1f77b96b427aad"; //pc开放平台secert

        public function __construct() {
                parent::__construct();
        }

        public function get_code() {
                $codeurl = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=" . $this->wxappid . "&redirect_uri=" . urlencode($this->redirect_uri) . "&response_type=code&scope=snsapi_base&state=STATE#wechat_redirect";


                $redirect_uri = UrlEncode("http://www.renrenlie.com/Home/Sunyuetest/code_return");
                $url = "https://open.weixin.qq.com/connect/qrconnect?appid=$this->appid&redirect_uri=$redirect_uri&response_type=code&scope=snsapi_login&state=STATE#wechat_redirect";
                header("location:" . $url);
        }

        public function code_return() {
                $code = $_GET['code'];
                $url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$this->appid&secret=$this->appsecert&code=$code&grant_type=authorization_code";

                $content = file_get_contents($url);
                $conArr = $this->std_class_object_to_array(json_decode($content));
                echo "<pre>";
                var_dump($conArr);
                echo "</pre>";
                $openid = $conArr['openid'];
                $access_token = $conArr['access_token'];
                $sUserinfo = $this->get_unionid($openid, $access_token);
                $arUserinfo = $this->std_class_object_to_array(json_decode($sUserinfo));
                echo "<pre>";
                var_dump($arUserinfo);
                echo "</pre>";
        }

        public function get_unionid($openid, $access_token) {
                $url = "https://api.weixin.qq.com/sns/userinfo?access_token=$access_token&openid=$openid";
                $content = file_get_contents($url);
                return $content;
        }

        function std_class_object_to_array($stdclassobject) {
                $_array = is_object($stdclassobject) ? get_object_vars($stdclassobject) : $stdclassobject;
                foreach ($_array as $key => $value) {
                        $value = (is_array($value) || is_object($value)) ? $this->std_class_object_to_array($value) : $value;
                        $array[$key] = $value;
                }
                return $array;
        }
        
        function readlog() {
                $re = file_exists(__URL__."/wxtest.txt");
                var_dump($re);echo "<br/>";
                $txt = file_get_contents(__URL__."/wxtest.txt");
                var_dump($txt);
        }
        function get_member(){
                $arr = M("qrcodefrom")->query("select * from stj_qrcodefrom");
                echo "<pre>";var_dump($arr);echo "</pre>";
        }
        function test(){
                session_id($_COOKIE['session_id']);
                session_start();
                echo "<pre>";var_dump($_SESSION);echo "</pre>";
                echo "<pre>";var_dump($_COOKIE);echo "</pre>";
        }

}
